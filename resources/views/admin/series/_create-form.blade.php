<x-forms.form action="{{ route('admins.series.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="row">
            <div class="col-12 col-md-7">
                  {{-- episode card --}}
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Episode information</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- episode title  -->
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode title</x-forms.label>
                                    <input type='text'name='title' required value="{{ old('title') }}"
                                          class="form-control" id="episode_name" placeholder="Enter episode title">
                              </x-forms.form-group><!-- form group -->

                              {{-- episode description --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode description</x-forms.label>
                                    <x-forms.text-area name='description' rows='9' id="episode_description"
                                          placeholder='Enter episode description'>
                                          {{ old('description') }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- what will learn --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode learns</x-forms.label>
                                    <x-forms.text-area name='learns' id="episode_learns" rows='7'
                                          placeholder='Enter episode learns'>
                                          {{ old('learns') }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- topic --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Topic</x-forms.label>
                                    <select class="form-control select2" name='topic_id' style="width: 100%;">
                                          @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                          @endforeach
                                    </select>
                                    <small><a href="{{ route('admins.topics.create') }}">+ create topic</a></small>
                              </x-forms.form-group>

                        </x-cards.body><!-- card body -->
                  </x-cards.card>

                  {{-- series card --}}
                  <x-cards.card class='card-outline card-info'>
                        <x-cards.header>
                              <h3 class="card-title mr-5">Series information</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>
                              <!-- series name  -->
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>series name</x-forms.label>
                                    <input type='text'name='series_name' required value="{{ old('name') }}"
                                          class="form-control" id="series_name" placeholder="Enter series name">
                              </x-forms.form-group><!-- form group -->

                              {{-- series description --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Series description</x-forms.label>
                                    <x-forms.text-area name='series_description' rows='9' id="series_description"
                                          placeholder='Enter series description'>
                                          {{ old('series_description') }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- series poster --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Series poster</x-forms.label>

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
                                          required hidden>

                              </x-forms.form-group>

                              <div class="text-center">
                                    <img id="output" class='mt-3' style="max-width: 100%;" />
                              </div>
                        </x-cards.body>
                  </x-cards.card>

            </div><!-- col-12 col-md-6 -->

            <div class="col-12 col-md-5">
                  {{-- sections and loading --}}
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Sections & loading</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              {{-- section select --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Sections</x-forms.label>
                                    <select class="form-control" id="select_section" name='section_id'
                                          data-section_url='{{ route('admins.sections.show', $series) }}'
                                          style="width: 100%;">
                                          {{-- @foreach ($sections as $section)
                                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                          @endforeach --}}
                                    </select>
                                    <small id='create_section_id'><a href="">+ create
                                                section</a></small>
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

                  {{-- series episode path --}}
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Series episode</h3>
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
                                    <input type="file" name="path" id="episode_path" required hidden>
                              </x-forms.form-group>

                              {{-- publis the series bit --}}
                              <x-forms.submit id='publish_btn' class="btn-success float-right" disabled> <i
                                          class="fa-fw fas fa-plus"></i> Publish
                              </x-forms.submit>
                              <input type="hidden" id='episode_id' value="" name="episode_id" required>
                        </x-cards.body>
                  </x-cards.card>

                  <!-- Modal HTML -->
                  <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-lg">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h5 class="modal-title">Create Section</h5>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                          <form action="">
                                                @csrf
                                                @method('POST')
                                                <x-forms.form-group class="mb-4">
                                                      <x-forms.label>Section name</x-forms.label>
                                                      <input type='text'name='section' required
                                                            class="form-control" id="section_input_id"
                                                            placeholder="Enter section name">
                                                </x-forms.form-group><!-- form group -->

                                          </form>
                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-success"
                                                data-series_id="{{ $series->id }}" id="section_submit">
                                                <i class="fas fa-plus"></i>
                                                create</button>
                                    </div>
                              </div>
                        </div>
                  </div>
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

                              // before create episode check the data for this episode
                              var errors = [];
                              var episode_name = $('#episode_name').val();
                              var episode_description = CKEDITOR.instances.episode_description.getData();
                              var episode_learns = CKEDITOR.instances.episode_learns.getData();
                              var select_section = $('#select_section option:selected').text();

                              if (episode_name.length == 0)
                                    errors.push('the episode name is required');

                              if (episode_description.length == 0)
                                    errors.push('the episode description is required');

                              if (episode_learns.length == 0)
                                    errors.push('the episode learnings is required');

                              if (select_section.length == 0)
                                    errors.push('the select section is required');


                              // check if there is errors or not
                              if (errors.length > 0) {
                                    Swal.fire({
                                          icon: 'error',
                                          title: 'Oops...',
                                          text: errors,
                                    })
                              } else
                                    $('#episode_path').click();
                        });

                        // on change reomve rhe episode wrapper
                        $(document).on('change', '#episode_path', function() {

                              // show the progress bar
                              $('.uploading-area').removeClass('d-none');

                              // get the episode
                              var episode = this.files[0];
                              var filename = episode.name.replace(/\.[^/.]+$/, "");

                              // put the name in name field
                              $('#episode_name').val(filename);

                              var episode_name = $('#episode_name').val();
                              var episode_description = CKEDITOR.instances.episode_description.getData();
                              var episode_learns = CKEDITOR.instances.episode_learns.getData();
                              var select_section = $('#select_section option:selected').val();

                              var formData = new FormData()
                              formData.append('access_token', csrf_token);
                              formData.append('name', episode_name);
                              formData.append('description', episode_description);
                              formData.append('learns', episode_learns);

                              $.ajax({
                                    url: `http://127.0.0.1:8000/admin/series/${select_section}/store/episode`,
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(id) {
                                          uploadEpisode(id, episode);
                                    }
                              });

                        });

                        // on click select_section
                        $(document).on('focus', '#select_section', function() {

                              var url = $(this).data('section_url');
                              // call function to to append ajax request
                              appendSection(url);
                        });

                        // on click to show modal dialog
                        $(document).on('click', '#create_section_id', function(e) {
                              e.preventDefault();

                              // empety the value
                              $('#section_input_id').val('');

                              // open the dialog
                              $('#myModal').modal('show');

                        }); //-- end of modal dialog

                        // on submit the modal dialog
                        $(document).on('click', '#section_submit', function() {
                              $('#section_input_id').val().length == 0 ?
                                    alert('Please select') :
                                    createSection($(this).data('series_id'), $('#section_input_id').val());
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
                                                      success: function(
                                                            edpisodeAfterEncoding
                                                      ) {

                                                            $('#encoding_progress_bar')
                                                                  .css('width',
                                                                        edpisodeAfterEncoding +
                                                                        '%'
                                                                  )
                                                                  .html(edpisodeAfterEncoding +
                                                                        '%'
                                                                  );

                                                            if (edpisodeAfterEncoding ==
                                                                  100) {
                                                                  clearInterval
                                                                        (
                                                                              interval
                                                                        );
                                                                  $('#publish_btn')
                                                                        .attr('disabled',
                                                                              false
                                                                        );
                                                                  $('#episode_id')
                                                                        .attr('value',
                                                                              id
                                                                        );
                                                            }

                                                      },
                                                });

                                          }, 1000);


                                    },
                                    error: function(error) {
                                          console.log('error');
                                    }

                              });
                        } //-- end of uploadEpisode

                        // get the sections name to append select box
                        function appendSection(url) {

                              // call ajax request
                              $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data: {
                                          '_token': csrf_token
                                    },
                                    success: function(sections) {
                                          $('#select_section').html(sections);
                                    }
                              });
                        } //-- end of appendSection

                        // create section
                        function createSection(id, section_name) {
                              // call post request ajax
                              var formData = new FormData()
                              formData.append('access_token', csrf_token);
                              formData.append('id', id);
                              formData.append('name', section_name);

                              $.ajax({
                                    url: "{{ route('admins.sections.store') }}",
                                    type: 'POST',
                                    data: {
                                          '_method': 'POST',
                                          '_token': csrf_token,
                                          'id': id,
                                          'name': section_name
                                    },
                                    success: function(section) {
                                          $('#myModal').modal('toggle');
                                          $("#select_section").focus();
                                    },
                                    error: function() {
                                          alert('Something went wrong');
                                    }
                              });
                        }
                  });
            </script>
      @endsection
</x-forms.form><!-- forms -->
