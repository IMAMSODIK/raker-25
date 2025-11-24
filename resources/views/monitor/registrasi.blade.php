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

        /* Sudah absensi */
        .registered {
            background: #b7ffb7 !important; /* hijau lebih terang */
        }

        /* Belum absensi */
        .not-registered {
            background: #ffe1e1 !important;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>

    <div class="">
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
        function loadPeserta() {
            $.ajax({
                url: "{{ route('monitor.registrasi.data') }}",
                type: "GET",
                success: function(res) {

                    let html = `
                    <table class="table table-bordered table-striped align-middle">
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

                    res.forEach((item, i) => {

                        // GREEN if absensi == 1
                        let rowClass = item.absensi == 1
                            ? 'registered'
                            : 'not-registered';

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
                },
                error: function() {
                    $("#pesertaContainer").html(`
                        <div class="alert alert-danger text-center">Gagal memuat data.</div>
                    `);
                }
            });
        }
        loadPeserta();
        setInterval(loadPeserta, 3000);
    </script>
</body>

</html>
