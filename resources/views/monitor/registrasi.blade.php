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

        table.table tr.registered td {
            background-color: #ccffd0 !important;
            /* hijau */
        }

        table.table tr.not-registered td {
            background-color: #ffe1e1 !important;
            /* merah */
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

        <!-- 📊 Statistik -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Peserta</h5>
                        <h2 id="totalPeserta">0</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Belum Registrasi</h5>
                        <h2 id="totalBelum">0</h2>
                    </div>
                </div>
            </div>
        </div>

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
                url: "{{ route('monitor.registrasi.data') }}",
                type: "GET",
                success: function(res) {
                    allData = res;

                    renderTable();
                    renderStats(); // update statistik
                },
                error: function() {
                    $("#pesertaContainer").html(`
                    <div class="alert alert-danger text-center">Gagal memuat data.</div>
                `);
                }
            });
        }

        // 📌 Render Statistik
        function renderStats() {
            let total = allData.length;
            let belum = allData.filter(x => !x.time_registrasi).length;

            $("#totalPeserta").text(total);
            $("#totalBelum").text(belum);
        }

        function formatWaktuIndonesia(datetime) {
            if (!datetime) return "-";

            // Ubah ke objek Date (dibaca sebagai lokal browser)
            let d = new Date(datetime.replace(" ", "T"));

            // Tambahkan 7 jam
            d.setHours(d.getHours() + 7);

            let tgl = d.getDate().toString().padStart(2, "0");
            let bln = (d.getMonth() + 1).toString().padStart(2, "0");
            let thn = d.getFullYear();

            let jam = d.getHours().toString().padStart(2, "0");
            let menit = d.getMinutes().toString().padStart(2, "0");

            return `${tgl}-${bln}-${thn} ${jam}:${menit}`;
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
                    <th>Waktu Registrasi</th>
                </tr>
            </thead>
            <tbody>
        `;

            filtered.forEach((item, i) => {

                let rowClass = item.time_registrasi ?
                    'registered' :
                    'not-registered';

                html += `
            <tr class="${rowClass}">
                <td class="text-center">${i + 1}</td>
                <td>${item.nama}</td>
                <td>${item.nip}</td>
                <td>${item.satker}</td>
                <td>${ formatWaktuIndonesia(item.time_registrasi) }</td>
            </tr>
            `;
            });

            html += `</tbody></table>`;

            $("#pesertaContainer").html(html);
        }

        // Event live search
        $("#searchInput").on("keyup", function() {
            renderTable();
        });

        // Load pertama kali
        loadPeserta();

        // Refresh otomatis tiap 1 detik
        setInterval(loadPeserta, 1000);
    </script>

</body>

</html>
