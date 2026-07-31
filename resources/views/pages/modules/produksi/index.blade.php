@extends('pages.layouts.master')

@push('title-modules', 'Master Produksi')

@push('title', 'Data Produksi')

@push('style-css')
    <link href="{{ url('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        #dataTable {
            min-width: 1400px;
        }
    </style>
@endpush

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
            <a href="{{ url('/pages/produksi/create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Aksi</th>
                            <th>Nama Mesin</th>
                            <th>Nama Operator</th>
                            <th>Tanggal Produksi</th>
                            <th>Shift</th>
                            <th>Jumlah Produksi</th>
                            <th>Temperatur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endpush

@push('style-javascript')
    <script src="{{ url('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: false,
                scrollX: true,
                ajax: "{{ url('/pages/produksi/datatable') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        class: 'text-center'
                    },
                    {
                        data: 'mesin',
                        name: 'mesin'
                    },
                    {
                        data: 'operator',
                        name: 'operator'
                    },
                    {
                        data: 'tanggal_produksi',
                        name: 'tanggal_produksi',
                        class: 'text-center'
                    },
                    {
                        data: 'shift',
                        name: 'shift',
                        class: 'text-center'
                    },
                    {
                        data: 'jumlah_produksi',
                        name: 'jumlah_produksi'
                    },
                    {
                        data: 'temperatur',
                        name: 'temperatur'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]

            });

        });
    </script>
@endpush
