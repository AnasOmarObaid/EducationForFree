<x-forms.form action="{{ route('admins.educ-bits.update', $bit) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
            <div class="col-12">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">EducBits information</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- title  -->
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode title</x-forms.label>
                                    <input type='text'name='title' required
                                          value="{{ old('title', $bit->episode->title) }}" class="form-control"
                                          id="episode_name" placeholder="Enter episode title">
                              </x-forms.form-group><!-- form group -->

                              {{-- description --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode description</x-forms.label>
                                    <x-forms.text-area name='description' rows='9'
                                          placeholder='Enter episode description'>
                                          {{ old('description', $bit->episode->description) }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- what will learn --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode learns</x-forms.label>
                                    <x-forms.text-area name='learns' rows='7' placeholder='Enter episode learns'>
                                          {{ old('learns', $bit->episode->learns) }}</x-forms.text-area>
                              </x-forms.form-group><!-- form group -->

                              {{-- playlist category --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Playlist category</x-forms.label>
                                    <select class="form-control select2" name='playlist_category' style="width: 100%;">
                                          @foreach ($categories as $category)
                                                <option {{ $bit->category->name == $category->name ? 'selected' : '' }}
                                                      value="{{ $category->id }}">{{ $category->name }}</option>
                                          @endforeach
                                    </select>
                              </x-forms.form-group>

                              {{-- episode poster --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>Episode poster</x-forms.label>

                                    <div class="d-flex w-100" onclick="$('#episodePoster').click()"
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

                                    <input type="file" name="poster" id="episodePoster" onchange="loadFile(event)">

                              </x-forms.form-group>

                              <div class="text-center">
                                    <img id="output" class='mt-3' style="max-width: 100%;"
                                          src="{{ $bit->getPosterUrl() }}" />
                              </div>

                        </x-cards.body><!-- card body -->
                        {{-- submit button --}}
                        <x-cards.footer class="text-right">
                              <x-forms.submit class="btn-success"> <i class="fa-fw fas fa-edit"></i> Edit
                              </x-forms.submit>
                        </x-cards.footer><!-- card footer -->
                  </x-cards.card>

            </div><!-- col-12 col-md-6 -->
      </div><!-- row -->
      @section('scripts')
            <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
            <script>
                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
      @endsection
</x-forms.form><!-- forms -->
