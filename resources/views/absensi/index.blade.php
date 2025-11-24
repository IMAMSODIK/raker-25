<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Absensi Tamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .flayer-section {
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .flayer-image {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }

        .form-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .form-section h2 {
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .btn-submit {
            background-color: var(--success);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .file-name {
            font-size: 0.9rem;
            margin-top: 10px;
        }

        #previewImage {
            margin-top: 15px;
            max-width: 200px;
            display: none;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .price-note {
            margin-top: 4px;
            font-size: 0.9rem;
            color: #6c757d;
            font-style: italic;
        }
    </style>

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
        }

        .search-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .peserta-list {
            max-height: 250px;
            overflow-y: auto;
            padding: 0;
            list-style: none;
        }

        .peserta-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .peserta-list li:hover {
            background: #f0f0f0;
        }

        .close-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>

    <style>
        .camera-wrapper {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
            text-align: center;
        }

        /* VIDEO CAMERA */
        #camera {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 10px;
            background: #000;
        }

        /* PREVIEW PHOTO */
        .photo-preview {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
        }

        /* BUTTON */
        .btn-capture {
            margin-top: 15px;
            padding: 12px 20px;
            background: #e67e22;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            font-size: 16px;
        }

        /* MOBILE ADJUSTMENT */
        @media (max-width: 480px) {
            .camera-wrapper {
                max-width: 100%;
            }

            #camera,
            .photo-preview {
                aspect-ratio: 3/4;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        @if (session('error'))
            <div style="padding: 12px; background:#ffdddd; border-left:4px solid #e74c3c; margin-bottom:15px; border-radius:5px;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                style="padding: 12px; background:#fff3cd; border-left:4px solid #f1c40f; margin-bottom:15px; border-radius:5px;">
                <strong>Periksa kembali input Anda:</strong>
                <ul style="margin-top:8px; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div
                style="padding: 12px; background:#d4edda; border-left:4px solid #27ae60; margin-bottom:15px; border-radius:5px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="flayer-section">
            <img src="{{ asset('own_assets/images/flayer.jpeg') }}" alt="Flayer Acara" class="flayer-image">
        </div>

        <div class="form-header">
            <h1>Formulir Absensi Peserta</h1>
        </div>

        <div style="text-align:right; margin-bottom:20px;">
            <button onclick="openSearchModal()"
                style="padding:10px 20px; background:#3498db; color:white; border:none; border-radius:6px; cursor:pointer;">
                Cari Peserta
            </button>
        </div>

        <div id="searchModal" class="modal">
            <div class="modal-content">
                <h3>Cari Data Peserta</h3>

                <input type="text" id="searchInput" onkeyup="filterPeserta()" placeholder="Cari nama atau NIP..."
                    class="search-field">

                <ul id="pesertaList" class="peserta-list">
                    @foreach ($peserta as $p)
                        <li
                            onclick="pilihPeserta('{{ $p->nama }}','{{ $p->nip }}','{{ $p->satker }}','{{ $p->foto }}')">
                            <strong>{{ $p->nama }}</strong><br>
                            <small>NIP: {{ $p->nip }}</small>
                        </li>
                    @endforeach
                </ul>

                <button onclick="closeSearchModal()" class="close-btn">Tutup</button>
            </div>
        </div>

        <form id="absensiForm">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" id="nama" name="nama" readonly class="form-control">

            <label>NIP</label>
            <input type="text" id="nip" name="nip" readonly class="form-control">

            <label>Satuan Kerja</label>
            <input type="text" id="satker" name="satker" readonly class="form-control">

            <label>Foto Absensi</label>

            <div class="camera-wrapper">
                <video id="camera" autoplay playsinline></video>
                <canvas id="canvas" style="display:none;"></canvas>
                <img id="photoResult" class="photo-preview" style="display:none;">

                <button type="button" class="btn-capture" onclick="takePhoto()">
                    Ambil Foto
                </button>
                <input type="hidden" id="foto_absensi" name="foto_absensi">
            </div>


            <button type="submit" style="padding:10px 20px; background:#27ae60; color:white; border:none; border-radius:6px; cursor:pointer; width:100%; margin-top:20px;">
                Simpan Absensi Hari Ini
            </button>
        </form>

    </div>

    <script>
        function openSearchModal() {
            document.getElementById("searchModal").style.display = "flex";
        }

        function closeSearchModal() {
            document.getElementById("searchModal").style.display = "none";
        }

        function filterPeserta() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let li = document.querySelectorAll("#pesertaList li");

            li.forEach(item => {
                item.style.display = item.innerText.toLowerCase().includes(input) ? "" : "none";
            });
        }

        function pilihPeserta(nama, nip, satker, foto) {
            document.getElementById("nama").value = nama;
            document.getElementById("nip").value = nip;
            document.getElementById("satker").value = satker;

            closeSearchModal();
        }
    </script>

    <script>
        let cameraStream;

        // Aktifkan kamera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                cameraStream = stream;
                document.getElementById("camera").srcObject = stream;
            })
            .catch(err => {
                alert("Kamera tidak dapat diakses: " + err);
            });

        function takePhoto() {
            let video = document.getElementById("camera");
            let canvas = document.getElementById("canvas");
            let photoResult = document.getElementById("photoResult");

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            let ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            let data = canvas.toDataURL("image/png");

            photoResult.src = data;
            photoResult.style.display = "block";
            document.getElementById("foto_absensi").value = data;
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("#absensiForm").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                url: "/absensi",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res) {
                    alert(res.message);
                    location.reload();
                },
                error: function(err) {
                    alert("Gagal menyimpan absensi!");
                    console.log(err);
                }
            });
        });
    </script>

</body>

</html>
