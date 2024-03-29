<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admins.welcome') }}" class="brand-link">
            <img src="{{ asset('admin_dashboard/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                  class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">EducationForFree</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                        <img src="{{ asset('admin_dashboard/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                              alt="User Image">
                  </div>
                  <div class="info">
                        <a href="{{ route('profile.show') }}" class="d-block">{{ auth()->user()->name }}</a>
                        <a class="d-block">roles:
                              {{ implode(',',auth()->user()->roles->pluck('name')->toArray()) }}</a>
                  </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                  <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                              aria-label="Search">
                        <div class="input-group-append">
                              <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                              </button>
                        </div>
                  </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- Dashboard --}}
                        <li class="nav-header">Dashboard</li>
                        <li class="nav-item">
                              <a href="{{ route('admins.welcome') }}"
                                    class="nav-link {{ request()->routeIs('admins.welcome') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                              </a>
                        </li>
                        {{-- // end Dashboard --}}

                        {{-- Roles --}}
                        <li class="nav-header">System Roles</li>
                        <li class="nav-item {{ request()->routeIs('admins.roles.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                          Roles
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.roles.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.roles.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Roles</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.roles.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.roles.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Roles</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- Users --}}
                        <li class="nav-header">System Users</li>

                        {{-- student --}}
                        <li class="nav-item {{ request()->routeIs('admins.users.students.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>
                                          Students
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.students.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.students.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Students</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.students.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.students.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Students</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- teachers --}}
                        <li class="nav-item {{ request()->routeIs('admins.users.teachers.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                          Teachers
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.teachers.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.teachers.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Teachers</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.teachers.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.teachers.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Teachers</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- admins --}}
                        <li class="nav-item {{ request()->routeIs('admins.users.admins.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield"></i>
                                    <p>
                                          Admins
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.admins.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.admins.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Admins</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.users.admins.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.users.admins.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Admins</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- Questions --}}
                        <li class="nav-header">Users Questions</li>
                        <li class="nav-item {{ request()->routeIs('admins.questions.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-question"></i>
                                    <p class="m-0">
                                          Questions
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.questions.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.questions.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Questions</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.questions.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.questions.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Question</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- post categories --}}
                        <li class="nav-header">Post Categories</li>
                        <li class="nav-item {{ request()->routeIs('admins.posts-categories.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fab fa-blogger-b"></i>
                                    <p>
                                          Post Categories
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.posts-categories.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.posts-categories.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Categories</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.posts-categories.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.posts-categories.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create Category</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- posts --}}
                        <li class="nav-item {{ request()->routeIs('admins.posts.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>
                                          Posts
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.posts.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.posts.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View posts</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.posts.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.posts.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Create post</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>


                        {{-- Comments --}}
                        <li class="nav-header">Users Comments</li>
                        <li class="nav-item {{ request()->routeIs('admins.comments.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-comments"></i>
                                    <p class="m-0">
                                          Comments
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.comments.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.comments.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Comments</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- playlist categories --}}
                        <li class="nav-header">Playlist Categories</li>
                        <li
                              class="nav-item {{ request()->routeIs('admins.playlist-categories.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p class="m-0">
                                          Playlist Categories
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.playlist-categories.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.playlist-categories.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Categories</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- educ bits --}}
                        <li class="nav-header">EducBits</li>
                        <li class="nav-item {{ request()->routeIs('admins.educ-bits.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-video"></i>
                                    <p class="m-0">
                                          EducBits
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.educ-bits.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.educ-bits.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View EducBits</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.educ-bits.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.educ-bits.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p class="text-whiet">Create EducBits</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>


                        {{-- educ bits --}}
                        <li class="nav-header">Topics</li>
                        <li class="nav-item {{ request()->routeIs('admins.topics.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-coins"></i>

                                    <p class="m-0">
                                          Topics
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.topics.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.topics.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Topics</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.topics.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.topics.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p class="text-whiet">Create Topic</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- series --}}
                        <li class="nav-header">Series</li>
                        <li class="nav-item {{ request()->routeIs('admins.series.*') ? 'menu-open' : '' }}">
                              <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-stream"></i>

                                    <p class="m-0">
                                          Series
                                          <i class="right fas fa-angle-left m-0"></i>
                                    </p>
                              </a>

                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="{{ route('admins.series.index') }}"
                                                class="nav-link {{ request()->routeIs('admins.series.index') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p class="text-whiet">View Series</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="{{ route('admins.series.create') }}"
                                                class="nav-link {{ request()->routeIs('admins.series.create') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p class="text-whiet">Create Series</p>
                                          </a>
                                    </li>
                              </ul>
                        </li>

                        {{-- Settings --}}
                        <li class="nav-header">Settings</li>
                        <li class="nav-item">
                              <a href="{{ route('admins.settings.index') }}"
                                    class="nav-link {{ request()->routeIs('admins.settings.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>Settings</p>
                              </a>
                        </li>

                        {{-- // end blog categories --}}
                        {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p>
                                        Dashboard
                                        <i class="right fas fa-angle-left"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="./index.html" class="nav-link active">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Dashboard v1</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="./index2.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Dashboard v2</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="./index3.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Dashboard v3</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                  </p>
                            </a>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-copy"></i>
                                  <p>
                                        Layout Options
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right">6</span>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/layout/top-nav.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Top Navigation</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/top-nav-sidebar.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Top Navigation + Sidebar</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/boxed.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Boxed</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Fixed Sidebar</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/fixed-sidebar-custom.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Fixed Sidebar <small>+ Custom Area</small></p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Fixed Navbar</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/fixed-footer.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Fixed Footer</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/layout/collapsed-sidebar.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Collapsed Sidebar</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-chart-pie"></i>
                                  <p>
                                        Charts
                                        <i class="right fas fa-angle-left"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/charts/chartjs.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>ChartJS</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/charts/flot.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Flot</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/charts/inline.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Inline</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/charts/uplot.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>uPlot</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-tree"></i>
                                  <p>
                                        UI Elements
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/UI/general.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>General</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/icons.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Icons</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/buttons.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Buttons</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/sliders.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Sliders</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/modals.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Modals & Alerts</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/navbar.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Navbar & Tabs</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/timeline.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Timeline</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/UI/ribbons.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Ribbons</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-edit"></i>
                                  <p>
                                        Forms
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/forms/general.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>General Elements</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/forms/advanced.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Advanced Elements</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/forms/editors.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Editors</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/forms/validation.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Validation</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                        Tables
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/tables/simple.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Simple Tables</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/tables/data.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>DataTables</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/tables/jsgrid.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>jsGrid</p>
                                        </a>
                                  </li>
                            </ul>
                      </li> --}}
                        {{-- <li class="nav-header">EXAMPLES</li> --}}
                        {{-- <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                  <i class="nav-icon far fa-calendar-alt"></i>
                                  <p>
                                        Calendar
                                        <span class="badge badge-info right">2</span>
                                  </p>
                            </a>
                      </li> --}}
                        {{-- <li class="nav-item">
                            <a href="pages/gallery.html" class="nav-link">
                                  <i class="nav-icon far fa-image"></i>
                                  <p>
                                        Gallery
                                  </p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="pages/kanban.html" class="nav-link">
                                  <i class="nav-icon fas fa-columns"></i>
                                  <p>
                                        Kanban Board
                                  </p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-envelope"></i>
                                  <p>
                                        Mailbox
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Inbox</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/mailbox/compose.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Compose</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Read</p>
                                        </a>
                                  </li>
                            </ul>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-book"></i>
                                  <p>
                                        Pages
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/examples/invoice.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Invoice</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/profile.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Profile</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/e-commerce.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>E-commerce</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/projects.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Projects</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/project-add.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Project Add</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/project-edit.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Project Edit</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/project-detail.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Project Detail</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/contacts.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Contacts</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/faq.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>FAQ</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/contact-us.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Contact us</p>
                                        </a>
                                  </li>
                            </ul>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-plus-square"></i>
                                  <p>
                                        Extras
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>
                                                    Login & Register v1
                                                    <i class="fas fa-angle-left right"></i>
                                              </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                              <li class="nav-item">
                                                    <a href="pages/examples/login.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Login v1</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/register.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Register v1</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/forgot-password.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Forgot Password v1</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/recover-password.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Recover Password v1</p>
                                                    </a>
                                              </li>
                                        </ul>
                                  </li>
                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>
                                                    Login & Register v2
                                                    <i class="fas fa-angle-left right"></i>
                                              </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                              <li class="nav-item">
                                                    <a href="pages/examples/login-v2.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Login v2</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/register-v2.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Register v2</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/forgot-password-v2.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Forgot Password v2</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="pages/examples/recover-password-v2.html"
                                                          class="nav-link">
                                                          <i class="far fa-circle nav-icon"></i>
                                                          <p>Recover Password v2</p>
                                                    </a>
                                              </li>
                                        </ul>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/lockscreen.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Lockscreen</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/legacy-user-menu.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Legacy User Menu</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/language-menu.html"
                                              class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Language Menu</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/404.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Error 404</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/500.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Error 500</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/pace.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Pace</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/examples/blank.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Blank Page</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="starter.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Starter Page</p>
                                        </a>
                                  </li>
                            </ul>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-search"></i>
                                  <p>
                                        Search
                                        <i class="fas fa-angle-left right"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="pages/search/simple.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Simple Search</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="pages/search/enhanced.html" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Enhanced</p>
                                        </a>
                                  </li>
                            </ul>
                      </li>
                      <li class="nav-header">MISCELLANEOUS</li>
                      <li class="nav-item">
                            <a href="iframe.html" class="nav-link">
                                  <i class="nav-icon fas fa-ellipsis-h"></i>
                                  <p>Tabbed IFrame Plugin</p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                                  <i class="nav-icon fas fa-file"></i>
                                  <p>Documentation</p>
                            </a>
                      </li>
                      <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Level 1</p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-circle"></i>
                                  <p>
                                        Level 1
                                        <i class="right fas fa-angle-left"></i>
                                  </p>
                            </a>
                            <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Level 2</p>
                                        </a>
                                  </li>
                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>
                                                    Level 2
                                                    <i class="right fas fa-angle-left"></i>
                                              </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                              <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                          <i class="far fa-dot-circle nav-icon"></i>
                                                          <p>Level 3</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                          <i class="far fa-dot-circle nav-icon"></i>
                                                          <p>Level 3</p>
                                                    </a>
                                              </li>
                                              <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                          <i class="far fa-dot-circle nav-icon"></i>
                                                          <p>Level 3</p>
                                                    </a>
                                              </li>
                                        </ul>
                                  </li>
                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Level 2</p>
                                        </a>
                                  </li>
                            </ul>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Level 1</p>
                            </a>
                      </li>
                      <li class="nav-header">LABELS</li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-circle text-danger"></i>
                                  <p class="text">Important</p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-circle text-warning"></i>
                                  <p>Warning</p>
                            </a>
                      </li>
                      <li class="nav-item">
                            <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-circle text-info"></i>
                                  <p>Informational</p>
                            </a>
                      </li> --}}
                  </ul>
            </nav>
            <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
</aside>
