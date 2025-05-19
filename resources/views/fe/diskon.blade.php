<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Bagian head tetap sama seperti sebelumnya -->
</head>
<body>
    @include('fe.navbar')

    <main>
        <!-- Konten utama -->
        <div class="container py-5">
            <!-- Header -->
            

            <!-- Daftar Diskon -->
            <div class="row g-4">
                @forelse($diskonList as $diskon)
                <!-- Konten diskon -->
                @empty
                <!-- Konten kosong -->
                @endforelse
            </div>
        </div>
    </main>

    @include('fe.footer')

    <!-- Scripts -->
    @push('scripts')
    <script>
        // Script copy kode
    </script>
    @endpush
</body>
</html>