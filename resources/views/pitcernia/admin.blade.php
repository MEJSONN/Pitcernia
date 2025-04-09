@extends('layouts.pitcernia.app')

@section('content')
@php
    $activeOrders = $orders->whereIn('status', [1, 2, 3]);
    $historyOrders = $orders->whereIn('status', [4, 5]);
@endphp

<div class="container my-4">
    <div class="accordion" id="accordionExample">

        <!-- UŻYTKOWNICY -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsers">
                    Użytkownicy
                </button>
            </h2>
            <div id="collapseUsers" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center align-middle">
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
                                            <span class="badge {{ $user->email_verified_at ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $user->email_verified_at ? 'Tak' : 'Nie' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $user->city ?? '-' }}, {{ $user->street ?? '-' }} {{ $user->house_number ?? '' }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                                                @csrf
                                                <select name="role" class="form-select" onchange="this.form.submit()">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Użytkownik</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
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
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseActive">
                    Aktywne zamówienia
                </button>
            </h2>
            <div id="collapseActive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        @if ($activeOrders->isEmpty())
                            <p class="text-muted">Brak aktywnych zamówień.</p>
                        @else
                            <table class="table text-center align-middle">
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
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_id }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td class="text-start">
                                                <ul>
                                                    @foreach ($order->items as $item)
                                                        <li>{{ $item['name'] }} x{{ $item['quantity'] }} ({{ $item['price'] }} zł)</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <select class="form-select status-select" data-id="{{ $order->id }}">
                                                    @foreach ([1=>'Oczekujące',2=>'Potwierdzone',3=>'Wykonane',4=>'Doręczone',5=>'Anulowane'] as $key=>$label)
                                                        <option value="{{ $key }}" @selected($order->status == $key)>{{ $label }}</option>
                                                    @endforeach
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
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseHistory">
                    Historia zamówień
                </button>
            </h2>
            <div id="collapseHistory" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        @if ($historyOrders->isEmpty())
                            <p class="text-muted">Brak zamówień historycznych.</p>
                        @else
                            <table class="table text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Klient ID</th><th>Adres</th><th>Przedmioty</th><th>Cena</th><th>Data</th><th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historyOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_id }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td class="text-start">
                                                <ul>
                                                    @foreach ($order->items as $item)
                                                        <li>{{ $item['name'] }} x{{ $item['quantity'] }} ({{ $item['price'] }} zł)</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $order->status == 4 ? 'Doręczone' : 'Anulowane' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="statusToast" class="toast text-bg-success" role="alert">
            <div class="toast-body">Status zaktualizowany!</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.status-select').forEach(el=>el.onchange=e=>{
        fetch(`/orders/${el.dataset.id}/status`,{
            method:'POST',headers:{
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type':'application/json'
            },body:JSON.stringify({status:el.value})
        }).then(r=>new bootstrap.Toast('#statusToast').show()).catch(console.error)
    });
</script>
@endpush
