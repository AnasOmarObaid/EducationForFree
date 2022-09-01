
<div class="lds-roller w-100 justify-content-center" id="loaders" style="display: none">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<div class="commentArea">
      <div class="comment-form shadow-sm">
            <div class="image">
                  <img src="{{ $user->profile_photo_url }}" alt="user image" height="72" width="72" class="rounded">
                  <span style=''><i class="fas fa-play-circle fa-fw"></i>
                        {{ implode(',', $user->roles->pluck('name')->toArray()) }}</span>
            </div>
            <div class="information w-100">
                  <div class="upper">
                        <h3>{{ $user->name }}</h3>
                        <small>posted {{ $comment->created_at->diffForHumans() }}</small>
                        <p class="lead">{{ $comment->body }}</p>
                  </div>
            </div>

      </div>
      <div class="replayArea">
            @foreach ($comment->replays as $replay)

                  <div class="replay-form d-flex">
                        <div class="image">
                              <img src="{{ $replay->user->profile_photo_url }}" alt="user image" height="72" width="72"
                                    class="rounded">
                              <span><i class="fas fa-play-circle fa-fw"></i>
                                <?php $us = App\Models\User::where('id', $replay->user->id)->first() ?>
                                    {{ implode(',', $us->roles->pluck('name')->toArray()) }}</span>
                        </div>
                        <div class="information w-100">
                              <div class="upper">
                                    <h3>{{ $replay->user->name }}</h3>
                                    <small>Posted 1 week
                                          ago</small>
                                    <p class="lead">
                                          <strong><a href="@" style="text-decoration:none">{{ $comment->user->username }}</a></strong>
                                          {{ $replay->body }}
                                    </p>
                              </div>
                        </div>
                  </div>
            @endforeach
      </div>
</div>
