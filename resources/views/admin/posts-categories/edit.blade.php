<x-admin.app title='Post Category | Edit'>

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <div class="container-fluid">
                <div class="row mb-2">
                      <div class="col-sm-6">
                            <h1 class="m-0">Edit Post Categories</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                  <li class="breadcrumb-item"><a
                                              href="{{ route('admins.posts-categories.index') }}">Post Categories</a>
                                  </li>
                                  <li class="breadcrumb-item active">Edit Post Categories</li>
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
                            <!-- include create role form -->
                            @includeIf('admin.posts-categories._edit-form')
                      </div><!-- col-12 -->
                </div>
          </div><!-- /.container-fluid -->
    </section><!-- content -->


</x-admin.app>
