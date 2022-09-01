<x-forms.form action="{{ route('admins.educ-bits.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="row">
            <div class="col-12 col-md-7">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">EducBits information</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- post name  -->
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode title</x-forms.label>
                                    <x-forms.input type='text' name='title' value="{{ old('title') }}"
                                          id="episode_name" placeholder="Enter post title" />
                              </x-forms.form-group><!-- form group -->

                              {{-- description --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode description</x-forms.label>
                                    <x-forms.text-area name='description' rows='9'
                                          placeholder='Enter episode description'>
                                          {{ old('description') }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- what will learn --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode learns</x-forms.label>
                                    <x-forms.text-area name='learns' rows='7' placeholder='Enter episode learns'>
                                          {{ old('learns') }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- playlist category --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Playlist category</x-forms.label>
                                    <select class="form-control select2" name='playlist_category' style="width: 100%;">
                                          <option value="1">
                                                Active
                                          </option>
                                    </select>
                              </x-forms.form-group>

                              {{-- episode poster --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode poster</x-forms.label>

                                    <div class="d-flex w-100" onclick="$('#episode_poster').click()"
                                          style="background:#f4f6f9;
                                          height:250px;
                                          align-items: center;
                                          justify-content: center;
                                          cursor:pointer;
                                          flex-direction: column;
                                          border: 1px solid;
                                          border-color: #c6c6c6;">
                                          <i class="fas fa-photo-video" style="font-size:80px"></i>
                                          click to upload
                                    </div>

                                    <input type="file" name="poster" id="episode_poster" onchange="loadFile(event)"
                                          hidden>

                              </x-forms.form-group>

                              <div class="text-center">
                                    <img id="output" class='mt-3' style="max-width: 100%;" />
                              </div>

                        </x-cards.body><!-- card body -->
                  </x-cards.card>

            </div><!-- col-12 col-md-6 -->
            <div class="col-12 col-md-5">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">EducBits episode</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              {{-- episode poster --}}
                              <x-forms.form-group>
                                    <div class="d-flex w-100" id="episode_wrapper"
                                          style="background:#f4f6f9;
                                            height:250px;
                                            align-items: center;
                                            justify-content: center;
                                            cursor:pointer;
                                            flex-direction: column;
                                            border: 1px solid;
                                            border-color: #c6c6c6;">
                                          <i class="fas fa-video" style="font-size:80px"></i>
                                          click to upload
                                    </div>
                                    <input type="file" name="path" id="episode_path"
                                          data-url='{{ route('admins.educ-bits.createEmptyEpisode') }}' hidden>
                              </x-forms.form-group>

                              {{-- upload progress bar --}}
                              <x-forms.form-group class='uploading-area d-none'>
                                    <x-forms.label>Uploading</x-forms.label>
                                    <div class="progress">
                                          <div class="progress-bar progress-bar-striped" id="upload_progress_bar"
                                                role="progressbar"></div>
                                    </div>
                              </x-forms.form-group>

                              {{-- encoding progress bar --}}
                              <x-forms.form-group class='uploading-area d-none mt-2'>
                                    <x-forms.label>Encoding episode</x-forms.label>
                                    <div class="progress">
                                          <div class="progress-bar progress-bar-striped" id="encoding_progress_bar"
                                                role="progressbar">0%</div>
                                    </div>
                              </x-forms.form-group>
                        </x-cards.body>
                  </x-cards.card>
            </div>
      </div><!-- row -->
      @section('scripts')
            <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
            <script>
                  $(document).ready(function() {
                        // select2 plugins
                        $('.select2').select2();

                        // send some value to method
                        const csrf_token = $("meta[name='csrf_token']").attr('content');

                        // remove the epispde wrapper
                        $(document).on('click', '#episode_wrapper', function() {
                              $('#episode_path').click();
                        });
                        var episode_id = 0;
                        // on change reomve rhe episode wrapper
                        $(document).on('change', '#episode_path', function() {

                              // reomve the episode wrapper
                              $('#episode_wrapper').remove();

                              // show the progress bar
                              $('.uploading-area').removeClass('d-none');

                              // get the episode
                              var episode = this.files[0];
                              var filename = episode.name.replace(/\.[^/.]+$/, "");

                              // put the name in name field
                              $('#episode_name').val(filename);

                              const url = $(this).data('url');

                              // create empty episode
                              $.ajax({
                                    url: url,
                                    type: 'GET',
                                    success: function(id) {
                                          uploadEpisode(id, episode);
                                    }
                              });


                        });

                        // upload episode functionality
                        function uploadEpisode(id, episode) {

                              var formData = new FormData()
                              formData.append('access_token', csrf_token);
                              formData.append('id', id);
                              formData.append('episode', episode);

                              // create ajax
                              $.ajax({
                                    url: "{{ route('admins.educ-bits.upload-episode') }}",
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    xhr: function() {
                                          var xhr = new window.XMLHttpRequest();

                                          // Upload progress
                                          xhr.upload.addEventListener("progress", function(evt) {
                                                if (evt.lengthComputable) {
                                                      var percentComplete = Math.round(evt
                                                            .loaded / evt.total *
                                                            100) + '%';
                                                      //Do something with upload progress
                                                      $('#upload_progress_bar').css(
                                                            'width', percentComplete
                                                      ).html(percentComplete);
                                                }
                                          }, false);

                                          return xhr;
                                    },
                                    success: function(episodBeforeEncoding) {
                                           var interval = setInterval(() => {
                                                $.ajax({
                                                      url: "http://127.0.0.1:8000/admin/educ-bits/" +
                                                            episodBeforeEncoding
                                                            .id + "/show",
                                                      type: "GET",
                                                      success: function(edpisodeAfterEncoding) {

                                                        $('#encoding_progress_bar').css(
                                                            'width', edpisodeAfterEncoding + '%'
                                                      ).html(edpisodeAfterEncoding + '%');

                                                        if(edpisodeAfterEncoding == 100)
                                                            clearInterval(interval);
                                                      },
                                                });

                                          }, 1000);

                                    },
                                    error: function(error) {
                                          console.log('error');
                                    }

                              });
                        }
                  });
            </script>
      @endsection
</x-forms.form><!-- forms -->
