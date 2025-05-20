<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Desa Arborek Papua - Riwayat Reservasi</title>

  <link href="{{ asset('fe/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('fe/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <style>
    body {
      background-color: #f5f5f5;
    }

    .reservation-card {
      border-radius: 10px;
      overflow: hidden;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .card-header {
      background: linear-gradient(135deg, #ff6b6b 0%, #f7b733 100%);
      color: white;
      padding: 15px;
    }

    .card-body {
      padding: 20px;
    }

    .status-badge {
      padding: 6px 12px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .status-menunggu_verifikasi {
      background-color: #ffeeba;
      color: #856404;
    }

    .status-dikonfirmasi {
      background-color: #d4edda;
      color: #155724;
    }

    .status-dibatalkan {
      background-color: #f8d7da;
      color: #721c24;
    }

    .reservation-details p {
      margin-bottom: 10px;
      border-bottom: 1px dashed #e0e0e0;
      padding-bottom: 10px;
    }

    .reservation-details strong {
      font-weight: 600;
      color: #495057;
    }

    .empty-state {
      text-align: center;
      padding: 40px 20px;
    }

    .empty-state i {
      font-size: 3rem;
      color: #ccc;
      margin-bottom: 20px;
    }

    .body {
      background-color: rgba(179, 179, 179, 0.32);
    }
  </style>
</head>

<body class="body">

  <header >
    @include('fe.navbar')
  </header>

  <main id="main" class="mt-5 pt-5">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-title mb-4">
            <h2><i class="bi bi-clock-history me-2"></i>Riwayat Reservasi</h2>
            <p>Daftar reservasi wisata yang pernah Anda lakukan</p>
          </div>

          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if(isset($reservasis) && count($reservasis) > 0)
            @foreach($reservasis as $reservasi)
            <div class="reservation-card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Reservasi #{{ $reservasi->id }}</h5>
                <span class="status-badge status-{{ $reservasi->status_reservasi_wisata }}">
                  {{ ucwords(str_replace('_', ' ', $reservasi->status_reservasi_wisata)) }}
                </span>
              </div>
              <div class="card-body">
                <div class="reservation-details">
                  <p><strong>Nama:</strong> {{ $reservasi->pelanggan->nama_lengkap }}</p>
                  <p><strong>Paket Wisata:</strong> {{ $reservasi->paketWisata->nama_paket }}</p>
                  <p><strong>Tanggal Reservasi:</strong> {{ \Carbon\Carbon::parse($reservasi->tgl_reservasi_wisata)->format('d F Y H:i') }}</p>
                  <p><strong>Jumlah Peserta:</strong> {{ $reservasi->jumlah_peserta }} orang</p>
                  <p><strong>Total Bayar:</strong> Rp {{ number_format($reservasi->total_bayar) }}</p>
                  <p><strong>Status:</strong> {{ ucwords(str_replace('_', ' ', $reservasi->status_reservasi_wisata)) }}</p>
                </div>
                <div class="d-flex justify-content-end mt-3">
                  <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-primary">
                    <i class="bi bi-eye me-1"></i>Detail
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <div class="reservation-card">
              <div class="card-body empty-state">
                <i class="bi bi-calendar-x"></i>
                <h5>Belum Ada Reservasi</h5>
                <p>Anda belum memiliki riwayat reservasi wisata.</p>
                <a href="{{ route('reservasi.create') }}" class="btn btn-primary">
                  <i class="bi bi-plus-circle me-1"></i>Buat Reservasi Baru
                </a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('fe/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('fe/assets/js/main.js') }}"></script>

  @section('footer')
  @include('fe.footer')
  @endsection
</body>

</html>