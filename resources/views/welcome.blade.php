<x-front.app title="Welcome page">
      <!-- banner  -->
      <div class="index">
            <section class="banner">

                  {{-- nav --}}
                  <x-front.nav />

                  <div class="container-fluid">
                        <div class="home-banner d-flex align-items-center">
                              <div class="home-banner-inner">
                                    <img class="img-fluid" src="{{ asset('front/images/home-banner-illustration.svg') }}"
                                          alt="">
                              </div>

                              <div class="content">
                                    <p class="fw-light">Learning that gets you <br> Skills for your present(and your
                                          future). Get started with us.
                                    </p>
                                    <span style="color: #fff;">Ready to binge?</span>
                                    <div class="buttons mt-5">
                                          <a class="btn" href="{{ route('pages.topics.all') }}">Browse topics</a>
                                          <a class="btn" href="{{ route('pages.support') }}">Discussion forum</a>
                                    </div>
                              </div>
                        </div>

                  </div>

            </section>

            <!-- main categories -->
            <section class="main-categories">
                  <div class="container">
                        <h3 class="text-center fw-lighter">Push your web development skills to the next
                              level, through <br />
                              expert screencasts on Laravel, Vue, and so much more.</h3>

                        {{-- playlist categories --}}
                        <div class="d-flex category-area mt-5">
                              @foreach ($categories as $category)
                                    <div class="shadow bg-body rounded category">
                                          <div class="category-top text-center">
                                                <div class="image-area">
                                                      <img class="img-fluid" style="display: inline;"
                                                            src="{{ $category->imageUrl() }}" alt="category image">
                                                </div>
                                                <div class="type-area">
                                                      <p><a href="#"
                                                                  class="text-decoration-none">{{ $category->name }}</a>
                                                      </p>
                                                </div>
                                          </div>

                                          <div class="category-bottom">
                                                <div class="content d-flex">
                                                      <div class="series">
                                                            <span
                                                                  class="d-block">{{ $category->getSeriesCount() }}</span>
                                                            <small>series</small>
                                                      </div>
                                                      <div class="co">|</div>
                                                      <div class="video">
                                                            <span
                                                                  class="d-block">{{ $category->getEpisodeCount() }}</span>
                                                            <small>episodes</small>
                                                      </div>
                                                </div>

                                                <!--explore button-->
                                                <div class="explore-btn d-grid gap-1">
                                                      <a href="#" class="btn text-decoration-none">
                                                            <i class="far fa-play-circle fa-fw"></i> Explore
                                                      </a>
                                                </div>
                                          </div>

                                    </div>
                              @endforeach

                        </div>
                  </div>
            </section>

            <!--rating course section-->
            <section class="rating py-5">
                  <div class="container">
                        <div class="header text-center">
                              <h3>What will you learn next?
                              </h3>
                              <p class="mt-4 fw-lighter">There's no shortage of content at Laracasts. Check back most
                                    work-days
                                    <br />
                                    for new lessons on your favorite web technologies and techniques.
                              </p>
                        </div>

                        <div class="series">
                              <div class="row">
                                    @foreach ($bits as $bit)
                                          <div class="col-sm-12 col-md-3  mt-5">
                                                <a href="http://" target="_blank" class="text-decoration-none">
                                                      <div class="image-area">
                                                            <img style="max-height: 184px;" class="img-fluid" src="{{ $bit->getPosterUrl() }}"
                                                                  alt="series image">
                                                      </div>
                                                      <p>{{ $bit->episode->title }}</p>
                                                      <span>{{ $bit->user->username }}</span>
                                                      <div class="rat d-flex mt-1">
                                                            <small>4.5</small>
                                                            <div class="star">
                                                                  <i class="fas fa-star" style="color: #645beb;"></i>
                                                                  <i class="fas fa-star" style="color: #645beb;"></i>
                                                                  <i class="fas fa-star" style="color: #645beb;"></i>
                                                                  <i class="fas fa-star" style="color: #645beb;"></i>
                                                                  <i class="fas fa-star" style="color: #fff;"></i>
                                                                  <small>(12,000)</small>
                                                            </div>

                                                      </div>
                                                </a>
                                          </div>
                                    @endforeach

                              </div>
                        </div>
                  </div>
            </section>

            {{-- random --}}
            @foreach ($serieses as $series)
                  <section class="educBit mx-2">
                        <div class="container">
                              <h3>Short and sweet courses for you "<a href="#"
                                          class="text-decoration-none">{{ $series->topic->category->name }}</a>"
                              </h3>

                              <div class="educ-video mt-4 owl-carousel owl-theme">

                                    @foreach ($series->sections as $section)
                                          @foreach ($section->episodes as $episode)
                                                <div class="item">
                                                      <img class="img-fluid" src="{{ $series->getPosterUrl() }}"
                                                            alt="series image">
                                                      <p>{{ $episode->title }}</p>
                                                      <span>{{ $series->user->username }}</span>
                                                </div>
                                          @endforeach
                                    @endforeach
                              </div>
                  </section>
            @endforeach

            <!--Random sub-categories-->
            <section class="sub-category">
                  <div class="container">
                        <h3>Education<span>ForFree</span></h3>
                        <p class="fw-lighter">If you already know what you're looking for, EducationForFree is divided
                              into
                              various, check what do you want to learn</p>
                  </div>
                  <div class="container-fluid">
                        <div class="owl-carousel owl-theme mt-5">
                              @foreach ($topics as $topic)
                                    <a href="#" class="d-flex text-decoration-none box shadow  rounded">
                                          <div class="image-area">
                                                <img width="50" height="50" src="{{ $topic->getPosterUrl() }}"
                                                      alt="image">
                                          </div>
                                          <div class="content">
                                                <span>{{ $topic->name }}</span>
                                                <div class="info">
                                                      <small>{{ $topic->series_count }} series</small>
                                                      <small>{{ $topic->getEpisodeCount() }} videos</small>
                                                </div>
                                          </div>
                                    </a>
                              @endforeach
                        </div>
                  </div>
            </section>

            <!-- topic categories navigation -->
            <section class="topic-categories">

                  <h2 class="section-header">Explore Topics</h2>
                  <p class="section-paragraph">EducationForFree is categorized into a variety of topics.</p>
                  <div class="content-area">

                        <!--new navigation-->
                        <section class="new-nav">
                              <div class="container">
                                    <ul>
                                          <li>
                                                <a href="{{ route('pages.topics.all') }}" class="my-active">All
                                                      Topics</a>
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
                                                      href="{{ route('pages.topics.tooling') }}">Tooling</a>
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
                                                      <a href="#"
                                                            class="d-flex text-decoration-none box shadow rounded">
                                                            <div class="image-area">
                                                                  <img src="{{ $topic->getPosterUrl() }}"
                                                                        alt="image">
                                                            </div>
                                                            <div class="content">
                                                                  <span>{{ $topic->name }}</span>
                                                                  <div class="info">
                                                                        <small>{{ $topic->series_count }}
                                                                              series</small>
                                                                        <small>{{ $topic->getEpisodeCount() }}
                                                                              videos</small>
                                                                  </div>
                                                            </div>
                                                      </a>
                                                </div>
                                          @endforeach
                                    </div>
                              </div>
                        </section>
                  </div>
            </section>

            {{-- footer --}}
            <x-front.footer />
      </div>

</x-front.app>
