<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Header, Hero & DataTable</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Header Styles */
        .top-bar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .top-bar.scrolled {
            padding: 10px 0;
            background-color: rgba(255, 255, 255, 0.98);
        }

        .logo {
            font-weight: 700;
            font-size: 1.8rem;
            color: #2c3e50;
            text-decoration: none;
        }

        .nav-link {
            color: #2c3e50;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: #029a13;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #02790f;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-custom {
            background-color: #029a13;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
        }

        .btn-custom:hover {
            background-color: #02790f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #02790f 0%, #2c3e50 100%);
            color: white;
            padding: 120px 0 80px;
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url({{ asset('own_assets/images/banner.jpg') }}) no-repeat center center;
            background-size: cover;
            opacity: 0.2;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-btn {
            background-color: white;
            color: #02790f;
            border-radius: 30px;
            padding: 12px 35px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            border: none;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .hero-btn:hover {
            background-color: rgb(66, 66, 66);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 37, 37, 0.7);
        }

        .hero-btn-outline {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .hero-btn-outline:hover {
            background-color: white;
            color: #02790f;
        }

        .hero-image-container {
            position: relative;
            text-align: center;
        }

        .hero-image {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: float 4s ease-in-out infinite;
            transition: all 0.5s;
        }

        .hero-image:hover {
            transform: scale(1.02);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Data Table Section */
        .data-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: #2c3e50;
            font-weight: 700;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .dataTables_wrapper {
            margin-top: 20px;
        }

        .table th {
            background-color: #02790f;
            color: white;
            border: none;
            padding: 15px;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #e9ecef;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-btn {
            padding: 5px 10px;
            margin: 0 3px;
            border-radius: 5px;
            border: none;
            transition: all 0.3s;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-view {
            background-color: #02790f;
            color: white;
        }

        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.3rem;
            }

            .hero-section {
                padding: 100px 0 60px;
                text-align: center;
            }

            .hero-image {
                margin-top: 40px;
            }

            .hero-btn {
                display: block;
                width: 100%;
                margin-bottom: 15px;
            }

            .table-container {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header Top Bar -->
    <header class="top-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand logo" href="#">
                        <img src="{{ asset('own_assets/logo/logo.png') }}" alt="" width="200px" srcset="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" href="#">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Analisis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Laporan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Tentang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Kontak</a>
                            </li> --}}
                        </ul>
                        <a href="/pendaftaran" class="btn btn-custom ms-lg-3">Pendaftaran</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">KONSINYERING PENYUSUNAN JUKNIS PENGGUNAAN BOPTN KEMENTRIAN AGAMA RI</h1>
                    <p class="hero-subtitle">HOTEL POLONIA MEDAN, 24 - 27 NOVEMBER 2025</p>
                    <div class="d-flex flex-wrap">
                        <a href="/registrasi" class="btn hero-btn">Registrasi</a>
                        <a href="/absensi" class="btn hero-btn hero-btn-outline">Absensi</a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-container">
                    <img src="{{ asset('own_assets/images/flayer.jpeg') }}" alt="Analisis Data" class="hero-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Data Table Section -->
    <section class="data-section">
        <div class="container">
            <h2 class="section-title">Data Peserta</h2>
            <div class="table-container table-responsive">
                <table id="dataTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Peserta</th>
                            <th class="text-center align-middle" style="width: 15%">Satuan Kerja</th>
                            <th class="text-center align-middle">Pangkat</th>
                            <th class="text-center align-middle" style="width: 15%">Jabatan</th>
                            <th class="text-center align-middle" style="width: 18%">Waktu Kedatangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($peserta as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index++ }}</td>
                                <td class="align-middle">
                                    <div class="row align-items-center">

                                        <!-- Foto -->
                                        <div class="col-4 text-center">
                                            <img width="50%" src="{{ asset('storage') . '/' . $item->foto }}"
                                                class="img-fluid rounded" alt="Foto">
                                        </div>

                                        <!-- Nama & NIP -->
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong>{{ $item->nama }}</strong>
                                                </div>
                                                <div class="col-12">
                                                    <small>NIP: {{ $item->nip }}</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                                <td class="align-middle">{{ $item->satker }}</td>
                                <td class="text-center align-middle">{{ $item->pangkat }}</td>
                                <td class="align-middle">{{ $item->jabatan }}</td>
                                <td class="text-center align-middle">
                                    {{-- Tanggal --}}
                                    @if ($item->tanggal_kedatangan)
                                        {{ \Carbon\Carbon::parse($item->tanggal_kedatangan)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif

                                    <br>

                                    {{-- Jam --}}
                                    @if ($item->jam_kedatangan)
                                        {{ \Carbon\Carbon::parse($item->jam_kedatangan)->format('H:i') }}
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="data-section">
        <div class="container">
            <h2 class="section-title">Data Registrasi Peserta</h2>
            <div class="table-container table-responsive">
                <table id="dataTable2" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peserta</th>
                            <th>Satuan Kerja</th>
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Status Registrasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach ($peserta as $item)
                            @if (is_null($item->time_registrasi))
                                @continue
                            @endif

                            <tr>
                                <td class="text-center align-middle">{{ $index++ }}</td>
                                <td class="align-middle">
                                    <div class="row align-items-center">

                                        <!-- Foto -->
                                        <div class="col-4 text-center">
                                            <img width="50%" src="{{ asset('storage') . '/' . $item->foto }}"
                                                class="img-fluid rounded" alt="Foto">
                                        </div>

                                        <!-- Nama & NIP -->
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong>{{ $item->nama }}</strong>
                                                </div>
                                                <div class="col-12">
                                                    <small>NIP: {{ $item->nip }}</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                                <td class="align-middle">{{ $item->satker }}</td>
                                <td class="text-center align-middle">{{ $item->pangkat }}</td>
                                <td class="align-middle">{{ $item->jabatan }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-success">
                                        Sudah Registrasi<br>
                                        <small>{{ \Carbon\Carbon::parse($item->time_registrasi)->format('d-m-Y H:i') }}</small>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="data-section">
        <div class="container">
            <h2 class="section-title">Data Absensi Peserta</h2>
            <div class="table-container table-responsive">
                <table id="dataTable3" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">No</th>
                            <th rowspan="2" class="text-center align-middle">Peserta</th>
                            <th rowspan="2" class="text-center align-middle">Satuan Kerja</th>
                            <th rowspan="2" class="text-center align-middle">Pangkat</th>
                            <th rowspan="2" class="text-center align-middle">Jabatan</th>
                            <th colspan="4" class="text-center align-middle">Absensi</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">24 Nov</th>
                            <th class="text-center align-middle">25 Nov</th>
                            <th class="text-center align-middle">26 Nov</th>
                            <th class="text-center align-middle">27 Nov</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp

                        @foreach ($peserta as $p)
                            {{-- Hanya tampilkan yang sudah registrasi --}}
                            @if (is_null($p->time_registrasi))
                                @continue
                            @endif

                            <tr>
                                <td class="text-center align-middle">{{ $index++ }}</td>

                                <td class="align-middle">
                                    <div class="row align-items-center">

                                        <!-- Foto -->
                                        <div class="col-4 text-center">
                                            <img width="50%" src="{{ asset('storage') . '/' . $item->foto }}"
                                                class="img-fluid rounded" alt="Foto">
                                        </div>

                                        <!-- Nama & NIP -->
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong>{{ $item->nama }}</strong>
                                                </div>
                                                <div class="col-12">
                                                    <small>NIP: {{ $item->nip }}</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </td>

                                <td class="align-middle">{{ $p->satker }}</td>
                                <td class="text-center align-middle">{{ $p->pangkat }}</td>
                                <td class="align-middle">{{ $p->jabatan }}</td>

                                {{-- Absensi 24 Nov --}}
                                <td class="text-center align-middle">
                                    @if ($p->time_absensi1)
                                        <span class="badge bg-success">
                                            Hadir<br>
                                            <small>{{ \Carbon\Carbon::parse($p->time_absensi1)->format('H:i') }}</small>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- Absensi 25 Nov --}}
                                <td class="text-center align-middle">
                                    @if ($p->time_absensi2)
                                        <span class="badge bg-success">
                                            Hadir<br>
                                            <small>{{ \Carbon\Carbon::parse($p->time_absensi2)->format('H:i') }}</small>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- Absensi 26 Nov --}}
                                <td class="text-center align-middle">
                                    @if ($p->time_absensi3)
                                        <span class="badge bg-success">
                                            Hadir<br>
                                            <small>{{ \Carbon\Carbon::parse($p->time_absensi3)->format('H:i') }}</small>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- Absensi 27 Nov --}}
                                <td class="text-center align-middle">
                                    @if ($p->time_absensi4)
                                        <span class="badge bg-success">
                                            Hadir<br>
                                            <small>{{ \Carbon\Carbon::parse($p->time_absensi4)->format('H:i') }}</small>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </section>

    <section class="data-section">
        <div class="container">
            <h2 class="section-title">Data Kit Peserta</h2>
            <div class="table-container table-responsive">
                <table id="dataTableKit" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">No</th>
                            <th rowspan="2" class="text-center align-middle">Peserta</th>
                            <th rowspan="2" class="text-center align-middle">Satuan Kerja</th>
                            <th rowspan="2" class="text-center align-middle">Pangkat</th>
                            <th rowspan="2" class="text-center align-middle">Jabatan</th>
                            <th colspan="4" class="text-center align-middle">Kit</th>
                        </tr>
                        <tr>
                            <th class="teMaxt-center align-middle">ID Card</th>
                            <th class="text-center align-middle">Topi</th>
                            <th class="text-center align-middle">Baju</th>
                            <th class="text-center align-middle">Tas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @foreach ($peserta as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $no++ }}</td>

                                {{-- Kolom Peserta --}}
                                <td class="align-middle">
                                    <div class="row align-items-center">

                                        <div class="col-4 text-center">
                                            <img width="50%" src="{{ asset('storage') . '/' . $item->foto }}"
                                                class="img-fluid rounded" alt="Foto">
                                        </div>

                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12"><strong>{{ $item->nama }}</strong></div>
                                                <div class="col-12"><small>NIP: {{ $item->nip }}</small></div>
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td class="align-middle">{{ $item->satker }}</td>
                                <td class="text-center align-middle">{{ $item->pangkat }}</td>
                                <td class="align-middle">{{ $item->jabatan }}</td>

                                {{-- KIT: ID Card --}}
                                <td class="text-center align-middle">
                                    @if ($item->kit && $item->kit->id_card)
                                        <span class="badge bg-success">Sudah</span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- KIT: Topi --}}
                                <td class="text-center align-middle">
                                    @if ($item->kit && $item->kit->topi)
                                        <span class="badge bg-success">Sudah</span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- KIT: Baju --}}
                                <td class="text-center align-middle">
                                    @if ($item->kit && $item->kit->baju)
                                        <span class="badge bg-success">Sudah</span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                                {{-- KIT: Tas --}}
                                <td class="text-center align-middle">
                                    @if ($item->kit && $item->kit->tas)
                                        <span class="badge bg-success">Sudah</span>
                                    @else
                                        <span class="badge bg-danger">Belum</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="data-section">
        <div class="container">
            <h2 class="section-title mb-4">Data Materi Raker</h2>

            @foreach ($materi as $m)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <h5 class="card-title mb-1">{{ $m->nama_materi }}</h5>
                            <small class="text-muted">
                                Diunggah: {{ $m->created_at->format('d M Y') }}
                            </small>
                        </div>

                        <div>
                            <a href="{{ asset('storage/' . $m->file) }}" target="_blank"
                                class="btn btn-primary btn-sm">
                                Preview
                            </a>

                            <a href="{{ asset('storage/' . $m->file) }}" download class="btn btn-success btn-sm">
                                Download
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

            @if ($materi->isEmpty())
                <div class="alert alert-info text-center">Belum ada materi raker</div>
            @endif
        </div>
    </section>

    <section class="data-section">
        <div class="container">
            <h2 class="section-title mb-4">Dokumentasi Raker</h2>

            @if (count($dokumentasi) > 0)
                <div class="row">
                    @foreach ($dokumentasi as $d)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="{{ asset('storage/dokumentasi/' . $d->file) }}"
                                    class="card-img-top img-preview" data-title="{{ $d->judul }}"
                                    alt="{{ $d->judul }}"
                                    style="height: 200px; object-fit: cover; cursor: pointer;">

                                <div class="card-body">
                                    <h6 class="card-title text-center">{{ $d->judul }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    Belum ada dokumentasi raker.
                </div>
            @endif

        </div>
    </section>

    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalImageTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid rounded">
                </div>

            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>KONSINYERING PENYUSUNAN JUKNIS PENGGUNAAN BOPTN KEMENTRIAN AGAMA RI</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "responsive": true
            });

            $('#dataTable2').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "responsive": true
            });

            $('#dataTable3').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "responsive": true
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.top-bar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    <script>
        // Ketika gambar diklik
        $(document).on("click", ".img-preview", function() {
            let src = $(this).attr("src");
            let title = $(this).data("title");

            $("#modalImageTitle").text(title);
            $("#modalImage").attr("src", src);

            $("#imageModal").modal("show");
        });
    </script>

</body>

</html>
