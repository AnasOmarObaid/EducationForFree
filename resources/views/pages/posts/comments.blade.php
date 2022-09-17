<div class="comment shadow-sm">
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
                              <button class="btn"><i class="fas fa-heart fa-fw hea" style="color:red"></i>
                                    {{ $comment->likes->count() }}</button>
                        </form>
                        <button class="btn replay-btn" data-user="{{ $comment->user->username }}" data-type="comment">
                              <i class="fas fa-reply"></i>
                              Replay</button>
                  </div>
            </div>
      </div>
      <div class="actions">
            <button class="btn edit-btn" data-id="1" data-type="comment"> <i class="fas fa-edit"></i>
                  Edit</button>
            <form action="" id="deleteComment"
                  data-url="{{ route('comments.posts.destroy', $comment) }}">
                  <button class="btn delete-btn" data-id="1" data-type="comment">
                        <i class="fas fa-trash-alt"></i> Delete</button>
            </form>
      </div>
</div>
