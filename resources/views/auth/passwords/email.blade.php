@extends('layouts.pitcernia.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-header">Resetowanie hasła</div>

                    <div class="card-body">
                        <p class="mb-4">
                            Wprowadź swój adres e-mail, a wyślemy Ci link do zresetowania hasła.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    autocomplete="email" placeholder="Adres e-mail">
                                <label for="email">Adres e-mail</label>

                                @error('email')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Wyślij link resetujący hasło
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
