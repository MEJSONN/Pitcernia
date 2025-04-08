@extends('layouts.pitcernia.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-header">Zarejestruj się</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row g-3 w-100 mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="floatingName" name="name" placeholder="Imię" value="{{ old('name') }}" required>
                                        <label for="floatingName">Imię</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                            id="floatingSurname" name="surname" placeholder="Nazwisko" value="{{ old('surname') }}" required>
                                        <label for="floatingSurname">Nazwisko</label>
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <!-- Adres -->
                            <div class="row g-3 w-100">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('town') is-invalid @enderror"
                                            id="floatingtown" name="city" placeholder="Miejscowość" value="{{ old('city') }}" required>
                                        <label for="floatingtown">Miejscowość</label>
                                        @error('town')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('street') is-invalid @enderror"
                                            id="floatingstreet" name="street" placeholder="Ulica" value="{{ old('street') }}" required>
                                        <label for="floatingstreet">Ulica</label>
                                        @error('street')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('number') is-invalid @enderror"
                                            id="floatingnumber" name="house_number" placeholder="Numer domu" value="{{ old('house_number') }}" required>
                                        <label for="floatingnumber">Numer domu</label>
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="floatingEmail" name="email" placeholder="name@example.com"
                                    value="{{ old('email') }}" required>
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

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPasswordConfirm"
                                    name="password_confirmation" placeholder="Potwierdź hasło" required>
                                <label for="floatingPasswordConfirm">Potwierdź hasło</label>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-center algin-items-center">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Zarejestruj się
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
