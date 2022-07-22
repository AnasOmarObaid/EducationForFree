@foreach ($permissions as $permission)
      <div class="col-md-4">
            <div class="form-group">
                  <div class="icheck-primary d-inline">
                        <input type="checkbox" checked name="" value="{{ $permission->name }}">
                        <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                  </div>

                  <div class="icheck-primary d-inline">
                        <label class="remove-padding-left"
                              for="{{ $permission->name }}">{{ $permission->namen }}</label>
                  </div>
            </div>
      </div>
@endforeach
