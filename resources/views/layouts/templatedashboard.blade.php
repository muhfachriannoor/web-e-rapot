<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  @yield('cssfile')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cogs"></i>
            {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- <div class="dropdown-divider"></div> --}}
            {{-- <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a> --}}
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i> Keluar
              {{-- <span class="float-right text-muted text-sm">2 days</span> --}}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            <div class="dropdown-divider"></div>
            {{-- <a href="#" class="dropdown-item dropdown-footer">Logout</a> --}}
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Rapot</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ url('datafoto_user/' . auth()->user()->foto_user) }}" class="img-circle elevation-2"
              alt="Foto {{ auth()->user()->nama }}">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
          </div>
        </div>

        {{-- <!-- SidebarSearch Form -->
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
                </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
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
            <li class="nav-item">
              <a href="{{ route('dashboard') }}"
                class="nav-link {{ $title == 'Dashboard E-Kepegawaian' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @if (auth()->user()->level == 1 or auth()->user()->level == 2)
              <li class="nav-item @if (
                  $title == 'Informasi Sekolah' or
                      $title == 'Tingkat Kelas' or
                      $title == 'Tahun Ajaran' or
                      $title == 'Kelas' or
                      $title == 'Mata Pelajaran' or
                      $title == 'Mata Pelajaran Kelas') menu-open @endif">
                <a href="#" class="nav-link @if (
                    $title == 'Informasi Sekolah' or
                        $title == 'Tingkat Kelas' or
                        $title == 'Tahun Ajaran' or
                        $title == 'Kelas' or
                        $title == 'Mata Pelajaran' or
                        $title == 'Mata Pelajaran Kelas') active @endif">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('informasi-sekolah.index') }}"
                      class="nav-link {{ $title == 'Informasi Sekolah' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Informasi Sekolah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('tahun-ajaran.index') }}"
                      class="nav-link {{ $title == 'Tahun Ajaran' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tahun Ajaran</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('tingkat-kelas.index') }}"
                      class="nav-link {{ $title == 'Tingkat Kelas' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tingkat Kelas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-link {{ $title == 'Kelas' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('mata-pelajaran.index') }}"
                      class="nav-link {{ $title == 'Mata Pelajaran' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mata Pelajaran</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('mapel-kelas.index') }}"
                      class="nav-link {{ $title == 'Mata Pelajaran Kelas' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mata Pelajaran Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item @if ($title == 'Data Guru' or $title == 'Data Wali Kelas') menu-open @endif">
                <a href="#" class="nav-link @if ($title == 'Data Guru' or $title == 'Data Wali Kelas') active @endif">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Guru
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('guru.index') }}"
                      class="nav-link {{ $title == 'Data Guru' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Guru</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('wali-kelas.index') }}"
                      class="nav-link {{ $title == 'Data Wali Kelas' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Wali Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item @if ($title == 'Data Siswa' or $title == 'Data Kelas Siswa') menu-open @endif">
                <a href="#" class="nav-link @if ($title == 'Data Siswa') active @endif">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Siswa
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('siswa.index') }}"
                      class="nav-link {{ $title == 'Data Siswa' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('kelas-siswa.index') }}"
                      class="nav-link {{ $title == 'Data Kelas Siswa' ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kelas Siswa</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            @if (auth()->user()->level == 1)
              <li class="nav-item">
                <a href="{{ route('rapot.TahunAjaran') }}" class="nav-link {{ $title == 'Rapot' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Rapot
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
            @endif
            @if (auth()->user()->level == 3)
              <li class="nav-item">
                <a href="{{ route('rapot.WaliKelas') }}" class="nav-link {{ $title == 'Rapot' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Rapot
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
            @endif
            @if (auth()->user()->level == 1)
              <li class="nav-item">
                <a href="{{ route('data-akun.index') }}"
                  class="nav-link {{ $title == 'Data Akun' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Akun
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </a>
              </li>
            @endif
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2023 muhfachriannoor.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{ asset('admin/dist/js/demo.js') }}"></script> --}}
  @yield('jsfile')
</body>

</html>
