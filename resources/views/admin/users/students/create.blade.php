<x-admin.app title='Users | Students | Create'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Create Students</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a
                                                href="{{ route('admins.users.students.index') }}">Students</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Students</li>
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
                              @includeIf('admin.users.students._create-form')
                        </div><!-- col-12 -->
                  </div>
            </div><!-- /.container-fluid -->
      </section><!-- content -->
      @section('scripts')
            <script>
                  var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                              URL.revokeObjectURL(output.src) // free memory
                        }
                  };

                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
      @endsection
</x-admin.app>
