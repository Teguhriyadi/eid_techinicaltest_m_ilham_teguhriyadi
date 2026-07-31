@extends('pages.layouts.master')

@push('title-modules', 'Master Operator')

@push('title', 'Data Operator')

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
            <a href="{{ url('/pages/operator/create') }}" class="btn btn-primary btn-sm">
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
                            <th>Nama</th>
                            <th>Shift</th>
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

                ajax: "{{ url('/pages/operator/datatable') }}",

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
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'shift',
                        name: 'shift'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]

            });

        });

        $(document).on('change', '.toggle-status', function() {
            let checkbox = $(this);
            let id = checkbox.data('id');
            if (!confirm('Apakah Anda yakin ingin mengubah status operator?')) {
                checkbox.prop('checked', !checkbox.prop('checked'));
                return;
            }
            $.ajax({
                url: "{{ url('/pages/operator') }}" + "/" + id + "/toggle-status",
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#dataTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message ?? 'Terjadi kesalahan.');
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });

        });
    </script>
@endpush