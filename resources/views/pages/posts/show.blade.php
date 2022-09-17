<x-front.app title="Blog | {{ $post->title }}">
      <div class="show-blog">
            <x-front.nav-topics />
            <!-- blog content -->
            <section class="show">
                  <div class="container">
                        <div class="row">
                              <div class="col-12 col-md-4">
                                    <div class="top">
                                          <div class="left d-flex align-items-center">
                                                <img src="{{ $post->author->profile_photo_url }}" alt="person"
                                                      width="60" height="60">
                                                <div class="info">
                                                      <a href="#"
                                                            class="btn-person">{{ $post->author->username }}</a>
                                                      <h6 class="">
                                                            {{ implode(',', $post->author->roles->pluck('name')->toArray()) }}
                                                            for educationforfree</h6>
                                                </div>
                                          </div>
                                          <span class="publish-date">Published
                                                {{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                              </div>
                              <div class="col-12 col-md-8">
                                    <div class="content">
                                          <div class="action">
                                                <div class="back">
                                                      <a href="{{ route('pages.posts.index') }}"><i
                                                                  class="fas fa-angle-left fa-fw"></i> Back to posts
                                                      </a>
                                                      <a href="#"
                                                            class="btn cate rounded">{{ $post->category->name }}</a>
                                                </div>
                                          </div>

                                          <h2 class="title">{{ $post->title }}</h2>

                                          <p class="lead">
                                                {{ $post->body }}
                                          </p>
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
                                          style="color: #000"type="submit"><i class="fas fa-sign-in-alt fa-fw"></i> sign
                                          up</a>
                              </div>
                        @else
                              <form id="cpa-form" class="mt-3" data-url="{{ route('comments.posts', $post) }}">
                                    <div class="form-floating">
                                          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" required></textarea>
                                          <label for="floatingTextarea2">Quick, thing of something to say!</label>
                                    </div>
                                    <hr>
                                    <div class="button mt-3">
                                          <button type="submit" class="btn"><i class="fas fa-comment-alt fa-fw"></i>
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

                              @foreach ($post->comments as $index => $comment)
                                    <div class="comment shadow-sm" id="{{ $index . '_' . $comment->user->username }}">
                                          <div class="image">
                                                <img src="https://ui-avatars.com/api/?name={{ str()->limit($comment->user->name, 2) }}&color=7F9CF5"
                                                      alt="user image" height="72" width="72" class="rounded">
                                                <span><i class="fas fa-play-circle fa-fw"></i> Subscriber</span>
                                          </div>
                                          <div class="information w-100">
                                                <div class="upper">
                                                      <h3>{{ $comment->user->username }}</h3>
                                                      <small>Posted {{ $comment->created_at->diffForHumans() }}</small>
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
                                                                  data-type="comment"> <i class="fas fa-reply"></i>
                                                                  Replay</button>
                                                      </div>
                                                </div>
                                          </div>
                                          {{-- if auth --}}
                                          @auth
                                                @if ($comment->user_id == auth()->user()->id)
                                                      <div class="actions">
                                                            <button class="btn edit-btn" data-comment="{{ $comment->id }}"
                                                                  data-id="1" data-type="comment">
                                                                  <i class="fas fa-edit"></i>
                                                                  Edit</button>
                                                            <form action="" class="deleteComment"
                                                                  data-id="#{{ $index . '_' . $comment->user->username }}"
                                                                  data-url="{{ route('comments.posts.destroy', $comment) }}"
                                                                  method="post">
                                                                  <button class="btn delete-btn" data-id="1"
                                                                        data-type="comment">
                                                                        <i class="fas fa-trash-alt"></i> Delete</button>
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
                                                                        data-user="{{ $replay->user->username }}"> <i
                                                                              class="fas fa-reply"></i>
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

            <!--footer section-->
            <x-front.footer />
      </div>

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

      @endsection
</x-front.app>
