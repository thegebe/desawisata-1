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
                    <h4>Daftar Berita</h4>
                    <p class="mb-0">Manajemen Berita</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Berita</h4>
                <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm float-right">Tambah Berita</a>
            </div>
            <!-- <div class="card-body"> -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Tanggal Posting</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritas as $berita)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $berita->judul }}</td>
                                    <td>{{ $berita->berita }}</td>
                                    <td>{{ $berita->tgl_post }}</td>
                                    <td>{{ $berita->kategoriBerita->kategori_berita ?? 'Tidak ada kategori' }}</td>
                                    <td>
                                        @if($berita->foto)
                                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
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
@endsection
@section('footer')
    @include('be.footer')
@endsection