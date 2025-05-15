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
                    <h4>Daftar Obyek Wisata</h4>
                    <p class="mb-0">Manajemen Obyek Wisata</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('obyekwisata.index') }}">Obyek Wisata</a></li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Obyek Wisata</h4>
                <a href="{{ route('obyekwisata.create') }}" class="btn btn-primary btn-sm float-right">Tambah Obyek Wisata</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Wisata</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Fasilitas</th>
                                <th class="text-center">Foto 1</th>
                                <th class="text-center">Foto 2</th>
                                <th class="text-center">Foto 3</th>
                                <th class="text-center">Foto 4</th>
                                <th class="text-center">Foto 5</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($obyekWisatas as $obyekWisata)
                            <tr class="text-bold text-dark">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $obyekWisata->nama_wisata }}</td>
                                <td>{{ $obyekWisata->kategoriWisata->kategori_wisata }}</td>
                                <td>{{ $obyekWisata->fasilitas }}</td>
                                <td>
                                    @if ($obyekWisata['foto1'] !== null)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $obyekWisata['foto1']) }}" alt="Foto 1" style="width: 50px; cursor: pointer;"
                                        class="img-thumbnail" data-toggle="modal" data-target="#foto1Modal_{{ $obyekWisata->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="foto1Modal_{{ $obyekWisata->id }}" tabindex="-1" role="dialog" aria-labelledby="foto1ModalLabel_{{ $obyekWisata->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="foto1ModalLabel_{{ $obyekWisata->id }}">Foto 1 - {{ $obyekWisata->nama_wisata }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $obyekWisata['foto1']) }}" alt="Foto 1" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($obyekWisata['foto2'] !== null)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $obyekWisata['foto2']) }}" alt="Foto 2" style="width: 50px; cursor: pointer;"
                                        class="img-thumbnail" data-toggle="modal" data-target="#foto2Modal_{{ $obyekWisata->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="foto2Modal_{{ $obyekWisata->id }}" tabindex="-1" role="dialog" aria-labelledby="foto2ModalLabel_{{ $obyekWisata->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="foto2ModalLabel_{{ $obyekWisata->id }}">Foto 2 - {{ $obyekWisata->nama_wisata }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $obyekWisata['foto2']) }}" alt="Foto 2" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($obyekWisata['foto3'] !== null)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $obyekWisata['foto3']) }}" alt="Foto 3" style="width: 50px; cursor: pointer;"
                                        class="img-thumbnail" data-toggle="modal" data-target="#foto3Modal_{{ $obyekWisata->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="foto3Modal_{{ $obyekWisata->id }}" tabindex="-1" role="dialog" aria-labelledby="foto3ModalLabel_{{ $obyekWisata->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="foto3ModalLabel_{{ $obyekWisata->id }}">Foto 3 - {{ $obyekWisata->nama_wisata }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $obyekWisata['foto3']) }}" alt="Foto 3" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($obyekWisata['foto4'] !== null)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $obyekWisata['foto4']) }}" alt="Foto 4" style="width: 50px; cursor: pointer;"
                                        class="img-thumbnail" data-toggle="modal" data-target="#foto4Modal_{{ $obyekWisata->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="foto4Modal_{{ $obyekWisata->id }}" tabindex="-1" role="dialog" aria-labelledby="foto4ModalLabel_{{ $obyekWisata->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="foto4ModalLabel_{{ $obyekWisata->id }}">Foto 4 - {{ $obyekWisata->nama_wisata }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $obyekWisata['foto4']) }}" alt="Foto 4" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($obyekWisata['foto5'] !== null)
                                    <!-- Thumbnail -->
                                    <img src="{{ asset('storage/' . $obyekWisata['foto5']) }}" alt="Foto 5" style="width: 50px; cursor: pointer;"
                                        class="img-thumbnail" data-toggle="modal" data-target="#foto5Modal_{{ $obyekWisata->id }}">

                                    <!-- Modal -->
                                    <div class="modal fade" id="foto5Modal_{{ $obyekWisata->id }}" tabindex="-1" role="dialog" aria-labelledby="foto5ModalLabel_{{ $obyekWisata->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="foto5ModalLabel_{{ $obyekWisata->id }}">Foto 5 - {{ $obyekWisata->nama_wisata }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $obyekWisata['foto5']) }}" alt="Foto 5" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- <a href="{{ route('obyekwisata.show', $obyekWisata->id) }}" class="mdi mdi-eye"></a> -->
                                    <a href="{{ route('obyekwisata.edit', $obyekWisata->id) }}" class="mdi mdi-pencil"></a>
                                    <form action="{{ route('obyekwisata.destroy', $obyekWisata->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mdi mdi-close text-danger" onclick="return confirm('Yakin ingin menghapus?')"></button>
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