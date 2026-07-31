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
        <form action="{{ url('/pages/mesin') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Kode Mesin <span class="text-danger">*</span></label>
                    <input type="text" name="kode_mesin" class="form-control @error('kode_mesin') is-invalid @enderror"
                        value="{{ old('kode_mesin') }}" placeholder="Contoh : CNC-001">

                    @error('kode_mesin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Mesin <span class="text-danger">*</span></label>
                    <input type="text" name="nama_mesin" class="form-control @error('nama_mesin') is-invalid @enderror"
                        value="{{ old('nama_mesin') }}" placeholder="Masukkan nama mesin">
                    @error('nama_mesin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">-- Pilih Status --</option>
                        @foreach ($status as $item)
                            <option value="{{ $item }}" {{ old('status') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="temperatur">Temperatur (°C) <span class="text-danger">*</span></label>
                    <input type="number" name="temperatur" class="form-control @error('temperatur') is-invalid @enderror"
                        value="{{ old('temperatur') }}" min="0" max="999.99" step="0.01"
                        placeholder="Contoh : 42.50">

                    @error('temperatur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                @include('pages.layouts.components.button')
            </div>
        </form>
    </div>
@endpush
