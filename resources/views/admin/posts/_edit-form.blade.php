<x-forms.form action="{{ route('admins.posts.update', $post->title) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
          <div class="col-12 col-md-12">
                <x-cards.card class="card-outline card-info">
                      <x-cards.header>
                            <h3 class="card-title mr-5">Posts</h3>
                      </x-cards.header><!-- card header -->
                      <x-cards.body>

                            <!-- post name  -->
                            <x-forms.form-group>
                                  <x-forms.label>Post title</x-forms.label>
                                  <x-forms.input type='text' name='title' value="{{ old('title', $post->title) }}"
                                        placeholder="Enter post title" small='show' show_name='title' />
                            </x-forms.form-group><!-- form group -->

                            {{-- body --}}
                            <div class="form-group mb-4">
                                  <x-forms.label>post body</x-forms.label>
                                  <x-forms.text-area name='body' rows='9' placeholder='Enter post body'>
                                        {!! old('body', $post->body) !!}</x-forms.text-area>
                            </div>

                            {{-- category --}}
                            <x-forms.form-group class="mt-4 mb-4">
                                  <x-forms.label>Category</x-forms.label>
                                  <select class="form-control select2" name='post_category_id' style="width: 100%;">
                                        @foreach ($categories as $category)
                                              <option value="{{ $category->id }}"
                                                    {{ $post->category->id == $category->id ? 'selected' : ''}}>
                                                    {{ $category->name }}
                                              </option>
                                        @endforeach
                                  </select>
                                  <small><a href="{{ route('admins.posts-categories.create') }}" target="_blank">
                                              <i class="fa-fw fa fa-plus"></i> update category</a></small>
                            </x-forms.form-group>

                            {{-- activation --}}
                            <x-forms.form-group class="mt-4 mb-4">
                                  <x-forms.label>Post activation</x-forms.label>
                                  <select class="form-control select2" name='activation' style="width: 100%;">
                                        <option value="1" {{ $post->activation == '1' ? 'selected' : '' }}>
                                              Active</option>
                                        <option value="0" {{ $post->cativation == '0' ? 'selected' : '' }}>Not
                                              active</option>
                                  </select>
                            </x-forms.form-group>

                            {{-- image --}}
                            <x-forms.form-group>
                                  <x-forms.label>post poster</x-forms.label>
                                  <div class="input-group">
                                        <div class="custom-file">
                                              <input type="file" name='image' accept="image/*"
                                                    onchange="loadFile(event)" class="custom-file-input"
                                                    id="exampleInputFile">
                                              <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                        </div>
                                        <div class="input-group-append">
                                              <span class="input-group-text">Upload</span>
                                        </div>
                                  </div>
                                  <div class="text-center" style="max-width: 200px">
                                        <img id="output" src='{{ $post->getPoster() }}' width="350" class='mt-3' />
                                  </div>
                            </x-forms.form-group><!-- form group -->

                            <x-forms.submit class="btn-success w-100"> <i class="fa-fw fas fa-edit"></i> Update
                            </x-forms.submit>
                      </x-cards.body><!-- card body -->
                </x-cards.card>
          </div><!-- col-12 col-md-6 -->

    </div><!-- row -->
    @section('scripts')
          <script>
                $(document).ready(function() {
                      $('.select2').select2();
                });
          </script>

          <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

          <script>
                $(document).ready(function() {
                      $('.ckeditor').ckeditor();
                });
          </script>
    @endsection
</x-forms.form><!-- forms -->
