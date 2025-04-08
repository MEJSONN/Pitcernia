@extends('layouts.pitcernia.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-header">Ustaw nowe hasło</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}"
                                    required autocomplete="email" placeholder="Adres e-mail">
                                <label for="email">Adres e-mail</label>

                                @error('email')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Nowe hasło">
                                <label for="password">Nowe hasło</label>

                                @error('password')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Potwierdź hasło">
                                <label for="password-confirm">Potwierdź hasło</label>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Zresetuj hasło
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
