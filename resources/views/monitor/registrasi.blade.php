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

        .table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .1);
            padding: 15px;
        }
    </style>
</head>

<body>

    <div class="container py-3">

        <!-- 🔍 LIVE SEARCH -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control form-control-lg" placeholder="Cari nama, NIP, atau satker...">
        </div>

        <div id="pesertaContainer" class="table-wrapper">
            <div class="text-center">
                <div class="spinner-border"></div>
                <p>Memuat data...</p>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        let pesertaData = []; // cache data agar bisa difilter tanpa request ulang

        function renderTable(data) {

            let html = `
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Satker</th>
                            <th>Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.forEach((item, i) => {

                let rowClass = item.absensi == 1 ? "bg-success text-white" : "bg-danger text-white";

                html += `
                    <tr class="${rowClass}">
                        <td class="text-center">${i + 1}</td>
                        <td>${item.nama}</td>
                        <td>${item.nip}</td>
                        <td>${item.satker}</td>
                        <td>${item.absensi == 1 ? '✔ Hadir' : '-'}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            $("#pesertaContainer").html(html);
        }

        function loadPeserta() {
            $.ajax({
                url: "{{ route('monitor.registrasi.data') }}",
                type: "GET",
                success: function(res) {

                    pesertaData = res; // simpan data untuk pencarian live
                    applySearch(); // render langsung dengan filter (jika ada)
                },
                error: function() {
                    $("#pesertaContainer").html(`
                        <div class="alert alert-danger text-center">Gagal memuat data.</div>
                    `);
                }
            });
        }

        // 🔍 LIVE SEARCH FUNCTION
        function applySearch() {

            let keyword = $("#search").val().toLowerCase();

            let filtered = pesertaData.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.nip.toLowerCase().includes(keyword) ||
                item.satker.toLowerCase().includes(keyword)
            );

            renderTable(filtered);
        }

        // EVENT: Saat mengetik → filter langsung
        $("#search").on("keyup", function() {
            applySearch();
        });

        // Load pertama kali
        loadPeserta();

        // Auto refresh setiap 3 detik
        setInterval(loadPeserta, 3000);
    </script>

</body>

</html>
