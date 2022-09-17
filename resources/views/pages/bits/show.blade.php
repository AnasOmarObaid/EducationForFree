<x-front.app title="EducBit | Show">
      <!-- episodes  -->
      <section class="episodes-page">

            <!-- aside section -->
            <aside class="episode-list keep-scrolling">

                  <!-- heading aside -->
                  <div class="top-heading">
                        <a href="{{ route('pages.bits.index') }}"><i class="fas fa-chevron-left fa-fw"></i> Educbit
                              overview</a>
                  </div>

                  <!-- episode information -->
                  <div class="episode-top-information">
                        <div class="episode-image mx-2">
                              <img src="{{ $bit->getPosterUrl() }}" alt="series image" width="65" height="65">
                        </div>
                        <div class="episode-info">
                              <h4>{{ $bit->episode->title }}</h4>
                        </div>
                  </div>

                  <!-- start sections for series -->
                  <section class="series-sections mt-4">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                              <div class="accordion-item">
                                    <div id="panelsStayOpen-1" class="accordion-collapse collapse show"
                                          aria-labelledby="panelsStayOpen-headingOne">
                                          <div class="accordion-body">
                                                @foreach ($user->educBits as $bi)
                                                      <a href=" {{ route('pages.users.episodes', [$bi->user, $bi]) }}"
                                                            class="episode-box {{ $bi->id == $bit->id ? 'episode-active' : '' }}">
                                                            <div class="episode-number">
                                                                  <div class="number">{{ $loop->index + 1 }}</div>
                                                            </div>
                                                            <div class="episode-information">
                                                                  <h4 class="title">{{ $bi->episode->title }}</h4>
                                                                  <div class="episode-inf">
                                                                        <span>Episode {{ $loop->index + 1 }}</span>
                                                                        <span>1h6m</span>
                                                                  </div>
                                                            </div>
                                                      </a>
                                                @endforeach
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </section>
            </aside>

            <!-- body content -->
            <section class="body-content">
                  <!-- navigation -->
                  <nav class="navbar navbar-expand-lg pt-3">

                        <div class="container-nav">
                              <div class="brand">
                                    <h2><a href="{{ route('welcome') }}"
                                                class="text-decoration-none navbar-brand">Education<span>4Free</span></a>
                                    </h2>
                              </div>

                              <!--collapse buttons-->
                              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                              </button>

                              <!--nav list-->
                              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                    <!--login and signup-->
                                    @guest
                                          <a href="{{ route('login') }}" class="btn btn-primary mr-3" type="submit"><i
                                                      class="fas fa-sign-in-alt fa-fw"></i>
                                                login</a>
                                          <a href="{{ route('register') }}" class="btn btn-primary" type="submit"><i
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
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 20 20" fill="currentColor">
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
                                                            @else
                                                                  <x-jet-dropdown-link href="{{ route('dashboard') }}">
                                                                        {{ __('Dashboard') }}
                                                                  </x-jet-dropdown-link>
                                                            @endif

                                                            <div class="border-t border-gray-100"></div>

                                                            {{-- profile --}}
                                                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                                  {{ __('Profiles') }}
                                                            </x-jet-dropdown-link>

                                                            <div class="border-t border-gray-100"></div>

                                                            {{-- notify --}}
                                                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                                  {{ __('Notification') }}
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
                  </nav>

                  <!-- play video -->
                  <div class="play-video" id="player">

                  </div>

                  <!-- series card details -->
                  <section class="episode-card-details">
                        <h3 class="title">{{ $bit->episode->title }}</h3>
                        <div class="episode-details">
                              <div class="d-flex flex-column epi">
                                    <span>Episode Number</span>
                                    <small>1</small>
                              </div>
                              <div class="d-flex flex-column mx-5">
                                    <span>Run Time</span>
                                    <small>7:03</small>
                              </div>
                              <div class="d-flex flex-column">
                                    <span>Published</span>
                                    <small>{{ $bit->episode->created_at->diffForHumans() }}</small>
                              </div>
                              <div class="d-flex flex-column">
                                    <span>Category</span>
                                    <small><a href="#">{{ $bit->category->name }}</a></small>
                              </div>
                              <div class="d-flex flex-column" style="margin-left: 3rem;">
                                    <span>Teacher</span>
                                    <small><a href="#">{{ $bit->user->username }}</a></small>
                              </div>
                        </div>
                  </section>

                  <!-- teacher box -->
                  <section class="teacher-box">
                        <div class="teacher-box">
                              <div class="top">
                                    <div class="teacher-name">
                                          <h5>YOUR TEACHER | {{ $user->name }}</h5>
                                    </div>
                                    <div class="teacher-media">
                                          <a href="#"><i class="icon fab fa-facebook"></i></a>
                                          <a href="#"><i class="icon fab fa-twitter"></i></a>
                                    </div>
                              </div>
                              <div class="bottom">
                                    <div class="image">
                                          <img src="{{ $user->profile_photo_url }}" alt="user image" height="72"
                                                width="72">
                                    </div>
                                    <p class="w-100 m-0">Hi, {{ $user->name }}. I'm the creator of Laracasts and
                                          spend most
                                          of my days
                                          building the site and
                                          thinking of new ways to teach confusing concepts. I live in Orlando, Florida
                                          with my
                                          wife
                                          and two kids.</p>
                              </div>
                        </div>
                  </section>

                  <!-- what to learn in this episode -->
                  <section class="what-learn">
                        <div class="container">
                              <div class="row">
                                    <div class="col-12 col-md-4 p-0">
                                          <div class="episode-learn-list">
                                                <h4>Things You'll Learn</h4>
                                                {!! $bit->episode->learns !!}
                                          </div>
                                    </div>
                                    <div class="col-12 col-md-8 p-0">
                                          <div class="episode-more-info">
                                                <div class="top">
                                                      <h4>About This Episode</h4>
                                                      <span>Published at
                                                            {{ $bit->episode->created_at->diffForHumans() }}</span>
                                                </div>
                                                {!! $bit->episode->description !!}
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </section>

                  <!-- comment form -->
                  <section class="comment-form">
                        <div class="container">
                              <div class="participate">
                                    <img src="{{ asset('front/images/lary-avatar.svg') }}" alt="participate image"
                                          width="40" height="40">
                                    <h2>Want to participate?</h2>
                              </div>

                              @guest
                                    <div class='mt-3'>
                                          <a href="{{ route('login') }}" class="btn btn-primary" style="color: #000"
                                                type="submit"><i class="fas fa-sign-in-alt fa-fw"></i>
                                                login</a>
                                          <a href="{{ route('register') }}" class="btn btn-info"
                                                style="color: #000"type="submit"><i class="fas fa-sign-in-alt fa-fw"></i>
                                                sign
                                                up</a>
                                    </div>
                              @else
                                    <form id="cpa-form" class="mt-3"
                                          data-url="{{ route('comments.episodes', $bit->episode) }}">
                                          <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" required></textarea>
                                                <label for="floatingTextarea2">Quick, thing of something to say!</label>
                                          </div>
                                          <hr>
                                          <div class="button mt-3">
                                                <button type="submit" class="btn"><i
                                                            class="fas fa-comment-alt fa-fw"></i>
                                                      comment</button>
                                          </div>
                                    </form>
                              @endguest
                        </div>
                  </section>
                  <!-- comments and replays -->
                  <section class="comments">
                        <div class="container">
                              <div class="wrapper">

                                    @foreach ($bit->episode->comments as $index => $comment)
                                          <div class="comment shadow-sm"
                                                id="{{ $index . '_' . $comment->user->username }}">
                                                <div class="image">
                                                      <img src="https://ui-avatars.com/api/?name={{ str()->limit($comment->user->name, 2) }}&color=7F9CF5"
                                                            alt="user image" height="72" width="72"
                                                            class="rounded">
                                                      <span><i class="fas fa-play-circle fa-fw"></i> Subscriber</span>
                                                </div>
                                                <div class="information w-100">
                                                      <div class="upper">
                                                            <h3>{{ $comment->user->username }}</h3>
                                                            <small>Posted
                                                                  {{ $comment->created_at->diffForHumans() }}</small>
                                                            <p class="lead">{{ $comment->body }}</p>
                                                      </div>
                                                      <div class="lower">
                                                            <div class="buttons">
                                                                  <form action="">
                                                                        <button class="btn clickLike"
                                                                              data-comment_id="{{ $comment->id }}"><i
                                                                                    class="fas fa-heart fa-fw hea"
                                                                                    @auth
{{ in_array(auth()->user()->id, $comment->likes->pluck('user_id')->toArray()) ? 'style=color:red !important' : '' }} @endauth>
                                                                              </i>
                                                                              {{ $comment->likes->count() }}</button>
                                                                  </form>
                                                                  <button class="btn replay-btn"
                                                                        data-comment_id="{{ $comment->id }}"
                                                                        data-user_id="{{ $comment->user->id }}"
                                                                        data-user="{{ $comment->user->username }}"
                                                                        data-type="comment"> <i
                                                                              class="fas fa-reply"></i>
                                                                        Replay</button>
                                                            </div>
                                                      </div>
                                                </div>
                                                {{-- if auth --}}
                                                @auth
                                                      @if ($comment->user_id == auth()->user()->id)
                                                            <div class="actions">
                                                                  <button class="btn edit-btn"
                                                                        data-comment="{{ $comment->id }}" data-id="1"
                                                                        data-type="comment">
                                                                        <i class="fas fa-edit"></i>
                                                                        Edit</button>
                                                                  <form action="" class="deleteComment"
                                                                        data-id="#{{ $index . '_' . $comment->user->username }}"
                                                                        data-url="{{ route('comments.posts.destroy', $comment) }}"
                                                                        method="post">
                                                                        <button class="btn delete-btn" data-id="1"
                                                                              data-type="comment">
                                                                              <i class="fas fa-trash-alt"></i>
                                                                              Delete</button>
                                                                  </form>
                                                            </div>
                                                      @endif
                                                @endauth
                                          </div>
                                          @foreach ($comment->replays as $replay)
                                                <div class="replay">
                                                      <div class="image">
                                                            <img src="{{ $replay->user->profile_photo_url }}"
                                                                  alt="user image" height="72" width="72"
                                                                  class="rounded">
                                                            <span><i class="fas fa-play-circle fa-fw"></i>
                                                                  {{ implode(',', $replay->user->roles->pluck('name')->toArray()) }}
                                                            </span>
                                                      </div>
                                                      <div class="information w-100">
                                                            <div class="upper">
                                                                  <h3>{{ $replay->user->username }}</h3>
                                                                  <small>Posted
                                                                        {{ $replay->created_at->diffForHumans() }}</small>
                                                                  <p class="lead"><strong><a href="@"
                                                                                    style="text-decoration:none">{{ $replay->comment->user->username }}</a></strong>
                                                                        {{ $replay->body }}</p>
                                                            </div>
                                                            <div class="lower">
                                                                  <div class="buttons">

                                                                        <button class="btn replay-btn"
                                                                              data-comment_id="{{ $comment->id }}"
                                                                              data-user="{{ $replay->user->username }}">
                                                                              <i class="fas fa-reply"></i>
                                                                              Replay</button>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          @endforeach
                                    @endforeach


                              </div>
                        </div>
                  </section>


            </section>
      </section>

      {{-- scripts --}}
      @section('scripts')
            <script>
                  $(document).ready(function() {
                        // create comment
                        $('#cpa-form').submit(function(e) {
                              // prevent default
                              e.preventDefault();

                              var comment_text = $('#floatingTextarea2').val();

                              // check if comment is not empty
                              if (comment_text.length > 0) {

                                    // send some value to method
                                    const csrf_token = $("meta[name='csrf_token']").attr('content');
                                    var url = $(this).data('url');

                                    var formData = new FormData()
                                    formData.append('access_token', csrf_token);
                                    formData.append('user_id', {{ auth()->user()->id }});
                                    formData.append('body', comment_text);

                                    $.ajax({
                                          url: url,
                                          type: 'POST',
                                          data: formData,
                                          processData: false,
                                          contentType: false,
                                          cache: false,
                                          success: function(res) {
                                                location.reload(true);
                                          }
                                    });


                              } else
                                    alert('Please enter comment text');

                        });

                        // delete comment
                        $('.deleteComment').on('click', function(e) {
                              e.preventDefault();

                              if (confirm("Are you sure?")) {
                                    // send ajax request
                                    $.ajax({
                                          url: $(this).data('url'),
                                          type: 'DELETE',
                                          data: {
                                                '_method': 'delete'
                                          },
                                          processData: false,
                                          contentType: false,
                                          cache: false,
                                          success: function() {
                                                location.reload(true);
                                          }
                                    });
                              }
                        });

                        //edit comment
                        $(document).on('submit', '#editForm', function(e) {
                              e.preventDefault();
                              var comment_id = $(this).data('comment');

                              var body = $('textarea#dynamicFocus').val();

                              var formData = new FormData()
                              formData.append('body', body);

                              // send ajax request
                              $.ajax({
                                    url: `http://127.0.0.1:8000/comments/${comment_id}/update`,
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(res) {
                                          $('textarea#dynamicFocus').val(res);
                                          location.reload(true);
                                    }
                              });

                        });

                        // click like button
                        $(document).on('click', '.clickLike', function(e) {
                              e.preventDefault();
                              var comment_id = $(this).data('comment_id');
                              // send ajax request
                              $.ajax({
                                    url: `http://127.0.0.1:8000/comments/${comment_id}/like`,
                                    type: 'POST',
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(res) {

                                          location.reload(true);
                                    }
                              });
                        });

                        // click replay
                        $(document).on('click', '.replayBtn', function(e) {
                              e.preventDefault();

                              var comment_id = $(this).data('comment_id');

                              var body = document.getElementById("replay_area").value;

                              var formData = new FormData();

                              formData.append('body', body);

                              // send ajax request
                              $.ajax({
                                    url: `http://127.0.0.1:8000/comments/${comment_id}/replay`,
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(res) {
                                          location.reload(true);
                                    }
                              });

                        });
                  });
            </script>

            <script>
                  var file =
                        "[Auto]{{ Storage::disk('public')->url('encoding/episodes/' . $bit->episode->id . '/' . $bit->episode->id . '.m3u8') }}," +
                        "[360]{{ Storage::disk('public')->url('encoding/episodes/' . $bit->episode->id . '/' . $bit->episode->id . '_0_144.m3u8') }}," +
                        "[480]{{ Storage::disk('public')->url('encoding/episodes/' . $bit->episode->id . '/' . $bit->episode->id . '_1_360.m3u8') }}," +
                        "[720]{{ Storage::disk('public')->url('encoding/episodes/' . $bit->episode->id . '/' . $bit->episode->id . '_2_720.m3u8') }}";
                  var player = new Playerjs({
                        id: "player",
                        file: file,
                        poster: "{{ $bit->getPosterUrl() }}",
                        default_quality: "Auto"
                  });
            </script>
      @endsection

</x-front.app>
