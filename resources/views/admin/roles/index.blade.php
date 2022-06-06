<x-admin.app title='Roles | View'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">System Roles</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Roles</li>
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
                                    <x-cards.header>
                                          <h3 class="card-title mr-5">View all roles for users</h3>
                                          {{-- make search form --}}
                                          <div class="d-flex">
                                                <div class="col-6">
                                                      <x-forms.form action="" class='d-flex'>

                                                            <x-forms.input type='search' name='search'
                                                                  value="{{ request('search') }}" placeholder="Search"
                                                                  required />

                                                            <x-forms.submit
                                                                  class=" ml-3 btn-info d-flex align-items-center"> <i
                                                                        class="fa-fw fas fa-search"></i> Search
                                                            </x-forms.submit>
                                                      </x-forms.form><!-- form -->
                                                </div>

                                                <!--col-6 -->
                                                <a class="ml-2 btn btn-success text-white  {{ auth()->user()->hasPermission('roles_create')? '': 'disabled cursor-not' }}"
                                                      href="{{ route('admins.roles.create') }}">
                                                      <i class="fa-fw fas fa-plus"></i>
                                                      Create
                                                </a>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-0'>
                                          {{-- check roles --}}
                                          @if ($roles->count() == 0)
                                                <x-admin.errors.no_data route="admins.roles.create" />
                                          @else
                                                <table class="table table-hover table-striped">
                                                      <thead>
                                                            <tr>
                                                                  <th style="width: 10px">#</th>
                                                                  <th>Name</th>
                                                                  <th>Description</th>
                                                                  <th>Permissions</th>
                                                                  <th>Users Count</th>
                                                                  <th>Created At</th>
                                                                  <th>Updated At</th>
                                                                  <th>Actions</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            @foreach ($roles as $role)
                                                                  <tr>
                                                                        <td>{{ $loop->index + 1 }}</td>
                                                                        <td>{{ str_replace('_', ' ', $role->name) }}
                                                                        </td>
                                                                        <td>{{ Str::limit($role->description, 30) }}
                                                                        </td>
                                                                        <td>
                                                                              @foreach ($role->permissions as $permission)
                                                                                    @if ($loop->index < 4)
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
                                                                  <td><span
                                                                              class="badge badge-pill badge-success">{{ $role->users_count }}</span>
                                                                  </td>
                                                                  <td>{{ $role->created_at->format('M d/y ') }}
                                                                  </td>
                                                                  <td>{{ $role->updated_at->format('M d/y ') }}
                                                                  </td>
                                                                  <td>
                                                                        <a href="#" class="btn btn-primary"><i
                                                                                    class="fas fa-edit"></i>Edit</a>

                                                                        <form class='d-inline' method='post'
                                                                              action='{{ route('admins.roles.destroy', $role) }}'>
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit"
                                                                                    class="btn btn-danger btn-sweet-delete"><i
                                                                                          class="fas fa-trash-alt"></i>Delete</button>
                                                                        </form>
                                                                  </td>
                                                            </tr>
                                                      @endforeach

                                                </tbody>
                                          </table>
                                    @endif
                              </x-cards.body><!-- body -->

                        </x-cards.card><!-- card -->
                        <div class="float-right">
                              {{ $roles->appends(['search' => request('search')])->links() }}
                        </div>
                  </div><!-- col-12 --->
            </div>
            <!--row -->
      </div><!-- container-fluid -->

</section>
<!--section -->
<!-- /.content -->
@section('scripts')
      <x-alerts.delete permission="roles_delete" />
@endsection
</x-admin.app>
