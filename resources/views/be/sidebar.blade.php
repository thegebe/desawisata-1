<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a href="" aria-expanded="false">
                    <i class="bi bi-window-fullscreen"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-label">User</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="bi bi-person-fill-gear"></i><span class="nav-text">User Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('users.index') }}">User</a></li>
                    <li><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
                    <li><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                </ul>
            </li>

            <li class="nav-label">Berita</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="bi bi-newspaper"></i><span class="nav-text">Kelola Berita</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route ('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route ('kategoriberita.index') }}">Kategori Berita</a></li>
                </ul>
            </li>

            <li class="nav-label">Wisata</li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="bi bi-card-image"></i><span class="nav-text">Kelola Wisata</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route ('obyekwisata.index') }}">Obyek Wisata</a></li>
                    <li><a href="{{ route ('kategoriwisata.index') }}">Kategori Wisata</a></li>
                </ul>
            </li>

            <li class="nav-label first">Penginapan</li>
            <li>
                <a href="{{ route ('penginapan.index') }}" aria-expanded="false">
                    <i class="bi bi-houses"></i><span class="nav-text">Kelola Penginapan</span>
                </a>
            </li>

            <li class="nav-label first">Paket Wisata</li>
            <li>
                <a href="{{ route ('paketwisata.index') }}" aria-expanded="false">
                    <i class="bi bi-card-list"></i><span class="nav-text">Kelola Paket Wisata</span>
                </a>
            </li>

            <li class="nav-label first">Reservasi</li>
            <li>
                <a href="{{ route ('reservasi.index') }}" aria-expanded="false">
                    <i class="bi bi-credit-card-2-front-fill"></i><span class="nav-text">Kelola Reservasi</span>
                </a>
            </li>

            <li class="nav-label first">Voucher</li>
            <li>
                <a href="{{ route ('voucher.index') }}" aria-expanded="false">
                    <i class="bi bi-credit-card-2-front-fill"></i><span class="nav-text">Kelola Voucher</span>
                </a>
            </li>

        </ul>
    </div>
</div>