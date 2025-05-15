@extends('be.master')
@section('navbar')
    @include('be.navbar')
@endsection
@section('sidebar')
    @include('be.sidebar') 
@endsection
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Daftar Reservasi</h4>
                    <p class="mb-0">Manajemen data reservasi</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reservasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Reservasi</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Reservasi</h4>
                <a href="{{ route('reservasi.create') }}" class="btn btn-primary float-right">Tambah Reservasi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Paket Wisata</th>
                                <th>Tanggal Reservasi</th>
                                <th>Harga</th>
                                <th>Jumlah Orang</th>
                                <th>Total Bayar</th>
                                <th>Bukti Transfer</th>
                                <th>Status</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservasis as $reservasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reservasi->pelanggan->nama_lengkap }}</td>
                                    <td>{{ $reservasi->paketWisata->nama_paket }}</td>
                                    <td>{{ $reservasi->tgl_reservasi_wisata }}</td>
                                    <td>{{ number_format($reservasi->harga, 0, ',', '.') }}</td>
                                    <td>{{ $reservasi->jumlah_peserta }}</td>
                                    <td>{{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($reservasi->file_bukti_tf)
                                            <a href="{{ asset('storage/' . $reservasi->file_bukti_tf) }}" target="_blank">Lihat</a>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($reservasi->status_reservasi_wisata) }}</td>
                                    <td align="center">
                                        <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data reservasi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection