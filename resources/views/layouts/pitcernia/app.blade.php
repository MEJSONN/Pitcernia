<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pitcernia</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/svg+xml">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
// Drop down menu
.dropdown-menu .dropdown-item:active {
    background-color: #f0f0f0 !important;
    border-radius: 6px !important;
    color: black !important;
}

//Rozwijana lista - kolor
.accordion-button:not(.collapsed) {
    background-color: #f0f0f0 !important;
    color: #212529;
    border-radius: 0.375rem;
    box-shadow: none;
}
    </Style>

</head>

<body>

    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Lewa strona (Logo + tekst) -->
                <a class="navbar-brand justify-content-start" href="{{ route('main') }}">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M38.88 16.7063L38.2754 15.8809C25.6224 -1.31968 13.9242 -0.0140576 13.431 0.043571C13.4251 0.0448103 13.419 0.0472889 13.4126 0.0510069C12.5926 0.0715087 11.7894 0.330038 11.0743 0.803704C10.3592 1.27737 9.75421 1.95156 9.31291 2.76658C8.8716 3.58159 8.6076 4.51229 8.54427 5.47627C8.48094 6.44024 8.62024 7.40775 8.94983 8.29313C8.94983 8.29313 -0.0126039 35.891 1.33093e-05 35.9301C0.0026419 35.9394 0.0199906 39.0953 0.0199906 39.0953C0.0199906 39.3847 0.105683 39.6592 0.305455 39.8277C0.424551 39.9381 0.571383 39.9987 0.722875 40C0.806043 39.9977 0.888591 39.9825 0.968385 39.9548L16.3866 33.9199C16.6753 35.0092 17.1663 36.0044 18.2519 36.0044C18.8906 36.0044 19.4064 35.7727 19.7838 35.3147C20.3842 34.5897 20.4762 33.5072 20.473 32.3187L36.3718 26.0954C37.6472 25.6678 40.0487 23.926 39.9992 20.3865C39.9846 19.0468 39.5907 17.7519 38.88 16.7063ZM13.5162 1.84803C13.532 1.84803 13.5425 1.83873 13.5577 1.83873C13.5711 1.84121 13.5849 1.84245 13.5993 1.84245C13.7049 1.82634 24.0295 0.751225 35.4818 14.9557C33.9156 14.8708 32.543 15.4682 31.5562 16.7404C30.9176 17.5765 30.4965 18.6116 30.3434 19.7222C24.8828 12.0972 18.3013 8.07253 10.3293 7.41011C10.1594 6.93816 10.0687 6.43185 10.0623 5.91921C10.0636 4.83997 10.428 3.8054 11.0754 3.04226C11.7229 2.27912 12.6006 1.84967 13.5162 1.84803ZM1.55509 36.2362L14.8421 30.6034C15.1154 30.4708 15.3331 30.4386 15.4393 30.5C15.7 30.6611 15.8814 31.4406 16.0213 32.1644L1.55509 37.8411V36.2362ZM11.7025 29.2929C9.77311 29.2929 8.14391 28.0461 8.14391 26.5676C8.14391 25.0891 9.77416 23.8423 11.703 23.8423C13.6319 23.8423 15.2595 25.0891 15.2595 26.5676C15.2595 28.0461 13.6308 29.2929 11.7025 29.2929ZM18.6845 34.05C18.6541 34.0866 18.5663 34.1931 18.2519 34.1931C17.9664 34.1931 17.7404 32.9625 17.6068 32.2282C17.3597 30.8798 17.1032 29.4868 16.1548 28.8969C16.1285 28.8802 16.0996 28.8752 16.0717 28.8603C16.5202 28.1849 16.7962 27.4072 16.7962 26.5676C16.7962 24.0251 14.5598 22.0329 11.7041 22.0329C8.84837 22.0329 6.60986 24.0251 6.60986 26.5676C6.60986 28.5257 7.94308 30.1468 9.8588 30.7931L2.05557 34.1002L8.14548 15.7086V15.7099C8.14548 18.2542 10.384 20.2446 13.2397 20.2446C16.0954 20.2446 18.3318 18.2523 18.3318 15.7099C18.3318 13.1674 16.0949 11.1752 13.2392 11.1752C11.4307 11.1752 9.87457 11.977 8.97296 13.2089L10.292 9.22634C18.2303 9.90859 24.7072 14.1843 30.0527 22.23L20.7264 26.1853L20.7185 26.1908L20.708 26.1927C18.826 27.0522 18.8827 29.5097 18.929 31.4834C18.95 32.4699 18.9763 33.6956 18.6845 34.05ZM9.67743 15.7105C9.67743 14.2338 11.3082 12.9852 13.2365 12.9852C15.1649 12.9852 16.7935 14.232 16.7935 15.7105C16.7935 17.189 15.1659 18.4358 13.2376 18.4358C11.3082 18.4358 9.67743 17.189 9.67743 15.7105ZM35.9186 24.3622L20.4546 30.6673C20.4652 29.3393 20.6071 28.3875 21.2606 28.3875H21.2621L31.2455 23.8999C31.3023 23.9161 31.3559 23.82 31.4143 23.82C31.5494 23.82 31.6845 23.7171 31.8075 23.6304C31.9725 23.5086 32.0941 23.32 32.1495 23.1C32.2048 22.8801 32.1902 22.6438 32.1082 22.4357C31.8318 21.7334 31.7394 20.9499 31.8428 20.1854C31.9462 19.4209 32.2407 18.7101 32.6886 18.1439C33.7033 16.837 35.303 15.721 37.2051 17.5304H37.2114L37.6966 18.0243C38.1845 18.7518 38.4505 19.5518 38.4626 20.4924C38.5041 23.5108 36.0522 24.3164 35.9186 24.3622Z"
                            fill="black" />
                    </svg>
                    <span class="ms-2 fw-bold logo-text">Pitcernia</span>
                </a>

                <!-- Przycisk mobilny -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-100 text-center" id="navbarNav">

                    <!-- Prawa strona (Szukaj, Koszyk, Login itp.) -->
                    <div class="navbar-nav justify-content-end w-100">
                        <ul class="navbar-nav">

                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::currentRouteName() == 'login' ? 'active' : '' }}"
                                            href="{{ route('login') }}">Zaloguj się</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::currentRouteName() == 'register' ? 'active' : '' }}"
                                            href="{{ route('register') }}">Zarejestruj się</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName() == 'basket' ? 'active' : '' }}"
                                        href="{{ route('basket') }}">Koszyk</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('orders') }}">
                                                <i class="bi bi-basket-fill me-2"></i>Moje zamówienia
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('settings') }}">
                                                <i class="bi bi-gear-fill me-2"></i>Ustawienia
                                            </a>
                                        </li>
                                        @php
                                            $user = Auth::user();
                                        @endphp

                                        @if ($user && $user->role === 'admin')
                                            <li>
                                                <a class="dropdown-item text-dark" href="{{ route('admin') }}">
                                                    <i class="bi bi-shield-lock-fill me-2"></i>Panel administratora
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i>Wyloguj się
                                            </a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Treść strony -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Stopka -->
    <footer class="text-center py-3 mt-5 bg-light border-top mh-25">
        &copy;2025 Pitcernia. Wszystkie prawa zastrzeżone.
    </footer>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeo5kyRj0r8jW9clpIMbK0pH/2JkU7Sk5CWzMj4v9Pp1dF2F" crossorigin="anonymous"></script>
</body>

</html>
