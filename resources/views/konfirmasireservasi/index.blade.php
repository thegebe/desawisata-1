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
                    <h4>Konfirmasi Reservasi</h4>
                    <p class="mb-0">Manajemen konfirmasi data reservasi</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reservasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Konfirmasi Reservasi</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title text-white">Daftar Reservasi Menunggu Konfirmasi</h4>
                <div class="card-tools">
                    <span class="badge badge-light">{{ $konfirmasiReservasis->count() }} Reservasi</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Nama Pelanggan</th>
                                <th width="15%">Paket Wisata</th>
                                <th width="15%" class="text-center">Tanggal Reservasi</th>
                                <th width="12%" class="text-right">Total Bayar</th>
                                <th width="10%" class="text-center">Bukti TF</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="18%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($konfirmasiReservasis as $reservasi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $reservasi->pelanggan->nama_lengkap }}</td>
                                    <td>{{ $reservasi->paketWisata->nama_paket }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi_wisata)->format('d M Y H:i') }}</td>
                                    <td class="text-right">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($reservasi->file_bukti_tf)
                                            <a href="{{ asset('storage/' . $reservasi->file_bukti_tf) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge badge-danger">Belum Upload</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($reservasi->status_reservasi_wisata == 'pesan')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($reservasi->status_reservasi_wisata == 'dbayar')
                                            <span class="badge badge-primary">Dibayar</span>
                                        @elseif($reservasi->status_reservasi_wisata == 'selesa')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            
                                            <form action="{{ route('konfirmasireservasi.updateStatus', $reservasi->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <select name="status" class="form-control form-control-sm" required>
                                                        <option value="dbayar" {{ $reservasi->status_reservasi_wisata == 'dbayar' ? 'selected' : '' }}>Dibayar</option>
                                                        <option value="selesa" {{ $reservasi->status_reservasi_wisata == 'selesa' ? 'selected' : '' }}>Selesai</option>
                                                        <option value="canceled" {{ $reservasi->status_reservasi_wisata == 'canceled' ? 'selected' : '' }}>Batal</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Update">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fa fa-calendar-times fa-3x text-muted"></i>
                                            <h4 class="mt-3">Tidak ada reservasi yang perlu dikonfirmasi</h4>
                                            <p class="text-muted">Semua reservasi telah diproses</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $konfirmasiReservasis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table thead th {
        vertical-align: middle;
    }
    .badge {
        font-size: 85%;
        padding: 0.35em 0.65em;
    }
    .empty-state {
        padding: 2rem;
        text-align: center;
    }
    .form-control-sm {
        height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .input-group-sm > .form-control, 
    .input-group-sm > .input-group-append > .btn {
        height: calc(1.5em + 0.5rem + 2px);
    }
</style>
@endsection
@section('footer')
    @include('be.footer')
@endsection