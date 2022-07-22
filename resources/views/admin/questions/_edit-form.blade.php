<x-forms.form action="{{ route('admins.questions.update', $question) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
          <div class="col-12 col-md-12">
                <x-cards.card class="card-outline card-info">
                      <x-cards.header>
                            <h3 class="card-title mr-5">Question</h3>
                      </x-cards.header><!-- card header -->
                      <x-cards.body>

                            <!-- admin name  -->
                            <x-forms.form-group>
                                  <x-forms.label>User Name</x-forms.label>
                                  <x-forms.input type='text' name='name' value="{{ old('name', $question->name) }}"
                                        placeholder="Enter user name" />
                            </x-forms.form-group><!-- form group -->

                            <!-- user email  -->
                            <x-forms.form-group>
                                  <x-forms.label>User Email</x-forms.label>
                                  <x-forms.input type='email' name='email' value="{{ old('email', $question->email) }}"
                                        placeholder="Enter user email" />
                            </x-forms.form-group><!-- form group -->

                            {{-- Question --}}
                            <div class="form-group mb-4">
                                  <x-forms.label>Question</x-forms.label>
                                  <x-forms.text-area name='question' rows='5'
                                        placeholder='Enter question'>
                                        {{ old('question', $question->question) }}</x-forms.text-area>
                            </div>
                            <x-forms.submit class="btn-success w-100"> <i class="fa-fw fas fa-edit"></i> Update</x-forms.submit>
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
