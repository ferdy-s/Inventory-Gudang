<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-image: url('/storage/background-login.png'); /* ganti sesuai lokasi gambarmu */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex items-center justify-center min-h-screen">

            {{ $slot }}
        </div>
    </div>
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
