<x-forms.form action="{{ route('admins.posts-categories.store') }}" method="POST">
      @csrf
      @method('POST')
      <div class="row">
            <div class="col-12 col-md-12">
                  <x-cards.card class="card-outline card-info">
                        <x-cards.header>
                              <h3 class="card-title mr-5">Post Categories</h3>
                        </x-cards.header><!-- card header -->
                        <x-cards.body>

                              <!-- category name  -->
                              <x-forms.form-group>
                                    <x-forms.label>Category Name</x-forms.label>
                                    <x-forms.input type='text' name='name' value="{{ old('name') }}"
                                          placeholder="Enter Category name" small='show' show_name='category'/>
                              </x-forms.form-group><!-- form group -->

                              {{-- description --}}
                              <div class="form-group mb-4">
                                    <x-forms.label>Category description</x-forms.label>
                                    <x-forms.text-area name='description' rows='5'
                                          placeholder='Enter Category description'>
                                          {{ old('description') }}</x-forms.text-area>
                              </div>

                              <x-forms.form-group class="mt-4 mb-4">
                                    <x-forms.label>Category activation</x-forms.label>
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
      @section('scripts')
            <script>
                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
      @endsection
</x-forms.form><!-- forms -->
