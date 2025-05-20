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
                    <h4>Edit Voucher</h4>
                    <p class="mb-0">Form edit voucher promo</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('voucher.index') }}">Voucher</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Voucher</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('voucher.update', $voucher->id) }}" method="POST" id="voucherForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode Voucher</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $voucher->kode }}" required>
                                        @error('kode')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Promo</label>
                                        <input type="text" name="nama_promo" class="form-control" value="{{ $voucher->nama_promo }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Detail Promo</label>
                                        <textarea name="detail_promo" class="form-control" rows="3" required>{{ $voucher->detail_promo }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $voucher->tanggal_mulai->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Berakhir</label>
                                        <input type="date" name="tanggal_berakhir" class="form-control" value="{{ $voucher->tanggal_berakhir->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Minimal Transaksi (Rp)</label>
                                        <input type="number" name="minimal_transaksi" class="form-control" value="{{ $voucher->minimal_transaksi }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipe Diskon</label>
                                        <select name="jenis_diskon" class="form-control" required>
                                            <option value="persentase" {{ $voucher->jenis_diskon == 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                                            <option value="nominal" {{ $voucher->jenis_diskon == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nilai Diskon</label>
                                        <input type="number" step="0.01" name="nilai_diskon" class="form-control" value="{{ $voucher->nilai_diskon }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maksimal Diskon (Rp)</label>
                                        <input type="number" name="maksimal_diskon" class="form-control" value="{{ $voucher->maksimal_diskon }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kuota</label>
                                        <input type="number" name="kuota" class="form-control" value="{{ $voucher->kuota }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Digunakan</label>
                                        <input type="number" name="digunakan" class="form-control" value="{{ $voucher->digunakan }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Perubahan</button>
                                    <a href="{{ route('voucher.index') }}" class="btn btn-light">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('voucherForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
        
        // Submit form via AJAX
        fetch(this.action, {
            method: this.method,
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success message and redirect
                window.location.href = data.redirect;
            } else {
                // Handle server-side validation errors
                alert(data.message || 'Terjadi kesalahan saat menyimpan data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            let errorMessage = 'Terjadi kesalahan saat menyimpan data';
            
            if (error.errors) {
                // Handle Laravel validation errors
                errorMessage = Object.values(error.errors).join('\n');
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            alert(errorMessage);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Simpan Perubahan';
        });
    });
</script>

@endsection
@section('footer')
    @include('be.footer')
@endsection