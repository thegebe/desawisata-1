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
                <h2>Edit Obyek Wisata</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('obyekwisata.update', $obyekWisata->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

            <div class="form-group">
                <label for="nama_wisata">Nama Wisata</label>
                <input type="text" name="nama_wisata" class="form-control" value="{{ $obyekWisata->nama_wisata }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi_wisata">Deskripsi Wisata</label>
                <textarea name="deskripsi_wisata" class="form-control" rows="3" required>{{ $obyekWisata->deskripsi_wisata }}</textarea>
            </div>

            <div class="form-group">
                <label for="id_kategori_wisata">Kategori Wisata</label>
                <select name="id_kategori_wisata" class="form-control" required>
                    @foreach($kategoriWisatas as $kategori)
                    <option value="{{ $kategori->id }}" {{ $obyekWisata->id_kategori_wisata == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->kategori_wisata }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea name="fasilitas" class="form-control" rows="3" required>{{ $obyekWisata->fasilitas }}</textarea>
            </div>
            
            @for($i = 1; $i <= 5; $i++)
            <div class="form-group">
                <label for="foto{{ $i }}">Foto {{ $i }}</label>
                @php $foto = 'foto' . $i; @endphp
                @if($obyekWisata->$foto)
                    <div>
                        <img src="{{ asset('storage/' . $obyekWisata->$foto) }}" alt="Foto {{ $i }}" style="width: 100px; margin-bottom: 10px;">
                    </div>
                @endif
                <input type="file" name="foto{{ $i }}" class="form-control-file">
            </div>
            @endfor
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('obyekwisata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@section('footer')
@include('be.footer')
@endsection