@extends('pages.layouts.master')

@push('title-modules', 'Master Produksi')

@push('title', 'Tambah Data Produksi')

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
        <form action="{{ url('/pages/produksi') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mesin_id">
                                Mesin <span class="text-danger">*</span>
                            </label>
                            <select name="mesin_id" class="form-control @error('mesin_id') is-invalid @enderror">
                                <option value="">-- Pilih Mesin --</option>
                                @foreach ($mesin as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('mesin_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->kode_mesin }} - {{ $item->nama_mesin }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mesin_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="operator_id">
                                Operator <span class="text-danger">*</span>
                            </label>
                            <select name="operator_id" class="form-control @error('operator_id') is-invalid @enderror">
                                <option value="">-- Pilih Operator --</option>
                                @foreach ($operator as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('operator_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('operator_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_produksi">
                                Tanggal Produksi <span class="text-danger">*</span>
                            </label>
                            <input type="datetime-local"
                                name="tanggal_produksi"
                                value="{{ old('tanggal_produksi') }}"
                                class="form-control @error('tanggal_produksi') is-invalid @enderror">
                            @error('tanggal_produksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="shift">
                                Shift <span class="text-danger">*</span>
                            </label>
                            <select name="shift" class="form-control @error('shift') is-invalid @enderror">
                                <option value="">-- Pilih Shift --</option>
                                @foreach ($shift as $item)
                                    <option value="{{ $item }}"
                                        {{ old('shift') == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_produksi">
                                Jumlah Produksi <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                min="1"
                                name="jumlah_produksi"
                                value="{{ old('jumlah_produksi') }}"
                                class="form-control @error('jumlah_produksi') is-invalid @enderror"
                                placeholder="Contoh : 250">
                            @error('jumlah_produksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temperatur">
                                Temperatur (°C) <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                min="0"
                                max="999.99"
                                step="0.01"
                                name="temperatur"
                                value="{{ old('temperatur') }}"
                                class="form-control @error('temperatur') is-invalid @enderror"
                                placeholder="Contoh : 42.50">
                            @error('temperatur')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">
                                Status Mesin <span class="text-danger">*</span>
                            </label>
                            <select name="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item }}"
                                        {{ old('status') == $item ? 'selected' : '' }}>
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
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @include('pages.layouts.components.button')
            </div>
        </form>
    </div>
@endpush
