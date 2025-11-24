<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Registrasi Tamu</title>
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
        .btn-reset-signature {
            background-color: #e63946;
            color: white;
            padding: 10px 18px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.25s ease-in-out;
            box-shadow: 0px 3px 8px rgba(230, 57, 70, 0.3);
            width: 100%;
        }

        .btn-reset-signature:hover {
            background-color: #d62839;
            /* sedikit lebih gelap */
            box-shadow: 0px 4px 10px rgba(214, 40, 57, 0.4);
        }

        .btn-reset-signature:active {
            transform: scale(0.97);
        }
    </style>

</head>

<body>

    <div class="container">

        @if (session('error'))
            <div
                style="padding: 12px; background:#ffdddd; border-left:4px solid #e74c3c; margin-bottom:15px; border-radius:5px;">
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

        <!-- 🔵 Flayer Paling Atas -->
        <div class="flayer-section">
            <img src="{{ asset('own_assets/images/flayer.jpeg') }}" alt="Flayer Acara" class="flayer-image">
        </div>

        <div class="form-header">
            <h1>Formulir Registrasi Peserta</h1>
            <p>Silakan lengkapi data diri Anda dengan benar</p>
        </div>

        <div style="text-align:right; margin-bottom:20px;">
            <button onclick="openSearchModal()"
                style="padding:10px 20px; background:#3498db; color:white; border:none; border-radius:6px; cursor:pointer;">
                Cari Peserta
            </button>
        </div>

        <!-- 🔍 Popup Search Modal -->
        <div id="searchModal" class="modal">
            <div class="modal-content">
                <h3>Cari Data Peserta</h3>

                <input type="text" id="searchInput" onkeyup="filterPeserta()" placeholder="Cari nama atau NIP..."
                    class="search-field">

                <ul id="pesertaList" class="peserta-list">
                    @foreach ($peserta as $p)
                        <li
                            onclick="pilihPeserta('{{ $p->nama }}','{{ $p->nip }}','{{ $p->satker }}','{{ $p->foto }}','{{ $p->no_hp }}','{{ $p->pangkat }}','{{ $p->jabatan }}')">
                            <strong>{{ $p->nama }}</strong><br>
                            <small>NIP: {{ $p->nip }}</small><br>
                            <small>Satuan Kerja: {{ $p->satker }}</small>
                        </li>
                    @endforeach
                </ul>

                <button onclick="closeSearchModal()" class="close-btn">Tutup</button>
            </div>
        </div>

        <form action="/registrasi" method="POST">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" id="nama" name="nama" readonly class="form-control">

            <label>NIP</label>
            <input type="text" id="nip" name="nip" readonly class="form-control">

            <label>No. Handphone</label>
            <input type="text" id="no_hp" name="no_hp" readonly class="form-control">

            <label>Pangkat</label>
            <input type="text" id="pangkat" name="pangkat" readonly class="form-control">

            <label>Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" readonly class="form-control">

            <label>Satuan Kerja</label>
            <input type="text" id="satker" name="satker" readonly class="form-control">

            <label>Foto</label><br>
            <img id="previewFoto" src=""
                style="width:130px; border-radius:8px; border:1px solid #ccc; margin-bottom:30px;">

            <hr style="margin-bottom:30px;">

            <label>Email</label>
            <input type="email" id="email" name="email" required class="form-control">

            <label>Pendidikan Terakhir</label>
            <input type="text" id="pt" name="pt" required class="form-control">

            <label>Tanda Tangan</label>
            <div style="width:100%; max-width:500px;">
                <canvas id="signaturePad" style="border:1px solid #000; width:100%; height:auto;"></canvas>
            </div>

            <button type="button" onclick="resetSignature()" class="btn-reset-signature">
                Reset Tanda Tangan
            </button>


            <input type="hidden" name="tanda_tangan" id="tanda_tangan">

            <button type="submit" onclick="saveSignature()"
                style="padding:10px 20px; background:#27ae60; color:white; border:none; border-radius:6px; cursor:pointer; width:100%; margin-top:20px;">
                Simpan Registrasi
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

        function pilihPeserta(nama, nip, satker, foto, no_hp, pangkat, jabatan) {
            document.getElementById("nama").value = nama;
            document.getElementById("nip").value = nip;
            document.getElementById("satker").value = satker;

            document.getElementById("no_hp").value = no_hp;
            document.getElementById("pangkat").value = pangkat;
            document.getElementById("jabatan").value = jabatan;
            document.getElementById("previewFoto").src = "/storage/" + foto;

            closeSearchModal();
        }
    </script>

    <script>
        let canvas = document.getElementById("signaturePad");
        let ctx = canvas.getContext("2d");

        // =====================================================
        // Resize Canvas Responsive
        // =====================================================
        function resizeCanvas() {
            const width = canvas.offsetWidth;
            const height = 200;
            canvas.width = width;
            canvas.height = height;

            ctx.lineWidth = 5;
            ctx.lineCap = "round";
            ctx.strokeStyle = "#000";
        }
        resizeCanvas();

        window.addEventListener("resize", resizeCanvas);

        // =====================================================
        // Drawing
        // =====================================================
        let drawing = false;

        // Prevent Scroll on Touch
        ["touchstart", "touchmove", "touchend"].forEach(ev => {
            canvas.addEventListener(ev, function(e) {
                e.preventDefault(); // ⛔ STOP SCROLLING
            }, {
                passive: false
            });
        });

        // Mouse
        canvas.addEventListener("mousedown", () => drawing = true);
        canvas.addEventListener("mouseup", () => {
            drawing = false;
            ctx.beginPath();
        });
        canvas.addEventListener("mousemove", draw);

        // Touch
        canvas.addEventListener("touchstart", () => drawing = true);
        canvas.addEventListener("touchend", () => {
            drawing = false;
            ctx.beginPath();
        });
        canvas.addEventListener("touchmove", drawTouch);

        function draw(e) {
            if (!drawing) return;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        }

        function drawTouch(e) {
            if (!drawing) return;

            let rect = canvas.getBoundingClientRect();
            let x = e.touches[0].clientX - rect.left;
            let y = e.touches[0].clientY - rect.top;

            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        // =====================================================
        // Save Signature
        // =====================================================
        function saveSignature() {
            document.getElementById("tanda_tangan").value = canvas.toDataURL("image/png");
        }

        // =====================================================
        // Reset Signature
        // =====================================================
        function resetSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.beginPath();
            document.getElementById("tanda_tangan").value = "";
        }
    </script>



</body>

</html>
