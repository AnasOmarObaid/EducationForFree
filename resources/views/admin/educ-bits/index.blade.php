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

                                                            {{-- categories --}}
                                                            <select name="categories[]"
                                                                  class="form-control select2 ml-3" multiple>

                                                                  @foreach ($categories as $category)
                                                                        <option value="{{ $category->name }}"
                                                                              {{ is_array(request('categories')) && in_array($category->name, request('categories')) ? 'selected' : '' }}>
                                                                              {{ $category->name }}</option>
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
                                                            <th>Comments</th>
                                                            <th>Status</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($bits as $bit)
                                                            <tr>

                                                                  <td>{{ $loop->index + 1 }}</td>

                                                                  <td><img src="{{ $bit->getPosterUrl() }}"
                                                                              alt="episode image" width="55"></td>

                                                                  <td>{{ Str::replace('-', ' ', Str::limit($bit->episode->title, 20)) }}
                                                                  </td>

                                                                  <td>{{ Str::limit($bit->episode->description, 30) }}
                                                                  </td>

                                                                  <td>{{ $bit->user->username }}</td>

                                                                  <td>{{ $bit->category->name }}</td>

                                                                  <td>
                                                                    <span class='badge badge-pill badge-primary'>
                                                                          {{ $bit->episode->comments->count() }}
                                                                    </span>
                                                              </td>

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

                                                                  <td>{{ $bit->created_at->format('M d/y') }}
                                                                  </td>

                                                                  <td>

                                                                        {{-- edit --}}
                                                                        <a href="{{ route('admins.educ-bits.edit', $bit) }}"
                                                                              class="btn btn-info" data-toggle="tooltip"
                                                                              data-placement="bottom"
                                                                              title="Edit Educ bit"><i
                                                                                    class="fas fa-edit"></i></a>


                                                                        {{-- activation --}}
                                                                        @if (!$bit->activation)
                                                                              {{-- not active --}}
                                                                              {{-- activation the post --}}
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.educ-bits.activation', $bit) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="activation educ bit"
                                                                                          data-activation='active'
                                                                                          class="btn btn-success btn-activation"><i
                                                                                                class="fas fa-check"></i></button>
                                                                              </form>
                                                                        @else
                                                                              {{-- activation the post --}}
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.educ-bits.activation', $bit) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="make educ bit inactive"
                                                                                          data-activation='not_active'
                                                                                          class="btn btn-danger btn-activation"><i
                                                                                                class="fas fa-ban"></i></button>
                                                                              </form>
                                                                        @endif

                                                                        {{-- delete bits --}}
                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.educ-bits.destroy', $bit) }}'>
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    title="delete this educbit"
                                                                                    class="btn btn-danger btn-sweet-delete"><i
                                                                                          class="fas fa-trash-alt"></i></button>
                                                                        </form>
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
                                                            <th>Comments</th>
                                                            <th>Status</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
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
            <x-alerts.delete permission="playlist-categories_delete" />
            <!-- make post active or not -->
            <x-alerts.activation permission='educ-bits_update' />
            <!-- delete selected element -->
            {{-- <x-alerts.delete-selected permission="categories-post_delete" route='admins.posts-categories.destroy-selected' /> --}}
      @endsection
</x-admin.app>
