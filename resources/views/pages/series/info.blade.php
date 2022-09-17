<x-front.app title="Series">

      <div class="series">
            <x-front.nav-topics />
            <div class="series-title">
                  <!-- banner -->
                  <section class="banner">
                        <div class="container">
                              <div class="wrapper">
                                    <div class="series-image">
                                          <img src="{{ $series->getPosterUrl() }}" alt="series image"
                                                width="215" height="215">
                                    </div>
                                    <div class="information">
                                          <div class="title">
                                                <h3>{{ $series->name }}</h3>
                                          </div>
                                          <div class="paragraph" style="margin-bottom: 5rem">
                                                {!! str()->limit($series->description, 250) !!}
                                          </div class="">
                                          <div class="buttons mt-5">
                                                <a href="{{ route('pages.series.show', [$series, $series->sections->first()->episodes->first()->id]) }}" class="btn"><i
                                                            class="far fa-play-circle fa-fw"></i> Start Series</a>
                                                <a href="#" class="btn"><i class="fas fa-heart fa-fw"></i> Add
                                                      to favorite</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </section>

                  <!--tail section-->
                  <section class="tail">
                        <div class="container">
                              <div class="wrapper">
                                    <div class="left">
                                          <ul>
                                                <li><i class="fas fa-book fa-fw"></i>
                                                      {{ $series->getEpisodeCount() }}episodes</li>
                                                <li><i class="fas fa-clock fa-fw"></i>{{ $series->created_at->diffForHumans() }}
                                                </li>
                                                <li><i class="fas fa-at fa-fw"></i>{{ $series->topic->name }}</li>
                                                <li><a href=""
                                                            class="btn">{{ $series->topic->category->name }}</a></li>
                                          </ul>
                                    </div>
                                    <div class="right">
                                          <a href="#"><i class="icon fab fa-facebook"></i></a>
                                          <a href="#"><i class="icon fab fa-twitter"></i></a>
                                    </div>
                              </div>
                        </div>
                  </section>

                  <!-- teacher box information -->
                  <section class="teacher">
                        <div class="container">
                              <div class="teacher-box">
                                    <div class="top">
                                          <div class="teacher-name">
                                                <h5>YOUR TEACHER | {{ $series->user->name }}</h5>
                                          </div>
                                          <div class="teacher-media">
                                                <a href="#"><i class="icon fab fa-facebook"></i></a>
                                                <a href="#"><i class="icon fab fa-twitter"></i></a>
                                          </div>
                                    </div>
                                    <div class="bottom">
                                          <div class="image">
                                                <img src="{{ $series->user->profile_photo_url }}" alt="user image"
                                                      height="72" width="72">
                                          </div>
                                          <p class="w-100 m-0">Hi, {{ $series->user->name }}. I'm the creator of
                                                Laracasts and spend
                                                most of my days
                                                building the site and
                                                thinking of new ways to teach confusing concepts. I live in Orlando,
                                                Florida with my wife
                                                and two kids.</p>
                                    </div>
                              </div>
                        </div>
                  </section>

                  <!-- start sections for series -->
                  <section class="series-sections">

                        <div class="container">
                              <div class="accordion" id="accordionPanelsStayOpenExample">
                                    @foreach ($series->sections as $section)
                                          <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                      <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#panelsStayOpen-{{ $section->id }}"
                                                            aria-expanded="true" aria-controls="panelsStayOpen-1">
                                                            Section 1 | {{ $section->name }}
                                                      </button>
                                                </h2>
                                                @foreach ($section->episodes as $episode)
                                                      <div id="panelsStayOpen-{{ $section->id }}"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body">

                                                                  <a href="{{ route('pages.series.show', [$series, $episode]) }}" class="episode-box">
                                                                        <div class="episode-number">
                                                                              <div class="number">{{ $loop->index+1 }}</div>
                                                                        </div>
                                                                        <div class="episode-information">
                                                                              <h4 class="title">{{ $episode->title }}
                                                                              </h4>
                                                                              {!! str()->limit($episode->description, 100) !!}
                                                                              <div class="episode-inf">
                                                                                    <span>Episode {{ $loop->index+1 }}</span>
                                                                                    <span>1h6m</span>
                                                                              </div>
                                                                        </div>
                                                                  </a>

                                                            </div>
                                                      </div>
                                                @endforeach
                                          </div>
                                    @endforeach

                              </div>
                        </div>

                  </section>

                  <!--image section-->
                  <section class="image-section">
                        <div class="container">
                              <img src="../dest/images/series-in-progress-robot.svg" alt=""
                                    class="text-center"><br>
                        </div>
                  </section>
            </div>

            <!--footer section-->
            <x-front.footer />
      </div>

</x-front.app>
