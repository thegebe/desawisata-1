<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Desa Arborek Papua</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('fe/assets/img/icon-big.png') }}" rel="icon">
  <link href="{{ asset('fe/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('fe/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('fe/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('fe/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('fe/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('fe/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('fe/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Desa Arborek</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>
          <li><a href="wisata">Wisata</a></li>
          <li><a href="#paket_wisata">Paket Wisata</a></li>
          <li><a href="#penginapan">Penginapan</a></li>
          <li><a href="#berita">Berita</a></li>
          <li class="dropdown"><a href="#"><span>Selengkapnya</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ url('/reservasi') }}">Reservasi</a></li>
              <li><a href="#">Voucher</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      @guest
        <a class="cta-btn" href="{{ route('login') }}">Sign In</a>
        <a class="cta-btn" href="{{ route('register') }}">Sign Up</a>
      @else
        <a href="#" data-bs-toggle="modal" data-bs-target="#userProfileModal" class="ms-3">
          <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
        </a>
      @endguest

    </div>
  </header>

  <!-- Modal Profil User -->
  @auth
  <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userProfileModalLabel">Profil Saya</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
          </div>
          <p><b>Nama:</b> {{ Auth::user()->name }}</p>
          <p><b>Email:</b> {{ Auth::user()->email }}</p>
          @if(Auth::user()->pelanggan)
            <p><b>No HP:</b> {{ Auth::user()->pelanggan->no_hp ?? '-' }}</p>
            <p><b>Alamat:</b> {{ Auth::user()->pelanggan->alamat ?? '-' }}</p>
          @endif
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
             class="btn btn-danger mt-3 w-100">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
  @endauth

  <main id="main" class="mt-5 pt-5">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-header bg-primary text-white">
              <h4 class="mb-0">Form Reservasi Wisata</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('reservasi.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Data Pelanggan (auto fill jika sudah login) -->
                <div class="mb-3 row">
                  <label class="col-md-4 col-form-label">Nama Lengkap</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control"
                      value="{{ Auth::user()->pelanggan->nama_lengkap ?? '' }}" readonly>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-md-4 col-form-label">No HP</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control"
                      value="{{ Auth::user()->pelanggan->no_hp ?? '' }}" readonly>
                  </div>
                </div>

                <!-- Pilih Paket Wisata -->
                <div class="mb-3 row">
                  <label for="id_paket" class="col-md-4 col-form-label">Paket Wisata</label>
                  <div class="col-md-8">
                    <select name="id_paket" id="id_paket" class="form-control" required>
                      <option value="">-- Pilih Paket --</option>
                      @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}" data-harga="{{ $paket->harga_per_pack }}">
                          {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga_per_pack) }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- Tanggal Reservasi -->
                <div class="mb-3 row">
                  <label for="tgl_reservasi_wisata" class="col-md-4 col-form-label">Tanggal Reservasi</label>
                  <div class="col-md-8">
                    <input type="datetime-local" name="tgl_reservasi_wisata" id="tgl_reservasi_wisata"
                      class="form-control" min="{{ date('Y-m-d\TH:i') }}" required>
                  </div>
                </div>

                <!-- Jumlah Peserta -->
                <div class="mb-3 row">
                  <label for="jumlah_peserta" class="col-md-4 col-form-label">Jumlah Peserta</label>
                  <div class="col-md-8">
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                      class="form-control" min="1" required>
                  </div>
                </div>

                <!-- Informasi Harga -->
                <div class="mb-3 row">
                  <label class="col-md-4 col-form-label">Harga Paket</label>
                  <div class="col-md-8">
                    <input type="text" id="harga_paket" class="form-control" readonly>
                  </div>
                </div>

                <!-- Diskon -->
                <div class="mb-3 row">
                  <label for="diskon" class="col-md-4 col-form-label">Diskon (%)</label>
                  <div class="col-md-8">
                    <input type="number" name="diskon" id="diskon" class="form-control" min="0" max="100" value="0">
                  </div>
                </div>

                <!-- Nilai Diskon -->
                <div class="mb-3 row">
                  <label class="col-md-4 col-form-label">Nilai Diskon</label>
                  <div class="col-md-8">
                    <input type="text" id="nilai_diskon" class="form-control" readonly>
                  </div>
                </div>

                <!-- Total Bayar -->
                <div class="mb-3 row">
                  <label class="col-md-4 col-form-label">Total Bayar</label>
                  <div class="col-md-8">
                    <input type="text" name="total_bayar" id="total_bayar" class="form-control" readonly>
                  </div>
                </div>

                <!-- Upload Bukti Transfer -->
                <div class="mb-3 row">
                  <label for="file_bukti_tf" class="col-md-4 col-form-label">Bukti Transfer</label>
                  <div class="col-md-8">
                    <input type="file" name="file_bukti_tf" id="file_bukti_tf" class="form-control" required>
                    <small class="text-muted">Upload bukti transfer pembayaran</small>
                  </div>
                </div>

                <div class="mb-0 row">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-save"></i> Submit Reservasi
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Vendor JS Files -->
  <script src="{{ asset('fe/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('fe/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('fe/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('fe/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('fe/assets/js/main.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const paketSelect = document.getElementById('id_paket');
      const jumlahPeserta = document.getElementById('jumlah_peserta');
      const diskonInput = document.getElementById('diskon');
      const hargaPaket = document.getElementById('harga_paket');
      const nilaiDiskon = document.getElementById('nilai_diskon');
      const totalBayar = document.getElementById('total_bayar');

      function calculateTotal() {
        const harga = parseInt(paketSelect.selectedOptions[0]?.dataset.harga || 0);
        const peserta = parseInt(jumlahPeserta.value || 0);
        const diskon = parseFloat(diskonInput.value || 0);

        const subtotal = harga * peserta;
        const diskonValue = subtotal * (diskon / 100);
        const total = subtotal - diskonValue;

        hargaPaket.value = formatRupiah(subtotal);
        nilaiDiskon.value = formatRupiah(diskonValue);
        totalBayar.value = formatRupiah(total);
        document.querySelector('input[name="total_bayar"]').value = total;
      }

      function formatRupiah(angka) {
        angka = isNaN(angka) ? 0 : angka;
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }

      paketSelect.addEventListener('change', calculateTotal);
      jumlahPeserta.addEventListener('input', calculateTotal);
      diskonInput.addEventListener('input', calculateTotal);
    });
  </script>
</body>
</html>