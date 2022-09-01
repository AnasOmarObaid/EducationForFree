<x-admin.app title='Comments| View'>
      @section('styles')
            <!-- DataTables -->
            <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
      @endsection
      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Comments</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Comments</li>
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
                                    <x-cards.header id='comments_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all comments<span
                                                                  class="badge badge-pill badge-success"></span>
                                                      </h3>
                                                </div>
                                                <div class="col-md-5">
                                                </div>
                                                <div class="col-md-7 mt-3">
                                                      <form action="" class="d-flex" style="align-items: center;">

                                                            {{-- active or not active --}}
                                                            <?php $models = ['App\Models\User', 'App\Models\Episode']; ?>
                                                            <select name="model" class="form-control select2 ml-3">
                                                                  <option selected value="">---
                                                                  </option>

                                                                  @foreach ($models as $model)
                                                                        <option value="{{ $model }}"
                                                                              {{ request('model') == $model ? 'selected' : '' }}>
                                                                              {{ $model }}
                                                                        </option>
                                                                  @endforeach
                                                            </select>

                                                            <div class="ml-2"></div>

                                                            {{-- username --}}
                                                            <select name="usernames[]" class="form-control select2 ml-3"
                                                                  multiple>

                                                                  @foreach ($users as $user)
                                                                        <option value="{{ $user->username }}"
                                                                              {{ is_array(request('usernames')) && in_array($user->username, request('usernames')) ? 'selected' : '' }}>
                                                                              {{ $user->username }}</option>
                                                                  @endforeach
                                                            </select>
                                                            <div class="ml-2"></div>

                                                            <div class="ml-2"></div>
                                                            <button type="submit" class='btn btn-info'>
                                                                  filter</button>
                                                            <div class="ml-2"></div>
                                                            <a href="#"
                                                                  class="btn-sweet-select-delete btn btn-danger disabled  {{ auth()->user()->hasPermission('comments_delete')? '': 'cursor-not disabled' }}">
                                                                  <i class="fas fa-trash-alt"></i></a>
                                                      </form>
                                                </div>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-2'>
                                          <div class="row">
                                                <div class="col-12 col-md-7">
                                                      <table id="comments_table"
                                                            class="table table-bordered table-hover table-striped">
                                                            <thead>
                                                                  <tr>
                                                                        <th><input class='select-all my-custom-control-input'
                                                                                    type="checkbox" /></th>
                                                                        <th>#</th>
                                                                        <th>User</th>
                                                                        <th>Model</th>
                                                                        <th>Likes</th>
                                                                        <th>Actions</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  @foreach ($comments as $comment)
                                                                        <tr>
                                                                              <td><input class='checkbox my-custom-control-input'
                                                                                          type="checkbox"
                                                                                          data-id="{{ $comment->id }}" />
                                                                              </td>

                                                                              <td>{{ $loop->index + 1 }}</td>


                                                                              <td>{{ $comment->user->username }}
                                                                              </td>

                                                                              <td>{{ $comment->model }}
                                                                              </td>

                                                                              <td>
                                                                                    {{ $comment->likes_count }}
                                                                              </td>

                                                                              <td>
                                                                                    {{-- delete comment --}}
                                                                                    <form class='d-inline'
                                                                                          method='comment'
                                                                                          action='{{ route('admins.comments.destroy', $comment) }}'>
                                                                                          @csrf
                                                                                          @method('DELETE')
                                                                                          <button type="submit"
                                                                                                data-toggle="tooltip"
                                                                                                title="delete this comment"
                                                                                                class="btn btn-danger btn-sweet-delete"><i
                                                                                                      class="fas fa-trash-alt"></i></button>
                                                                                    </form>

                                                                                    <a href="#"
                                                                                          class="btn btn-primary view-comment"
                                                                                          data-toggle="tooltip"
                                                                                          data-route="{{ route('admins.comments.show', $comment) }}"
                                                                                          title="view this comment">

                                                                                          <i class="fas fa-eye"></i>
                                                                                    </a>
                                                                              </td>
                                                                        </tr>
                                                                  @endforeach
                                                            </tbody>
                                                            <tfoot>

                                                                  <tr>
                                                                        <th><input class='select-all my-custom-control-input'
                                                                                    type="checkbox" /></th>
                                                                        <th>#</th>
                                                                        <th>User</th>
                                                                        <th>Model</th>
                                                                        <th>Likes</th>
                                                                        <th>Actions</th>
                                                                  </tr>

                                                            </tfoot>
                                                      </table>
                                                </div>
                                                <div class="col-md-5">
                                                      <x-cards.card>
                                                            <x-cards.header>
                                                                  <h6>Replay forma</h6>
                                                            </x-cards.header>
                                                            <x-cards.body id="response">

                                                                  {{-- here comment --}}
                                                            </x-cards.body>
                                                            </x-cards.table>
                                                </div>
                                          </div>
                                    </x-cards.body><!-- body -->

                              </x-cards.card><!-- card -->
                        </div><!-- col-12 --->
                  </div>
                  <!--row -->
            </div><!-- container-fluid -->

      </section>
      @section('scripts')
            <script>
                  (function($) {
                        $(document).ready(function() {
                              $("#comments_table").DataTable({
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    "paging": true,
                                    "info": true,
                                    'pageLength': 25,
                                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                              }).buttons().container().appendTo('#comments_wrapper .col-md-5:eq(0)');
                        });
                  })(jQuery)

                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>

            <!-- show the comment -->
            <script>
                  $(document).ready(function() {
                        // click view button

                        $(document).on('click', '.view-comment', function(e) {

                              e.preventDefault();
                              // url
                              const url = $(this).data('route');

                              // show the loader
                              $('#loaders').css('display', 'flex');

                              // csrf
                              const csrf_token = $("meta[name='csrf_token']").attr('content');

                              $.ajax({
                                    url: url,
                                    type: 'GET',
                                    success: function(data) {

                                          // hide the loader
                                          $('#loaders').css('display', 'none');

                                          $('#response').html(data);
                                    }
                              });
                        });
                  });
            </script>
            <!-- delete single element -->
            <x-alerts.delete permission="comments_delete" />

            <!-- delete selected element -->
            <x-alerts.delete-selected permission="comments_delete" route='admins.comments.destroy-selected' />
      @endsection
</x-admin.app>
