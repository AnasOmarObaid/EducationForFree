<x-admin.app title='EducBits| View'>
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
                              <h1 class="m-0">EdicBits</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">EducBits</li>
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
                                    <x-cards.header id='episode_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all EducBits<span
                                                                  class="badge badge-pill badge-success"></span>
                                                      </h3>
                                                </div>
                                                <div class="col-md-5 mt-3 mb-0"></div>
                                                <div class="col-md-7 mt-3">
                                                      <form action="" class="d-flex" style="align-items: center;">

                                                            {{-- active or not active --}}
                                                            <select name="activation" class="form-control select2 ml-3">
                                                                  <option selected value="">---
                                                                  </option>
                                                                  <option value="1"
                                                                        {{ request('activation') == 1 ? 'selected' : '' }}>
                                                                        active</option>
                                                                  <option value="false"
                                                                        {{ request('activation') == 'false' ? 'selected' : '' }}>
                                                                        not active</option>
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

                                                            <button type="submit" class='btn btn-info'>
                                                                  filter</button>

                                                            <div class="ml-2"></div>

                                                      </form>
                                                </div>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-2'>
                                          <table id="episode_table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>#</th>
                                                            <th>Poster</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>User</th>
                                                            <th>Category</th>
                                                            <th>Status</th>
                                                            <th>Created At</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($bits as $bit)
                                                            <tr>

                                                                  <td>{{ $loop->index + 1 }}</td>

                                                                  <td><img src="{{ $bit->episode->getPosterUrl() }}"
                                                                              alt="episode image" width="55"></td>

                                                                  <td>{{ Str::replace('-', ' ', Str::limit($bit->episode->title, 20)) }}
                                                                  </td>

                                                                  <td>{{ Str::limit($bit->episode->description, 30) }}
                                                                  </td>

                                                                  <td>{{ $bit->user->username }}</td>

                                                                  <td>{{ $bit->category->name }}</td>

                                                                  <td>
                                                                        @if ($bit->activation)
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
                                                                  </td>

                                                                  <td>{{ $category->created_at->format('M d/y') }}
                                                                  </td>

                                                            </tr>
                                                      @endforeach
                                                </tbody>
                                                <tfoot>
                                                      <tr>
                                                            <th>#</th>
                                                            <th>Poster</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>User</th>
                                                            <th>Category</th>
                                                            <th>Status</th>
                                                            <th>Created At</th>
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
                        $("#episode_table").DataTable({
                              "responsive": true,
                              "lengthChange": true,
                              "autoWidth": false,
                              "paging": true,
                              "info": true,
                              'pageLength': 25,
                              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#episode_wrapper .col-md-5:eq(0)');
                  });


                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
            <!-- delete single element -->
            {{-- <x-alerts.delete permission="playlist-categories_delete" /> --}}
            <!-- make post active or not -->
            {{-- <x-alerts.activation permission='playlist-categories_update' /> --}}
            <!-- delete selected element -->
            {{-- <x-alerts.delete-selected permission="categories-post_delete" route='admins.posts-categories.destroy-selected' /> --}}
      @endsection
</x-admin.app>
