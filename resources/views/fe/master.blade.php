<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Desa Arborek Papua</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="fe/assets/img/icon-big.png" rel="icon">
  <link href="fe/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="fe/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="fe/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="fe/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="fe/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="fe/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="fe/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
  @include('fe.navbar')

  <main class="main">

    <!-- Hero Section -->
    <section id="home" class="hero section dark-background">
      <img src="fe/assets/img/arborek2.jpeg" alt="" data-aos="fade-in">
      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">Desa ARBOREK</h2>
        <p data-aos="fade-up" data-aos-delay="200">Desa Wisata</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="#about" class="btn-get-started">Get Started</a>
          <a href="https://youtu.be/RF660LcsuDQ?si=h6ebnfhU2zItmcJx" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div>
      </div>

    </section>
    <!-- /Hero Section -->

    <!-- Wisata Section -->
    <section id="wisata" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Wisata</h2>
        <p>Wisata Desa Arborek<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
          @forelse($obyekWisatas as $wisata)
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                @php
                $foto = $wisata->foto1 ?? $wisata->foto2 ?? $wisata->foto3 ?? $wisata->foto4 ?? $wisata->foto5;
                @endphp
                @if($foto)
                <img src="{{ asset('storage/' . $foto) }}" class="img-fluid" alt="{{ $wisata->nama_wisata }}">
                @else
                <img src="fe/assets/img/default-wisata.jpg" class="img-fluid" alt="Default">
                @endif
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-activity"></i>
                </div>
                <!-- Tombol untuk membuka modal -->
                <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modalWisata{{ $wisata->id }}">
                  <h3>{{ $wisata->nama_wisata }}</h3>
                </a>
                <p>{{ Str::limit($wisata->deskripsi_wisata, 100) }}</p>
                <p><b>Kategori:</b> {{ $wisata->kategoriWisata->kategori_wisata ?? '-' }}</p>
                <p><b>Fasilitas:</b> {{ Str::limit($wisata->fasilitas, 50) }}</p>
              </div>
            </div>
          </div>

          <!-- Modal Detail Wisata -->
          <div class="modal fade" id="modalWisata{{ $wisata->id }}" tabindex="-1" aria-labelledby="modalWisataLabel{{ $wisata->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalWisataLabel{{ $wisata->id }}">{{ $wisata->nama_wisata }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-20 mb-10">
                      @if($foto)
                      <img src="{{ asset('storage/' . $foto) }}" class="img-fluid rounded" alt="{{ $wisata->nama_wisata }}">
                      @else
                      <img src="fe/assets/img/default-wisata.jpg" class="img-fluid rounded" alt="Default">
                      @endif
                    </div>
                    <div class="col-md-6">
                      <p><b>Kategori:</b> {{ $wisata->kategoriWisata->kategori_wisata ?? '-' }}</p>
                      <p><b>Deskripsi:</b><br>{{ $wisata->deskripsi_wisata }}</p>
                      <p><b>Fasilitas:</b><br>{{ $wisata->fasilitas }}</p>
                      @for($i = 1; $i <= 5; $i++)
                        @if($wisata->{'foto'.$i})
                        <img src="{{ asset('storage/' . $wisata->{'foto'.$i}) }}" class="img-thumbnail me-1 mb-1" style="width:60px;">
                        @endif
                        @endfor
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <p class="text-center">Belum ada wisata yang tersedia.</p>
          @endforelse
        </div>
      </div>
    </section>
    <!-- /Wisata Section -->

    <!-- Paket Wisata Section -->
    <section id="paket_wisata" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Activity</h2>
        <p>Wisata Desa Arborek<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
          @forelse($paketWisatas as $paket)
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                @php
                $foto = $paket->foto1 ?? $paket->foto2 ?? $paket->foto3 ?? $paket->foto4 ?? $paket->foto5;
                @endphp
                @if($foto)
                <img src="{{ asset('storage/' . $foto) }}" class="img-fluid" alt="{{ $paket->nama_paket }}">
                @else
                <img src="fe/assets/img/default-wisata.jpg" class="img-fluid" alt="Default">
                @endif
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-activity"></i>
                </div>
                <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modalPaket{{ $paket->id }}">
                  <h3>{{ $paket->nama_paket }}</h3>
                </a>
                <p>{{ Str::limit($paket->deskripsi, 100) }}</p>
                <p><b>Fasilitas:</b> {{ Str::limit($paket->fasilitas, 50) }}</p>
                <p>Harga mulai dari Rp{{ number_format($paket->harga_per_pack, 0, ',', '.') }}/orang</p>
              </div>
            </div>
          </div>

          <!-- Modal Detail Paket Wisata -->
          <div class="modal fade" id="modalPaket{{ $paket->id }}" tabindex="-1" aria-labelledby="modalPaketLabel{{ $paket->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalPaketLabel{{ $paket->id }}">{{ $paket->nama_paket }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-20 mb-10">
                      @php
                      $foto = $paket->foto1 ?? $paket->foto2 ?? $paket->foto3 ?? $paket->foto4 ?? $paket->foto5;
                      @endphp
                      @if($foto)
                      <img src="{{ asset('storage/' . $foto) }}" class="img-fluid rounded" alt="{{ $paket->nama_paket }}">
                      @else
                      <img src="fe/assets/img/default-wisata.jpg" class="img-fluid rounded" alt="Default">
                      @endif
                    </div>
                    <div class="col-md-6">
                      <p><b>Deskripsi:</b><br>{{ $paket->deskripsi }}</p>
                      <p><b>Fasilitas:</b><br>{{ $paket->fasilitas }}</p>
                      <p><b>Harga:</b> Rp{{ number_format($paket->harga_per_pack, 0, ',', '.') }}/orang</p>
                      @for($i = 1; $i <= 5; $i++)
                        @if($paket->{'foto'.$i})
                        <img src="{{ asset('storage/' . $paket->{'foto'.$i}) }}" class="img-thumbnail me-1 mb-1" style="width:60px;">
                        @endif
                        @endfor
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <p class="text-center">Belum ada paket wisata yang tersedia.</p>
          @endforelse
        </div>
      </div>

    </section>
    <!-- /Paket Wisata Section -->

    <!-- Penginapan Section -->
    <section id="penginapan" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Penginapan</h2>
        <p>Penginapan Desa Arborek<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
          @forelse($penginapans as $penginapan)
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <!-- kalo block if di php di ilangin kenapa foto gede ga muncul -->
                @php
                // $foto = $penginapan->foto1 ?? $penginapan->foto2 ?? $penginapan->foto3 ??$penginapan->foto4 ?? $penginapan->foto5;
                $foto = $penginapan->foto1 ?? $penginapan->foto2 ?? $penginapan->foto3 ?? $penginapan->foto4 ?? $penginapan->foto5;
                if($foto) {
                $foto = str_replace(url('storage/'), '', $foto);
                $foto = str_replace('storage/', '', $foto);
                }
                @endphp
                @if($foto)
                <img src="{{ asset('storage/' . $foto) }}" class="img-fluid" alt="{{ $penginapan->nama_penginapan }}">
                @else
                <img src="fe/assets/img/default-penginapan.jpg" class="img-fluid" alt="Default">
                @endif
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-house-door"></i>
                </div>
                <!-- Tombol untuk membuka modal -->
                <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modalPenginapan{{ $penginapan->id }}">
                  <h3>{{ $penginapan->nama_penginapan }}</h3>
                </a>
                <p>{{ Str::limit($penginapan->deskripsi, 100) }}</p>
                <p><b>Fasilitas:</b> {{ Str::limit($penginapan->fasilitas, 50) }}</p>
              </div>
            </div>
          </div>

          <!-- Modal Detail Penginapan -->
          <div class="modal fade" id="modalPenginapan{{ $penginapan->id }}" tabindex="-1" aria-labelledby="modalPenginapanLabel{{ $penginapan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalPenginapanLabel{{ $penginapan->id }}">{{ $penginapan->nama_penginapan }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-20 mb-10">
                      @php
                      $foto = $penginapan->foto1 ?? $penginapan->foto2 ?? $penginapan->foto3 ?? $penginapan->foto4 ?? $penginapan->foto5;
                      @endphp
                      @if($foto)
                      <img id="mainPenginapanImage{{ $penginapan->id }}" src="{{ asset('storage/' . $foto) }}" class="img-fluid rounded" alt="{{ $penginapan->nama_penginapan }}">
                      @else
                      <img id="mainPenginapanImage{{ $penginapan->id }}" src="fe/assets/img/default-penginapan.jpg" class="img-fluid rounded" alt="Default">
                      @endif

                      <!-- Galeri foto kecil -->
                      <div class="mt-3">
                        @for($i = 1; $i <= 5; $i++)
                          @if($penginapan->{'foto'.$i})
                          <img src="{{ asset('storage/' . $penginapan->{'foto'.$i}) }}"
                            class="img-thumbnail me-1 mb-1"
                            style="width:60px; cursor:pointer;"
                            onclick="document.getElementById('mainPenginapanImage{{ $penginapan->id }}').src='{{ asset('storage/' . $penginapan->{'foto'.$i}) }}';">
                          @endif
                          @endfor
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h5 class="mb-3">Detail Penginapan</h5>
                      <p><b>Deskripsi:</b><br>{{ $penginapan->deskripsi }}</p>
                      <p><b>Fasilitas:</b><br>{{ $penginapan->fasilitas }}</p>

                      <!-- Tambahkan info tambahan jika ada -->
                      <!-- <p><b>Harga:</b> Rp{{ number_format($penginapan->harga, 0, ',', '.') }}/malam</p> -->
                      <!-- <p><b>Kapasitas:</b> {{ $penginapan->kapasitas }} orang</p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center">
            <div class="alert alert-info">
              Belum ada penginapan yang tersedia.
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- /Penginapan Section -->

    <!-- Berita Section -->
    <section id="berita" class="services-2 section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Berita</h2>
        <p>Berita Tentang Kita</p>
      </div>
      <!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          @forelse($beritas as $berita)
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="service-item d-flex position-relative h-100">
              @if($berita->foto)
              <div class="img-container me-3" style="width: 100px; height: 100px; overflow: hidden;">
                <img src="{{ asset('storage/' . $berita->foto) }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $berita->judul }}">
              </div>
              @else
              <i class="bi bi-newspaper icon flex-shrink-0"></i>
              @endif
              <div>
                <h4 class="title">
                  <a href="javascript:void(0)" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modalBerita{{ $berita->id }}">
                    {{ $berita->judul }}
                  </a>
                </h4>
                <p class="description">{{ Str::limit($berita->berita, 150) }}</p>
                <small class="text-muted">
                  @if(is_string($berita->tgl_post))
                    {{ \Carbon\Carbon::parse($berita->tgl_post)->format('d M Y') }}
                  @else
                    {{ $berita->tgl_post->format('d M Y') }}
                  @endif
                </small>
              </div>
            </div>
          </div>

          <!-- Modal Detail Berita -->
          <div class="modal fade" id="modalBerita{{ $berita->id }}" tabindex="-1" aria-labelledby="modalBeritaLabel{{ $berita->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalBeritaLabel{{ $berita->id }}">{{ $berita->judul }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      @if($berita->foto)
                      <img src="{{ asset('storage/' . $berita->foto) }}" class="img-fluid rounded w-100" alt="{{ $berita->judul }}" style="max-height: 400px; object-fit: cover;">
                      @else
                      <img src="fe/assets/img/default-news.jpg" class="img-fluid rounded w-100" alt="Default" style="max-height: 400px; object-fit: cover;">
                      @endif
                    </div>
                    <div class="col-md-12">
                      <p class="text-muted mb-3">
                        <i class="bi bi-calendar me-2"></i>
                        @if(is_string($berita->tgl_post))
                          {{ \Carbon\Carbon::parse($berita->tgl_post)->format('l, d F Y') }}
                        @else
                          {{ $berita->tgl_post->format('l, d F Y') }}
                        @endif
                      </p>
                      <p><b>Kategori:</b> {{ $berita->kategoriBerita->kategori_berita ?? 'Tidak ada kategori' }}</p>
                      <div class="content mt-4">
                        {!! nl2br(e($berita->berita)) !!}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal Detail Berita -->

          @empty
          <div class="col-12 text-center">
            <p>Belum ada berita yang tersedia.</p>
          </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- /Berita Section -->

    <!-- Reservasi Section -->
    <section id="reservasi" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <!-- <div class="loading">Loading</div> -->
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section>
    <!-- /Reservasi Section -->

  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <!-- <div id="preloader"></div> -->

  @yield('navbar')
  @yield('content')
  @yield('footer')

  <!-- Vendor JS Files -->
  <script src="fe/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="fe/assets/vendor/php-email-form/validate.js"></script>
  <script src="fe/assets/vendor/aos/aos.js"></script>
  <script src="fe/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="fe/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="fe/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="fe/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="fe/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="fe/assets/js/main.js"></script>

</body>

</html>