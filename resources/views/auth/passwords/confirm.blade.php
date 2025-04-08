@extends('layouts.pitcernia.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-header">Potwierdź hasło</div>

                    <div class="card-body">
                        <p class="mb-4">
                            Zanim przejdziesz dalej, prosimy o potwierdzenie hasła.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="Hasło">
                                <label for="password">Hasło</label>

                                @error('password')
                                    <span class="invalid-feedback d-block mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Potwierdź hasło
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Zapomniałeś hasła?
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
