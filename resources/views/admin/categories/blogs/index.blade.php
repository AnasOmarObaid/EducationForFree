<x-admin.app title='Categories | Blogs'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Categories Blogs</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Categories Blogs</li>
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
                              <div class="card">
                                    <div class="card-header">
                                          <h3 class="card-title mr-5">View all categories for blogs</h3>
                                          {{-- make search form --}}
                                          <div class="d-flex">
                                                <div class="col-6">
                                                      <form action="" class='d-flex'>
                                                            <input type="search" class='form-control' name="" id=""
                                                                  placeholder="search">
                                                            <button type="submit"
                                                                  class='ml-3 btn btn-info d-flex align-items-center'><i
                                                                        class="fas fa-search"></i>
                                                                  Search</button>
                                                      </form>
                                                </div>

                                                <button type="button" class='ml-2 btn btn-success'><a
                                                            class="text-white"
                                                            href="{{ route('admins.categories.blogs.create') }}"><i
                                                                  class="fas fa-plus"></i> Create</a></button>
                                          </div>
                                    </div>
                                    <div class="card-body p-0">
                                          {{-- check categories --}}
                                          @if ($categories->count() == 0)
                                                <x-admin.errors.no_data route="admins.categories.blogs.create" />
                                          @else
                                                <table class="table table-hover table-striped">
                                                      <thead>
                                                            <tr>
                                                                  <th style="width: 10px">#</th>
                                                                  <th>Name</th>
                                                                  <th>Created At</th>
                                                                  <th>Updated At</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            @foreach ($categories as $category)
                                                                  <tr>
                                                                        <td>{{ $loop->index + 1 }}</td>
                                                                        <td>{{ $category->name }}</td>
                                                                        <td>{{ $category->created_at }}</td>
                                                                        <td>{{ $category->updated_at }}</td>
                                                                  </tr>
                                                            @endforeach

                                                      </tbody>
                                                </table>
                                          @endif
                                    </div>
                              </div>
                              <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                          <li class="page-item"><a class="page-link" href="#">Previous</a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                              </nav>
                        </div>
                  </div>
            </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

</x-admin.app>
