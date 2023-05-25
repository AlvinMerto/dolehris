<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div> -->
        <div class="d-flex align-items-center justify-content-center ht-100v">

            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
                    <!-- <img src='https://www.dole.gov.ph/javascript/images/logo-masthead-large.png'/> -->
                    <span class="tx-normal"></span> DOLE <span class="tx-normal"></span>
                </div>
            <div class="tx-center mg-b-60">Human Resource Information System</div>

            <div class="form-group">
                <input type="text" id="email" class="form-control" placeholder="Enter your username" name="email" :value="old('email')" required autofocus autocomplete="username" >
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div><!-- form-group -->
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password"  placeholder="Enter your password">
                <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div><!-- form-group -->
            <button type="submit" class="btn btn-info btn-block">Sign In</button>

            <!-- <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ url('/register') }}" class="tx-info">Sign Up</a></div> -->
            <div class="mg-t-60 tx-center">Not yet a member? Please ask the HR for your account. </div>
            </div><!-- login-wrapper -->
        </div><!-- d-flex -->

    </form>
</x-guest-layout>
