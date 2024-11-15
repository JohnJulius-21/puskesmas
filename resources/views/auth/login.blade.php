<x-guest-layout>
    <!-- Make the card bigger using max-w-xl for 36rem or 576px -->
    <x-authentication-card class="w-full max-w-2xl"> 
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
            <div><img  src="/images/logo puskes.png" alt="logo kesehatan"  style="width: 160px; height: 160px;"></div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email Atau ID') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email/ID Anda" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Kata Sandi') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi Anda" />
                <input type="checkbox" id="show_password" class="ml-2" onclick="togglePassword()" />
                    <label for="show_password" class="text-sm text-gray-600 cursor-pointer">{{ __('Perlihatkan Password Saya') }}</label>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Simpan Info Saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Daftar Jika Belum Punya Akun') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const showPasswordCheckbox = document.getElementById('show_password');
                passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
            }
        </script>
    </x-authentication-card>
</x-guest-layout>
