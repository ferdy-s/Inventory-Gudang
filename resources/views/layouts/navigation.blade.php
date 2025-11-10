<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

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
