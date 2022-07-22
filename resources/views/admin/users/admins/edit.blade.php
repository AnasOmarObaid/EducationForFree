<x-admin.app title='Users | Admins | Edit'>

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <div class="container-fluid">
                <div class="row mb-2">
                      <div class="col-sm-6">
                            <h1 class="m-0">Edit Admins</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                  <li class="breadcrumb-item"><a
                                              href="{{ route('admins.users.admins.index') }}">Admins</a>
                                  </li>
                                  <li class="breadcrumb-item active">Edit Admins</li>
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
                            <!-- include edit role form -->
                            @includeIf('admin.users.admins._edit-form')
                      </div><!-- col-12 -->
                </div>
          </div><!-- /.container-fluid -->
    </section><!-- content -->


</x-admin.app>
