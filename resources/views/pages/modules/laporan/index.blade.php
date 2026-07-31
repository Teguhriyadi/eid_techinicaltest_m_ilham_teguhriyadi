@extends('pages.layouts.master')

@push('title-modules', 'Laporan Produksi')

@push('title', 'Laporan Produksi')

@push('style-css')
    <style>
        .card-report {
            border-radius: 15px;
            border: none;
        }
        .stat-value {
            font-size: 28px;
            font-weight: bold;
        }
    </style>
@endpush

@push('content-modules')
    <div class="row mb-4">
        <div class="col-md-4">
            <label>
                Tanggal
            </label>
            <input type="date" id="tanggal" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary btn-block" id="btnFilter">
                Filter
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow card-report bg-primary text-white">
                <div class="card-body">
                    <div>
                        Total Produksi
                    </div>
                    <div class="stat-value" id="totalProduksi">
                        0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow card-report bg-success text-white">
                <div class="card-body">
                    <div>
                        Total Mesin
                    </div>
                    <div class="stat-value" id="totalMesin">
                        0
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow card-report bg-info text-white">
                <div class="card-body">
                    <div>
                        Total Operator
                    </div>
                    <div class="stat-value" id="totalOperator">
                        0
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <strong>
                        Produksi Per Shift
                    </strong>
                </div>
                <div class="card-body">
                    <canvas id="chartShift"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong>
                        Rekap Shift
                    </strong>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Shift
                                </th>
                                <th>
                                    Produksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="shiftTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mt-4">
        <div class="card-header">
            <strong>
                Detail Produksi
            </strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Mesin
                        </th>
                        <th>
                            Operator
                        </th>
                        <th>
                            Shift
                        </th>
                        <th>
                            Jumlah
                        </th>
                        <th>
                            Temperatur
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody id="tableProduksi"></tbody>
            </table>
        </div>
    </div>
@endpush

@push('style-javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart = new Chart(
            document.getElementById('chartShift'), {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Jumlah Produksi',
                        data: []
                    }]
                }
            }

        );
        function loadLaporan() {
            let tanggal = $('#tanggal').val();
            $.get(
                "{{ url('/pages/laporan-produksi/data') }}", {
                    tanggal: tanggal
                },
                function(res) {
                    let data = res.data;
                    let total = 0;
                    let mesin = [];
                    let operator = [];
                    let shift = {};
                    let html = '';
                    data.forEach(item => {
                        total += Number(item.jumlah_produksi);
                        mesin.push(item.mesin_id);
                        operator.push(item.operator_id);
                        if (!shift[item.shift]) {
                            shift[item.shift] = 0;
                        }
                        shift[item.shift] += Number(item.jumlah_produksi);
                        html += `
                            <tr>

                                <td>
                                ${item.mesin.nama_mesin}
                                </td>


                                <td>
                                ${item.operator.nama}
                                </td>


                                <td>
                                ${item.shift}
                                </td>


                                <td>
                                    ${item.jumlah_produksi}
                                </td>
                                <td>
                                    ${item.temperatur} °C
                                </td>
                                <td>
                                    ${item.status}
                                </td>
                            </tr>
                        `;
                    });

                    $('#totalProduksi').text(total);
                    $('#totalMesin').text(
                        [...new Set(mesin)].length
                    );
                    $('#totalOperator').text(
                        [...new Set(operator)].length
                    );
                    $('#tableProduksi')
                        .html(html);

                    $('#shiftTable').html('');
                    Object.keys(shift).forEach(s => {
                        $('#shiftTable').append(`
                            <tr>
                                <td>
                                ${s}
                                </td>
                                <td>
                                ${shift[s]}
                                </td>
                            </tr>
                        `);
                    });

                    chart.data.labels =
                        Object.keys(shift);

                    chart.data.datasets[0].data =
                        Object.values(shift);
                        
                    chart.update();
                }
            );
        }

        $('#btnFilter').click(function() {
            loadLaporan();
        });

        loadLaporan();
    </script>
@endpush
