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
                    <h4>Kelola Penginapan</h4>
                    <p class="mb-0">Selamat datang di halaman Manajemen Penginapan</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Penginapan</a></li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Daftar Penginapan</h4>
                        <a href="{{ route('penginapan.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Tambah Penginapan
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="15%">Nama Penginapan</th>
                                        <th width="20%">Deskripsi</th>
                                        <th width="15%">Fasilitas</th>
                                        <th width="8%">Foto 1</th>
                                        <th width="8%">Foto 2</th>
                                        <th width="8%">Foto 3</th>
                                        <th width="8%">Foto 4</th>
                                        <th width="8%">Foto 5</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penginapans as $penginapan)
                                    <tr>
                                        <td>{{ $penginapan->nama_penginapan }}</td>
                                        <td>{{ Str::limit($penginapan->deskripsi, 50) }}</td>
                                        <td>{{ Str::limit($penginapan->fasilitas, 30) }}</td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <td class="text-center align-middle">
                                                @if($penginapan->{'foto'.$i})
                                                    <img src="{{ asset('storage/' . $penginapan->{'foto'.$i}) }}" alt="Foto {{$i}}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endfor
                                        <td>
                                            <div class="d-flex" style="gap: 8px;">
                                                <a href="{{ route('penginapan.edit', $penginapan->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <!-- Dalam loop penginapan -->
                                                <form action="{{ route('penginapan.destroy', $penginapan->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus penginapan ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('be.footer')
@endsection