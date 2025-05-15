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
                    <h4>Detail Reservasi</h4>
                    <p class="mb-0">Informasi detail reservasi</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('reservasi.index') }}">Reservasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Reservasi</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Reservasi</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td>{{ $reservasi->pelanggan->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Paket Wisata</th>
                        <td>{{ $reservasi->paketWisata->nama_paket }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Reservasi</th>
                        <td>{{ $reservasi->tgl_reservasi_wisata }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Peserta</th>
                        <td>{{ $reservasi->jumlah_peserta }}</td>
                    </tr>
                    <tr>
                        <th>Harga Awal</th>
                        <td>{{ number_format($reservasi->harga, 0, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td>{{ $reservasi->diskon }}%</td>
                    </tr>
                    <tr>
                        <th>Total Bayar</th>
                        <td>{{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Bukti Transfer</th>
                        <td>
                            @if ($reservasi->file_bukti_tf)
                                <a href="{{ asset('storage/' . $reservasi->file_bukti_tf) }}" target="_blank">Lihat</a>
                            @else
                                Tidak ada
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($reservasi->status_reservasi_wisata) }}</td>
                    </tr>
                </table>
                <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection