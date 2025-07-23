<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative" x-data="{ showCurrentPassword: false }">
                <x-text-input id="update_password_current_password" name="current_password" class="block mt-1 w-full pr-10"
                                x-bind:type="showCurrentPassword ? 'text' : 'password'"
                                autocomplete="current-password" />
                <button type="button" @click="showCurrentPassword = !showCurrentPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <template x-if="showCurrentPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </template>
                        <template x-if="!showCurrentPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .47 0 .929.049 1.375.145M12 19v1m-4.5-4.5l-.707.707M12 19h1M6 15l-.707.707M5 12h-.707M19 12h.707m-4.5-4.5l.707.707M17 17l.707.707m-4.5 0H12v-1.5M12 6.5V6M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </template>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative" x-data="{ showNewPassword: false }">
                <x-text-input id="update_password_password" name="password" class="block mt-1 w-full pr-10"
                                x-bind:type="showNewPassword ? 'text' : 'password'"
                                autocomplete="new-password" />
                <button type="button" @click="showNewPassword = !showNewPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <template x-if="showNewPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </template>
                        <template x-if="!showNewPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .47 0 .929.049 1.375.145M12 19v1m-4.5-4.5l-.707.707M12 19h1M6 15l-.707.707M5 12h-.707M19 12h.707m-4.5-4.5l.707.707M17 17l.707.707m-4.5 0H12v-1.5M12 6.5V6M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </template>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative" x-data="{ showConfirmNewPassword: false }">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" class="block mt-1 w-full pr-10"
                                x-bind:type="showConfirmNewPassword ? 'text' : 'password'"
                                autocomplete="new-password" />
                <button type="button" @click="showConfirmNewPassword = !showConfirmNewPassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <template x-if="showConfirmNewPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </template>
                        <template x-if="!showConfirmNewPassword">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .47 0 .929.049 1.375.145M12 19v1m-4.5-4.5l-.707.707M12 19h1M6 15l-.707.707M5 12h-.707M19 12h.707m-4.5-4.5l.707.707M17 17l.707.707m-4.5 0H12v-1.5M12 6.5V6M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </template>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>