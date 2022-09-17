<x-front.app title='EducBits'>


      <div class="educ-bit">

            <x-front.nav-topics />

            <!--introduction-->
            <section class="introduction">
                  <div class="container">
                        <h3 class="section-heading">Today's Featured Bit</h3>
                        <p class="section-paragraph">EducBit are short lessons that focus on a single technique. No
                              hassle, no
                              investment. <br>Got five minutes?</p>

                        <!--introduction-course-->
                        <div class="introduction-course shadow rounded">
                              <div class="wrapper">
                                    <aside>
                                          <div class="image-area">
                                                <img src="{{ $main_bit->user->profile_photo_url }}" alt="teacher image">
                                          </div>
                                          <div class="content">

                                                <small>Your Teacher</small>
                                                <a href="#">{{ $main_bit->user->name }}</a>

                                                <small class="mt-3">Progress</small>
                                                <a href="#">instructor</a>

                                                <small class="mt-3">Episode Duration</small>
                                                <a href="#">7:39</a>

                                                <small class="mt-3">Find me on</small>
                                                <a href="#">Twitter</a>
                                          </div>
                                    </aside>
                                    <div class="content-area w-100">
                                          <div class="upper-information">
                                                <h3><a href="{{ route('pages.users.episodes', [$main_bit->user, $main_bit]) }}">{{ $main_bit->episode->title }}</a></h3>
                                                {!! str()->limit($main_bit->episode->description, 500) !!}
                                          </div>

                                          <!-- bottom information -->
                                          <div class="bottom-information">
                                                <div class="buttons">
                                                      <a href="{{ route('pages.users.episodes', [$main_bit->user, $main_bit]) }}" class="btn"> <i
                                                                  class="far fa-play-circle fa-fw"></i> Watch Video </a>
                                                      <a href="" class="btn"><i
                                                                  class="fas fa-heart fa-fw"></i> Add to favorite</a>
                                                </div>
                                                <hr>
                                                <a href="{{ route('pages.users.episodes', [$main_bit->user, $main_bit]) }}" class="tech">More EducBit From
                                                      {{ $main_bit->user->username }} <i class="fa fa-angle-right fa-fw"
                                                            style="font-size: .75rem; font-weight: 400;"></i></a>
                                                <a href="{{ route('pages.users.episodes', [$main_bit->user, $main_bit]) }}" class="btn cat">{{ $main_bit->category->name }}</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>

            <!--recently updated bits-->
            <section class="recently-updated">
                  <div class="container">
                        <h3 class="section-heading">More Recent Bits</h3>
                        <p class="section-paragraph">We're always working on new lessons, so check back often to see
                              what's new!
                        </p>

                        <!-- courses -->
                        <div class="row row-cols-1 row-cols-md-2">
                              @foreach ($recent_bit as $bit)
                                    <div class="col">
                                          <div class="recently-course d-flex shadow rounded">
                                                <aside>
                                                      <img src="{{ $bit->user->profile_photo_url }}" alt="teacher image"
                                                            width="120" height="120">
                                                      <div class="content">

                                                            <small>Your Teacher</small>
                                                            <a href="#">{{ $bit->user->name }}</a>

                                                            <small class="mt-3">Progress</small>
                                                            <a href="#">instructor</a>

                                                            <small class="mt-3">Episode Duration</small>
                                                            <a href="#">7:39</a>

                                                            <small class="mt-3">Find me on</small>
                                                            <a href="#">Twitter</a>
                                                      </div>
                                                </aside>
                                                <div class="content-area w-100">
                                                      <div class="upper-information">
                                                            <h3><a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}">{{ $bit->episode->title }}</a></h3>
                                                            {!! str()->limit($bit->episode->description, 200) !!}
                                                            <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="tech">More EducBit From
                                                                  {{ $bit->user->username }} <i
                                                                        class="fa fa-angle-right fa-fw"
                                                                        style="font-size: .75rem; font-weight: 400;"></i></a>
                                                      </div>

                                                      <!-- bottom information -->
                                                      <div class="bottom-information">

                                                            <div class="buttons">
                                                                  <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="btn"> <i
                                                                              class="far fa-play-circle fa-fw"></i>
                                                                        Watch
                                                                        Video
                                                                  </a>
                                                                  <a href="" class="btn"><i
                                                                              class="fas fa-heart fa-fw"></i> Add to
                                                                        favorite</a>
                                                            </div>
                                                            <hr>
                                                            <a href="#"
                                                                  class="btn cat">{{ $bit->category->name }}</a>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach
                        </div>
                  </div>
            </section>

            <!--popular  bits-->
            <section class="popular-bit">
                  <div class="container">
                        <h3 class="section-heading">Popular Bits</h3>
                        <p class="section-paragraph">Here's what your peers have watched the most.
                        </p>

                        <!-- courses -->
                        <div class="row row-cols-1 row-cols-md-2">

                              @foreach ($pop_bit->skip(5) as $bit)
                                    <div class="col">
                                          <div class="recently-course d-flex shadow rounded">
                                                <aside>
                                                      <img src="{{ $bit->user->profile_photo_url }}"
                                                            alt="teacher image" width="120" height="120">
                                                      <div class="content">

                                                            <small>Your Teacher</small>
                                                            <a href="#">{{ $bit->user->name }}</a>

                                                            <small class="mt-3">Progress</small>
                                                            <a href="#">instructor</a>

                                                            <small class="mt-3">Episode Duration</small>
                                                            <a href="#">7:39</a>

                                                            <small class="mt-3">Find me on</small>
                                                            <a href="#">Twitter</a>
                                                      </div>
                                                </aside>
                                                <div class="content-area w-100">
                                                      <div class="upper-information">
                                                            <h3><a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}">{{ $bit->episode->title }}</a>
                                                            </h3>
                                                            {!! str()->limit($bit->episode->description, 200) !!}
                                                            <br>

                                                            <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="tech">More EducBit From
                                                                  {{ $bit->user->username }}
                                                                  <i class="fa fa-angle-right fa-fw"
                                                                        style="font-size: .75rem; font-weight: 400;"></i></a>
                                                      </div>

                                                      <!-- bottom information -->
                                                      <div class="bottom-information">

                                                            <div class="buttons">
                                                                  <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="btn"> <i
                                                                              class="far fa-play-circle fa-fw"></i>
                                                                        Watch
                                                                        Video
                                                                  </a>
                                                                  <a href="" class="btn"><i
                                                                              class="fas fa-heart fa-fw"></i> Add to
                                                                        favorite</a>
                                                            </div>
                                                            <hr>
                                                            <a href="#"
                                                                  class="btn cat">{{ $bit->category->name }}</a>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach
                        </div>
                  </div>
            </section>

            <!-- bit by bit -->
            <section class="bit-by-bit">
                  <div class="container">
                        <h3 class="section-heading">Bit By Bit</h3>
                        <p class="section-paragraph">The fun doesn’t end here. We still have plenty of tricks to share.
                        </p>

                        <div class="wrapper">

                              @foreach ($bits as $bit)
                                    <div href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="item">
                                          <div class="content-item">
                                                <div class="image-area">
                                                      <img src="{{ $bit->user->profile_photo_url }}"
                                                            alt="teacher image" width="90" height="90">
                                                </div>
                                                <div class="information">
                                                      <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}">
                                                            {{ $bit->episode->title }} </a>
                                                      {!! str()->limit($bit->episode->description, 100) !!}
                                                </div>

                                                <div class="teacher">
                                                      <div class="upper">
                                                            <small>Your Teacher</small>
                                                            <a href="#">{{ $bit->user->name }}</a>
                                                      </div>
                                                      <div class="lower">
                                                            <small>Episode Duration</small>
                                                            <span>16:55</span>
                                                      </div>
                                                </div>
                                                <div class="buttons ">
                                                      <a href="{{ route('pages.users.episodes', [$bit->user, $bit]) }}" class="btn"> <i
                                                                  class="far fa-play-circle fa-fw"></i> Watch Video
                                                      </a>
                                                      <a href="" class="btn"><i
                                                                  class="fas fa-heart fa-fw"></i>
                                                            Add to favorite</a>
                                                </div>
                                          </div>
                                    </div>
                              @endforeach

                        </div>
                  </div>
            </section>

            <!--show more button-->
            <div class="show-more">
                  <a href="#" class="btn"><i class="fas fa-tv fa-fw"></i> Show more</a>
            </div>
                <!--footer section-->
                <x-front.footer />

      </div>

</x-front.app>
