<div class="h-32 md:h-auto md:w-1/2">
@switch(Route::currentRouteName())
    @case(Route::currentRouteName() == 'register')
        <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/create-account-office.jpeg') }}" alt="Office" />
        <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/create-account-office-dark.jpeg') }}" alt="Office" />
    @break
    @case(Route::currentRouteName() == 'password.request')
        <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/forgot-password-office.jpeg') }}" alt="Office" />
        <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/forgot-password-office-dark.jpeg') }}" alt="Office" />
    @break
    @default()
        <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/login-office.jpeg') }}" alt="Office" />
        <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/login-office-dark.jpeg') }}" alt="Office" />
@endswitch
</div>

<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
    <div class="w-full">
        {{ $slot }}
    </div>
</div>

{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}
