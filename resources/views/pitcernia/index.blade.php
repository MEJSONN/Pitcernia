@extends('layouts.pitcernia.app')

@section('content')
    <form class="d-flex flex-column w-100" method="GET">
        <div class="container mt-4 d-flex flex-column align-items-center justify-content-between border g-4 rounded-3 p-3 mb-3 shadow">
            <div class="search-wrapper w-100">
                <div class="search-box w-100">
                    <input type="text" name="search" class="search-input form-control w-100"
                           placeholder="Wyszukaj coś pysznego..." value="{{ request('search') }}">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($data as $item)
            @php
                $itemId = str_replace(' ', '_', $item->name);
            @endphp

            <div class="col">
                <div class="card h-100 cursor-pointer shadow" data-bs-toggle="modal"
                     data-bs-target="#Pizza_{{ $itemId }}">
                    <img src="{{ asset('images/' . $itemId . '.jpeg') }}" class="card-img-top w-100 h-100" style="max-width: 600px; height: auto"
                         alt="{{ $itemId }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p>{{ $item->size }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">{{ $item->ingredients }}</p>
                            <p class="card-text fw-bold">{{ $item->price }}zł</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade shadow" id="Pizza_{{ $itemId }}" tabindex="-1"
                 aria-labelledby="Pizza_{{ $itemId }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content shadow-sm rounded-3 border-0">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $item->name }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 shadow">
                            <div class="text-center mb-3">
                                <img src="{{ asset('images/' . $itemId . '.jpeg') }}" style="max-width: 600px; max-height: 400px" class="card-img-top rounded-3"
                                     alt="{{ $itemId }}">
                            </div>
                            <div class="mt-3 p-3 border rounded-3 shadow">
                                <h5 class="mb-1">Składniki:</h5>
                                <span class="text-muted">{{ $item->ingredients }}</span>
                            </div>
                            <div class="mt-3 p-3 border rounded-3 shadow">
                                <h5 class="mb-1">Opis:</h5>
                                <span class="text-muted">{{ $item->description }}</span>
                            </div>
                            <div class="mt-3 p-3 border rounded-3 shadow d-flex justify-content-between">
                                <h5 class="mb-0">Cena: <span class="fw-bold">{{ $item->price }} zł</span></h5>
                                <span class="text-muted fw-bold">{{ $item->size }}</span>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-outline-secondary btn-lg w-100 shadow add-to-cart-btn"
                                        data-id="{{ $itemId }}" data-name="{{ $item->name }}"
                                        data-price="{{ $item->price }}">
                                    <i class="bi bi-cart-plus me-2"></i> Dodaj do koszyka
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ✅ Toast: Sukces -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="successToastBody"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- ❌ Toast: Niezalogowany -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="loginToast" class="toast align-items-center text-bg-danger border-0" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="d-flex justify-content-between w-100">
                <div class="toast-body">
                    Musisz być zalogowany, aby dodać do koszyka.
                </div>
                <a href="{{ route('login') }}" class="btn btn-sm btn-light me-2 my-auto">Zaloguj się</a>
                <button type="button" class="btn-close btn-close-white me-2 my-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- ✅ JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const successToastEl = document.getElementById('successToast');
    const successToastBody = document.getElementById('successToastBody');
    const loginToastEl = document.getElementById('loginToast');

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = this.dataset.price;

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // ← DODANE!
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id, name, price })
            })
            .then(async response => {
                const text = await response.text();
                console.log('Odpowiedź z serwera:', text); // ← PODGLĄD!

                try {
                    const data = JSON.parse(text);

                    if (!response.ok || !data.success) {
                        if (response.status === 401) {
                            const toast = new bootstrap.Toast(loginToastEl);
                            toast.show();
                        } else {
                            alert(data.message || 'Wystąpił problem.');
                        }
                        return;
                    }

                    successToastBody.textContent = `Dodano "${name}" do koszyka!`;
                    const toast = new bootstrap.Toast(successToastEl);
                    toast.show();
                } catch (err) {
                    console.error('Błąd parsowania JSON:', err);
                    alert('Błąd odpowiedzi serwera.');
                }
            })
            .catch(() => alert('Fetch całkiem się wysypał.'));
        });
    });
});

    </script>
@endsection
