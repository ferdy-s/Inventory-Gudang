<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Inventory Gudang</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">


  <!-- CSS Libraries -->

  <!-- Template CSS -->

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!-- Datatable Jquery -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>


<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">


          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="/ubah-password" class="dropdown-item has-icon">
                <i class="fa fa-sharp fa-solid fa-lock"></i> Ubah Password
              </a>
              <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                Swal.fire({
                                    title: 'Konfirmasi Keluar',
                                    text: 'Apakah Anda yakin ingin keluar?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Keluar!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      document.getElementById('logout-form').submit();
                                    }
                                  });">
                               <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
                              </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">

          <div class="sidebar-brand">
            <a href="/">INVENTORY GUDANG</a>
          </div>

          <ul class="sidebar-menu">
            @if (auth()->user()->role->role === 'kepala gudang')
              <li class="sidebar-item">
                <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                  <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
                </a>
              </li>

              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-reguler fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>

              <li class="menu-header">MANAJEMEN USER</li>
              <li><a class="nav-link {{ Request::is('aktivitas-user') ? 'active' : '' }}" href="aktivitas-user"><i class="fa fa-solid fa-list"></i><span>Aktivitas User</span></a></li>
            @endif

            @if (auth()->user()->role->role === 'superadmin')
              <li class="sidebar-item">
                <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                  <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
                </a>
              </li>

              <li class="menu-header">DATA MASTER</li>
                <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown {{ Request::is('barang') || Request::is('jenis-barang') || Request::is('satuan-barang') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-thin fa-cubes"></i><span>Data Barang</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link {{ Request::is('barang') ? 'active' : '' }}" href="/barang"><i class="fa fa-solid fa-circle fa-xs"></i> Nama Barang</a></li>
                    <li><a class="nav-link {{ Request::is('jenis-barang') ? 'active' : '' }}" href="/jenis-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Jenis</a></li>
                    <li><a class="nav-link {{ Request::is('satuan-barang') ? 'active' : '' }}" href="/satuan-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Satuan</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown {{ Request::is('supplier')  || Request::is('customer') ? 'active' : '' }}" data-toggle="dropdown"><i class="fa fa-sharp fa-solid fa-building"></i><span>Perusahaan</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier"><i class="fa fa-solid fa-circle fa-xs"></i> Supplier</a></li>
                    <li><a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="/customer"><i class="fa fa-solid fa-circle fa-xs"></i> Customer</a></li>
                  </ul>
                </li>

              <li class="menu-header">TRANSAKSI</li>
              <li><a class="nav-link {{ Request::is('barang-masuk') ? 'active' : '' }}" href="barang-masuk"><i class="fa fa-solid fa-arrow-right"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('barang-keluar') ? 'active' : '' }}" href="barang-keluar"><i class="fa fa-sharp fa-solid fa-arrow-left"></i> <span>Barang Keluar</span></a></li>

              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-reguler fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>

              <li class="menu-header">MANAJEMEN USER</li>
              <li><a class="nav-link {{ Request::is('data-pengguna') ? 'active' : '' }}" href="data-pengguna"><i class="fa fa-solid fa-users"></i><span>Data Pengguna</span></a></li>
              <li><a class="nav-link {{ Request::is('hak-akses') ? 'active' : '' }}" href="hak-akses"><i class="fa fa-solid fa-user-lock"></i><span>Hak Akses/Role</span></a></li>
              <li><a class="nav-link {{ Request::is('aktivitas-user') ? 'active' : '' }}" href="aktivitas-user"><i class="fa fa-solid fa-list"></i><span>Aktivitas User</span></a></li>

            @endif

            @if (auth()->user()->role->role === 'admin gudang')
            <li class="sidebar-item">
              <a class="sidebar-link nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
              </a>
            </li>

              <li class="menu-header">DATA MASTER</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('barang') || Request::is('jenis-barang') || Request::is('satuan-barang') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-thin fa-cubes"></i><span>Data Barang</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link {{ Request::is('barang') ? 'active' : '' }}" href="/barang"><i class="fa fa-solid fa-circle fa-xs"></i> Nama Barang</a></li>
                  <li><a class="nav-link {{ Request::is('jenis-barang') ? 'active' : '' }}" href="/jenis-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Jenis</a></li>
                  <li><a class="nav-link {{ Request::is('satuan-barang') ? 'active' : '' }}" href="/satuan-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Satuan</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('supplier')  || Request::is('customer') ? 'active' : '' }}" data-toggle="dropdown"><i class="fa fa-sharp fa-solid fa-building"></i><span>Perusahaan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier"><i class="fa fa-solid fa-circle fa-xs"></i> Supplier</a></li>
                  <li><a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="/customer"><i class="fa fa-solid fa-circle fa-xs"></i> Customer</a></li>
                </ul>
              </li>

              <li class="menu-header">TRANSAKSI</li>
              <li><a class="nav-link {{ Request::is('barang-masuk') ? 'active' : '' }}" href="barang-masuk"><i class="fa fa-solid fa-arrow-right"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('barang-keluar') ? 'active' : '' }}" href="barang-keluar"><i class="fa fa-sharp fa-solid fa-arrow-left"></i> <span>Barang Keluar</span></a></li>

              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-reguler fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>

            @endif
          </ul>

        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

            @yield('content')
          <div class="section-body">
          </div>
        </section>
      </div>
