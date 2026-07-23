<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- 名前 -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- メールアドレス -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- 電話番号 --}}
        <div class="mt-4">
            <x-input-label for="phone" :value="__('電話番号')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- 郵便番号 --}}
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('郵便番号')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required autocomplete="postal-code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        {{-- 都道府県 --}}
        <div class="mt-4">
            <x-input-label for="prefecture" :value="__('都道府県')" />
            <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture')" required autocomplete="address-level1" />
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>

        {{-- 市町村 --}}
        <div class="mt-4">
            <x-input-label for="city" :value="__('市町村')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autocomplete="address-level2" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        {{-- 丁目・番地 --}}
        <div class="mt-4">
            <x-input-label for="address" :value="__('丁目・番地')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="street-address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        {{-- 建物名 --}}
        <div class="mt-4">
            <x-input-label for="building" :value="__('建物名')" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building" :value="old('building')" autocomplete="address-line2" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        <!-- パスワード -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- パスワード（確認） -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（確認）')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('すでに会員登録済みの方はこちら') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
