<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Lainnya</div>
        <div class="breadcrumb-item"><a href="{{ route('user') }}">User</a></div>
        <div class="breadcrumb-item">Edit User</div>
        </div>
    </x-slot>

    <div class="bg-white p-4 rounded shadow-sm">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block font-medium text-sm text-gray-700" for="name">Nama</label>
                <input id="name" type="text" name="name" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                <input id="email" type="email" name="email" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label class="block font-medium text-sm text-gray-700" for="email">Role</label>
                <select name="role" id="role" class="w-full rounded border-slate-300 text-gray-700">
                    <option value="KABID" {{ $user->role == 'KABID' ? 'selected' : '' }}>KABID</option>
                    <option value="TEKNISI" {{ $user->role == 'TEKNISI' ? 'selected' : '' }}>TEKNISI</option>
                    <option value="PENGGUNA" {{ $user->role == 'PENGGUNA' ? 'selected' : '' }}>PENGGUNA</option>
                </select>
            </div>
            <div class="mb-3 text-right">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
