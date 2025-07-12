<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            @php
                $user = Auth::user();
                $profileRoute = '#';
                $fotoProfil = asset('assets/img/avatar/avatar-1.png');

                if ($user->role == 'admin') {
                    $profileRoute = route('admin.profil.edit');
                } elseif ($user->role == 'guru' && $user->guru) {
                    $profileRoute = route('guru.profil.edit');
                    if ($user->guru->foto) {
                        $fotoProfil = Storage::url($user->guru->foto);
                    }
                } elseif ($user->role == 'siswa' && $user->siswa) {
                    $profileRoute = route('siswa.profil.edit');
                    if ($user->siswa->foto) {
                        $fotoProfil = Storage::url($user->siswa->foto);
                    }
                }
            @endphp

            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ $fotoProfil }}" class="rounded-circle mr-1"
                    style="width:30px; height:30px; object-fit: cover;">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->nama }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Masuk sebagai {{ Str::title($user->role) }}</div>
                <a href="{{ $profileRoute }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
