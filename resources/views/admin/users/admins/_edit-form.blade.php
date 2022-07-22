<x-forms.form action="{{ route('admins.users.admins.update', $admin) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
            <div class="col-12 col-md-7">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Admin informations</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- admin name  -->
                              <x-forms.form-group>
                                    <x-forms.label>Admin Name</x-forms.label>
                                    <x-forms.input type='text' name='name' value="{{ old('name', $admin->name) }}"
                                          placeholder="Enter admin name" small='show' show_name='admin' />
                              </x-forms.form-group><!-- form group -->

                              <!-- admin email  -->
                              <x-forms.form-group>
                                    <x-forms.label>Admin Email</x-forms.label>
                                    <x-forms.input type='email' name='email'
                                          value="{{ old('email', $admin->email) }}" placeholder="Enter admin email"
                                          small='show' show_name='email' />
                              </x-forms.form-group><!-- form group -->


                              <!-- aadmin address  -->
                              <x-forms.form-group>
                                    <x-forms.label>Admin Address</x-forms.label>
                                    <x-forms.input type='text' name='address'
                                          value="{{ old('address', $admin->address) }}"
                                          placeholder="Enter admin address" />
                              </x-forms.form-group><!-- form group -->

                              <!-- admin profile  -->
                              <x-forms.form-group>
                                    <x-forms.label>Admin profile</x-forms.label>
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
                                          <img id="output" src="{{ $admin->profile_photo_url }}" class='mt-3' />
                                    </div>
                              </x-forms.form-group><!-- form group -->

                        </x-cards.body><!-- card body -->
                  </x-cards.card>
            </div><!-- col-12 col-md-6 -->

            <div class="col-12 col-md-5">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Admin control & permissions</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- checkbox -->
                              <x-forms.label>Admin role</x-forms.label>

                              <select name="role" class="form-control select2 ml-3" id='selectRoles'>
                                    <option hidden disabled selected value>---</option>
                                    @foreach ($roles as $role)
                                          <option id='{{ $role->name }}'
                                                {{ in_array($role->name, $admin->roles->pluck('name')->toArray()) ? 'selected' : '' }}
                                                data-url='{{ route('admins.users.admins.roles.permissions', $role) }}'
                                                value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                              </select>
                              @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                              @enderror
                              <small><a href="{{ route('admins.roles.create') }}"><i class="fas fa-plus fa-fw"></i>
                                          click to add role</a></small>
                              <hr>

                              <x-forms.form-group class="mt-4">
                                    <x-forms.label>Admin activation</x-forms.label>
                                    <select class="form-control select2" name='activation' style="width: 100%;">
                                          <option value="1" {{ $admin->activation == 1 ? 'selected' : '' }}>
                                                Active</option>
                                          <option value="0" {{ $admin->activation == 0 ? 'selected' : '' }}>Not
                                                active</option>
                                    </select>
                              </x-forms.form-group>
                        </x-cards.body><!-- card body -->

                  </x-cards.card>

                  {{-- Admin permissions area --}}
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Admin permissions</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>
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
                              <div class="row" id='permissions_area'>
                              </div>
                        </x-cards.body><!-- card body -->
                        <x-cards.footer class="text-right">
                              <button type="submit" class="btn btn-primary"> <i class="fa-fw fas fa-check"></i>
                                    Update</button>
                              </button>
                        </x-cards.footer>
                  </x-cards.card>
            </div><!-- col-12 col-md-6 -->

      </div><!-- row -->
      @section('scripts')
            <script>
                  // show image when selected
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

                  // csrf token
                  const csrf_token = $("meta[name='csrf_token']").attr('content');

                  // show the permissions
                  var urls = $('#selectRoles').find(':selected').data('url');

                  // ajax requset to get the permissions
                  sendAjax(urls);

                  // show the permissions for the selected roles
                  $('#selectRoles').on('change', function() {

                        // show the loader
                        $('#loaders').css('display', 'flex');

                        // option selected
                        var selected = $(this).find(':selected').text();
                        // data url
                        var url = $('#' + selected).data('url');

                        // ajax request
                        sendAjax(url);

                  });

                  function sendAjax(path) {
                        $.ajax({
                              url: path,
                              type: 'POST',
                              data: {
                                    '_method': 'POST',
                                    '_token': csrf_token
                              },
                              success: function(data) {

                                    // show the loader
                                    $('#loaders').css('display', 'none');

                                    $('#permissions_area').html(data);
                              },
                              error: function() {
                                    $('#permissions_area').html('opps! Something error try again');
                              }
                        });
                  }
            </script>
      @endsection
</x-forms.form><!-- forms -->
