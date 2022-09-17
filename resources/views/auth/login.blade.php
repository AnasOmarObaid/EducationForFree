{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<x-front.app title="Login">
      <!--login-->
      <section class="login">
            <!-- container -->
            <div class="container">
                  <!-- row -->
                  <div class="row">
                        <!-- form-area -->
                        <div class="col-12 col-md-6">
                              <section class="form-area bg-white shadow-sm p-3 mb-5 bg-body rounded"
                                    style="margin-bottom:0 !important">
                                    <div class="brand">
                                          <h2><a href="{{ route('welcome') }}"
                                                      class="text-decoration-none">EducationForFree</a></h2>
                                    </div>

                                    <!--form-->
                                    <form action="{{ route('login') }}" class="mt-5" method="post">
                                          @csrf

                                          <x-jet-validation-errors class="mb-4" />

                                          @if (session('status'))
                                                <div class="mb-4 font-medium text-sm text-green-600">
                                                      {{ session('status') }}
                                                </div>
                                          @endif

                                          <!-- email address -->
                                          <div class="mb-4 field">
                                                <input type="email" value="{{ old('email') }}" name='email'
                                                      class="form-control" placeholder="Enter email">
                                                <div class="input-icon">
                                                      <i class="fas fa-envelope fa-fw"></i>
                                                </div>
                                          </div>
                                          <!-- password -->
                                          <div class="mb-4 field">
                                                <input type="password" class="form-control" name="password"
                                                      placeholder="Enter password">
                                                <div class="input-icon">
                                                      <i class="fas fa-unlock-alt fa-fw"></i>
                                                </div>
                                          </div>
                                          <!-- submit -->
                                          <div class="d-grid gap-1 pt-2">
                                                <button type="submit" class="btn btn-primary btn-block"> <i
                                                            class="fas fa-check fa-fw" style="font-size: 1rem;"></i>
                                                      Login</button>
                                          </div>
                                          <!-- check me -->
                                          <div class="mb-3 mt-4 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                                <a link href="{{ route('password.request') }}"
                                                      class="text-decoration-none">Forget
                                                      your password? click me</a>
                                          </div>
                                    </form>

                                    <hr class="my-4">
                                    <p class="text-center">Do you don't have account? <a href="{{ route('register') }}"
                                                class="text-decoration-none">Register</a>
                                    </p>

                                    <!-- social media -->
                                    <div class="d-grid gap-2 pt-2">
                                          <a href="" class="btn btn-primary btn-block"><i
                                                      class="fab fa-facebook-f fa-fw"></i> Login
                                                by facebook</a>
                                          <a href="" class="btn btn-primary btn-block mt-1"><i
                                                      class="fab fa-google fa-fw"></i> Login
                                                by Google</a>
                                    </div>
                              </section>
                        </div>

                        <!-- image-area -->
                        <div class="col-12 col-md-6 d-flex">
                              <img class="img-fluid d-none d-md-block" style="margin-left: 1.3rem;"
                                    src="{{ asset('front/images/login.svg') }}" alt="login image" />
                        </div>
                  </div>
            </div>
      </section>
</x-front.app>
