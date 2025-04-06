<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as AuthAlias;

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


    public function Basket()
    {
        //$basket = Basket::all();
        return view('pitcernia.basket');
    }
    public function Orders()
    {
        return view('pitcernia.orders');
    }
    public function admin()
    {
        $users = User::all();
        return view('pitcernia.admin', compact('users'));
    }

    public function addToCart(Request $request)
    {
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
        'customer_name' => $user ? $user->name : 'Gość', // użyjemy imienia użytkownika, jeśli jest zalogowany
        'address' => 'Opole, Kościuszki 69', // można też zrobić $user->address
        'items' => $cart,
        'total_price' => $total,
    ]);

    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Zamówienie zostało złożone!');
}

}
