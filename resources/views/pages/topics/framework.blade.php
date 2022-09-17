<x-front.app title='Topics | Frameworks'>
      <!-- topics  -->
      <div class="topics">

            <x-front.nav-topics />

            <!--introduction-->
            <section class="introduction">
                  <div class="container">
                        <h3>Explore By Topic</h3>
                        <p>All EducationForFree series are categorized into various <span
                                    style="color: #ffffff;display: inline-block;font-weight: bold;opacity: 1;">//topics.</span>
                              This
                              should provide you with an alternate
                              way to decide what to learn next, whether it be a particular framework, language, or tool.
                        </p>
                  </div>
            </section>

            <!--new navigation-->
            <section class="new-nav">
                  <div class="container">
                        <ul>
                              <li>
                                    <a href="{{ route('pages.topics.all') }}"
                                          class="{{ request()->routeIs('pages.topics.all') ? 'my-active' : '' }}">All
                                          topics</a>
                              </li>
                              <li>
                                    <a class="{{ request()->routeIs('pages.topics.framework') ? 'my-active' : 's' }}"
                                          href="{{ route('pages.topics.framework') }}">Frameworks</a>
                              </li>
                              <li>
                                    <a href="{{ route('pages.topics.testing') }}"
                                          class="{{ request()->routeIs('pages.topics.testing') ? 'my-active' : 's' }}">Testing</a>
                              </li>
                              <li>
                                    <a class="{{ request()->routeIs('pages.topics.languages') ? 'my-active' : 's' }}"
                                          href="{{ route('pages.topics.languages') }}">Languages</a>
                              </li>
                              <li>
                                    <a class="{{ request()->routeIs('pages.topics.tooling') ? 'my-active' : 's' }}"
                                          href="{{ route('pages.topics.tooling')}}">Tooling</a>
                              </li>
                              <li>
                                    <a class="{{ request()->routeIs('pages.topics.techniques') ? 'my-active' : 's' }}"
                                          href="{{ route('pages.topics.techniques') }}">Techniques</a>
                              </li>
                        </ul>
                  </div>
            </section>

            <!-- content -->
            <section class="all-topics">
                  <div class="container">
                        <div class="row">
                              @foreach ($topics as $topic)
                                    <div class="col-12 col-md-3 col-xxl-2">
                                          <a href="#" class="d-flex text-decoration-none box shadow rounded">
                                                <div class="image-area">
                                                      <img src="{{ $topic->getPosterUrl() }}" alt="image">
                                                </div>
                                                <div class="content">
                                                      <span>{{ $topic->name }}</span>
                                                      <div class="info">
                                                            <small>{{ $topic->series_count }} series</small>
                                                            <small>{{ $topic->getEpisodeCount() }} videos</small>
                                                      </div>
                                                </div>
                                          </a>
                                    </div>
                              @endforeach

                        </div>

                  </div>
            </section>

            <!--footer section-->
            <x-front.footer />
      </div>


</x-front.app>
