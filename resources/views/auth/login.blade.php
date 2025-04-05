@extends('layouts.pitcernia.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-header">Zaloguj się</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="floatingEmail" name="email" placeholder="name@example.com"
                                    value="{{ old('email') }}" required autofocus>
                                <label for="floatingEmail">Adres Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="floatingPassword" name="password" placeholder="Hasło" required>
                                <label for="floatingPassword">Hasło</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Zapamiętaj mnie
                                </label>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Zaloguj się
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Zapomniałeś hasła?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
