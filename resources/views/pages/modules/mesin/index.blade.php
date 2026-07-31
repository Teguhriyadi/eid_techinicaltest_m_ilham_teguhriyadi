@extends('pages.layouts.master')

@push('title-modules', 'Master Mesin')

@push('title', 'Data Mesin')

@push('style-css')
    <link href="{{ url('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <a href="{{ url('/pages/mesin/create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Aksi</th>
                            <th>Kode Mesin</th>
                            <th>Nama Mesin</th>
                            <th>Status</th>
                            <th>Temperatur</th>
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

                ajax: "{{ url('/pages/mesin/datatable') }}",

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
                        data: 'kode_mesin',
                        name: 'kode_mesin'
                    },
                    {
                        data: 'nama_mesin',
                        name: 'nama_mesin'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'temperatur',
                        name: 'temperatur'
                    }
                ]

            });

        });
    </script>
@endpush
