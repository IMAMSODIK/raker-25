<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Registrasi Peserta</title>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        /* Background warna custom */
        table.table tr.registered td {
            background-color: #ccffd0 !important;
        }

        table.table tr.not-registered td {
            background-color: #ffe1e1 !important;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .1);
        }

        /* Search bar fixed */
        .search-bar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: white;
            padding: 10px 0;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="table-wrapper">

        <!-- 🔍 Live Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control"
                   placeholder="Cari nama, NIP, atau satker...">
        </div>

        <div id="pesertaContainer">
            <div class="text-center">
                <div class="spinner-border"></div>
                <p>Memuat data...</p>
            </div>
        </div>

    </div>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    let allData = []; // data asli dari server

    function loadPeserta() {
        $.ajax({
            url: "{{ route('monitor.registrasi.data') }}",
            type: "GET",
            success: function (res) {
                allData = res;     // simpan data global
                renderTable();     // render tabel sesuai search
            },
            error: function () {
                $("#pesertaContainer").html(`
                    <div class="alert alert-danger text-center">Gagal memuat data.</div>
                `);
            }
        });
    }

    // 🔍 Filter + render tabel
    function renderTable() {
        let keyword = $("#searchInput").val().toLowerCase();

        let filtered = allData.filter(item =>
            item.nama.toLowerCase().includes(keyword) ||
            item.nip.toLowerCase().includes(keyword) ||
            item.satker.toLowerCase().includes(keyword)
        );

        let html = `
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="50">#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Satker</th>
                    <th>Waktu Registrasi</th>
                </tr>
            </thead>
            <tbody>
        `;

        filtered.forEach((item, i) => {
            let rowClass = item.time_registrasi ? 'registered' : 'not-registered';

            html += `
            <tr class="${rowClass}">
                <td class="text-center">${i + 1}</td>
                <td>${item.nama}</td>
                <td>${item.nip}</td>
                <td>${item.satker}</td>
                <td>${item.time_registrasi ?? '-'}</td>
            </tr>
            `;
        });

        html += `</tbody></table>`;

        $("#pesertaContainer").html(html);
    }

    // Live search event listener
    $("#searchInput").on("keyup", function () {
        renderTable();
    });

    // Load pertama
    loadPeserta();

    // Auto refresh tiap 1 detik
    setInterval(loadPeserta, 1000);
</script>

</body>
</html>
