{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

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
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}


<x-front.app title="Register">
  <!--Register-->
  <section class="register">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- form-area -->
            <div class="col-12 col-md-6">
                <section class="form-area bg-white shadow-sm p-3 mb-5 bg-body rounded" style="margin-bottom:0 !important">
                    <div class="">
                        <h2><a href="index.html" class="text-decoration-none">EducationForFree</a></h2>
                    </div>
                    <!--form-->
                    <form class="mt-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <x-jet-validation-errors class="mb-4" />
                        <!-- name user -->
                        <div class="mb-4 field">
                            <input type="text" name='name' value="{{ old('name') }}" class="form-control" placeholder="Enter your name">
                            <div class="input-icon">
                                <i class="fas fa-user fa-fw"></i>
                            </div>
                        </div>

                        <!-- email address -->
                        <div class="mb-4 field">
                            <input type="email" name='email' value="{{ old('email') }}" class="form-control" placeholder="Enter email">
                            <div class="input-icon">
                                <i class="fas fa-envelope fa-fw"></i>
                            </div>
                        </div>

                        <!-- password -->
                        <div class="mb-4 field">
                            <input type="password" class="form-control" name='password' placeholder="Enter password">
                            <div class="input-icon">
                                <i class="fas fa-unlock-alt fa-fw"></i>
                            </div>
                        </div>

                        <!-- confirm password -->
                        <div class="mb-4 field">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            <div class="input-icon">
                                <i class="fas fa-unlock-alt fa-fw"></i>
                            </div>
                        </div>
                        <!-- submit -->
                        <div class="d-grid gap-1 pt-2">
                            <button type="submit" class="btn btn-primary btn-block"> <i class="fas fa-check fa-fw"
                                    style="font-size: 1rem;"></i> Register</button>
                        </div>
                        <!-- check me -->
                        <div class="mb-3 mt-4 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                    </form>

                    <hr class="my-4">
                    <p class="text-center">Do you have already account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </p>

                    <!-- social media -->
                    <div class="d-grid gap-2 pt-2">
                        <a href="" class="btn btn-primary btn-block"><i class="fab fa-facebook-f fa-fw"></i> Register
                            by facebook</a>
                        <a href="" class="btn btn-primary btn-block mt-1"><i class="fab fa-google fa-fw"></i> Register
                            by Google</a>
                    </div>
                </section>
            </div>
            <!-- image-area -->
            <div class="col-12 col-md-6 d-flex">
                <img class="img-fluid d-none d-md-block" style="margin-left: 6rem;max-width: 85%;" src="{{ asset('front/images/register.svg') }}" alt="Register image" />
            </div>
        </div>
    </div>
</section>
</x-front.app>
