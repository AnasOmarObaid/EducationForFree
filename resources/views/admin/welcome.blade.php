<x-admin.app title='Dashboard'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                              </ol>
                        </div><!-- /.col -->
                  </div><!-- /.row -->
            </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <!-- Main content -->
                  <section class="content">
                        <div class="container-fluid">
                              <!-- Small boxes (Stat box) -->
                              <div class="row">
                                    <div class="col-lg-3 col-6">
                                          <!-- users box -->
                                          <div class="small-box bg-info">
                                                <div class="inner">
                                                      <h3>{{ $users->count() }}</h3>

                                                      <p>New Users</p>
                                                </div>
                                                <div class="icon">
                                                      <i class="ion ion-bag"></i>
                                                </div>
                                                <a href="{{ route('admins.users.students.index') }}"
                                                      class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                          </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                          <!-- posts box -->
                                          <div class="small-box bg-success">
                                                <div class="inner">
                                                      <h3>{{ $posts->count() }}</h3>

                                                      <p>New Posts</p>
                                                </div>
                                                <div class="icon">
                                                      <i class="ion ion-stats-bars"></i>
                                                </div>
                                                <a href="{{ route('admins.posts.index') }}"
                                                      class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                          </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                          <!-- small box -->
                                          <div class="small-box bg-warning">
                                                <div class="inner">
                                                      <h3>{{ $series->count() }}</h3>

                                                      <p>New Series</p>
                                                </div>
                                                <div class="icon">
                                                      <i class="ion ion-person-add"></i>
                                                </div>
                                                <a href="{{ route('admins.series.index') }}"
                                                      class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                          </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                          <!-- small box -->
                                          <div class="small-box bg-danger">
                                                <div class="inner">
                                                      <h3>{{ $episodes->count() }}</h3>

                                                      <p>New Episode</p>
                                                </div>
                                                <div class="icon">
                                                      <i class="ion ion-pie-graph"></i>
                                                </div>
                                                <a href="{{ route('admins.educ-bits.index') }}"
                                                      class="small-box-footer">More info <i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                          </div>
                                    </div>
                                    <!-- ./col -->
                              </div>
                              <!-- /.row -->
                              <!-- Main row -->
                              <div class="row">

                                    <section class="col-lg-12 connectedSortable">

                                          <!-- TABLE: LATEST Users -->
                                          <div class="card mt-4">
                                                <div class="card-header border-transparent">
                                                      <h3 class="card-title">Latest Users</h3>

                                                      <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                  data-card-widget="collapse">
                                                                  <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool"
                                                                  data-card-widget="remove">
                                                                  <i class="fas fa-times"></i>
                                                            </button>
                                                      </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                      <div class="table-responsive">
                                                            <table class="table m-0">
                                                                  <thead>
                                                                        <tr>
                                                                              <th>User ID</th>
                                                                              <th>Poster</th>
                                                                              <th>Username</th>
                                                                              <th>Email</th>
                                                                              <th>Status</th>
                                                                              <th>Created at</th>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                        @foreach ($students as $student)
                                                                              <tr>

                                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                                    <td class="">
                                                                                          <img class="height-2 width-2 rounded-circle object-fit"
                                                                                                src="{{ $student->profile_photo_url }}"
                                                                                                alt="{{ $student->name }}" />
                                                                                    </td>

                                                                                    <td>{{ $student->username }}</td>
                                                                                    <td>{{ $student->email }}</td>

                                                                                    <td>
                                                                                          @if ($student->activation)
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
                                                                                          | @foreach ($student->permissions as $permission)
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

                                                                              </td>
                                                                              <td>{{ $student->created_at->format('M d/y ') }}
                                                                              </td>

                                                                        </tr>
                                                                  @endforeach

                                                            </tbody>
                                                      </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                          </div>
                                          <!-- /.card-body -->
                                          <div class="card-footer clearfix">
                                                <a href="{{ route('admins.users.students.create') }}"
                                                      class="btn btn-sm btn-info float-left">Place New User</a>
                                                <a href="{{ route('admins.users.students.index') }}"
                                                      class="btn btn-sm btn-secondary float-right">View All
                                                      Users</a>
                                          </div>
                                          <!-- /.card-footer -->
                                    </div>
                              </section>
                              <!-- right col -->
                        </div>
                        <!-- /.row (main row) -->
                  </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</x-admin.app>
