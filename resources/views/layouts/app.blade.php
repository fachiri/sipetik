<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @isset($meta)
    {{ $meta }}
    @endisset

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- Noty --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">

    <livewire:styles />

    <style>
        .tab-btn-pengaduan.active {
            background-color: #002979;
            color: #fff;
        }
    </style>

    <!-- Scripts -->
    <script defer src="{{ asset('vendor/alpine.js') }}"></script>
</head>

<body class="antialiased">
    @if (session('notifications'))
        <x-notif />
    @endif
    <div id="app">
        <div class="main-wrapper">
            @include('components.navbar')
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @isset($header_content)
                        {{ $header_content }}
                        @else
                        {{ __('Halaman') }}
                        @endisset
                    </div>

                    <div class="section-body">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </div>

    @stack('modals')

    @if (session('success'))
    <script>
        new Noty({
            type: 'success',
            text: @json(session('success')),
            timeout: 2000,
        }).show();
    </script>
    @endif

    @if (session('error'))
    <script>
        new Noty({
            type: 'error',
            text: @json(session('error')),
            timeout: 2000,
        }).show();
    </script>
    @endif

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script defer async src="{{ asset('stisla/js/modules/popper.js') }}"></script>
    <script defer async src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
    <script defer src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
    <script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('stisla/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>

    <livewire:scripts />
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    @isset($script)
    {{ $script }}
    @endisset
</body>

</html>