<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kedatangan Tamu</title>
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
            <h1>Formulir Kedatangan Tamu</h1>
            <p>Silakan lengkapi data diri Anda dengan benar</p>
        </div>

        <form action="/pendaftaran" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-container">

                <!-- Kolom Kiri -->
                <div class="form-section">
                    <h2>Data Pribadi</h2>

                    <div class="form-group">
                        <label class="required">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label class="required">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip') }}" class="form-control"
                            placeholder="Masukkan NIP (maksimal 20 digit)" maxlength="20" required>
                    </div>

                    <div class="form-group">
                        <label class="required">Pangkat / Golongan</label>
                        <select name="pangkat" class="form-control" value="{{ old('pangkat') }}" required>
                            <option value="II/A" {{ old('pangkat')=='II/A' ? 'selected' : '' }}>II/A</option>
                            <option value="II/B" {{ old('pangkat')=='II/B' ? 'selected' : '' }}>II/B</option>
                            <option value="II/C" {{ old('pangkat')=='II/C' ? 'selected' : '' }}>II/C</option>
                            <option value="II/D" {{ old('pangkat')=='II/D' ? 'selected' : '' }}>II/D</option>
                            <option value="III/A" {{ old('pangkat')=='III/A' ? 'selected' : '' }}>III/A</option>
                            <option value="III/B" {{ old('pangkat')=='III/B' ? 'selected' : '' }}>III/B</option>
                            <option value="III/C" {{ old('pangkat')=='III/C' ? 'selected' : '' }}>III/C</option>
                            <option value="III/D" {{ old('pangkat')=='III/D' ? 'selected' : '' }}>III/D</option>
                            <option value="IV/A" {{ old('pangkat')=='IV/A' ? 'selected' : '' }}>IV/A</option>
                            <option value="IV/B" {{ old('pangkat')=='IV/B' ? 'selected' : '' }}>IV/B</option>
                            <option value="IV/C" {{ old('pangkat')=='IV/C' ? 'selected' : '' }}>IV/C</option>
                            <option value="IV/D" {{ old('pangkat')=='IV/D' ? 'selected' : '' }}>IV/D</option>
                            <option value="IV/E" {{ old('pangkat')=='IV/E' ? 'selected' : '' }}>IV/E</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="required">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" class="form-control"
                            placeholder="Masukkan Jabatan" required>
                    </div>

                    <div class="form-group">
                        <label class="required">Satuan Kerja</label>
                        <input type="text" id="satker" name="satker" class="form-control" value="{{ old('satker') }}"
                            placeholder="Masukkan Satuan Kerja" required>
                    </div>

                    <div class="form-group">
                        <label class="required">Ukuran Baju</label>
                        <select id="ukuranBaju" name="ukuranBaju" class="form-control" required>
                            <option value="">Pilih ukuran</option>
                            <option value="S"  {{ old('ukuranBaju')=='S' ? 'selected' : '' }}>S</option>
                            <option value="M"  {{ old('ukuranBaju')=='M' ? 'selected' : '' }}>M</option>
                            <option value="L"  {{ old('ukuranBaju')=='L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('ukuranBaju')=='XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('ukuranBaju')=='XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ old('ukuranBaju')=='XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="required">Upload Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*" required>
                        <div id="fileName" class="file-name">Belum ada file yang dipilih</div>
                        <img id="previewImage">
                    </div>

                </div>

                <!-- Kolom Kanan -->
                <div class="form-section">
                    <h2>Informasi Kedatangan</h2>

                    <div class="form-group">
                        <label class="required">Tanggal Kedatangan</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="required">Jam Kedatangan</label>
                        <input type="time" name="jam" value="{{ old('jam') }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="required">Maskapai / Armada</label>
                        <select name="maskapai" class="form-control" value="{{ old('maskapai') }}" required>
                            <option value="Garuda Indonesia" {{ old('maskapai')=='S' ? 'selected' : '' }}>Garuda Indonesia</option>
                            <option value="Citilink" {{ old('maskapai')=='Citilink' ? 'selected' : '' }}>Citilink</option>
                            <option value="Lion Air" {{ old('maskapai')=='Lion Air' ? 'selected' : '' }}>Lion Air</option>
                            <option value="Batik Air" {{ old('maskapai')=='Batik Air' ? 'selected' : '' }}>Batik Air</option>
                            <option value="Sriwijaya Air" {{ old('maskapai')=='Sriwijaya Air' ? 'selected' : '' }}>Sriwijaya Air</option>
                            <option value="Super Air Jet" {{ old('maskapai')=='Super Air Jet' ? 'selected' : '' }}>Super Air Jet</option>
                            <option value="Wings Air" {{ old('maskapai')=='Wings Air' ? 'selected' : '' }}>Wings Air</option>
                            <option value="Pelita Air" {{ old('maskapai')=='Pelita Air' ? 'selected' : '' }}>Pelita Air</option>
                            <option value="Nam Air" {{ old('maskapai')=='Nam Air' ? 'selected' : '' }}>Nam Air</option>
                            <option value="TransNusa" {{ old('maskapai')=='TransNusa' ? 'selected' : '' }}>TransNusa</option>
                            <option value="Lainnya" {{ old('maskapai')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="required">Status Kamar</label>
                        <select name="kamar" class="form-control" value="{{ old('kamar') }}" required>
                            <option value="Single" {{ old('kamar')=='Single' ? 'selected' : '' }}>Single</option>
                            <option value="Twin" {{ old('kamar')=='Twin' ? 'selected' : '' }}>Twin</option>
                        </select>
                    </div>

                </div>

            </div>

            <button class="btn-submit" type="submit">Kirim Formulir</button>
        </form>
    </div>


    <script>
        // 🔒 NIP hanya angka
        document.getElementById('nip').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 20);
        });

        // 📷 Preview gambar setelah upload
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const fileName = file ? file.name : 'Belum ada file yang dipilih';
            document.getElementById('fileName').textContent = fileName;

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('previewImage');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
