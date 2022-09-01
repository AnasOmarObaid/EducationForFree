<x-forms.form action="{{ route('admins.roles.update', $role) }}" method="POST">
      @csrf
      @method('PUT')
      <x-cards.card>

            <x-cards.header>
                  <h3 class="card-title mr-5">edit roles for user form</h3>
            </x-cards.header><!-- card header -->


            <x-cards.body>

                  <!-- role name  -->
                  <x-forms.form-group>
                        <x-forms.label>Role Name</x-forms.label>
                        <x-forms.input type='text' name='name' value="{{ old('name', $role->name) }}"
                              placeholder="Enter role name" small='show' />
                  </x-forms.form-group><!-- form group -->

                  {{-- display description --}}
                  <div class="form-group mb-4">
                        <x-forms.label>Description</x-forms.label>
                        <x-forms.text-area name='description' rows='2' placeholder='Enter description for the role'>
                              {{ old('description', $role->description) }}</x-forms.text-area>
                  </div>

                  {{-- permissions --}}
                  <div class="row">
                    <?php $models = ['roles', 'users', 'questions','categories-post', 'posts', 'comments', 'playlist-category']; ?>
                        @foreach ($models as $model)
                              <div class="col-md-4 mb-3">
                                    <x-cards.card class="{{ $loop->even ? 'card-primary' : 'card-danger' }}">

                                          <x-cards.header>
                                                <h3 class="card-title">
                                                      {{ ucfirst(str_replace('_', ' ', $model)) }}
                                                      permissions</h3>
                                          </x-cards.header><!-- header -->

                                          <x-cards.body>
                                                <div class="row">
                                                      <?php $permissions_map = ['create', 'read', 'update', 'delete']; ?>
                                                      @foreach ($permissions_map as $permission_map)
                                                            <div class="col-sm-6">
                                                                  <!-- checkbox -->
                                                                  <div class="form-group clearfix">
                                                                        <div class="icheck-primary d-inline">
                                                                              <input type="checkbox"
                                                                                    {{ $role->hasPermission($model . '_' . $permission_map) ? 'checked' : '' }}
                                                                                    name="permissions[]"
                                                                                    value="{{ $model . '_' . $permission_map }}"
                                                                                    id="{{ $model . '_' . $permission_map }}">
                                                                              <label
                                                                                    for="{{ $model . '_' . $permission_map }}">
                                                                              </label>
                                                                        </div>

                                                                        <div class="icheck-primary d-inline">
                                                                              <label class="remove-padding-left"
                                                                                    for="{{ $model . '_' . $permission_map }}">
                                                                                    {{ $model . '_' . $permission_map }}
                                                                              </label>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      @endforeach
                                                </div>
                                          </x-cards.body><!-- body -->
                                          <x-cards.footer>
                                                this permissions for
                                                {{ str_replace('_', ' ', $model) }}
                                                model
                                          </x-cards.footer><!-- footer -->
                                    </x-cards.card>
                                    <!--cards -->
                              </div><!-- col-md-4 -->
                        @endforeach
                  </div>
                  {{-- print the error for permissions --}}
                  @error('permissions')
                        <p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                              {{ $message }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </button>
                        </p>
                  @enderror
            </x-cards.body> <!-- card body -->

            {{-- submit button --}}
            <x-cards.footer class="text-right">
                  <x-forms.submit class="btn-success"> <i class="fa-fw fas fa-edit"></i> Edit</x-forms.submit>
            </x-cards.footer><!-- card footer -->
      </x-cards.card>
      </x-admin.forms.form><!-- forms -->
