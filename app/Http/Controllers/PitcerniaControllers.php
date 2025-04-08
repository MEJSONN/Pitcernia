<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $users = User::all();
        $orders = Order::with('user')->get(); // dodałem eager loading userów
        return view('pitcernia.admin', compact('users', 'orders'));
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
            'status' => 1, // status jako liczba
        ]);

        session()->forget('cart');
        return redirect()->route('main')->with('success', 'Zamówienie zostało złożone!');
    }

    // ✅ Nowa metoda do zmiany statusu zamówienia
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|integer|between:1,5',
        ]);

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status zaktualizowany.']);
    }
}
