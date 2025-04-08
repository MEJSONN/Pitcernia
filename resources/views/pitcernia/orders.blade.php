@extends('layouts.pitcernia.app')

@section('content')
@php
    $totalSpent = $orders->sum('total_price');

    $activeOrders = $orders->whereIn('status', [1, 2, 3]);
    $completedOrders = $orders->where('status', [4, 5]);

    $statusLabels = [
        1 => ['text' => 'Oczekujące na potwierdzenie', 'class' => 'bg-secondary text-white'],
        2 => ['text' => 'Potwierdzone', 'class' => 'bg-info text-dark'],
        3 => ['text' => 'Gotowe', 'class' => 'bg-warning text-dark'],
        4 => ['text' => 'Doręczone', 'class' => 'bg-success text-white'],
        5 => ['text' => 'Anulowane', 'class' => 'bg-danger text-white']
    ];
@endphp

<div class="container my-4">
    <div class="alert alert-success text-center fw-bold fs-5" role="alert">
        Wydałeś u nas {{ number_format($totalSpent, 2, ',', ' ') }} zł
    </div>

    <!-- Aktywne zamówienia -->
    <div class="mb-5">
        <h4 class="mb-3">Aktywne zamówienia</h4>
        @if($activeOrders->isEmpty())
            <p class="text-muted">Brak aktywnych zamówień.</p>
        @else
            <div class="accordion" id="activeOrdersAccordion">
                @foreach($activeOrders as $index => $order)
                    <div class="accordion-item shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingActive{{ $index }}">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseActive{{ $index }}"
                                    aria-expanded="false"
                                    aria-controls="collapseActive{{ $index }}">
                                Zamówienie #{{ $order->id }} z {{ $order->created_at->format('Y-m-d H:i') }}
                            </button>
                        </h2>
                        <div id="collapseActive{{ $index }}" class="accordion-collapse collapse"
                             aria-labelledby="headingActive{{ $index }}"
                             data-bs-parent="#activeOrdersAccordion">
                            <div class="accordion-body">
                                <div class="mb-2"><strong>Adres dostawy:</strong> {{ $order->address }}</div>

                                <div class="row g-3">
                                    @foreach($order->items as $item)
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <div class="fw-bold">{{ $item['name'] }}</div>
                                                <div class="text-muted">Ilość: {{ $item['quantity'] }}</div>
                                                <div class="text-muted">Cena: {{ number_format($item['price'], 2, ',', ' ') }} zł</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 px-1">
                                    <span class="badge {{ $statusLabels[$order->status]['class'] }} py-2 px-3 fs-6">
                                        {{ $statusLabels[$order->status]['text'] }}
                                    </span>
                                    <span class="fw-bold fs-5">
                                        Razem: {{ number_format($order->total_price, 2, ',', ' ') }} zł
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Zrealizowane zamówienia -->
    <div class="mb-5">
        <h4 class="mb-3">Zrealizowane zamówienia</h4>
        @if($completedOrders->isEmpty())
            <p class="text-muted">Brak zrealizowanych zamówień.</p>
        @else
            <div class="accordion" id="completedOrdersAccordion">
                @foreach($completedOrders as $index => $order)
                    <div class="accordion-item shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingCompleted{{ $index }}">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseCompleted{{ $index }}"
                                    aria-expanded="false"
                                    aria-controls="collapseCompleted{{ $index }}">
                                Zamówienie #{{ $order->id }} z {{ $order->created_at->format('Y-m-d H:i') }}
                            </button>
                        </h2>
                        <div id="collapseCompleted{{ $index }}" class="accordion-collapse collapse"
                             aria-labelledby="headingCompleted{{ $index }}"
                             data-bs-parent="#completedOrdersAccordion">
                            <div class="accordion-body">
                                <div class="mb-2"><strong>Adres dostawy:</strong> {{ $order->address }}</div>

                                <div class="row g-3">
                                    @foreach($order->items as $item)
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <div class="fw-bold">{{ $item['name'] }}</div>
                                                <div class="text-muted">Ilość: {{ $item['quantity'] }}</div>
                                                <div class="text-muted">Cena: {{ number_format($item['price'], 2, ',', ' ') }} zł</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 px-1">
                                    <span class="badge {{ $statusLabels[$order->status]['class'] }} py-2 px-3 fs-6">
                                        {{ $statusLabels[$order->status]['text'] }}
                                    </span>
                                    <span class="fw-bold fs-5">
                                        Razem: {{ number_format($order->total_price, 2, ',', ' ') }} zł
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
