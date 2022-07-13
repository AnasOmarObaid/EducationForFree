<x-admin.app title='Settings | View'>

      <!-- Content Header (Page header) -->
      <div class="content-header">
            <div class="container-fluid">
                  <div class="row mb-2">
                        <div class="col-sm-6">
                              <h1 class="m-0">System Settings</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admins.welcome') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                              </ol>
                        </div><!-- /.col -->
                  </div><!-- /.row -->
            </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
            <div class="container-fluid">
                  <form action="{{ route('admins.settings.store') }}" method='POST'>
                        @csrf
                        <div class="row">

                              <div class="col-12 col-md-7">
                                    <!-- system information -->
                                    <x-cards.card class="card-outline card-info">
                                          <x-cards.header>
                                                <h3 class="card-title">System information</h3>
                                          </x-cards.header> <!-- /card header -->
                                          <x-cards.body>

                                                {{-- -system name --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System name
                                                      </x-forms.label>
                                                      <x-forms.input type='text' name="system_name"
                                                            value="{{ setting('system_name') }}"
                                                            placeholder="Enter system name" />
                                                </x-forms.form-group>

                                                {{-- -system address --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System address
                                                      </x-forms.label>
                                                      <x-forms.input type='text' name="system_url"
                                                            value="{{ setting('system_url') }}"
                                                            placeholder="Enter system url" />
                                                </x-forms.form-group>

                                                {{-- -system phone --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>Contact phone
                                                      </x-forms.label>
                                                      <x-forms.input type='text' name="system_phone"
                                                            value="{{ setting('system_phone') }}"
                                                            placeholder="Enter system phone" />
                                                </x-forms.form-group>

                                                {{-- -system version --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System version
                                                      </x-forms.label>
                                                      <x-forms.input type='text' name="system_version"
                                                            value="{{ setting('system_version') }}"
                                                            placeholder="Enter system version" />
                                                </x-forms.form-group>

                                                {{-- -system content --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System content
                                                      </x-forms.label>
                                                      <x-forms.text-area name="system_content" rows='4'
                                                            placeholder='Enter system content'>
                                                            {{ setting('system_content') }}</x-forms.textarea>
                                                </x-forms.form-group>

                                          </x-cards.body><!-- card body -->
                                    </x-cards.card><!-- /card -->

                                    <!-- social login -->
                                    <x-cards.card class="card-outline card-info">
                                          <x-cards.header>
                                                <h3 class="card-title">Social media login</h3>
                                          </x-cards.header> <!-- /card header -->
                                          <x-cards.body>
                                                <?php $logins = ['facebook', 'google']; ?>
                                                @foreach ($logins as $login)
                                                      <x-forms.form-group>
                                                            <x-forms.label>{{ ucfirst($login) }} client id
                                                            </x-forms.label>
                                                            <x-forms.input type='text'
                                                                  name="{{ $login }}_client_id"
                                                                  value="{{ setting($login . '_client_id') }}"
                                                                  placeholder="Enter {{ $login }} client id" />
                                                      </x-forms.form-group>

                                                      <x-forms.form-group>
                                                            <x-forms.label>{{ ucfirst($login) }} client secret
                                                            </x-forms.label>
                                                            <x-forms.input type='text'
                                                                  name="{{ $login }}_client_secret"
                                                                  value="{{ setting($login . '_client_secret') }}"
                                                                  placeholder="Enter {{ $login }} client secret" />
                                                      </x-forms.form-group>


                                                      <x-forms.form-group>
                                                            <x-forms.label>{{ ucfirst($login) }} redirect url
                                                            </x-forms.label>
                                                            <x-forms.input type='text'
                                                                  name="{{ $login }}_redirect_url"
                                                                  value="{{ setting($login . '_redirect_url') }}"
                                                                  placeholder="Enter {{ $login }} redirect url" />
                                                      </x-forms.form-group>
                                                @endforeach

                                          </x-cards.body><!-- card body -->
                                    </x-cards.card><!-- /card -->
                              </div>

                              <div class="col-12 col-md-5">
                                    {{-- system controller --}}
                                    <x-cards.card class="card-outline card-info">
                                          <x-cards.header>
                                                <h3 class="card-title">System controller</h3>
                                          </x-cards.header> <!-- /card header -->
                                          <x-cards.body>
                                                {{-- manage activation of the system --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System activation</x-forms.label>
                                                      <select class="form-control select2" name='system_activation'
                                                            style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_activation') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_activation') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage activation of create post in system --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>Create posts</x-forms.label>
                                                      <select class="form-control select2" name="system_post_create"
                                                            style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_post_create') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_post_create') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage activation of create comment on post in system --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>Create comment on posts</x-forms.label>
                                                      <select class="form-control select2"
                                                            name='system_comment_post_create' style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_comment_post_create') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_comment_post_create') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage activation of create series --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>Create series</x-forms.label>
                                                      <select class="form-control select2" name='system_series_create'
                                                            style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_series_create') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_series_create') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage activation of create comment on series in system --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>Create comment on series</x-forms.label>
                                                      <select class="form-control select2"
                                                            name='system_comment_series_create' style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_comment_series_create') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_comment_series_create') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage activation register --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>User Registration</x-forms.label>
                                                      <select class="form-control select2" name='system_user_register'
                                                            style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_user_register') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_user_register') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>

                                                {{-- manage system notification --}}
                                                <x-forms.form-group>
                                                      <x-forms.label>System notification</x-forms.label>
                                                      <select class="form-control select2" name='system_notification'
                                                            style="width: 100%;">
                                                            <option value="1"
                                                                  {{ setting('system_notification') == 1 ? 'selected' : '' }}>
                                                                  Active
                                                            </option>
                                                            <option value="0"
                                                                  {{ setting('system_notification') == 0 ? 'selected' : '' }}>
                                                                  Not active
                                                            </option>
                                                      </select>
                                                </x-forms.form-group>
                                          </x-cards.body><!-- card body -->
                                    </x-cards.card><!-- /card -->

                                    {{-- Social media links --}}
                                    <x-cards.card class="card-outline card-info">
                                          <x-cards.header>
                                                <h3 class="card-title">Social media links</h3>
                                          </x-cards.header> <!-- /card header -->
                                          <x-cards.body>
                                                <?php $links = ['facebook', 'twitter', 'linkedin', 'email']; ?>
                                                @foreach ($links as $link)
                                                      <x-forms.form-group>
                                                            <x-forms.label>{{ ucfirst($link) }} link
                                                            </x-forms.label>
                                                            <x-forms.input type='text' name="{{ $link }}_link"
                                                                  value="{{ setting($link . '_link') }}"
                                                                  placeholder="Enter {{ $link }} link" />
                                                      </x-forms.form-group>
                                                @endforeach
                                                <x-forms.form-group>
                                                      <x-forms.label>Email password
                                                      </x-forms.label>
                                                      <x-forms.input type='password' name="email_password"
                                                            value="{{ setting('email_password') }}"
                                                            placeholder="Enter email password" />
                                                </x-forms.form-group>
                                          </x-cards.body><!-- card body -->
                                          <x-cards.footer class="text-right">
                                                <button type="submit" class="btn btn-primary"> <i
                                                            class="fa-fw fas fa-check"></i> Save Settings</button>
                                                </button>
                                          </x-cards.footer>
                                    </x-cards.card><!-- /card -->
                              </div>

                        </div><!-- /row -->
                  </form>
            </div><!-- container-fluid -->
      </section>
      @section('scripts')
            <!-- select2 -->
            <script>
                  $(document).ready(function() {
                        $('.select2').select2();
                  });
            </script>
      @endsection
</x-admin.app>
