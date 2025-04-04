<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function admin()
    {
        $users = User::all();
        return view('pitcernia.admin', compact('users'));
    }

}
