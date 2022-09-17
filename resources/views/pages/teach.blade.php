<x-front.app title='Teach'>

      <!--teach-->
      <section class="teach">

            <!-- home -->
            <section class="home">
                  <!--navigation-->
                  <x-front.nav />

                  <div class="container">
                        <!-- row -->
                        <div class="row">
                              <!--banner-->
                              <div class="banner">
                                    <!--content area-->
                                    <div class="col-12 col-md-6">
                                          <div class="content">
                                                <h2>Come teach <br />
                                                      with us</h2>
                                                <p> Become an instructor and change <br />
                                                      lives -- include your own</p>
                                                <div class="buttons mt-4">
                                                      {{-- check if there is authenticated or not --}}
                                                      @guest
                                                            <a href="login.html" style="background: #6c63ff;color: #ffffff;"
                                                                  class="btn" type="submit"><i
                                                                        class="fas fa-sign-in-alt fa-fw"></i>
                                                                  login</a>

                                                            <a href="register.html"
                                                                  style="background: #fff;margin-left: 1rem;" class="btn"
                                                                  type="submit"><i class="fas fa-sign-in-alt fa-fw"></i> sign
                                                                  up</a>
                                                      @else
                                                            {{-- admin --}}
                                                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                                                  <p>You have already able to create series</p>
                                                                  <small>
                                                                        <a href="{{ route('admins.welcome') }}"
                                                                              style="background: #fff;margin-top: 1rem;"
                                                                              class="btn" type="submit"><i
                                                                                    class="fas fa-sign-in-alt fa-fw"></i>
                                                                              Dashboard</a>
                                                                  </small>
                                                            @endif

                                                            {{-- teacher --}}
                                                            @if (auth()->user()->hasRole('teacher'))
                                                                  <p>You have already able to create series</p>
                                                                  <a href="" style="background: #fff;margin-top: 1rem;"
                                                                        class="btn" type="submit"><i
                                                                              class="fas fa-sign-in-alt fa-fw"></i>
                                                                        Dashboard</a>
                                                            @elseif(auth()->user()->hasRole('student') and auth()->user()->request_teacher)
                                                                  <p>Your request is reviewed by Technical Supportو when
                                                                        you accepted we will send email to you.</p>
                                                            @elseif(auth()->user()->hasRole('student') and !auth()->user()->request_student)
                                                                  <form action="{{ route('request.teacher') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button class="btn btn-primary" type="submit">Get
                                                                              started</button>
                                                                  </form>
                                                            @endif


                                                      @endguest
                                                </div>
                                          </div>
                                    </div>

                                    <!-- image-area -->
                                    <div class="col-md-6 d-none d-md-block" style="margin-right: 3rem;">
                                          <img class="img-fluid"
                                                src="{{ asset('front/images/undraw_teaching_f-1-cm.svg') }}"
                                                alt="about us image" />
                                    </div>
                              </div>
                        </div>
                  </div>
            </section>

            <!--start reason-->
            <section class="start mt-5">
                  <div class="container">
                        <h2 class="text-center">So many reasons to start</h2>
                        <div class="content-area">

                              <div class="content" style="text-align:-webkit-center">
                                    <img class="img-fluid" width="100" height="100"
                                          src="{{ asset('front/images/value-prop-teach-v3.jpg') }}" alt="">
                                    <h5>Teach your way</h5>
                                    <p>Publish the course you want, in the way you want, and always have of control your
                                          own
                                          content.</p>
                              </div>

                              <div class="content" style="text-align:-webkit-center">
                                    <img class="img-fluid" width="100" height="100"
                                          src="{{ asset('front/images/value-prop-inspire-v3.jpg') }}" alt="">
                                    <h5>Inspire learners
                                    </h5>
                                    <p>Teach what you know and help learners explore their interests, gain new skills,
                                          and advance
                                          their careers.</p>
                              </div>

                              <div class="content" style="text-align:-webkit-center">
                                    <img class="img-fluid" width="100" height="100"
                                          src="{{ asset('front/images/value-prop-get-rewarded-v3.jpg') }}"
                                          alt="">
                                    <h5>Get rewarded</h5>
                                    <p>Expand your professional network, build your expertise, and earn money on each
                                          paid
                                          enrollment.</p>
                              </div>
                        </div>
                  </div>
            </section>

            <!--information-->
            <section class="information">
                  <div class="container">
                        <div class="information-area">

                              <div class="content">
                                    <div>
                                          <p>40K</p>
                                    </div>
                                    <p>students</p>
                              </div>

                              <div class="content">
                                    <div>
                                          <p>95K</p>
                                    </div>
                                    <p>Series</p>
                              </div>

                              <div class="content">
                                    <div>
                                          <p>155K</p>
                                    </div>
                                    <p>Hours</p>
                              </div>

                              <div class="content">
                                    <div>
                                          <p>17K</p>
                                    </div>
                                    <p>instructor</p>
                              </div>

                        </div>
                  </div>
            </section>

            <!--How to begin-->
            <section class="begin">
                  <div class="container">
                        <header>How to begin</header>

                        <div class="accordion mt-4">

                              <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseOne">
                                                #Plan your curriculum
                                          </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                          aria-labelledby="panelsStayOpen-headingOne">
                                          <div class="accordion-body">
                                                <div class="row">
                                                      <!--content-->
                                                      <div class="col-12 col-md-6">
                                                            <div class="content">
                                                                  <p>You start with your passion and knowledge. Then
                                                                        choose a promising topic
                                                                        with the help of our Marketplace Insights tool.
                                                                        <br><br>

                                                                        The way that you teach — what you bring to it —
                                                                        is up to you.
                                                                  </p>

                                                                  <h3>How we help you</h3>
                                                                  <p>We offer plenty of resources on how to create your
                                                                        first course. And, our
                                                                        instructor dashboard and curriculum pages help
                                                                        keep you organized.</p>
                                                            </div>
                                                      </div>

                                                      <!--image-->
                                                      <div class="col-md-6 d-none d-md-block">
                                                            <img class="img-fluid"
                                                                  src="{{ asset('front/images/plan.svg') }}"
                                                                  alt="image" style="max-width:70%; float:right">
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                              <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseTwo">
                                                #Record your series
                                          </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                          aria-labelledby="panelsStayOpen-headingTwo">
                                          <div class="accordion-body">
                                                <div class="row">
                                                      <!--content-->
                                                      <div class="col-12 col-md-6">
                                                            <div class="content">
                                                                  <p>Use basic tools like a smartphone or a DSLR camera.
                                                                        Add a good microphone
                                                                        and you’re ready to start.<br /><br />

                                                                        If you don’t like being on camera, just capture
                                                                        your screen. Either way,
                                                                        we recommend two hours or more of video for a
                                                                        paid course.se basic tools
                                                                        like a smartphone or a DSLR camera. Add a good
                                                                        microphone
                                                                        and you’re ready to start</p>

                                                                  <h3>How we help you</h3>
                                                                  <p>Our support team is available to help you
                                                                        throughout the process and
                                                                        provide feedback on test videos.</p>
                                                            </div>
                                                      </div>

                                                      <!--image-->
                                                      <div class="col-md-6 d-none d-md-block">
                                                            <img class="img-fluid"
                                                                  src="{{ asset('front/images/record.svg') }}"
                                                                  alt="image" style="max-width:70%; float:right;">
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                              <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseThree">
                                                #launch your series
                                          </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                          aria-labelledby="panelsStayOpen-headingThree">
                                          <div class="accordion-body">
                                                <div class="row">
                                                      <!--content-->
                                                      <div class="col-12 col-md-6">
                                                            <div class="content">
                                                                  <p>Gather your first ratings and reviews by promoting
                                                                        your course through
                                                                        social media and your professional networks.
                                                                        <br /> <br />

                                                                        Your course will be discoverable in our
                                                                        marketplace where you earn
                                                                        revenue from each paid enrollment.
                                                                  </p>

                                                                  <h3>How we help you</h3>
                                                                  <p>Our custom coupon tool lets you offer enrollment
                                                                        incentives while our
                                                                        global promotions drive traffic to courses.
                                                                        There’s even more
                                                                        opportunity for courses chosen for
                                                                        EducationForFree Business.</p>
                                                            </div>
                                                      </div>

                                                      <!--image-->
                                                      <div class="col-md-6 d-none d-md-block">
                                                            <img class="img-fluid"
                                                                  src="{{ asset('front/images/lanuch.svg') }}"
                                                                  alt="image" style="max-width:70%; float:right;">
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                        </div>
                  </div>
            </section>

            <!--instructor-->
            <section class="instructor">
                  <div class="container">
                        <h2>Become an instructor today</h2>
                        <p>Join one of the world’s largest online learning marketplaces.</p>
                        <div class="buttons mt-2">
                              {{-- check if there is authenticated or not --}}
                              @guest
                              <a href="login.html" style="background: #6c63ff;color: #ffffff;"
                                    class="btn" type="submit"><i
                                          class="fas fa-sign-in-alt fa-fw"></i>
                                    login</a>

                              <a href="register.html"
                                    style="background: #fff;margin-left: 1rem;" class="btn"
                                    type="submit"><i class="fas fa-sign-in-alt fa-fw"></i> sign
                                    up</a>
                        @else
                              {{-- admin --}}
                              @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <p>You have already able to create series</p>
                                    <small>
                                          <a href="{{ route('admins.welcome') }}"
                                                style="background: #fff;margin-top: 1rem;"
                                                class="btn" type="submit"><i
                                                      class="fas fa-sign-in-alt fa-fw"></i>
                                                Dashboard</a>
                                    </small>
                              @endif

                              {{-- teacher --}}
                              @if (auth()->user()->hasRole('teacher'))
                                    <p>You have already able to create series</p>
                                    <a href="" style="background: #fff;margin-top: 1rem;"
                                          class="btn" type="submit"><i
                                                class="fas fa-sign-in-alt fa-fw"></i>
                                          Dashboard</a>
                              @elseif(auth()->user()->hasRole('student') and auth()->user()->request_teacher)
                                    <p>Your request is reviewed by Technical Supportو when
                                          you accepted we will send email to you.</p>
                              @elseif(auth()->user()->hasRole('student') and !auth()->user()->request_student)
                                    <form action="{{ route('request.teacher') }}"
                                          method="post">
                                          @csrf
                                          <button class="btn btn-primary" type="submit">Get
                                                started</button>
                                    </form>
                              @endif


                        @endguest

                        </div>
                  </div>
            </section>

            <!--footer section-->
            <x-front.footer />

      </section>


</x-front.app>
