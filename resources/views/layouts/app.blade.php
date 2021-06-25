<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.1/css/perfect-scrollbar.min.css"
        integrity="sha512-ygIxOy3hmN2fzGeNqys7ymuBgwSCet0LVfqQbWY10AszPMn2rB9JY0eoG0m1pySicu+nvORrBmhHVSt7+GI9VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    @livewireStyles
</head>

<body class="c-app">

    @include('layouts.partials.sidebar')

    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item">
                    <a class="c-header-nav-link" href="{{ route('consultation') }} ">{{ __('Get Consultation') }}
                    </a>
                </li>
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link"
                        href="{{ route('welcome') }} ">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-settings') }} "></use>
                        </svg></a></li>
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="c-avatar"><svg class="c-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }} "></use>
                            </svg></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }} ">
                                </use>
                            </svg> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </header>
        <div class="c-body">
            <main class="c-main">
                @yield('content')
            </main>
        </div>

        <!-- Optional JavaScript -->
        <!-- Popper.js first, then CoreUI JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.1/perfect-scrollbar.min.js"
                integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
                integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
        @livewireScripts
        @yield('scripts')
</body>

</html>
