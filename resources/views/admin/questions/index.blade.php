<x-admin.app title='Questions | View'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Users Questions</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Questions</li>
                              </ol>
                        </div><!-- /.col -->
                  </div><!-- /.row -->
            </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-12">
                              <x-cards.card>
                                    <x-cards.header id='question_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all questions<span
                                                                  class="badge badge-pill badge-success"></span>
                                                      </h3>
                                                </div>
                                                <div class="col-md-5 mt-3 mb-0"></div>
                                                <div class="col-md-7 mt-3">
                                                      <form action="" class="d-flex" style="align-items: center;">

                                                            {{-- read or not red --}}
                                                            <select name="read_at" class="form-control select2 ml-3">
                                                                  <option selected value="">---
                                                                  </option>
                                                                  <option value="1"
                                                                        {{ request('read_at') == 1 ? 'selected' : '' }}>
                                                                        read</option>
                                                                  <option value="false"
                                                                        {{ request('read_at') == 'false' ? 'selected' : '' }}>
                                                                        not read</option>
                                                            </select>

                                                            <div class="ml-2"></div>

                                                            {{-- is answered or not --}}
                                                            <select name="is_answered"
                                                                  class="form-control select2 ml-3">
                                                                  <option selected value="">---
                                                                  </option>
                                                                  <option value="1"
                                                                        {{ request('is_answered') == 1 ? 'selected' : '' }}>
                                                                        answered</option>
                                                                  <option value="false"
                                                                        {{ request('is_answered') == 'false' ? 'selected' : '' }}>
                                                                        no answer</option>
                                                            </select>

                                                            <div class="ml-2"></div>

                                                            <button type="submit" class='btn btn-info'>
                                                                  filter</button>
                                                            <div class="ml-2"></div>
                                                            <a href="#"
                                                                  class="btn-sweet-select-delete btn btn-danger disabled  {{ auth()->user()->hasPermission('questions_delete')? '': 'cursor-not disabled' }}">
                                                                  <i class="fas fa-trash-alt"></i></a>
                                                      </form>
                                                </div>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-2'>
                                          <table id="question_table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead>
                                                      <tr>
                                                            <th><input class='select-all my-custom-control-input'
                                                                        type="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Question</th>
                                                            <th>Answer</th>
                                                            <th>Created At</th>
                                                            <th>Read At</th>
                                                            <th>Actions</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($questions as $question)
                                                            <tr>
                                                                  <td><input class='checkbox my-custom-control-input'
                                                                              type="checkbox"
                                                                              data-id="{{ $question->id }}" />

                                                                  <td>{{ $loop->index + 1 }}</td>


                                                                  <td>{{ Str::limit($question->name, 7) }}</td>

                                                                  <td>{{ $question->email }}</td>

                                                                  <td>{{ Str::limit($question->question, 15) }}</td>

                                                                  <td id="answerTd_{{$question->id}}">
                                                                        @if ($question->answer)
                                                                              {{ Str::limit($question->answer, 35) }}
                                                                        @else
                                                                              <span data-answer='badge-danger' id="notAnswer_{{ $question->id }}"
                                                                                    class='badge badge-pill badge-danger'>
                                                                                    not answer
                                                                              </span>
                                                                        @endif
                                                                  </td>

                                                                  <td>{{ $question->created_at->format('M d/y') }}
                                                                  </td>
                                                                  <td id='readAt_{{ $question->id }}'>
                                                                        @if ($question->read_at)
                                                                              <span
                                                                                    class="read_at">{{ $question->read_at->format('M d/y') }}</span>
                                                                        @else
                                                                              <span data-answer='badge-danger'
                                                                                    id="notRead_{{ $question->id }}"
                                                                                    class='badge badge-pill badge-danger'>
                                                                                    not readed
                                                                              </span>
                                                                        @endif
                                                                  </td>
                                                                  <td>
                                                                        <a href="{{ route('admins.questions.edit', $question) }}"
                                                                              class="btn btn-info" data-toggle="tooltip"
                                                                              data-placement="bottom"
                                                                              title="Edit Question"><i
                                                                                    class="fas fa-user-edit"></i></a>

                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.questions.destroy', $question) }}'>
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    title="delete this question"
                                                                                    class="btn btn-danger btn-sweet-delete"><i
                                                                                          class="fas fa-trash-alt"></i></button>
                                                                        </form>

                                                                        <form action="" class='d-inline'
                                                                              method='post'>
                                                                              @csrf
                                                                              @method('POST')
                                                                              <button type="submit"
                                                                                    class='btn btn-success btn-sweet-replay'
                                                                                    data-id="{{ $question->id }}"
                                                                                    data-read_url='{{ route('admins.questions.read', $question) }}'
                                                                                    data-toggle="tooltip"
                                                                                    data-email='{{ $question->email }}'
                                                                                    data-question='{{ $question->question }}'
                                                                                    data-url='{{ route('admins.questions.replay', $question) }}'
                                                                                    title="replay for this question">
                                                                                    <i class="fas fa-reply"></i>
                                                                              </button>
                                                                        </form>
                                                                  </td>
                                                            </tr>
                                                      @endforeach
                                                </tbody>
                                                <tfoot>
                                                      <tr>
                                                            <th><input class='select-all my-custom-control-input'
                                                                        type="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Question</th>
                                                            <th>Answer</th>
                                                            <th>Created At</th>
                                                            <th>Read At</th>
                                                            <th>Actions</th>
                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </x-cards.body><!-- body -->

                              </x-cards.card><!-- card -->
                        </div><!-- col-12 --->
                  </div>
                  <!--row -->
            </div><!-- container-fluid -->

            <!-- Modal HTML -->
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog modal-lg">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <h5 class="modal-title">Replay Model</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                    <p style="font-weight: bold;">Email: <small id="userEmail"
                                                style="font-size: 1rem; font-weight: bold"></small></p>
                                    <p style="font-weight: bold" id="userQuestion"></p>
                                    <form action="">
                                          @csrf
                                          @method('POST')
                                          <x-forms.text-area name='answer' rows='7' id="answerArea"
                                                placeholder='Enter answer for this question'>
                                          </x-forms.text-area>
                                          <small class="text-danger" id="errorMessage"></small>
                                          <small class="text-success" id="successMessage"></small>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                          data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success" id="replay-btn">
                                          <i class="fas fa-reply"></i>
                                          Replay</button>
                              </div>
                        </div>
                  </div>
            </div>
      </section>
      @section('scripts')
            <script>
                  $(function() {
                        $("#question_table").DataTable({
                              "responsive": true,
                              "lengthChange": true,
                              "autoWidth": false,
                              "paging": true,
                              "info": true,
                              'pageLength': 25,
                              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#question_wrapper .col-md-5:eq(0)');
                  });


                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>

            <!-- delete single element -->
            <x-alerts.delete permission="questions_delete" />
            <!-- delete selected element -->
            <x-alerts.delete-selected permission="questions_delete" route='admins.questions.destroy-selected' />
            {{-- replay to the question --}}
            <script>
                  $(document).ready(function() {
                        var url = '';
                        const csrf_token = $("meta[name='csrf_token']").attr('content');
                        var id = '';
                        var answer = '';
                        // show modal dialog
                        $(document).on('click', '.btn-sweet-replay', function(e) {
                              // preventDefault
                              e.preventDefault();
                              // reomve the error message
                              $('#errorMessage').text('');
                              // remove the successMessage
                              $('#successMessage').text('');
                              // send the email in dialog
                              $('#userEmail').html($(this).data('email'));
                              // send the question in dialog
                              $('#userQuestion').html('Question: ' + $(this).data('question'));
                              // get the url
                              url = $(this).data('url');
                              // get the id for the question
                              id = $(this).data('id');
                              // open the dialog
                              $('#myModal').modal('show');
                              // make this question read
                              var read_url = $(this).data('read_url');
                              // ajax request to make this question read
                              $.ajax({
                                    url: read_url,
                                    type: 'POST',
                                    data: {
                                          '_method': 'POST',
                                          '_token': csrf_token
                                    },
                                    success: function(data) {

                                          // date
                                          var date = data.read_at;

                                          // set the answer in textarea
                                          $('#answerArea').val(data.answer);

                                          // remove the badge
                                          $('#notRead_' + id).remove();

                                          // add the date in span
                                          $('#readAt_' + id).html(date);
                                    },
                                    error: function(data) {
                                          console.log(data);
                                    }
                              });

                        });

                        // click replay-btn
                        $(document).on('click', '#replay-btn', function() {

                              // answer
                              answer = $('#answerArea').val();

                              $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                          '_method': 'POST',
                                          '_token': csrf_token,
                                          'answer': answer
                                    },
                                    success: function(data) {
                                          // remove the error message
                                          $('#errorMessage').text('');
                                          // add success message
                                          $('#successMessage').text(data.msg);
                                          // remove the badge
                                          $('#notAnswer_' + id).remove();
                                          // add the answer in table
                                          $('#answerTd_' + id).html(answer);

                                    },
                                    error: function(data) {
                                          // send the error to small tag
                                          $('#successMessage').text('');
                                          $('#errorMessage').text(data.responseJSON
                                                .message);
                                    }
                              });
                        });
                  });
            </script>
      @endsection
</x-admin.app>
