<nav class="navbar navbar-expand-lg pt-3">
      <div class="container-fluid">
            <div class="brand">
                  <h2><a href="{{ route('welcome') }}"
                              class="text-decoration-none navbar-brand">Education<span>ForFree</span></a>
                  </h2>
            </div>

            <!--collapse buttons-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>

            <!--nav list-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                  <div class="col-12 col-md-9">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                              <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs('pages.topics.*')) my-active @endif"
                                          href="{{ route('pages.topics.all') }}">Topics</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs('pages.series.*')) my-active @endif" href="{{ route('pages.series.index') }}">Series</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs('pages.bits.*')) my-active @endif" href="{{ route('pages.bits.index') }}">EducBit</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs('pages.posts.*')) my-active @endif" href="{{ route('pages.posts.index') }}">Blogs</a>
                              </li>

                              <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.teach') }}">instructor</a>
                              </li>

                        </ul>
                  </div>

                  <!--login and signup-->

                  <div class="buttons float-end">
                        @guest
                              <a href="{{ route('login') }}" class="btn" type="submit"><i
                                          class="fas fa-sign-in-alt fa-fw"></i>
                                    login</a>
                              <a href="{{ route('register') }}" class="btn" type="submit"><i
                                          class="fas fa-sign-in-alt fa-fw"></i> sign
                                    up</a>
                        @else
                              <div class="ml-3 relative">
                                    <x-jet-dropdown align="right" width="48">
                                          <x-slot name="trigger">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                      <button
                                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                            <img class="h-8 w-8 rounded-full object-cover"
                                                                  src="{{ Auth::user()->profile_photo_url }}"
                                                                  alt="{{ Auth::user()->name }}" />
                                                      </button>
                                                @else
                                                      <span class="inline-flex rounded-md">
                                                            <button type="button"
                                                                  class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                                  {{ Auth::user()->name }}

                                                                  <svg class="ml-2 -mr-0.5 h-4 w-4"
                                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                        fill="currentColor">
                                                                        <path fill-rule="evenodd"
                                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                              clip-rule="evenodd" />
                                                                  </svg>
                                                            </button>
                                                      </span>
                                                @endif
                                          </x-slot>

                                          <x-slot name="content">
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                      {{ __('Manage Account') }}
                                                </div>

                                                {{-- admin dashboard --}}
                                                @if (auth()->user()->hasRole(['admin']))
                                                      <x-jet-dropdown-link href="{{ route('admins.welcome') }}">
                                                            {{ __('Dashboard') }}
                                                      </x-jet-dropdown-link>
                                                @endif

                                                <div class="border-t border-gray-100"></div>

                                                {{-- profile --}}
                                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                      {{ __('Profiles') }}
                                                </x-jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}" x-data>
                                                      @csrf

                                                      <x-jet-dropdown-link href="{{ route('logout') }}"
                                                            @click.prevent="$root.submit();">
                                                            {{ __('Log Out') }}
                                                      </x-jet-dropdown-link>
                                                </form>

                                          </x-slot>
                                    </x-jet-dropdown>
                              </div>
                        @endguest

                  </div>


            </div>
      </div>
</nav>
