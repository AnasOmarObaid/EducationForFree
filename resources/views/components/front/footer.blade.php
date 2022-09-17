  <!--footer section-->
  <section class="footer">
    <div class="container">
          <div class="content py-5">
                <h3 class="text-center">Want us to email you occasionally with EducationForFree News?
                </h3>
                <!-- form -->
                <form action="">
                      <!-- email address -->
                      <div class="mb-4 field">
                            <input name="email" type="email" class="form-control"
                                  placeholder="Enter email" style="background-color:#fff">
                            <div class="input-icon">
                                  <i class="fas fa-envelope fa-fw"></i>
                            </div>
                            <button class="btn" type="submit">Subscribe</button>
                      </div>
                </form>
                <!-- content -->
                <div class="row">
                      <div class="col-md-6">
                            <div class="info">
                                  <h2><a href="{{ route('welcome') }}">Education<span>ForFree</span></a></h2>.
                                  <p>Nine out of ten doctors recommend EducationForFree over competing
                                        brands.<br />
                                        Come inside, see for yourself, and massively level up<br />
                                        your development skills in the process.</p>

                                  <div class="social-icons d-flex mt-3">
                                        <a href="#"><img src="{{ asset('front/images/Facebook.svg') }}"
                                                    alt="facebook page"></a>
                                        <a href="#"><img src="{{ asset('front/images/tw.svg') }}"
                                                    alt="twitter page"></a>
                                        <a href="#"><img src="{{ asset('front/images/Linkedin.svg') }}"
                                                    alt="linkedin page"></a>
                                  </div>
                            </div>
                      </div>
                      <div class="col-md-6">
                            <div class="aside">
                                  <div class="row" style="justify-content: flex-end;">
                                        <!-- learn -->
                                        <div class="col-md-3">
                                              <span>Learn</span>
                                              <ul>
                                                    <li>
                                                          <a href="register.html">Sign Up</a>
                                                    </li>
                                                    <li>
                                                          <a href="login.html">Sign In</a>
                                                    </li>
                                                    <li>
                                                          <a href="series.html">Series</a>
                                                    </li>
                                                    <li>
                                                          <a href="educbit.html">EducBit</a>
                                                    </li>
                                                    <li>
                                                          <a href="topics.html">Topics</a>
                                                    </li>
                                                    <li>
                                                          <a href="search.html">Search</a>
                                                    </li>
                                              </ul>
                                        </div>

                                        <!-- Discuss -->
                                        <div class="col-md-3">
                                              <span>Discuss</span>
                                              <ul>
                                                    <li>
                                                          <a href="{{ route('pages.about') }}">About us</a>
                                                    </li>
                                                    <li>
                                                          <a href="browse.html">Browse</a>
                                                    </li>
                                                    <li>
                                                          <a href="blog.html">Blog</a>
                                                    </li>
                                                    <li>
                                                          <a href="{{ route('pages.support') }}">Support</a>
                                                    </li>
                                              </ul>
                                        </div>

                                        <!-- EXTRAS -->
                                        <div class="col-md-3">
                                              <span>EXTRAS</span>
                                              <ul>
                                                    <li>
                                                          <a href="{{ route('pages.faq') }}">FAQ</a>
                                                    </li>
                                                    <li>
                                                          <a href="{{ route('pages.teach') }}">Get a Job</a>
                                                    </li>
                                                    <li>
                                                          <a href="{{ route('pages.privacy') }}">Privacy</a>
                                                    </li>
                                                    <li>
                                                          <a href="{{ route('pages.term') }}">Terms</a>
                                                    </li>
                                              </ul>
                                        </div>
                                  </div>
                            </div>
                      </div>
                </div>
                <!-- copy -->
                <hr class="my-5" style="color: #fff;">
                <div class="copy">
                      <p class="text-center">&copy;EducationForFree 2022. All rights reserved.</p>
                </div>
          </div>
    </div>
</section>
