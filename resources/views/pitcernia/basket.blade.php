@extends('layouts.pitcernia.app')

@section('content')
    <div class="row g-4">
        <!-- Lista pozycji -->
        <div class="col-md-8">
            @php
                $cart = session('cart', []);
                $total = 0;
            @endphp

            @forelse ($cart as $id => $item)
                @php
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                @endphp

                <div class="border rounded p-3 bg-light shadow-sm mb-3">
                    <div class="row align-items-center">
                        <!-- Obraz i opis -->
                        <div class="col-md-5 d-flex align-items-center gap-3">
                            <img src="{{ asset('images/' . $id . '.jpeg') }}" style="width: 100px" class="rounded">
                            <div>
                                <h5 class="mb-1">{{ $item['name'] }}</h5>
                                <small class="text-muted">{{ $item['ingredients'] ?? '' }}</small>
                            </div>
                        </div>

                        <!-- Ilość -->
                        <div class="col-md-3 d-flex justify-content-center">
                            <div class="input-group" style="max-width: 160px;">
                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="hidden" name="action" value="decrease">
                                    <button class="btn btn-outline-secondary" type="submit">−</button>
                                </form>

                                <input type="number" class="form-control text-center" value="{{ $item['quantity'] }}"
                                    readonly>

                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="hidden" name="action" value="increase">
                                    <button class="btn btn-outline-secondary" type="submit">+</button>
                                </form>
                            </div>
                        </div>

                        <!-- Cena i usuń -->
                        <div class="col-md-4 d-flex justify-content-end align-items-center gap-3">
                            <div class="fw-bold fs-5 text-nowrap">{{ number_format($itemTotal, 2) }} zł</div>
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Twój koszyk jest pusty!
                </div>
            @endforelse
        </div>

        <!-- Podsumowanie -->
        <div class="col-md-4">
            <div class="border rounded p-3 bg-light shadow">
                <div class="mb-3 border p-3 rounded">
                    <h5 class="mb-2">Adres dostawy:</h5>
                    <div class="text-muted">
                        {{ Auth::user()->city }}, {{ Auth::user()->street }} {{ Auth::user()->house_number }}
                    </div>

                </div>
                <div class="mb-3 border p-3 rounded">
                    <h5 class="mb-2">Cena całkowita:</h5>
                    <div class="fw-bold fs-4">{{ number_format($total, 2) }} zł</div>
                </div>
                <form method="POST" action="{{ route('order.submit') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100 py-2">
                        Złóż zamówienie
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
