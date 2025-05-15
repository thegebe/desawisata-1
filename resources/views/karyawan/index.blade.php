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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Karyawan</h4>
                <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Jabatan</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $key => $karyawan)
                        <tr>
                            <td>{{ $karyawans->firstItem() + $key }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td>{{ $karyawan->no_hp }}</td>
                            <td>{{ ucfirst($karyawan->jabatan) }}</td>
                            <td>{{ $karyawan->user->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus karyawan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $karyawans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection