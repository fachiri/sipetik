<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('User') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat data user baru') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <small>Nama Lengkap Akun</small>
                <x-jet-input id="name" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="user.name" />
                <x-jet-input-error for="user.name" class="mt-2" />
            </div>
            @if ($action == "createUser")

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="user_id" value="{{ __('NIP/NIM') }}" />
                <x-jet-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" wire:model.defer="user.user_id" />
                <x-jet-input-error for="user.user_id" class="mt-2" />
            </div>
            @endif
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="user.email" />
                <x-jet-input-error for="user.email" class="mt-2" />
            </div>

            @if ($action == "createUser")

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select name="role" id="role" wire:model.defer="user.role" class="w-full rounded border-slate-300 text-gray-700" onchange="toggleCategory(this)">
                    @if (auth()->user()->role == 'KABID')
                        <option value="">Pilih Role</option>
                        <option value="TEKNISI">TEKNISI</option>
                    @else
                        <option value="">Pilih Role</option>
                        <option value="PENGGUNA">PENGGUNA</option>
                        <option value="TEKNISI">TEKNISI</option>
                    @endif
                </select>
                <x-jet-input-error for="user.role" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jenis" value="{{ __('Jenis') }}" />
                <select name="level" id="jenis" wire:model.defer="user.level" class="w-full rounded border-slate-300 text-gray-700">
                    <option value="">Pilih Jenis</option>
                    <option value="REKTORAT">REKTORAT</option>
                    <option value="BAKP">BAKP</option>
                    <option value="FAKULTAS">FAKULTAS</option>
                    <option value="JURUSAN">JURUSAN</option>
                    <option value="PRODI">PRODI</option>
                    <option value="DOSEN">DOSEN</option>
                    <option value="MAHASISWA">MAHASISWA</option>
                </select>
                <x-jet-input-error for="user.level" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5 hidden" id="category-group">
                <x-jet-label for="category" value="{{ __('Bidang') }}" />
                <select name="category" id="category" wire:model.defer="user.category" class="mt-1 block w-full form-control shadow-none">
                    @if (auth()->user()->role == 'KABID')
                        <option value="{{ auth()->user()->kabid->category->id }}">{{ auth()->user()->kabid->category->name }}</option>
                    @else
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
                <x-jet-input-error for="user.category" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <small>Minimal 8 karakter</small>
                <x-jet-input id="password" type="password" class="mt-1 block w-full form-control shadow-none" wire:model.defer="user.password" />
                <x-jet-input-error for="user.password" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <small>Minimal 8 karakter</small>
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full form-control shadow-none" wire:model.defer="user.password_confirmation" />
                <x-jet-input-error for="user.password_confirmation" class="mt-2" />
            </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>

<script>
    const toggleCategory = (select) => {
        const categoryGroup = document.getElementById('category-group');
        if (select.value === 'TEKNISI') {
            categoryGroup.classList.remove('hidden')
        } else {
            categoryGroup.classList.add('hidden')
        }
    }
</script>
