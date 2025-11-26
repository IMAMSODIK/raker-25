<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Absensi Peserta</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        /* Search + card sticky */
        .top-sticky {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 10px 0;
            background: #f5f5f5;
        }
    </style>
</head>

<body>

    <div class="container py-4">

        <!-- ======================= SEARCH + STATISTIK ======================= -->
        <div class="row align-items-center top-sticky">

            <div class="col-md-6 mb-2">
                <input type="text" id="searchInput" class="form-control form-control-lg"
                    placeholder="Cari nama / NIP / Satker...">
            </div>

            <div class="col-md-3 mb-2" style="display: none">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="text-muted">Total Peserta</h6>
                        <h4 id="totalPeserta">0</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2" style="display: none">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="text-muted">Total Absensi 2</h6>
                        <h4 id="totalAbsensi">0</h4>
                    </div>
                </div>
            </div>

        </div>

        <!-- ======================= TABLE ======================= -->
        <div id="pesertaContainer" class="table-wrapper mt-2">
            <div class="text-center py-4">
                <div class="spinner-border"></div>
                <p>Memuat data...</p>
            </div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        let allPeserta = [];

        function loadPeserta() {
            $.ajax({
                url: "{{ route('monitor.absensi.data') }}",
                type: "GET",
                success: function(res) {
                    allPeserta = res;

                    // Hitung statistik
                    $("#totalPeserta").text(res.length);
                    $("#totalAbsensi").text(res.filter(i => i.time_absensi3 !== null).length);

                    renderTable(res);
                },
                error: function() {
                    $("#pesertaContainer").html(`
                    <div class="alert alert-danger text-center">Gagal memuat data.</div>
                `);
                }
            });
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

        // Render tabel
        function renderTable(data) {
            let html = `
        <table class="table table-bordered table-striped align-middle">
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

            data.forEach((item, i) => {
                let rowClass = item.time_absensi3 ? 'registered' : 'not-registered';

                html += `
            <tr class="${rowClass}">
                <td class="text-center">${i + 1}</td>
                <td>${item.nama}</td>
                <td>${item.nip}</td>
                <td>${item.satker}</td>
                <td>${ formatWaktuIndonesia(item.time_absensi3) ?? '-'}</td>
            </tr>
            `;
            });

            html += `
            </tbody>
        </table>
        `;

            $("#pesertaContainer").html(html);
        }

        // Live search
        $("#searchInput").on("keyup", function() {
            let keyword = $(this).val().toLowerCase();

            let filtered = allPeserta.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.nip.toLowerCase().includes(keyword) ||
                item.satker.toLowerCase().includes(keyword)
            );

            renderTable(filtered);
        });

        // Load pertama kali
        loadPeserta();

        // Auto refresh 1 detik
        setInterval(loadPeserta, 1000);
    </script>

</body>

</html>
Kepala Bagian Tata Usaha Fakultas Syariah dan Hukum

{{-- Abdul Jousef Sitepu, S.Ag, M.A.P. --}}