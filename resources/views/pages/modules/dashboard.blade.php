@extends('pages.layouts.master')

@push('title-modules', 'Dashboard')

@push('title', 'Smart Manufacturing Dashboard')

@push('style-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        .card-stat {
            border: none;
            border-radius: 15px;
            color: white;
            overflow: hidden;
        }

        .card-stat .card-body {
            padding: 22px;
        }

        .bg-primary-soft {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }

        .bg-success-soft {
            background: linear-gradient(135deg, #1cc88a, #17a673);
        }

        .bg-warning-soft {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
        }

        .bg-info-soft {
            background: linear-gradient(135deg, #36b9cc, #258391);
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 12px;
        }

        .chart-container {
            height: 420px;
        }
    </style>
@endpush

@push('content-modules')
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow card-stat bg-primary-soft">
                <div class="card-body">
                    <div>Total Mesin</div>
                    <div class="stat-value" id="total_mesin">0</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow card-stat bg-success-soft">
                <div class="card-body">
                    <div>Mesin Running</div>
                    <div class="stat-value" id="running">0</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow card-stat bg-warning-soft">
                <div class="card-body">
                    <div>Produksi Hari Ini</div>
                    <div class="stat-value" id="produksi">0</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow card-stat bg-info-soft">
                <div class="card-body">
                    <div>Operator Aktif</div>
                    <div class="stat-value" id="operator">0</div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header">

                    <strong>Grafik Produksi per Jam</strong>

                </div>

                <div class="card-body chart-container">

                    <canvas id="chartProduksi"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <strong>Monitoring Mesin</strong>

                    <div>

                        <button class="btn btn-sm btn-outline-secondary" id="btnPrev">
                            <i class="fa fa-chevron-left"></i>
                        </button>

                        <span class="mx-2 font-weight-bold" id="pageInfo">1 / 1</span>

                        <button class="btn btn-sm btn-outline-secondary" id="btnNext">
                            <i class="fa fa-chevron-right"></i>
                        </button>

                    </div>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead class="thead-light">

                            <tr>

                                <th>Mesin</th>

                                <th>Status</th>

                                <th>Suhu</th>

                                <th>Operator</th>

                            </tr>

                        </thead>

                        <tbody id="monitoring-table"></tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
@endpush

@push('style-javascript')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        const chart = new Chart(document.getElementById('chartProduksi'), {

            type: 'line',

            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah Produksi',
                    data: [],
                    fill: true,
                    tension: .35,
                    borderWidth: 2
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });

        let monitoringData = [];
        let currentPage = 1;
        const perPage = 5;

        function badgeStatus(status) {

            switch (status) {

                case 'Running':
                    return '<span class="badge badge-success">Running</span>';

                case 'Idle':
                    return '<span class="badge badge-secondary">Idle</span>';

                case 'Maintenance':
                    return '<span class="badge badge-warning">Maintenance</span>';

                default:
                    return '<span class="badge badge-danger">Error</span>';

            }

        }

        function renderMonitoring() {

            const totalPage = Math.max(1, Math.ceil(monitoringData.length / perPage));

            if (currentPage > totalPage) {
                currentPage = totalPage;
            }

            const start = (currentPage - 1) * perPage;

            const rows = monitoringData.slice(start, start + perPage);

            let html = '';

            rows.forEach(function(x) {

                html += `
            <tr>
                <td>
                    <strong>${x.kode_mesin}</strong><br>
                    <small>${x.nama_mesin}</small>
                </td>

                <td>${badgeStatus(x.status)}</td>

                <td>${x.temperatur} °C</td>

                <td>${x.operator}</td>

            </tr>
        `;

            });

            $('#monitoring-table').html(html);

            $('#pageInfo').text(currentPage + ' / ' + totalPage);

            $('#btnPrev').prop('disabled', currentPage === 1);

            $('#btnNext').prop('disabled', currentPage === totalPage);

        }

        $('#btnPrev').on('click', function() {

            if (currentPage > 1) {

                currentPage--;

                renderMonitoring();

            }

        });

        $('#btnNext').on('click', function() {

            const totalPage = Math.max(1, Math.ceil(monitoringData.length / perPage));

            if (currentPage < totalPage) {

                currentPage++;

                renderMonitoring();

            }

        });

        function refreshDashboard() {

    $.get('/pages/dashboard/statistik')
        .done(function(r) {

            console.log("DATA DASHBOARD BARU:", r);

            $('#total_mesin').text(r.total_mesin);
            $('#running').text(r.running);
            $('#produksi').text(r.total_produksi);
            $('#operator').text(r.operator_aktif);

            chart.data.labels = r.chart.labels;
            chart.data.datasets[0].data = r.chart.data;
            chart.update();

            monitoringData = r.monitoring;

            renderMonitoring();

        })
        .fail(function(xhr) {

            console.log("STATISTIK ERROR", xhr.responseText);

        });

}

        // Load pertama
        refreshDashboard();

        // Realtime menggunakan Laravel Reverb
        if (window.Echo) {
            console.log("Echo aktif");

            window.Echo.channel('dashboard')
                .listen('.produksi.created', function(e) {

                    console.log(e);

                    Toastify({
                        text: `📢 Produksi baru (${e.mesin})`,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#1cc88a"
                    }).showToast();

                    refreshDashboard();

                });

        }
    </script>

@endpush
