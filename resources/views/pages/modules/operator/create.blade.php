@extends('pages.layouts.master')

@push('title-modules', 'Master Mesin')

@push('title', 'Tambah Data Mesin')

@push('content-modules')

    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Gagal,</strong> {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            <strong>Berhasil,</strong> {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ url('/pages/mesin') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ url('/pages/operator') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Operator <span class="text-danger">*</span></label>

                    <input type="text" name="nama"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                        placeholder="Masukkan nama operator">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">

                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                            {{ old('is_active') ? 'checked' : '' }}>

                        <label class="custom-control-label" for="is_active">
                            Operator Aktif
                        </label>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                @include('pages.layouts.components.button')
            </div>
        </form>
    </div>
@endpush
