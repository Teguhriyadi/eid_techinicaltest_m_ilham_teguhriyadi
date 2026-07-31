@extends('pages.layouts.master')

@push('title-modules', 'Master Operator')

@push('title', 'Edit Data Operator')

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
            <a href="{{ url('/pages/operator') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ url('/pages/operator/' . $operator['id']) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Operator <span class="text-danger">*</span></label>

                    <input type="text" name="nama"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $operator) }}"
                        placeholder="Masukkan nama operator">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                @include('pages.layouts.components.button')
            </div>
        </form>
    </div>
@endpush
