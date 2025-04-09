@extends('layouts.pitcernia.app')

@section('content')
    @php
        $totalSpent = $orders->sum('total_price');
        $waitingOrders = $orders->whereIn('status', [1, 2]);
        $activeOrders = $orders->whereIn('status', [1, 2, 3]);
        $completedOrders = $orders->whereIn('status', [4, 5]);

        $statusLabels = [
            1 => ['text' => 'Oczekujące na potwierdzenie', 'class' => 'bg-secondary text-white'],
            2 => ['text' => 'Potwierdzone', 'class' => 'bg-info text-dark'],
            3 => ['text' => 'Wykonane', 'class' => 'bg-warning text-dark'],
            4 => ['text' => 'Doręczone', 'class' => 'bg-success text-white'],
            5 => ['text' => 'Anulowane', 'class' => 'bg-danger text-white'],
        ];
    @endphp

    <div class="container my-4">
        <div class="alert alert-success text-center fw-bold fs-5" role="alert">
            Wydałeś u nas {{ number_format($totalSpent, 2, ',', ' ') }} zł
        </div>

        <!-- Aktywne zamówienia -->
        <div class="mb-5">
            <h4 class="mb-3">Aktywne zamówienia</h4>
            @if ($activeOrders->isEmpty())
                <p class="text-muted">Brak aktywnych zamówień.</p>
            @else
                <div class="accordion" id="activeOrdersAccordion">
                    @foreach ($activeOrders as $index => $order)
                        <div class="accordion-item shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingActive{{ $index }}">
                                <button class="accordion-button collapsed fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseActive{{ $index }}"
                                        aria-expanded="false" aria-controls="collapseActive{{ $index }}">
                                    Zamówienie #{{ $order->id }} z {{ $order->created_at->format('Y-m-d H:i') }}
                                </button>
                            </h2>
                            <div id="collapseActive{{ $index }}" class="accordion-collapse collapse"
                                 aria-labelledby="headingActive{{ $index }}" data-bs-parent="#activeOrdersAccordion">
                                <div class="accordion-body">
                                    <div class="mb-2"><strong>Adres dostawy:</strong> {{ $order->address }}</div>

                                    <div class="row g-3">
                                        @foreach ($order->items as $item)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="border rounded p-3 bg-light h-100">
                                                    <div class="fw-bold">{{ $item['name'] }}</div>
                                                    <div class="text-muted">Ilość: {{ $item['quantity'] }}</div>
                                                    <div class="text-muted">Cena:
                                                        {{ number_format($item['price'], 2, ',', ' ') }} zł</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row align-items-center mt-4 g-2">
                                        <div class="col-12 col-md-4 text-center text-md-start">
                                            <span class="badge {{ $statusLabels[$order->status]['class'] }} py-2 px-3 fs-6">
                                                {{ $statusLabels[$order->status]['text'] }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-md-4 text-center">
                                            @if ($waitingOrders->isNotEmpty() && $waitingOrders->first()->id === $order->id)
                                                <button type="button" class="btn btn-danger w-100 w-md-auto"
                                                        onclick="confirmCancel({{ $order->id }})">
                                                    Anuluj zamówienie
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-4 text-center text-md-end fw-bold fs-5">
                                            Razem: {{ number_format($order->total_price, 2, ',', ' ') }} zł
                                        </div>
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
            <h4>Historia zamówień</h4>
            @if ($completedOrders->isEmpty())
                <p class="text-muted">Brak zrealizowanych zamówień.</p>
            @else
                <div class="accordion" id="completedOrdersAccordion">
                    @foreach ($completedOrders as $index => $order)
                        <div class="accordion-item shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingCompleted{{ $index }}">
                                <button class="accordion-button collapsed fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCompleted{{ $index }}"
                                        aria-expanded="false" aria-controls="collapseCompleted{{ $index }}">
                                    Zamówienie #{{ $order->id }} z {{ $order->created_at->format('Y-m-d H:i') }}
                                </button>
                            </h2>
                            <div id="collapseCompleted{{ $index }}" class="accordion-collapse collapse"
                                 aria-labelledby="headingCompleted{{ $index }}" data-bs-parent="#completedOrdersAccordion">
                                <div class="accordion-body">
                                    <div class="mb-2"><strong>Adres dostawy:</strong> {{ $order->address }}</div>
                                    <div class="row g-3">
                                        @foreach ($order->items as $item)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="border rounded p-3 bg-light h-100">
                                                    <div class="fw-bold">{{ $item['name'] }}</div>
                                                    <div class="text-muted">Ilość: {{ $item['quantity'] }}</div>
                                                    <div class="text-muted">Cena:
                                                        {{ number_format($item['price'], 2, ',', ' ') }} zł</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row align-items-center justify-content-between mt-4 g-2">
                                        <div class="col-12 col-md-4 text-center text-md-start">
                                            <span class="badge {{ $statusLabels[$order->status]['class'] }} py-2 px-3 fs-6">
                                                {{ $statusLabels[$order->status]['text'] }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-md-4 text-center text-md-end fw-bold fs-5">
                                            Razem: {{ number_format($order->total_price, 2, ',', ' ') }} zł
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Anuluj zamówienie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Czy na pewno chcesz anulować zamówienie?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">Tak, anuluj</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let orderIdToCancel;
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));

            function confirmCancel(orderId) {
                orderIdToCancel = orderId;
                cancelModal.show();
            }

            document.getElementById('confirmCancelBtn').onclick = () => {
                fetch(`/orders/${orderIdToCancel}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({status: 5})
                }).then(res => res.ok ? location.reload() : Promise.reject(res))
                  .catch(() => alert('Nie udało się anulować zamówienia'));
            };
        </script>
    @endpush
@endsection