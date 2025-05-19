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
  
  <style>

    /* Improved form styling */
    .reservation-form {
      border-radius: 10px;
      overflow: hidden;
    }
    
    .form-header {
      background: linear-gradient(135deg,rgb(255, 77, 0) 0%,rgb(255, 89, 0) 100%);
      color: white;
      padding: 20px;
      text-align: center;
    }
    
    .form-body {
      padding: 30px;
      background-color: #f8f9fa;
    }
    
    .form-control, .form-select {
      border-radius: 5px;
      padding: 10px 15px;
      border: 1px solid #ced4da;
      transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }
    
    .form-label {
      font-weight: 600;
      color: #495057;
    }
    
    .btn-submit {
      background: linear-gradient(135deg, #007bff 0%, #00a1ff 100%);
      border: none;
      padding: 10px 25px;
      font-weight: 600;
      transition: all 0.3s;
    }
    
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
    
    .price-display {
      background-color: #f1f8ff;
      border-left: 4px solid #007bff;
      padding: 10px 15px;
      font-weight: 600;
    }
    
    .readonly-field {
      background-color: #e9ecef;
      cursor: not-allowed;
    }

    .body {
      background-color:rgba(179, 179, 179, 0.32);
   }
  </style>
</head>

<body class="body">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <!-- <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Desa Arborek</h1>
      </a> -->

     <nav>@include('fe.navbar')</nav>

    </div>
  </header>

  <main id="main" class="mt-5 pt-5">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="reservation-form shadow">
            <div class="form-header">
              <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Form Reservasi Wisata</h4>
            </div>
            <div class="form-body">
              <form method="POST" action="{{ route('reservasi.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Data Pelanggan -->
                <div class="mb-4">
                  <label class="form-label">Informasi Pemesan</label>
                  <div class="card p-3 mb-3">
                    <div class="row mb-2">
                      <div class="col-md-4">
                        <span class="text-muted">Nama Lengkap</span>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control readonly-field" 
                            value="{{ Auth::user()->pelanggan->nama_lengkap ?? Auth::user()->name }}" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <span class="text-muted">No HP</span>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control readonly-field" 
                            value="{{ Auth::user()->pelanggan->no_hp ?? '-' }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pilih Paket Wisata -->
                <div class="mb-4">
                  <label for="id_paket" class="form-label">Paket Wisata</label>
                  <select name="id_paket" id="id_paket" class="form-select" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                      <option value="{{ $paket->id }}" data-harga="{{ $paket->harga_per_pack }}">
                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga_per_pack) }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <!-- Tanggal Reservasi -->
                <div class="mb-4">
                  <label for="tgl_reservasi_wisata" class="form-label">Tanggal Reservasi</label>
                  <input type="datetime-local" name="tgl_reservasi_wisata" id="tgl_reservasi_wisata"
                    class="form-control" min="{{ date('Y-m-d\TH:i') }}" required>
                </div>

                <!-- Jumlah Peserta -->
                <div class="mb-4">
                  <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                  <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                    class="form-control" min="1" required>
                </div>

                <!-- Informasi Pembayaran -->
                <div class="mb-4">
                  <label class="form-label">Detail Pembayaran</label>
                  <div class="card p-3">
                    <div class="row mb-2">
                      <div class="col-md-4">
                        <span class="text-muted">Harga Paket</span>
                      </div>
                      <div class="col-md-8">
                        <input type="text" id="harga_paket" class="form-control price-display readonly-field" readonly>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-md-4">
                        <span class="text-muted">Diskon (%)</span>
                      </div>
                      <div class="col-md-8">
                        <input type="number" name="diskon" id="diskon" class="form-control" min="0" max="100" value="0">
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-md-4">
                        <span class="text-muted">Nilai Diskon</span>
                      </div>
                      <div class="col-md-8">
                        <input type="text" id="nilai_diskon" class="form-control price-display readonly-field" readonly>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-4">
                        <span class="text-muted fw-bold">Total Bayar</span>
                      </div>
                      <div class="col-md-8">
                        <input type="text" name="total_bayar" id="total_bayar" class="form-control price-display readonly-field fw-bold" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Upload Bukti Transfer -->
                <div class="mb-4">
                  <label for="file_bukti_tf" class="form-label">Bukti Transfer</label>
                  <input type="file" name="file_bukti_tf" id="file_bukti_tf" class="form-control" required>
                  <div class="form-text">Upload bukti transfer pembayaran (format: JPG, PNG, PDF, maks 2MB)</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                  <button type="submit" class="btn btn-primary btn-submit">
                    <i class="bi bi-send-check me-2"></i>Submit Reservasi
                  </button>
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
      
      // Initialize calculation on page load if values exist
      calculateTotal();
    });
  </script>

@section('footer')
    @include('fe.footer')
@endsection
</body>
</html>