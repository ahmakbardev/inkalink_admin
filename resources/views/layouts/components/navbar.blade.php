<nav class="navbar-vertical navbar">
    <div id="myScrollableElement" class="h-screen" data-simplebar>
        <!-- brand logo -->
        <a class="navbar-brand flex gap-3 items-center justify-center text-white text-lg font-bold"
            href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/logo/logo-square.png') }}" class="inline" alt="" />
            <p class="inline pt-2">INKALINK</p>
        </a>

        <!-- navbar nav -->
        <ul class="navbar-nav flex-col" id="sideNavbar">
            <!-- Dashboard link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </li>
            <!-- nav item heading -->
            <li class="nav-item">
                <div class="navbar-heading">Manajemen Konten</div>
            </li>
            <!-- Categories link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">
                    <i data-feather="layers" class="w-4 h-4 mr-2"></i>
                    Kategori
                </a>
            </li>
            <!-- nav item for collapsible content -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('personality_types.*') || request()->routeIs('questions.*') || request()->routeIs('results.*') || request()->routeIs('universities.*') ? 'active' : '' }} collapsed"
                    href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false"
                    aria-controls="navPages">
                    <i data-feather="layers" class="w-4 h-4 mr-2"></i>
                    Konten
                </a>
                <div id="navPages"
                    class="collapse {{ request()->routeIs('personality_types.*') || request()->routeIs('questions.*') || request()->routeIs('results.*') || request()->routeIs('universities.*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-col">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('personality_types.*') ? 'active' : '' }}"
                                href="{{ route('personality_types.index') }}">Tipe Kepribadian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('questions.*') ? 'active' : '' }}"
                                href="{{ route('questions.index') }}">Soal Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('results.*') ? 'active' : '' }}"
                                href="{{ route('results.index') }}">Hasil Kepribadian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('universities.*') ? 'active' : '' }}"
                                href="{{ route('universities.index') }}">
                                Rekomendasi Universitas
                            </a>
                        </li>
                        <!-- More links can be added here -->
                    </ul>
                </div>
            </li>
            <!-- jurnalkarir link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jurnalkarir.*') ? 'active' : '' }}"
                    href="{{ route('jurnalkarir.index') }}">
                    <i data-feather="layers" class="w-4 h-4 mr-2"></i>
                    Jurnal Karir
                </a>
            </li>


        </ul>
    </div>
</nav>
