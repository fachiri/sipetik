<x-app-layout>
    <x-slot name="header_content">
        @php
            if (auth()->user()->role == 'KABID') {
                $user = 'Teknisi';
            }
            if (auth()->user()->role == 'ADMIN') {
                $user = 'Pengguna';
            }
        @endphp
        <h1>{{ __('Tambah ').$user }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Lainnya</div>
        <div class="breadcrumb-item"><a href="{{ route('user') }}">Semua {{ $user }}</a></div>
        <div class="breadcrumb-item">Tambah {{ $user }}</div>
        </div>
    </x-slot>

    <div>
        <livewire:create-user action="createUser" />
    </div>
</x-app-layout>
