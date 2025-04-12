@extends('layouts.pitcernia.app')

@section('content')
    <div class="container my-5" style="max-width: 720px;">
        <h2 class="mb-4">Ustawienia konta</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Formularz - ustawienia -->
        <form method="POST" action="{{ route('settings.update') }}">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Imię" required>
                        <label for="name">Imię</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}"
                            class="form-control @error('surname') is-invalid @enderror" placeholder="Nazwisko" required>
                        <label for="surname">Nazwisko</label>
                        @error('surname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" required>
                <label for="email">Adres E-mail</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                            class="form-control @error('city') is-invalid @enderror" placeholder="Miasto">
                        <label for="city">Miejscowość</label>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="street" id="street" value="{{ old('street', $user->street) }}"
                            class="form-control @error('street') is-invalid @enderror" placeholder="Ulica">
                        <label for="street">Ulica</label>
                        @error('street')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="house_number" id="house_number"
                            value="{{ old('house_number', $user->house_number) }}"
                            class="form-control @error('house_number') is-invalid @enderror" placeholder="Numer domu">
                        <label for="house_number">Numer domu</label>
                        @error('house_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Nowe hasło">
                <label for="password">Nowe hasło (opcjonalnie)</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    placeholder="Potwierdź hasło">
                <label for="password_confirmation">Potwierdź nowe hasło</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-outline-primary">Zapisz zmiany</button>

                <!-- Usuń kontot -->
                @if ($hasActiveOrders)
                    <button type="button" class="btn btn-outline-danger" data-bs-container="body" data-bs-toggle="popover"
                        data-bs-placement="top" data-bs-content="Masz aktywne zamówienia!">
                        Usuń konto
                    </button>
                @else
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal">
                        Usuń konto
                    </button>
                @endif

            </div>
        </form>
    </div>

    <!-- Modal - potwierdzenia usunięcia -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">Potwierdzenie usunięcia konta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body">
                    Czy na pewno chcesz usunąć swoje konto? Tej operacji nie można cofnąć.
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('settings.delete') }}">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-danger">Tak, usuń</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- skrypt popover -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
                popovers.forEach(p => new bootstrap.Popover(p));
            });
        </script>
    @endpush

@endsection
