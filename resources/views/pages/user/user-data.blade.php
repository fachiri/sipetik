<x-app-layout>
    <x-slot name="header_content">
        @if (auth()->user()->role == 'KABID')
            <h1>{{ __('Daftar Teknisi') }}</h1>
        @endif
        @if (auth()->user()->role == 'ADMIN')
            <h1>{{ __('Semua Pengguna') }}</h1>
        @endif

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Lainnya</div>
        @if (auth()->user()->role == 'KABID')
            <div class="breadcrumb-item">Daftar Teknisi</div>
        @endif
        @if (auth()->user()->role == 'ADMIN')
            <div class="breadcrumb-item">Semua Pengguna</div>
        @endif
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="user" :model="$user" :categories="$categories" />
    </div>
</x-app-layout>
