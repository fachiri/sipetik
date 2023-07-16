<x-guest-layout>
  <div class="bg-[#173D7A]">
    <h3 class="text-white text-2xl text-center font-bold">Daftar PETIK</h3>
  </div>
  <img src="{{ asset('assets/bg2.png') }}" alt="Ilustrasi" class="mb-5 w-screen h-40 md:h-auto object-cover">
  <div class="flex flex-col justify-start items-center mb-20">
    <x-jet-validation-errors class="mb-4" />
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <div class="mt-4">
            <x-jet-label for="jenis" value="{{ __('Jenis') }}" />
            <select name="level" id="jenis" class="select2 w-full rounded border-slate-300 text-gray-700" onchange="toggleLevel(this)">
                <option value="" selected>Pilih Jenis</option>
                @foreach ($criterias as $criteria)
                    <option value="{{ $criteria->kriteria }}">{{ $criteria->kriteria }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-jet-label for="user_id" value="{{ __('NIM/NIP') }}" />
            <x-jet-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms"/>

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-jet-button class="ml-4">
                {{ __('Register') }}
            </x-jet-button>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
