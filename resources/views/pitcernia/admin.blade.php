@extends('layouts.pitcernia.app')

@section('content')
    @php
        $activeOrders = $orders->whereIn('status', [1, 2, 3]);
        $historyOrders = $orders->whereIn('status', [4, 5]);
    @endphp

    <div class="accordion" id="accordionExample">

        <!-- UŻYTKOWNICY -->
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
                                    <th>Imię</th>
                                    <th>Nazwisko</th>
                                    <th>Email</th>
                                    <th>Zweryfikowano</th>
                                    <th>Data utworzenia</th>
                                    <th>Adres</th>
                                    <th>Rola</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->email_verified_at)
                                                <span class="badge bg-success">Tak</span>
                                            @else
                                                <span class="badge bg-secondary">Nie</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            {{ $user->city ?? '-' }},
                                            {{ $user->street ?? '-' }}
                                            {{ $user->house_number ?? '' }}
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                                                @csrf
                                                <select name="role" class="form-select" onchange="this.form.submit()">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                        Użytkownik</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                        Administrator</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- AKTYWNE ZAMÓWIENIA -->
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
                        @if ($activeOrders->isEmpty())
                            <p>Brak aktywnych zamówień.</p>
                        @else
                            <table class="table text-center align-items-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Klient ID</th>
                                        <th>Adres</th>
                                        <th>Przedmioty</th>
                                        <th>Cena</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeOrders as $order)
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
                                            <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <select name="status" class="form-select status-select"
                                                    data-id="{{ $order->id }}">
                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                                        Oczekujące</option>
                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>
                                                        Potwierdzone</option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>
                                                        Wykonane</option>
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

        <!-- HISTORIA ZAMÓWIEŃ -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Historia zamówień
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container">
                        <h2>Historia zamówień</h2>

                        @if ($historyOrders->isEmpty())
                            <p id="no-history-msg" class="text-muted">Brak zrealizowanych lub anulowanych zamówień.</p>
                        @endif

                        <table class="table text-center align-items-center" id="historyTable"
                            @if ($historyOrders->isEmpty()) style="display: none;" @endif>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Klient ID</th>
                                    <th>Adres</th>
                                    <th>Przedmioty</th>
                                    <th>Cena</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                @foreach ($historyOrders as $order)
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
                                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @switch($order->status)
                                                @case(4)
                                                    Doręczone
                                                @break

                                                @case(5)
                                                    Anulowane
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- DZISIEJSZE ZAMÓWIENIA -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseToday" aria-expanded="false" aria-controls="collapseToday">
                    Zamówienia z dnia {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                </button>
            </h2>
            <div id="collapseToday" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="alert alert-success text-center fw-bold fs-5" role="alert">
                        Zarobiliśmy dzisiaj {{ number_format($todayTotal, 2, ',', ' ') }} zł
                    </div>
                    <div class="container">
                        <h2 class="mb-3">Dzisiejsze zamówienia</h2>

                        @if ($todayOrders->isEmpty())
                            <p class="text-muted">Brak zamówień z dzisiaj.</p>
                        @else
                            <table class="table text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID użytkownika</th>
                                        <th>Adres</th>
                                        <th>Przedmioty</th>
                                        <th>Łączna cena</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todayOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_id }}</td>
                                            <td>{{ $order->address ?? '-' }}</td>
                                            <td class="text-start">
                                                <ul class="mb-0">
                                                    @foreach ($order->items as $item)
                                                        <li>{{ $item['name'] }} x{{ $item['quantity'] }}
                                                            ({{ $item['price'] }} zł)
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @switch($order->status)
                                                    @case(1)
                                                        Oczekujące
                                                    @break

                                                    @case(2)
                                                        Potwierdzone
                                                    @break

                                                    @case(3)
                                                        Wykonane
                                                    @break

                                                    @case(4)
                                                        Doręczone
                                                    @break

                                                    @case(5)
                                                        Anulowane
                                                    @break

                                                    @default
                                                        Nieznany
                                                @endswitch
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


        <!-- STATYSTYKI -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseStats" aria-expanded="false" aria-controls="collapseStats">
                    Statystyki
                </button>
            </h2>
            <div id="collapseStats" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container">
                        <h2 class="mb-3">Statystyki zarobków</h2>
                        <div class="alert alert-success fw-semibold fs-5 text-center mb-0">
                            <p>Dzisiaj: {{ number_format($todayTotal, 2, ',', ' ') }} zł</p>
                            <p>W tym miesiącu: {{ number_format($monthTotal, 2, ',', ' ') }} zł</p>
                            <p>W ostatnich 12 miesiącach: {{ number_format($yearTotal, 2, ',', ' ') }} zł</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- TOAST -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="statusToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">Status zaktualizowany!</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Zamknij"></button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = new bootstrap.Toast(document.getElementById('statusToast'));

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
                            if (parseInt(data.status) === 4 || parseInt(data.status) === 5) {
                                const row = document.querySelector(
                                    `select[data-id="${data.id}"]`)?.closest('tr');
                                if (row) row.remove();
                            }
                        })
                        .catch(err => console.error(err));
                });
            });
        });
    </script>
@endpush