<footer class="main-footer">
    <div class="footer-left">
        Inventaris-Gudang &copy; {{ date('Y') }}
    </div>
    <div class="footer-right">

    </div>
</footer>

    </div>
  </div>



  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Select2 Jquery -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Datatables Jquery -->
  <script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <!-- Sweet Alert -->
  @include('sweetalert::alert')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Day Js Format -->
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>


  @stack('scripts')


  <script>
    $(document).ready(function() {
      var currentPath = window.location.pathname;

      $('.nav-link a[href="' + currentPath + '"]').addClass('active');
    });
  </script>

</body>
</html>

<style>
    /* === GLOBAL THEME === */
body {
  background: linear-gradient(180deg, #f7f9ff 0%, #f1f4ff 100%);
  color: #2c2c2c;
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  letter-spacing: 0.2px;
}

/* === NAVBAR === */
.navbar-bg {
  background: linear-gradient(90deg, #7686ff 0%, #9ba8ff 100%);
  box-shadow: 0 2px 10px rgba(110, 130, 255, 0.2);
}

.navbar {
  background: #ffffff;
  border-bottom: 1px solid #e6e9f3;
  box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
  height: 70px;
}

.navbar .nav-link {
  color: #333 !important;
  font-weight: 500;
}

.navbar .nav-link:hover {
  color: #2e38ff !important;
}

.navbar .dropdown-menu {
  border-radius: 10px;
  box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
  border: none;
}

/* === SIDEBAR === */
.main-sidebar {
  background: #fdfdff;
  border-right: 1px solid #e5e8f3;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.03);
}

.sidebar-brand a {
  font-weight: 700;
  color: #1d1f2c;
  letter-spacing: 0.5px;
}

.sidebar-menu li a {
  color: #555;
  border-radius: 10px;
  padding: 10px 16px;
  margin-bottom: 4px;
  transition: all 0.25s ease;
  font-weight: 500;
}

.sidebar-menu li a.active,
.sidebar-menu li a:hover {
  background: linear-gradient(90deg, rgba(130,138,255,0.2), rgba(210,216,255,0.4));
  color: #2b2b2b !important;
  box-shadow: inset 2px 0 0 #6e7eff;
  transform: translateX(2px);
}

.sidebar-menu .menu-header {
  color: #8c90a8;
  font-size: 0.75rem;
  letter-spacing: 0.6px;
  margin-top: 15px;
}

/* === MAIN CONTENT AREA === */
.main-content {
  background: #f8faff;
  padding-top: 85px;
}

/* === SECTION === */
.section {
  background: #ffffff;
  border-radius: 18px;
  padding: 30px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
}

/* === DASHBOARD HEADER === */
.section .section-header {
  background: linear-gradient(90deg, #f5f7ff 0%, #f0f4ff 100%);
  border-radius: 12px;
  padding: 16px 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
}
.section .section-header h1 {
  color: #1f1f33;
  font-weight: 700;
}

/* === DASHBOARD CARDS === */
.card {
  border: none;
  border-radius: 16px;
  background: #ffffff;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(110, 130, 255, 0.12);
}

.card .card-header {
  border-bottom: none;
  background: transparent;
  color: #4a4a4a;
  font-weight: 600;
  font-size: 1rem;
}

/* === STATISTIC CARDS === */
.card-statistic-1 {
  display: flex;
  align-items: center;
  background: #ffffff;
  border-radius: 14px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.card-statistic-1:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(120, 130, 255, 0.15);
}

.card-statistic-1 .card-icon {
  width: 70px;
  height: 70px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin: 16px;
  color: #fff;
}

.card-statistic-1 .card-wrap {
  padding: 10px 20px;
}

.card-statistic-1 .card-header h4 {
  color: #7a7a7a;
  font-weight: 500;
}

.card-statistic-1 .card-body {
  color: #1f1f1f;
  font-weight: 700;
  font-size: 1.8rem;
}

.bg-primary {
  background: linear-gradient(135deg, #6e73ff, #8c9aff) !important;
}
.bg-danger {
  background: linear-gradient(135deg, #ff5f6d, #ff7a85) !important;
}
.bg-warning {
  background: linear-gradient(135deg, #ffca58, #ffb347) !important;
}
.bg-success {
  background: linear-gradient(135deg, #54e08e, #33d4a0) !important;
}

/* === TABLE === */
.table {
  border-radius: 10px;
  overflow: hidden;
  color: #333;
}
.table thead {
  background: #f1f3ff;
  color: #444;
  font-weight: 600;
}
.table tbody tr:hover {
  background: rgba(150, 160, 255, 0.08);
}

/* === BADGES === */
.badge-warning {
  background: linear-gradient(90deg, #ffcd4f, #f7b74a);
  color: #3a3a3a;
  border-radius: 8px;
  font-weight: 600;
  padding: 6px 10px;
}

/* === FOOTER === */
.main-footer {
  background: #f8faff;
  border-top: 1px solid #e5e8f3;
  color: #666;
  font-size: 0.9rem;
  padding: 20px;
  text-align: center;
}

/* === SCROLLBAR === */
::-webkit-scrollbar {
  width: 8px;
}
::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #b8bfff, #a6adff);
  border-radius: 10px;
}
::-webkit-scrollbar-track {
  background: #f0f3ff;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
  .card-statistic-1 .card-icon {
    width: 55px;
    height: 55px;
    font-size: 22px;
  }
  .card-statistic-1 .card-body {
    font-size: 1.4rem;
  }
}

</style>

