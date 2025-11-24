<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Absensi Peserta</title>

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
        background-color: #ccffd0 !important; /* hijau */
    }

    table.table tr.not-registered td {
        background-color: #ffe1e1 !important; /* merah */
    }

    .table-wrapper {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .1);
    }

    /* Search bar tetap di atas */
    .search-bar {
        position: sticky;
        top: 0;
        z-index: 100;
        background: white;
        padding: 10px 0;
    }
</style>

</head>

<body>

<div class="container mt-4">

    <div class="table-wrapper">

        <!-- 🔍 Live Search -->
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

    let allData = []; // semua data dari server

    function loadPeserta() {
        $.ajax({
            url: "{{ route('monitor.absensi.data') }}",
            type: "GET",
            success: function (res) {
                allData = res;      // simpan global
                renderTable();      // render sesuai filter
            },
            error: function () {
                $("#pesertaContainer").html(`
                    <div class="alert alert-danger text-center">Gagal memuat data.</div>
                `);
            }
        });
    }

    // 🔍 FILTER + RENDER TABEL
    function renderTable() {

        let keyword = $("#searchInput").val().toLowerCase();

        let filtered = allData.filter(item =>
            item.nama.toLowerCase().includes(keyword) ||
            item.nip.toLowerCase().includes(keyword) ||
            item.satker.toLowerCase().includes(keyword)
        );

        let html = `
        <table class="table table-bordered align-middle table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="50">#</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Satker</th>
                    <th>Waktu Absensi</th>
                </tr>
            </thead>
            <tbody>
        `;

        filtered.forEach((item, i) => {

            // Jika time_absensi1 ada → hadir
            let rowClass = item.time_absensi1
                ? 'registered'
                : 'not-registered';

            html += `
            <tr class="${rowClass}">
                <td class="text-center">${i + 1}</td>
                <td>${item.nama}</td>
                <td>${item.nip}</td>
                <td>${item.satker}</td>
                <td>${item.time_absensi1 ?? '-'}</td>
            </tr>
            `;
        });

        html += `</tbody></table>`;

        $("#pesertaContainer").html(html);
    }

    // Event live search
    $("#searchInput").on("keyup", function () {
        renderTable();
    });

    // Load pertama kali
    loadPeserta();

    // Refresh otomatis tiap 1 detik
    setInterval(loadPeserta, 1000);

</script>

</body>
</html>
