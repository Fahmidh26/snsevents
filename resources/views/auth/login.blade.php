<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8" style="margin-bottom: 2rem;">
        <h2 class="text-3xl font-serif text-gray-900 tracking-wide mb-2" style="font-family: 'Playfair Display', serif; color: #111827; margin-bottom: 0.5rem; font-size: 1.875rem; line-height: 2.25rem;">Welcome Back</h2>
        <p class="text-gray-500 text-sm" style="color: #6b7280; font-size: 0.875rem;">Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5" style="margin-bottom: 1.25rem;">
            <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2" style="color: #4b5563; margin-bottom: 0.5rem;">{{ __('Email Address') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="padding-left: 1rem;">
                    <svg class="h-5 w-5 text-gray-400" style="color: #9ca3af; height: 1.25rem; width: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <!-- Need exactly original class mapping: block w-full pl-10 pr-3 py-2.5 border rounded-lg sm:text-sm -->
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="block w-full pl-10 pr-3 py-2.5 border rounded-lg sm:text-sm brand-focus" 
                    style="padding-left: 2.75rem; padding-right: 1rem; padding-top: 0.75rem; padding-bottom: 0.75rem; background-color: #f9fafb; border-color: #e5e7eb; color: #111827; box-sizing: border-box; width: 100%; border-radius: 0.5rem; border-width: 1px;"
                    placeholder="admin@example.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" style="margin-top: 0.5rem; color: #ef4444;" />
        </div>

        <!-- Password -->
        <div class="mb-6" style="margin-bottom: 1.5rem;">
            <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2" style="color: #4b5563; margin-bottom: 0.5rem;">{{ __('Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="padding-left: 1rem;">
                    <svg class="h-5 w-5 text-gray-400" style="color: #9ca3af; height: 1.25rem; width: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-10 pr-10 py-2.5 border rounded-lg sm:text-sm brand-focus" 
                    style="padding-left: 2.75rem; padding-right: 2.75rem; padding-top: 0.75rem; padding-bottom: 0.75rem; background-color: #f9fafb; border-color: #e5e7eb; color: #111827; box-sizing: border-box; width: 100%; border-radius: 0.5rem; border-width: 1px;"
                    placeholder="••••••••">
                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 transition-colors focus:outline-none brand-color-hover"
                    style="color: #9ca3af; padding-right: 1rem;"
                    onclick="const input = document.getElementById('password'); const iconShow = document.getElementById('icon-show'); const iconHide = document.getElementById('icon-hide'); if(input.type === 'password') { input.type = 'text'; iconShow.classList.add('hidden'); iconHide.classList.remove('hidden'); } else { input.type = 'password'; iconShow.classList.remove('hidden'); iconHide.classList.add('hidden'); }">
                    <svg id="icon-show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="height: 1.25rem; width: 1.25rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="icon-hide" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="height: 1.25rem; width: 1.25rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" style="margin-top: 0.5rem; color: #ef4444;" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6" style="margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
            <div class="flex items-center" style="display: flex; align-items: center;">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded cursor-pointer transition-colors duration-200 brand-color brand-focus" style="accent-color: #c9a227; border-color: #d1d5db; height: 1rem; width: 1rem;">
                <label for="remember_me" class="ml-2 block text-sm cursor-pointer" style="margin-left: 0.5rem; color: #4b5563; font-size: 0.875rem;">
                    {{ __('Remember me') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium transition-colors focus:outline-none brand-color-hover" style="color: #6b7280; font-size: 0.875rem;">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8" style="margin-top: 2rem;">
            <!-- exact original button classes mapping -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white focus:outline-none uppercase tracking-widest brand-bg" style="padding-top: 0.75rem; padding-bottom: 0.75rem; padding-left: 1rem; padding-right: 1rem; justify-content: center; align-items: center; display: flex; width: 100%; border-radius: 0.5rem; color: white;">
                {{ __('Sign In') }}
            </button>
        </div>
    </form>
</x-guest-layout>
