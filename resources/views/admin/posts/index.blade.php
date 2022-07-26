<x-admin.app title='Posts| View'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">Posts</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Posts</li>
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
                                    <x-cards.header id='post_wrapper'>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                      <h3 class="card-title mr-5">View all posts<span
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

                                                            {{-- category --}}
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
                                                            <a href="#"
                                                                  class="btn-sweet-select-delete btn btn-danger disabled {{ auth()->user()->hasPermission('categories-post_delete')? '': 'cursor-not disabled' }}">
                                                                  <i class="fas fa-trash-alt"></i></a>
                                                      </form>
                                                </div>
                                          </div>
                                    </x-cards.header><!-- header -->

                                    <x-cards.body class='p-2'>
                                          <table id="posts_table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead>
                                                      <tr>
                                                            <th><input class='select-all my-custom-control-input'
                                                                        type="checkbox" /></th>
                                                            <th>#</th>
                                                            <th>Poster</th>
                                                            <th>Title</th>
                                                            <th>Body</th>
                                                            <th>Author</th>
                                                            <th>Category</th>
                                                            <th>Activation</th>
                                                            <th>Created At</th>
                                                            <th>Actions</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach ($posts as $post)
                                                            <tr>
                                                                  <td><input class='checkbox my-custom-control-input'
                                                                              type="checkbox"
                                                                              data-id="{{ $post->id }}" />

                                                                  <td>{{ $loop->index + 1 }}</td>

                                                                  <td><img src="{{ $post->getPoster() }}" alt="post image" width="55"></td>

                                                                  <td>{{ Str::replace('-', ' ', Str::limit($post->title, 15)) }}
                                                                  </td>

                                                                  <td>{{ Str::limit($post->body, 20) }}
                                                                  </td>

                                                                  <td>{{ $post->author->username }}</td>
                                                                  <td>{{ $post->category->name }}</td>
                                                                  <td>
                                                                        @if ($post->activation)
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

                                                                  <td>{{ $post->created_at->format('M d/y') }}
                                                                  </td>

                                                                  <td>
                                                                        {{-- edit the post --}}
                                                                        <a href="{{ route('admins.posts.edit', $post) }}" class="btn btn-info"
                                                                              data-toggle="tooltip"
                                                                              data-placement="bottom"
                                                                              title="Edit Post"><i
                                                                                    class="fas fa-edit"></i></a>

                                                                        @if (!$post->activation)
                                                                              {{-- not active --}}
                                                                              {{-- activation the post --}}
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.posts.activation', $post) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="activation post"
                                                                                          data-activation='active'
                                                                                          class="btn btn-success btn-activation"><i
                                                                                                class="fas fa-check"></i></button>
                                                                              </form>
                                                                        @else
                                                                              {{-- activation the post --}}
                                                                              <form class='d-inline' method='post'
                                                                                    action='{{ route('admins.posts.activation', $post) }}'>
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <button type="submit"
                                                                                          data-toggle="tooltip"
                                                                                          data-placement="bottom"
                                                                                          title="make post inactive"
                                                                                          data-activation='not_active'
                                                                                          class="btn btn-danger btn-activation"><i
                                                                                                class="fas fa-ban"></i></button>
                                                                              </form>
                                                                        @endif

                                                                        {{-- delete post --}}
                                                                        <form class='d-inline' method='post'
                                                                              action=''>
                                                                              @csrf
                                                                              @method('DELETE')
                                                                              <button type="submit"
                                                                                    data-toggle="tooltip"
                                                                                    title="delete this post"
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
                                                            <th>Poster</th>
                                                            <th>Title</th>
                                                            <th>Body</th>
                                                            <th>Author</th>
                                                            <th>Category</th>
                                                            <th>Activation</th>
                                                            <th>Created At</th>
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
                        $("#posts_table").DataTable({
                              "responsive": true,
                              "lengthChange": true,
                              "autoWidth": false,
                              "paging": true,
                              "info": true,
                              'pageLength': 25,
                              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#post_wrapper .col-md-5:eq(0)');
                  });


                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
            <!-- delete single element -->
            {{-- <x-alerts.delete permission="categories-post_delete" /> --}}
            <!-- make post active or not -->
            <x-alerts.activation permission='posts_update' />
            <!-- delete selected element -->
            {{-- <x-alerts.delete-selected permission="categories-post_delete" route='admins.posts-categories.destroy-selected' /> --}}
      @endsection
</x-admin.app>
