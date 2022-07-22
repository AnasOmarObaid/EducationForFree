<x-admin.app title='Users | Admins | View'>
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
                              <h1 class="m-0">System Admins</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
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
                                    <x-cards.header id='admin_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all admins<span
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

                                                            <select name='roles[]' class="form-control select2"
                                                                  multiple>
                                                                  @foreach ($roles as $role)
                                                                        <option value="{{ $role->name }}"
                                                                              {{ is_array(request('roles')) && in_array($role->name, request('roles')) ? 'selected' : '' }}>
                                                                              {{ $role->name }}
                                                                        </option>
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
                                          <table id="admin_table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead>
                                                      <tr>
                                                            <th><input class='select-all my-custom-control-input'
                                                                        type="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Profile</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Username</th>
                                                            <th>Address</th>
                                                            <th>Status</th>
                                                            <th>Joineded</th>
                                                            <th>Actions</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($admins as $admin)
                                                            <tr>
                                                                  <td><input class='checkbox my-custom-control-input'
                                                                              type="checkbox"
                                                                              data-id="{{ $admin->id }}" />
                                                                  <td>{{ $loop->index + 1 }}</td>
                                                                  <td class="">
                                                                        <img class="height-2 width-2 rounded-circle object-fit"
                                                                              src="{{ $admin->profile_photo_url }}"
                                                                              alt="{{ $admin->name }}" />
                                                                  </td>
                                                                  <td>{{ Str::limit($admin->name, 7) }}</td>
                                                                  <td>{{ $admin->email }}</td>
                                                                  <td>{{ $admin->username }}</td>
                                                                  <td>{{ Str::limit($admin->address, 7) }}</td>
                                                                  <td>
                                                                        @if ($admin->activation)
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
                                                                        | @foreach ($admin->roles as $role)
                                                                              <span class='badge badge-pill badge-info'>
                                                                                    {{ $role->name }}
                                                                              </span>
                                                                        @endforeach

                                                                  </td>
                                                                  <td>{{ $admin->created_at->format('M d/y ') }}
                                                                  </td>
                                                                  <td>
                                                                        <a href="{{ route('admins.users.admins.edit', $admin->username) }}"
                                                                              class="btn btn-info" data-toggle="tooltip"
                                                                              data-placement="bottom"
                                                                              title="Edit Admin"><i
                                                                                    class="fas fa-user-edit"></i></a>
                                                                        @if (!$admin->activation)
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.users.admins.activation', $admin) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="activation admin"
                                                                                          data-activation='active'
                                                                                          class="btn btn-success btn-activation"><i
                                                                                                class="fas fa-check"></i></button>
                                                                              </form>
                                                                        @else
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.users.admins.activation', $admin) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="make admin inactive"
                                                                                          data-activation='not_active'
                                                                                          class="btn btn-danger btn-activation"><i
                                                                                                class="fas fa-ban"></i></button>
                                                                              </form>
                                                                        @endif

                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.users.admins.destroy', $admin) }}'>
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    title="delete this admin"
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
                                                            <th>Username</th>
                                                            <th>Address</th>
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
                        $("#admin_table").DataTable({
                              "responsive": true,
                              "lengthChange": true,
                              "autoWidth": false,
                              "paging": true,
                              "info": true,
                              'pageLength': 25,
                              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#admin_wrapper .col-md-5:eq(0)');
                  });


                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>

            <!-- delete single element -->
            <x-alerts.delete permission="users_delete" />
            <!-- delete selected element -->
            <x-alerts.delete-selected permission="users_delete" route='admins.users.admins.destroy-selected' />
            <!-- make admin active or not -->
            <x-alerts.activation permission='users_update' />
      @endsection
</x-admin.app>
