<x-front.app title="Series">

      <div class="series">
            <x-front.nav-topics />
            <!-- page header -->
            <section class="introduction">
                  <div class="container">
                        <h2 class="section-header">Recently Updated</h2>
                        <p class="section-paragraph">Curious what's new at <span class="span">EducationForFree?</span>
                              The
                              following series
                              have been recently updated.
                        </p>
                  </div>
            </section>


            <!--Recently updated section-->
            <section class="recently-updated">
                  <div class="container">

                        <div class="course">
                              <div class="image-area">
                                    <img width="420" height="auto" src="{{ $main_series->getPosterUrl() }}"
                                          alt="course image">
                              </div>

                              <div class="content">
                                    <h3 class="title"><a href="{{ route('pages.series.info', $main_series) }}">{{ $main_series->name }}</a></h3>
                                    {!! str()->limit($main_series->description, 150) !!}

                              </div>

                              <div class="bottom-information">
                                    <ul>
                                          <li>
                                                <a href="{{ route('pages.series.info', $main_series) }}"><i class="fas fa-book"></i></i>
                                                      {{ $main_series->getEpisodeCount() }}
                                                      lessons</a>
                                          </li>
                                          <li>
                                                <i class="fas fa-clock"></i>
                                                {{ $main_series->created_at->diffForHumans() }}
                                          </li>
                                          <li>
                                                <i class="fas fa-at"></i> <a
                                                      href="{{ route('pages.series.info', $main_series) }}">{{ $main_series->topic->category->name }}</a>
                                          </li>
                                    </ul>
                                    <div class="buttons">
                                          <a href="{{ route('pages.series.info', $main_series) }}" class="btn"><i
                                                      class="far fa-play-circle fa-fw"></i>
                                                Start Series</a>
                                          <a href="#" class="btn"><i class="fas fa-heart fa-fw"></i> Add to
                                                favorite</a>
                                    </div>
                              </div>

                              <div class="aside-information">
                                    <!-- number -->
                                    <a href="{{ route('pages.series.info', $main_series) }}" class="episode">
                                          <div class="number">
                                                <span>{{ $main_series->getEpisodeCount() }}</span>
                                          </div>
                                    </a>

                                    <!--LATEST EPISODE IN THIS SERIES-->
                                    <div class="episode-information">
                                          <span>LATEST EPISODE IN THIS SERIES</span>
                                          <span>Added {{ $main_series->created_at->diffForHumans() }}</span>
                                          <p>{{ $main_series->sections->last()->episodes->last()->title }}</p>
                                          <span class="episode-span">{!! str()->limit($main_series->sections->last()->episodes->last()->description, 50) !!}</span>
                                          <div class="buttons">
                                                <a href="{{ route('pages.series.info', $main_series) }}" class="btn"><i
                                                            class="far fa-play-circle fa-fw"></i> Watch</a>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        <div class="wrapper">
                              <div class="content-wrapper">

                                    <div class="row">
                                          @foreach ($main_series->sections as $section)
                                                @foreach ($section->episodes as $episode)
                                                      <div class="col-12 col-md-6">
                                                            <a href="{{ route('pages.series.info', $main_series) }}">
                                                                  <div class="content">
                                                                        <div class="image-area">
                                                                              <img src="{{ $main_series->getPosterUrl() }}"
                                                                                    alt="course image" width="76"
                                                                                    height="76" />
                                                                        </div>
                                                                        <div class="information">
                                                                              <h5>{{ $episode->title }}</h5>
                                                                              {!! str()->limit($episode->description, 100) !!}
                                                                        </div>
                                                                  </div>
                                                            </a>

                                                      </div>
                                                @endforeach
                                          @endforeach

                                    </div>

                              </div>
                        </div>
                  </div>
            </section>

            <!-- new to EducationF4 -->
            <section class="new-to-education4f introduction">
                  <div class="container">
                        <h2 class="section-header">New to <span class="span">EducationForFree?</span></h2>
                        <p class="section-paragraph">Brand new to EducationForFree? Might we suggest these two beginner
                              series
                              to get you started?</p>

                        <div class="wrapper">

                              <div class="row">
                                    @foreach ($news as $new)
                                          <div class="col-12 col-md-6">
                                                <!-- course -->
                                                <div class="course">
                                                      <div class="image-area">
                                                            <img src="{{ $new->getPosterUrl() }}" alt="images"
                                                                  width="420" height="420">
                                                      </div>
                                                      <div class="top-information">
                                                            <div class="title">
                                                                  <h3>
                                                                        <a href="{{ route('pages.series.info', $new) }}">{{ $new->name }}</a>
                                                                  </h3>
                                                                  {!! str()->limit($new->description, 150) !!}
                                                            </div>
                                                      </div>
                                                      <div class="bottom-information">
                                                            <ul>
                                                                  <li>
                                                                        <a href="{{ route('pages.series.info', $new) }}"><i
                                                                                    class="fas fa-book"></i></i>
                                                                              {{ $new->getEpisodeCount() }}
                                                                              lessons</a>
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-clock"></i>
                                                                        {{ $new->created_at->diffForHumans() }}
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-at"></i> <a
                                                                              href="{{ route('pages.series.info', $new) }}">{{ $new->topic->category->name }}</a>
                                                                  </li>
                                                            </ul>
                                                            <div class="buttons">
                                                                  <a href="{{ route('pages.series.info', $new) }}" class="btn"><i
                                                                              class="far fa-play-circle fa-fw"></i>
                                                                        Start
                                                                        Series</a>
                                                            </div>
                                                      </div>
                                                </div>

                                          </div>
                                    @endforeach
                              </div>

                        </div>
                  </div>
            </section>

            <!-- Learn a tool -->
            <section class="learn-tool">
                  <div class="container">
                        <h2 class="section-header">Learn a Tool</h2>
                        <p class="section-paragraph">You use your tools every single day. So take some time to master
                              them.
                        </p>
                        @if ($tools->count())
                              <div class="course">
                                    <div class="image-area">
                                          <img width="420" height="auto"
                                                src="{{ $tools->first()->getPosterUrl() }}" alt="course image">
                                    </div>

                                    <div class="content">
                                          <h3 class="title"><a href="{{ route('pages.series.info', $tools->first()) }}">{{ $tools->first()->name }}</a></h3>
                                          {!! str()->limit($tools->first()->description, 100) !!}

                                    </div>

                                    <div class="bottom-information">
                                          <ul>
                                                <li>
                                                      <a href="{{ route('pages.series.info', $tools->first()) }}"><i class="fas fa-book"></i></i>
                                                            {{ $tools->first()->getEpisodeCount() }} lessons</a>
                                                </li>
                                                <li>
                                                      <i class="fas fa-clock"></i>
                                                      {{ $tools->first()->created_at->diffForHumans() }}
                                                </li>
                                                <li>
                                                      <i class="fas fa-at"></i> <a
                                                            href="{{ route('pages.series.info', $tools->first()) }}">{{ $tools->first()->topic->category->name }}</a>
                                                </li>
                                          </ul>
                                          <div class="buttons">
                                                <a href="{{ route('pages.series.info', $tools->first()) }}" class="btn"><i
                                                            class="far fa-play-circle fa-fw"></i>
                                                      Start
                                                      Series</a>
                                                <a href="{{ route('pages.series.info', $tools->first()) }}" class="btn"><i class="fas fa-heart fa-fw"></i>
                                                      Add to
                                                      favorite</a>
                                          </div>
                                    </div>

                                    <div class="aside-information">
                                          <!-- number -->
                                          <a href="{{ route('pages.series.info', $tools->first()) }}" class="episode">
                                                <div class="number">
                                                      <span>{{ $tools->first()->getEpisodeCount() }}</span>
                                                </div>
                                          </a>

                                          <!--LATEST EPISODE IN THIS SERIES-->
                                          <div class="episode-information">
                                                <span>LATEST EPISODE IN THIS SERIES</span>
                                                <span>Added {{ $tools->first()->created_at->diffForHumans() }}</span>
                                                <p>{!! $tools->first()->sections->last()->episodes->last()->title !!}</p>
                                                <span class="episode-span">Laravel's traditional getXAttribute and
                                                      {!! str()->limit(
                                                          $tools->first()->sections->last()->episodes->last()->description,
                                                      ) !!}
                                                </span>
                                                <div class="buttons">
                                                      <a href="{{ route('pages.series.info', $tools->first()) }}" class="btn"><i
                                                                  class="far fa-play-circle fa-fw"></i>
                                                            Watch</a>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        @endif

                        <div class="mini-wrapper">
                              @foreach ($tools->take(3) as $tool)
                                    <div class="mini-course ">
                                          <div class="image-area">
                                                <img src="{{ $tool->getPosterUrl() }}" alt="course image"
                                                      width="225">
                                          </div>
                                          <div class="content">
                                                <h4><a href="{{ route('pages.series.info', $tool) }}">{{ $tool->name }}</a></h4>
                                                {!! str()->limit($tool->description, 100) !!}
                                          </div>
                                          <div class="bottom-information">
                                                <ul>
                                                      <li>
                                                            <a href="{{ route('pages.series.info', $tool) }}"><i class="fas fa-book"></i></i>
                                                                  {{ $tool->getEpisodeCount() }}
                                                                  lessons</a>
                                                      </li>
                                                      <li>
                                                            <i class="fas fa-clock"></i>
                                                            {{ $tool->created_at->diffForHumans() }}
                                                      </li>
                                                      <li>
                                                            <i class="fas fa-at"></i> <a
                                                                  href="{{ route('pages.series.info', $tool) }}">{{ $tool->topic->category->name }}</a>
                                                      </li>
                                                </ul>
                                          </div>
                                          <div class="bottom-toggle">
                                                <div class="buttons">
                                                      <a href="{{ route('pages.series.info', $tool) }}" class="btn"><i
                                                                  class="far fa-play-circle fa-fw"></i>
                                                            Start Series</a>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach

                        </div>
            </section>

            <!-- testing section -->
            <section class="testing">
                  <div class="container">
                        <h2 class="section-header">Level Up Your Testing</h2>
                        <p class="section-paragraph">Imagine a workflow that alerts you each time a particular refactor
                              was
                              unsuccessful. How <br> much more might you get done with that level of confidence?
                        </p>
                        <div class="wrapper">

                              <div class="row">
                                    @foreach ($testings->take(2) as $testing)
                                          <div class="col-12 col-md-6">
                                                <!-- course -->
                                                <div class="course">
                                                      <div class="image-area">
                                                            <img src="{{ $testing->getPosterUrl() }}" alt="images"
                                                                  width="420" height="420">
                                                      </div>
                                                      <div class="top-information">
                                                            <div class="title">
                                                                  <h3>
                                                                        <a href="{{ route('pages.series.info', $testing) }}">{{ $testing->name }}</a>
                                                                  </h3>
                                                                  {!! str()->limit($testing->description, 150) !!}
                                                            </div>
                                                      </div>
                                                      <div class="bottom-information">
                                                            <ul>
                                                                  <li>
                                                                        <a href="{{ route('pages.series.info', $testing) }}"><i
                                                                                    class="fas fa-book"></i></i>
                                                                              {{ $testing->getEpisodeCount() }}
                                                                              lessons</a>
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-clock"></i>
                                                                        {{ $testing->created_at->diffForHumans() }}
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-at"></i> <a
                                                                              href="{{ route('pages.series.info', $testing) }}">{{ $testing->topic->category->name }}</a>
                                                                  </li>
                                                            </ul>
                                                            <div class="buttons">
                                                                  <a href="{{ route('pages.series.info', $testing) }}" class="btn"><i
                                                                              class="far fa-play-circle fa-fw"></i>
                                                                        Start
                                                                        Series</a>
                                                            </div>
                                                      </div>
                                                </div>

                                          </div>
                                    @endforeach

                              </div>

                        </div>
                        <div class="other-wrapper">
                              <div class="content-wrapper">

                                    <div class="row">

                                          @foreach ($testings as $testing)
                                                <div class="col-12 col-md-6">
                                                      <a href="{{ route('pages.series.info', $testing) }}">
                                                            <div class="content">
                                                                  <div class="image-area">
                                                                        <img src="{{ $testing->getPosterUrl() }}"
                                                                              alt="course image" width="76"
                                                                              height="76" />
                                                                  </div>
                                                                  <div class="information">
                                                                        <h5>{{ $testing->name }}</h5>
                                                                        {!! str()->limit($testing->description, 100) !!}
                                                                  </div>
                                                            </div>
                                                      </a>

                                                </div>
                                          @endforeach

                                    </div>

                              </div>
                        </div>
                  </div>
            </section>

            <!-- learn languages -->
            <section class="language">
                  <div class="container">
                        <h2 class="section-header">Learn Languages</h2>
                        <p class="section-paragraph">Pull up a chair and watch as we, from scratch, build a variety of
                              real-world apps.
                        </p>

                        <div class="mini-wrapper">
                              @foreach ($languages->take(3) as $language)
                                    <div class="mini-course">
                                          <div class="image-area">
                                                <img src="{{ $language->getPosterUrl() }}" alt="course image"
                                                      width="225">
                                          </div>
                                          <div class="content">
                                                <h4><a href="{{ route('pages.series.info', $language) }}">{{ $language->name }}</a></h4>
                                                {!! str()->limit($language->description, 100) !!}
                                          </div>
                                          <div class="bottom-information">
                                                <ul>
                                                      <li>
                                                            <a href="{{ route('pages.series.info', $language) }}"><i class="fas fa-book"></i></i>
                                                                  {{ $language->getEpisodeCount() }}
                                                                  lessons</a>
                                                      </li>
                                                      <li>
                                                            <i class="fas fa-clock"></i>
                                                            {{ $language->created_at->diffForHumans() }}
                                                      </li>
                                                      <li>
                                                            <i class="fas fa-at"></i> <a
                                                                  href="{{ route('pages.series.info', $language) }}">{{ $language->topic->category->name }}</a>
                                                      </li>
                                                </ul>
                                          </div>
                                          <div class="bottom-toggle">
                                                <div class="buttons">
                                                      <a href="{{ route('pages.series.info', $language) }}" class="btn"><i
                                                                  class="far fa-play-circle fa-fw"></i>
                                                            Start Series</a>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach

                        </div>

                        <div class="other">
                              <h4>Don't Forget About These </h4>
                              <div class="other-wrapper">
                                    @foreach ($languages->take(4) as $language)
                                          <div class="other-course shadow-sm rounded">
                                                <a href="{{ route('pages.series.info', $language) }}">
                                                      <div class="image-area">
                                                            <img src="{{ $language->getPosterUrl() }}" alt="image"
                                                                  width="64" height="64">
                                                      </div>
                                                      <h5>{{ $language->name }}</h5>
                                                      <span>{{ $language->created_at->diffForHumans() }}</span>
                                                      {!! str()->limit($language->description, 100) !!}
                                                </a>
                                          </div>
                                    @endforeach

                              </div>
                        </div>
                  </div>
            </section>

            <!-- Frameworks section -->
            <section class="frameworks mb-5">
                  <div class="container">
                        <h2 class="section-header">Frameworks</h2>
                        <p class="section-paragraph">learn every things about the famous frameworks, and become master
                              about
                              you
                              needed
                        </p>

                        <div class="wrapper">

                              <div class="row">
                                    @foreach ($frameworks->take(2) as $framework)
                                          <div class="col-12 col-md-6">
                                                <!-- course -->
                                                <div class="course">
                                                      <div class="image-area">
                                                            <img src="{{ $framework->getPosterUrl() }}"
                                                                  alt="images" width="420" height="420">
                                                      </div>
                                                      <div class="top-information">
                                                            <div class="title">
                                                                  <h3>
                                                                        <a href="{{ route('pages.series.info', $framework) }}">{{ $framework->name }}</a>
                                                                  </h3>
                                                                  {!! str()->limit($framework->description, 150) !!}
                                                            </div>
                                                      </div>
                                                      <div class="bottom-information">
                                                            <ul>
                                                                  <li>
                                                                        <a href="{{ route('pages.series.info', $framework) }}"><i
                                                                                    class="fas fa-book"></i></i>
                                                                              {{ $framework->getEpisodeCount() }}
                                                                              lessons</a>
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-clock"></i>
                                                                        {{ $framework->created_at->diffForHumans() }}
                                                                  </li>
                                                                  <li>
                                                                        <i class="fas fa-at"></i> <a
                                                                              href="{{ route('pages.series.info', $framework) }}">{{ $framework->topic->category->name }}</a>
                                                                  </li>
                                                            </ul>
                                                            <div class="buttons">
                                                                  <a href="{{ route('pages.series.info', $framework) }}" class="btn"><i
                                                                              class="far fa-play-circle fa-fw"></i>
                                                                        Start
                                                                        Series</a>
                                                            </div>
                                                      </div>
                                                </div>

                                          </div>
                                    @endforeach
                              </div>

                        </div>
                        <div class="other-wrapper">
                              <div class="content-wrapper">

                                    <div class="row">

                                          @foreach ($frameworks->take(6) as $framework)
                                                <div class="col-12 col-md-6">
                                                      <a href="{{ route('pages.series.info', $framework) }}">
                                                            <div class="content">
                                                                  <div class="image-area">
                                                                        <img src="{{ $framework->getPosterUrl() }}"
                                                                              alt="course image" width="76"
                                                                              height="76" />
                                                                  </div>
                                                                  <div class="information">
                                                                        <h5>{{ $framework->name }}</h5>
                                                                        {!! str()->limit($framework->description, 100) !!}
                                                                  </div>
                                                            </div>
                                                      </a>

                                                </div>
                                          @endforeach

                                    </div>

                              </div>
                        </div>
                  </div>
            </section>

            <!--footer section-->
            <x-front.footer />
      </div>

</x-front.app>
