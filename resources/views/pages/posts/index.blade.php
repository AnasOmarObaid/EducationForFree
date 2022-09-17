<x-front.app title='Postss'>

      <div class="blogs">

            <x-front.nav-topics />

            <!--introduction-->
            <section class="introduction">
                  <div class="container">
                        <h3 class="section-heading">Latest <span class="span">Blogs From Scratch </span> News</h3>
                        <div class="filter">
                              <div class="dropdown ">
                                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-bs-toggle="dropdown" aria-expanded="false">
                                          Category
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          @foreach ($categories as $category)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('pages.posts.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
                                                </li>
                                          @endforeach

                                          @if (request('search'))
                                          <input  type="hidden" name="search" value="{{ request('search') }}"class="form-control" placeholder="find some things">
                                          @endif
                                    </ul>
                              </div>
                              <form action="">
                                    <div class="field">
                                          <input type="search" name="search" value="{{ request()->search }}" class="form-control" placeholder="find some things">
                                          <div class="input-icon">
                                                <i class="fas fa-search"></i>
                                          </div>
                                          @if (request('category'))
                                          <input  type="hidden" name="category" value="{{ request('category') }}"class="form-control" placeholder="find some things">
                                          @endif
                                    </div>
                              </form>
                        </div>
                  </div>
            </section>

            @if ($posts->isNotEmpty())
                  <!--blogs wrapper-->
                  <section class="blogs-wrapper">
                        <div class="container">
                              <div class="wrapper">
                                    <div class="row">

                                          <!-- main article -->
                                          <div class="col-12">
                                                <article class="main-blog mb-5 rounded">
                                                      <div class="col-md-6">
                                                            <div class="image-area">
                                                                  <img src="{{ $main_post->getPoster() }}"
                                                                        class="w-100" alt="blog image"
                                                                        class="rounded img-fluid">
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                            <div class="content-area">
                                                                  <div class="top-area">
                                                                        <a href="{{ route('pages.posts.index', ['category' => $main_post->category->name]) }}"
                                                                              class="btn cate rounded">{{ $main_post->category->name }}</a>
                                                                        <h3 class="title"><a
                                                                                    href="{{ route('pages.posts.show', $main_post) }}">{{ $main_post->title }}</a>
                                                                        </h3>
                                                                        <span class="publish">Published
                                                                              {{ $main_post->created_at->diffForHumans() }}</span>
                                                                        <p class="leader mt-4">
                                                                              {{ str()->limit($main_post->body, 500) }}
                                                                        </p>
                                                                  </div>
                                                                  <div class="bottom-area mt-1">
                                                                        <div class="left d-flex align-items-center">
                                                                              <img src="{{ $main_post->author->profile_photo_url }}"
                                                                                    alt="person" width="60"
                                                                                    height="60">
                                                                              <div class="info">
                                                                                    <a href="#"
                                                                                          class="btn-person">{{ $main_post->author->username }}r</a>
                                                                                    <h6 class="">
                                                                                          {{ implode(',', $main_post->author->roles->pluck('name')->toArray()) }}
                                                                                          for
                                                                                          educationforfree</h6>
                                                                              </div>
                                                                        </div>
                                                                        <div class="right">
                                                                              <a href="{{ route('pages.posts.show', $main_post) }}"
                                                                                    class="btn">show
                                                                                    more</a>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </article>
                                          </div>

                                          @foreach ($posts as $post)
                                                <div
                                                      class="col-12 {{ $loop->iteration < 3 ? 'col-md-6' : 'col-md-4' }}">
                                                      <article class="mb-3 blog rounded">
                                                            <div class="img-top">
                                                                  <img src="{{ $post->getPoster() }}" alt="blog image">
                                                            </div>
                                                            <div class="content">
                                                                  <div class="top-area">
                                                                        <a href="{{ route('pages.posts.index', ['category' => $post->category->name]) }}"
                                                                              class="btn cate rounded">{{ $post->category->name }}</a>
                                                                        <h3 class="title"><a href="{{ route('pages.posts.show', $post) }}"
                                                                                    style="font-size: 1.35rem;">{{ $post->title }}</a>
                                                                        </h3>
                                                                        <span class="publish">Published
                                                                              {{ $post->created_at->diffForHumans() }}</span>
                                                                        <p class="leader mt-2 mb-2">
                                                                              {{ str()->limit($main_post->body, 500) }}
                                                                        </p>
                                                                  </div>
                                                                  <div class="bottom-area">
                                                                        <div class="left d-flex align-items-center">
                                                                              <img src="{{ $post->author->profile_photo_url }}"
                                                                                    alt="person" width="60"
                                                                                    height="60">
                                                                              <div class="info">
                                                                                    <a href="#"
                                                                                          class="btn-person">{{ $post->author->username }}</a>
                                                                                    <h6 class="">
                                                                                          {{ implode(',', $post->author->roles->pluck('name')->toArray()) }}
                                                                                          for
                                                                                          educationforfree
                                                                                    </h6>
                                                                              </div>
                                                                        </div>
                                                                        <div class="right">
                                                                              <a href="{{ route('pages.posts.show', $post) }}"
                                                                                    class="btn">show
                                                                                    more</a>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </article>
                                                </div>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                  </section>
            @else
                  <div style="text-align: center">Soory! there is no post</div>
            @endif

            <!--pagination-->
            <div class="container mb-3">
                  <section aria-label="Page navigation example" class="d-flex flex-row-reverse">
                        {{ $posts->appends(['search' => request('search')])->links() }}
                  </section>
            </div>

            <!--footer section-->
            <x-front.footer />

      </div>

</x-front.app>
