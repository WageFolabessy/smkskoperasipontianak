<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{ config('app.name', 'SIAKAD') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SK</a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::user()->role == 'admin')
                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>

                <li class="menu-header">Master Data</li>
                <li class="{{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.jurusan.tampil') }}"><i class="fas fa-graduation-cap"></i>
                        <span>Jurusan</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.matapelajaran.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.matapelajaran.tampil') }}"><i
                            class="fas fa-book-open"></i> <span>Mata Pelajaran</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.kelas.tampil') }}"><i class="fas fa-school"></i>
                        <span>Kelas</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.jadwal.tampil') }}"><i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Pelajaran</span></a>
                </li>

                <li class="menu-header">Pengguna</li>

                <li class="{{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.admin.index') }}"><i class="fas fa-user-cog"></i>
                        <span>Admin</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.guru.tampil') }}"><i
                            class="fas fa-chalkboard-teacher"></i> <span>Guru</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.siswa.tampil') }}"><i class="fas fa-users"></i>
                        <span>Siswa</span></a>
                </li>
                <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-user-cog"></i>
                        <span>Manajemen User</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'guru')
                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Akademik</li>
                <li class="{{ request()->routeIs('guru.materi.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.materi.tampil') }}"><i class="fas fa-book"></i>
                        <span>Materi</span></a>
                </li>
                <li class="{{ request()->routeIs('guru.tugas.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('guru.tugas.tampil') }}"><i class="fas fa-clipboard-list"></i>
                        <span>Tugas</span></a>
                </li>
            @endif

            @if (Auth::user()->role == 'siswa')
                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Akademik</li>
                <li class="{{ request()->routeIs('siswa.materi.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.materi.index') }}"><i class="fas fa-book"></i>
                        <span>Materi</span></a>
                </li>
                <li class="{{ request()->routeIs('siswa.tugas.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.tugas.index') }}"><i class="fas fa-clipboard-list"></i>
                        <span>Tugas</span></a>
                </li>
                <li class="{{ request()->routeIs('siswa.jadwal.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.jadwal.index') }}"><i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Pelajaran</span></a>
                </li>
                <li class="{{ request()->routeIs('siswa.nilai.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('siswa.nilai.index') }}"><i class="fas fa-star"></i>
                        <span>Nilai</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
