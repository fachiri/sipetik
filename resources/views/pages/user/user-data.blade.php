<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Lainnya</div>
        <div class="breadcrumb-item">User</div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="user" :model="$user" :categories="$categories" />
    </div>
</x-app-layout>
