@extends('layouts.pitcernia.app')

@section('content')
    <div class="accordion" id="accordionExample">
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <select name="status" id="status" class="form-select"
                                                aria-label="Status zamówienia">
                                                <option class="" value="1">Oczekujące na potwierdzenie</option>
                                                <option value="2">Potwierdzone</option>
                                                <option value="3">Gotowe</option>
                                                <option value="4">Doręczone</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Klient</th>
                                        <th>Adres</th>
                                        <th>Przedmioty</th>
                                        <th>Łączna cena</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($order->items as $item)
                                                        <li>{{ $item['name'] }} x{{ $item['quantity'] }}
                                                            ({{ $item['price'] }} zł)
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $order->total_price }} zł</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
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
@endsection
