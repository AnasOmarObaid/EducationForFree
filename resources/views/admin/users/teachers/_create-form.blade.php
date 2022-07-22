<x-forms.form action="{{ route('admins.users.teachers.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="row">
            <div class="col-12 col-md-6">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Teacher informations</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- teacher name  -->
                              <x-forms.form-group>
                                    <x-forms.label>Teacher Name</x-forms.label>
                                    <x-forms.input type='text' name='name' value="{{ old('name') }}"
                                          placeholder="Enter teacher name" small='show' show_name='teacher' />
                              </x-forms.form-group><!-- form group -->

                              <!-- teacher email  -->
                              <x-forms.form-group>
                                    <x-forms.label>Teacher Email</x-forms.label>
                                    <x-forms.input type='email' name='email' value="{{ old('email') }}"
                                          placeholder="Enter teacher email" small='show' show_name='email' />
                              </x-forms.form-group><!-- form group -->

                              <!-- teacher password  -->
                              <x-forms.form-group>
                                    <x-forms.label>Teacher password</x-forms.label>
                                    <x-forms.input type='password' name='password' value="{{ old('password') }}"
                                          placeholder="Teacher password" />
                                    @error('password')
                                          <small class="text-danger">{{ $message }}</small>
                                    @enderror
                              </x-forms.form-group><!-- form group -->

                              <!-- Teacher confirm password  -->
                              <x-forms.form-group>
                                    <x-forms.label>Confirm password</x-forms.label>
                                    <x-forms.input type='password' name='password_confirmation'
                                          value="{{ old('password_confirmation') }}" placeholder="Confirm password" />
                              </x-forms.form-group><!-- form group -->

                              <!-- teacher address  -->
                              <x-forms.form-group>
                                    <x-forms.label>Teacher Address</x-forms.label>
                                    <x-forms.input type='text' name='address' value="{{ old('address') }}"
                                          placeholder="Enter teacher address" />
                              </x-forms.form-group><!-- form group -->

                              <!-- teacher profile  -->
                              <x-forms.form-group>
                                    <x-forms.label>Teacher profile</x-forms.label>
                                    <div class="input-group">
                                          <div class="custom-file">
                                                <input type="file" name='profile' accept="image/*"
                                                      onchange="loadFile(event)" class="custom-file-input"
                                                      id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                      file</label>
                                          </div>
                                          <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                          </div>
                                    </div>
                                    <div class="text-center">
                                          <img id="output" class='mt-3' />
                                    </div>
                              </x-forms.form-group><!-- form group -->

                        </x-cards.body><!-- card body -->
                  </x-cards.card>
            </div><!-- col-12 col-md-6 -->

            <div class="col-12 col-md-6">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">teacher control & permissions</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>
                              <!-- checkbox -->
                              <x-forms.label>Teacher permissions</x-forms.label>

                              <div class='row'>
                                    <?php $models = ['comments', 'categories-post', 'posts', 'profiles'];
                                    $permissions = ['create', 'read', 'update', 'delete']; ?>
                                    @foreach ($models as $model)
                                          @foreach ($permissions as $permission)
                                                @if ($loop->parent->last)
                                                      @if ($loop->first or $loop->index == 1)
                                                            @continue
                                                      @endif
                                                @endif
                                                <div class="col-md-4 mb-2">
                                                      <div class="form-group clearfix">
                                                            <div class="icheck-primary d-inline">
                                                                  <input type="checkbox"
                                                                        @if (is_array(old('permissions'))) @if (in_array($model . '_' . $permission, old('permissions'))) checked @endif
                                                                  @else checked @endif
                                                                  name="permissions[]"
                                                                  value="{{ $model . '_' . $permission }}"
                                                                  id="{{ $model . '_' . $permission }}">
                                                                  <label
                                                                        for="{{ $model . '_' . $permission }}"></label>
                                                            </div>

                                                            <div class="icheck-primary d-inline">
                                                                  <label class="remove-padding-left"
                                                                        for="{{ $model . '_' . $permission }}">{{ $model . '_' . $permission }}</label>
                                                            </div>
                                                      </div>
                                                </div>
                                          @endforeach
                                    @endforeach

                              </div><!-- /.row -->

                              <hr>
                              <x-forms.form-group class="mt-4">
                                    <x-forms.label>teacher activation</x-forms.label>
                                    <select class="form-control select2" name='activation' style="width: 100%;">
                                          <option value="1" {{ old('activation') == '1' ? 'selected' : '' }}>
                                                Active</option>
                                          <option value="0" {{ old('activation') == '0' ? 'selected' : '' }}>Not
                                                active</option>
                                    </select>
                              </x-forms.form-group>
                        </x-cards.body><!-- card body -->
                        <x-cards.footer class="text-right">
                              <button type="submit" class="btn btn-primary"> <i class="fa-fw fas fa-check"></i>
                                    Create</button>
                              </button>
                        </x-cards.footer>
                  </x-cards.card>
            </div><!-- col-12 col-md-6 -->
      </div><!-- row -->
      @section('scripts')
            <script>
                  var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                              URL.revokeObjectURL(output.src) // free memory
                        }
                  };

                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
      @endsection
</x-forms.form><!-- forms -->
