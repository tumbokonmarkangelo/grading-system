<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ !empty($page_title) ? $page_title : 'DILIMAN COLLAGE GRADING SYSTEM' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
  <link rel="icon" type="image/png" href="{{ asset('img/dclogo.png') }}">

  <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body id="page-top" class="{{ !Auth::user() ? 'bg-gradient-primary' : 'loading' }}">

@if($user = Auth::user())
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('User', [$user->username]) }}">
                <div class="sidebar-brand-icon">
                    <img class="brand-logo" src="{{ asset('img/dclogo.png') }}" alt="Diliman College Logo">
                </div>
                <div class="sidebar-brand-text mx-3">Grading System</div>
            </a>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider my-0"> -->

            @if (!empty($user->type) && in_array($user->type, ['admin']))
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ActivitiesLogs') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Activity logs</span></a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            @if (!empty($user->type) && in_array($user->type, ['admin']))
            <!-- Nav Item - Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module:</h6>
                        <a class="collapse-item" href="{{ route('UsersManagement') }}">Manage</a>
                    </div>
                </div>
            </li>
            @endif

            @if (!empty($user->type) && in_array($user->type, ['admin']))
            <!-- Nav Item - Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects" aria-expanded="true" aria-controls="collapseSubjects">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Subjects</span>
                </a>
                <div id="collapseSubjects" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module:</h6>
                        <a class="collapse-item" href="{{ route('SubjectsManagement') }}">Manage</a>
                    </div>
                </div>
            </li>
            @endif

            @if (!empty($user->type) && in_array($user->type, ['admin', 'teacher']))
            <!-- Nav Item - Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClasses" aria-expanded="true" aria-controls="collapseClasses">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Classes</span>
                </a>
                <div id="collapseClasses" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module:</h6>
                        <a class="collapse-item" href="{{ route('ClassesManagement') }}">Manage</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Nav Item - Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrades" aria-expanded="true" aria-controls="collapseGrades">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Grades</span>
                </a>
                <div id="collapseGrades" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module:</h6>
                        @if (!empty($user->type) && in_array($user->type, ['admin', 'teacher']))
                        <a class="collapse-item" href="{{ route('GradesManagement') }}">Manage</a>
                        @endif
                        @if (!empty($user->type) && in_array($user->type, ['admin', 'teacher', 'assistant']))
                        <a class="collapse-item" href="{{ route('ViewClassRecords') }}">Class Record</a>
                        @endif
                        @if (!empty($user->type) && in_array($user->type, ['admin', 'student', 'assistant']))
                        <a class="collapse-item" href="{{ route('ViewGradeRecords') }}">All Records</a>
                        @endif
                        <a class="collapse-item" href="{{ route('ViewGrade') }}">View</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            @if (!empty($user->type) && in_array($user->type, ['admin']))
            <div class="sidebar-heading">
                Database
            </div>

            <li class="nav-item">
                <form action="{{ url('/adminer/?dump=') }}" method="post">
                    <input type="hidden" name="auth[server]" value="{{ env('DB_HOST','localhost') }}">
                    <input type="hidden" name="auth[username]" value="{{ env('DB_USERNAME','root') }}">
                    <input type="hidden" name="auth[password]" value="{{ env('DB_PASSWORD','') }}">
                    <input type="hidden" name="auth[db]" value="{{ env('DB_DATABASE','grading_system') }}">

                    <a class="nav-link submit-onclick" href="#">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Access Database</span></a>
                </form>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            @endif

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                @if (!empty($user->type) && $user->type == 'admin')
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    @if (!empty($user->type) && $user->type == 'admin')
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="{{ route('Search') }}" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endif

                    @if (!empty($alerts))
                        @include('templates.alerts')
                    @endif
                    
                    @if (!empty($messages))
                        @include('templates.messages')
                    @endif
                    
                    @if (!empty($user->type) && in_array($user->type, ['student']) && $user->incomplete_grades->count())
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-exclamation-triangle fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">{{ $user->incomplete_grades->count()}}</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                            Incomplete Grades
                            </h6>
                            @foreach ($user->incomplete_grades as $inc_key => $grade)
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">{{ $grade->classes_subject->class->code . ' (' . $grade->classes_subject->subject->code . ' - ' . $grade->classes_subject->subject->name . ')'}}</div>
                                    <div class="small text-gray-500">{{ $grade->classes_subject->teacher->name . ' (' . $grade->classes_subject->class->semester->name . ' - ' . $grade->classes_subject->class->year_level->name . ')' }}</div>
                                </div>
                            </a>
                            @endforeach
                            <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
                        </div>
                    </li>
                    @endif
                    
                    @if (!empty($user->type) && in_array($user->type, ['student']) && $user->drop_grades->count())
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ban fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">{{ $user->drop_grades->count()}}</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                            Drop Subjects
                            </h6>
                            @foreach ($user->drop_grades as $drop_key => $grade)
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">{{ $grade->classes_subject->class->code . ' (' . $grade->classes_subject->subject->code . ' - ' . $grade->classes_subject->subject->name . ')'}}</div>
                                    <div class="small text-gray-500">{{ $grade->classes_subject->teacher->name . ' (' . $grade->classes_subject->class->semester->name . ' - ' . $grade->classes_subject->class->year_level->name . ')' }}</div>
                                </div>
                            </a>
                            @endforeach
                            <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
                        </div>
                    </li>
                    @endif

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (!empty($user->name))
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
                            @endif
                            <img class="img-profile rounded-circle" src="{{ !empty($user->image) ? asset($user->image) : asset('img/default-user-img.svg') }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('UserProfile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <!-- <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                                </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div> -->
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="page-header-container mb-4"> 
                        @if (!empty($page_name))
                            <!-- Page Heading -->
                            <h1 class="h3 mb-0 text-gray-800">{{ $page_name }}</h1>
                        @endif
                        @if (!empty($page_description))
                            <!-- Page Heading -->
                            <p class="mb-0">{{ $page_description }}</p>
                        @endif
                    </div>
                    <div class="content-container">
                        @yield('content')
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Diliman Collage 2019</span>
                </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
@else 
    @yield('content')
@endif
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@include('modals.logout')

<div class="loading-overlay">
    <img src="{{ asset('img/loader.svg') }}">
</div>
  
  <script src="{{ asset('/js/all.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        beforeSend: function(xhr,data) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            $('body').addClass('loading');
        },
        complete: function(data) {
            if (!data.responseJSON.redirect) {
                $('body').removeClass('loading');
            }
        }
    });
  </script>
  @if(Session::has('message'))
    <script type="text/javascript">
        console.log('{{ Session::get('message') }}');
    </script>
  @endif
  @yield('form-helper-scripts')
  @yield('added-scripts')
</body>
</html>
