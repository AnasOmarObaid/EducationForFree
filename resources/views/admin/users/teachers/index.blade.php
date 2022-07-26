<x-admin.app title='Users | Tecahers | View'>
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
                              <h1 class="m-0">System Tecahers</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Teacher</li>
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
                                    <x-cards.header id='teacher_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all teachers<span
                                                                  class="badge badge-pill badge-success"></span>
                                                      </h3>
                                                </div>
                                                <div class="col-md-5 mt-3 mb-0"></div>
                                                <div class="col-md-7 mt-3">
                                                      <form action="" class="d-flex" style="align-items: center;">

                                                            <select name="activation" class="form-control select2 ml-3">
                                                                  <option selected value="">all status
                                                                  </option>
                                                                  <option value="1"
                                                                        {{ request('activation') == 1 ? 'selected' : '' }}>
                                                                        active</option>
                                                                  <option value="false"
                                                                        {{ request('activation') == 'false' ? 'selected' : '' }}>
                                                                        not active</option>
                                                            </select>

                                                            <div class="ml-2"></div>
                                                            <select name='permissions[]' class="form-control select2"
                                                                  multiple>
                                                                  </option>
                                                                  <?php $models = ['comments', 'categories-post', 'posts', 'profiles'];
                                                                  $permissions = ['create', 'read', 'update', 'delete']; ?>
                                                                  @foreach ($models as $model)
                                                                        @foreach ($permissions as $permission)
                                                                              @if ($loop->parent->last)
                                                                                    @if ($loop->first or $loop->index == 1)
                                                                                          @continue
                                                                                    @endif
                                                                              @endif
                                                                              <option
                                                                                    value="{{ $model . '_' . $permission }}"
                                                                                    {{ is_array(request('permissions')) && in_array($model . '_' . $permission, request('permissions')) ? 'selected' : '' }}>
                                                                                    {{ $model . '_' . $permission }}
                                                                              </option>
                                                                        @endforeach
                                                                  @endforeach
                                                            </select>
                                                            <div class="ml-2"></div>
                                                            <button type="submit" class='btn btn-info'>
                                                                  filter</button>
                                                            <div class="ml-2"></div>
                                                            <a href="#"
                                                                  class="btn-sweet-select-delete btn btn-danger disabled  {{ auth()->user()->hasPermission('users_delete')? '': 'cursor-not disabled' }}">
                                                                  <i class="fas fa-trash-alt"></i></a>
                                                      </form>
                                                </div>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-2'>
                                          <table id="tecaher_table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead>
                                                      <tr>
                                                            <th><input class='select-all my-custom-control-input'
                                                                        type="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Profile</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>username</th>
                                                            <th>Posts</th>
                                                            <th>Status</th>
                                                            <th>Joineded</th>
                                                            <th>Actions</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($teachers as $teacher)
                                                            <tr>
                                                                  <td><input class='checkbox my-custom-control-input'
                                                                              type="checkbox"
                                                                              data-id="{{ $teacher->id }}" />
                                                                  <td>{{ $loop->index + 1 }}</td>
                                                                  <td class="">
                                                                        <img class="height-2 width-2 rounded-circle object-fit"
                                                                              src="{{ $teacher->profile_photo_url }}"
                                                                              alt="{{ $teacher->name }}" />
                                                                  </td>
                                                                  <td>{{ Str::limit($teacher->name, 7) }}</td>
                                                                  <td>{{ $teacher->email }}</td>
                                                                  <td>{{ $teacher->username }}</td>

                                                                  <td>
                                                                        <span class='badge badge-pill badge-primary'>
                                                                              <a class='text-white'
                                                                                    href="{{ route('admins.posts.index', ['usernames[]' => $teacher->username]) }}"
                                                                                    target="_blank">
                                                                                    {{ $teacher->posts_count }}</a>
                                                                        </span>
                                                                  </td>

                                                                  <td>
                                                                        @if ($teacher->activation)
                                                                              <span data-activation='badge-active'
                                                                                    class='badge badge-pill badge-success badge-active'>
                                                                                    active
                                                                              </span>
                                                                        @else
                                                                              <span data-activation='badge-not_active'
                                                                                    class='badge badge-pill badge-danger badge-not_active'>
                                                                                    not active
                                                                              </span>
                                                                        @endif
                                                                        | @foreach ($teacher->permissions as $permission)
                                                                              @if ($loop->index < 1)
                                                                                    <span
                                                                                          class='badge badge-pill badge-info'>
                                                                                          {{ $permission->name }}
                                                                                    </span>
                                                                              @else
                                                                                    ...
                                                                              @break
                                                                        @endif
                                                                  @endforeach
                                                                  |
                                                                  <span class='badge badge-pill badge-primary'>
                                                                        teacher
                                                                  </span>

                                                            </td>
                                                            <td>{{ $teacher->created_at->format('M d/y ') }}
                                                            </td>
                                                            <td>
                                                                  <a href="{{ route('admins.users.teachers.edit', $teacher->username) }}"
                                                                        class="btn btn-info" data-toggle="tooltip"
                                                                        data-placement="bottom"
                                                                        title="Edit Teacher"><i
                                                                              class="fas fa-user-edit"></i></a>
                                                                  @if (!$teacher->activation)
                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.users.teachers.activation', $teacher) }}'>
                                                                              @csrf
                                                                              @method('POST')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="bottom"
                                                                                    title="activation teacher"
                                                                                    data-activation='active'
                                                                                    class="btn btn-success btn-activation"><i
                                                                                          class="fas fa-check"></i></button>
                                                                        </form>
                                                                  @else
                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.users.teachers.activation', $teacher) }}'>
                                                                              @csrf
                                                                              @method('POST')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="bottom"
                                                                                    title="make tecaher inactive"
                                                                                    data-activation='not_active'
                                                                                    class="btn btn-danger btn-activation"><i
                                                                                          class="fas fa-ban"></i></button>
                                                                        </form>
                                                                  @endif

                                                                  <form action="{{ route('admins.users.teachers.rejectRequest', $teacher) }}"
                                                                        method="post" class='d-inline'>
                                                                        <button type="submit" name="reject"
                                                                              value="1"
                                                                              data-toggle="tooltip"
                                                                              data-placement="bottom"
                                                                              title=""
                                                                              class="btn btn-danger btn-accept-control"
                                                                              data-original-title="reject a teacher"><i
                                                                                    class="fas fa-user-times"></i></button>
                                                                  </form>

                                                                  <form class='d-inline' method='post'
                                                                        action='{{ route('admins.users.teachers.destroy', $teacher) }}'>
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                              data-toggle="tooltip"
                                                                              title="delete this tecaher"
                                                                              class="btn btn-danger btn-sweet-delete"><i
                                                                                    class="fas fa-trash-alt"></i></button>
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
                                                      <th>Profile</th>
                                                      <th>Name</th>
                                                      <th>Email</th>
                                                      <th>username</th>
                                                      <th>Posts</th>
                                                      <th>Status</th>
                                                      <th>Joineded</th>
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
</section>
@section('scripts')
      <script>
            $(function() {
                  $("#tecaher_table").DataTable({
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                        "paging": true,
                        "info": true,
                        'pageLength': 25,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                  }).buttons().container().appendTo('#teacher_wrapper .col-md-5:eq(0)');
            });


            $(document).ready(function() {
                  $('.select2').select2();
            });
      </script>

      <!-- delete single element -->
      <x-alerts.delete permission="users_delete" />
      <!-- delete selected element -->
      <x-alerts.delete-selected permission="users_delete" route='admins.users.teachers.destroy-selected' />
      <!-- make teacher active or not -->
      <x-alerts.activation permission='users_update' />
      <!-- accept to control request for student -->
      <x-alerts.accept-control permission='users_update' remove='true' />
@endsection
</x-admin.app>
