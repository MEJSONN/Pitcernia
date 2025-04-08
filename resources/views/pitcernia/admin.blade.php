@extends('layouts.pitcernia.app')

@section('content')
    <div class="accordion" id="accordionExample">
        <!-- Użytkownicy -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Użytkownicy
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container">
                        <h2>Lista użytkowników</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID użytkownika</th>
                                    <th>Email</th>
                                    <th>Data utworzenia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktywne zamówienia -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Aktywne zamówienia
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container">
                        <h2>Aktywne zamówienia</h2>
                        @if ($orders->isEmpty())
                            <p>Brak aktywnych zamówień.</p>
                        @else
                            <table class="table text-center align-items-center">
                                <thead class="align-middle text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Klient ID</th>
                                        <th>Adres</th>
                                        <th>Przedmioty</th>
                                        <th>Łączna cena</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="align-middle text-center">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_id }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td class="text-start">
                                                <ul class="mb-0">
                                                    @foreach ($order->items as $item)
                                                        <li>{{ $item['name'] }} x{{ $item['quantity'] }}
                                                            ({{ $item['price'] }} zł)
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $order->total_price }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <select name="status" class="form-select status-select"
                                                    data-id="{{ $order->id }}">
                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                                        Oczekujące</option>
                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>
                                                        Potwierdzone</option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>
                                                        Gotowe</option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>
                                                        Doręczone</option>
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Anulowane</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Historia zamówień -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Historia zamówień
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Lista historia zamówień
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ TOAST Bootstrap -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="statusToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Status zaktualizowany!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Zamknij"></button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastElement = document.getElementById('statusToast');
            const toast = new bootstrap.Toast(toastElement);

            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function() {
                    const orderId = this.dataset.id;
                    const status = this.value;

                    fetch(`/orders/${orderId}/status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status
                            })
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Błąd zapisu statusu');
                            return res.json();
                        })
                        .then(data => {
                            toast.show();
                        })
                        .catch(err => {
                            console.error(err);
                        });
                });
            });
        });
    </script>
@endpush
