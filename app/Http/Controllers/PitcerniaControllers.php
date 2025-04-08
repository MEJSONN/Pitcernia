<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PitcerniaControllers extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('type')) {
            $query->whereIn('type', $request->input('type'));
        }

        if ($request->has('size')) {
            $query->whereIn('size', $request->input('size'));
        }

        if ($request->has('ingredient')) {
            $ingredients = array_slice($request->input('ingredient', []), 0, 6);
            $query->where(function ($q) use ($ingredients) {
                foreach ($ingredients as $ingredient) {
                    $q->where('ingredients', 'LIKE', '%' . $ingredient . '%');
                }
            });
        }

        if ($request->has('min_price') && !empty($request->input('min_price'))) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('max_price') && !empty($request->input('max_price'))) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->orWhere('ingredients', 'LIKE', "%$search%")
                    ->orWhere('price', 'LIKE', "%$search%")
                    ->orWhere('size', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%");
            });
        }

        $data = $query->get();

        return view('pitcernia.index', compact('data'));
    }

    public function basket()
    {
        return view('pitcernia.basket');
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('customer_id', $user->id)->get();
        return view('pitcernia.orders', compact('orders'));
    }

    public function admin()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(404);
        }
        
        $users = User::all();
        $orders = Order::with('user')->get(); // wszystkie zamówienia

        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $yearBack = Carbon::now()->subMonths(12);

        $todayOrders = $orders->filter(fn($order) => $order->created_at->isSameDay($today));
        $todayTotal = $todayOrders->where('status', '!=', 5)->sum('total_price');
        $monthTotal = $orders->filter(fn($o) => $o->created_at->greaterThanOrEqualTo($monthStart) && $o->status != 5)->sum('total_price');
        $yearTotal = $orders->filter(fn($o) => $o->created_at->greaterThanOrEqualTo($yearBack) && $o->status != 5)->sum('total_price');

        return view('pitcernia.admin', compact(
            'users',
            'orders',
            'todayOrders',
            'todayTotal',
            'monthTotal',
            'yearTotal'
        ));
    }
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);
    
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
    
        return back()->with('success', 'Rola użytkownika została zmieniona.');
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Musisz być zalogowany, aby dodać do koszyka.'
            ], 401);
        }

        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true, 'message' => 'Dodano do koszyka']);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function submitOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Musisz być zalogowany, aby złożyć zamówienie.');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Koszyk jest pusty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $user = Auth::user();

        Order::create([
            'customer_id' => $user->id,
            // 'address' => $user->city . ', ' . $user->street . ' ' . $user->house_number,
            'items' => $cart,
            'total_price' => $total,
            'status' => 1,
        ]);

        session()->forget('cart');
        return redirect()->route('main')->with('success', 'Zamówienie zostało złożone!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|integer|in:1,2,3,4,5',
        ]);
        $order->status = $request->status;
        $order->save();
        return response()->json([
            'message' => 'Status zaktualizowany.',
            'status' => $order->status,
            'id' => $order->id
        ]);
    }



    public function settings()
{
    $user = Auth::user();

    $hasActiveOrders = \App\Models\Order::where('customer_id', $user->id)
        ->whereIn('status', [1, 2, 3])
        ->exists();

    return view('pitcernia.settings', compact('user', 'hasActiveOrders'));
}


public function updateSettings(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        'surname' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'city' => ['nullable', 'string', 'max:255'],
        'street' => ['nullable', 'string', 'max:255'],
        'house_number' => ['nullable', 'string', 'max:255'],
        'password' => ['nullable', 'string', 'min:6', 'confirmed'],
    ]);

    $user->name = $request->name;
    $user->surname = $request->surname;
    $user->email = $request->email;
    $user->city = $request->city;
    $user->street = $request->street;
    $user->house_number = $request->house_number;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Dane zostały zaktualizowane.');
}

    public function deleteAccount()
    {
        $user = Auth::user();

        $hasActive = \App\Models\Order::where('customer_id', $user->id)
            ->whereIn('status', [1, 2, 3])
            ->exists();

        if ($hasActive) {
            return back()->with('error', 'Nie możesz usunąć konta z aktywnymi zamówieniami.');
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Konto zostało usunięte.');
    }

}
