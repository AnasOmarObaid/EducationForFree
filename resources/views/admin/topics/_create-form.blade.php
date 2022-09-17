<x-forms.form action="{{ route('admins.topics.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="row">
            <div class="col-12 col-md-12">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Topics</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- topic name  -->
                              <x-forms.form-group>
                                    <x-forms.label>topic Name</x-forms.label>
                                    <x-forms.input type='text' name='name' value="{{ old('name') }}"
                                          placeholder="Enter topic name" small='show' show_name='topic' />
                              </x-forms.form-group><!-- form group -->

                              {{-- topic poster --}}
                              <x-forms.form-group class="mb-2">
                                    <x-forms.label>topic poster</x-forms.label>

                                    <div class="d-flex w-100" onclick="$('#topic_poster').click()"
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

                                    <input type="file" name="poster" id="topic_poster" onchange="loadFile(event)"
                                          required>

                              </x-forms.form-group>

                              <div class="text-center">
                                    <img id="output" class='mt-3' style="max-width: 100%;" />
                              </div>

                              {{-- categories --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>topic activation</x-forms.label>
                                    <select name="playlist_category_id" class="form-control select2">

                                          @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                      {{ is_array(request('categories')) && in_array($category->name, request('categories')) ? 'selected' : '' }}>
                                                      {{ $category->name }}</option>
                                          @endforeach
                                    </select>
                              </x-forms.form-group>

                              {{-- activation --}}
                              <x-forms.form-group class="mb-4">
                                    <x-forms.label>topic activation</x-forms.label>
                                    <select class="form-control select2" name='activation' style="width: 100%;">
                                          <option value="1" {{ old('activation') == '1' ? 'selected' : '' }}>
                                                Active</option>
                                          <option value="0" {{ old('activation') == '0' ? 'selected' : '' }}>Not
                                                active</option>
                                    </select>
                              </x-forms.form-group>

                              <x-forms.submit class="btn-success w-100"> <i class="fa-fw fas fa-check"></i> Create
                              </x-forms.submit>
                        </x-cards.body><!-- card body -->
                  </x-cards.card>
            </div><!-- col-12 col-md-6 -->

      </div><!-- row -->
</x-forms.form><!-- forms -->
