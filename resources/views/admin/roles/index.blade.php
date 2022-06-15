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
                                          <h3 class="card-title mr-5">View all roles for users <span
                                                      class="badge badge-pill badge-success">{{ $roles->count() }}</span>
                                          </h3>
                                          {{-- make search form --}}
                                          <div class="d-flex justify-content-end">
                                                <div class="col-8">
                                                      <x-forms.form action="" class='d-flex'>

                                                            <x-forms.input type='search' name='search'
                                                                  value="{{ request('search') }}" placeholder="Search"
                                                                  required />

                                                            <x-forms.submit
                                                                  class="ml-2 btn-info d-flex align-items-center"> <i
                                                                        class="fa-fw fas fa-search"></i> Search
                                                            </x-forms.submit>
                                                      </x-forms.form><!-- form -->
                                                </div>

                                                <!--col-6 -->
                                                <a class="btn btn-success text-white  {{ auth()->user()->hasPermission('roles_create')? '': 'cursor-not disabled' }}"
                                                      href="{{ route('admins.roles.create') }}">
                                                      <i class="fa-fw fas fa-plus"></i>
                                                      Create
                                                </a>

                                                <a class="btn-sweet-select-delete ml-5 btn btn-danger text-white disabled  {{ auth()->user()->hasPermission('roles_delete')? '': 'cursor-not disabled' }}"
                                                      href="">
                                                      <i class="fa-fw fas fa-trash-alt"></i>
                                                      Delete Selected
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
                                                                  <th><input class='select-all my-custom-control-input'
                                                                              type="checkbox" /></th>
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
                                                                        <td><input class='checkbox my-custom-control-input'
                                                                                    type="checkbox"
                                                                                    data-id="{{ $role->id }}" />
                                                                        </td>
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
                                                                        <a href="{{ route('admins.roles.edit', $role) }}" class="btn btn-primary"><i
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
                        <div class="float-left">
                              <span>showing {{ $roles->count() }} from {{ $roles->total() }}</span>
                        </div>
                        <div class="float-right">
                              {{ $roles->appends(['search' => request('search')])->links() }}
                        </div>
                  </div><!-- col-12 --->
            </div>
            <!--row -->
      </div><!-- container-fluid -->
</section>



@section('scripts')
      <!-- delete single element -->
      <x-alerts.delete permission="roles_delete" />
      <!-- delete selected element -->
      <x-alerts.delete-selected permission="roles_delete" />
@endsection
</x-admin.app>
