<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th { background: #f2f2f2; padding: 6px; text-align: center; }
        td { padding: 4px; }
        .foto { width: 60px; height: 70px; object-fit: cover; }
        h2 { text-align: center; margin-bottom: 0; }
    </style>
</head>
<body>

    <h2>DAFTAR ABSENSI PESERTA KONSINYERING BOPTN 2025</h2>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Pangkat</th>
                <th rowspan="2">Jabatan</th>
                <th rowspan="2">Satker</th>
                <th rowspan="2">Registrasi</th>
                <th colspan="4">Absensi</th>
            </tr>
            <tr>
                <th>25</th>
                <th>26</th>
                <th>27</th>
                <th>28</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesertas as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->pangkat }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ $p->satker }}</td>

                    <td>
                        @if($p->time_registrasi)
                            Sudah Registrasi
                        @else
                            Belum Registrasi
                        @endif
                    </td>

                    <td>
                        @if($p->time_absensi1)
                            <img src="{{ public_path($p->ttd) }}" class="foto">
                            {{ $p->time_absensi1 ? \Carbon\Carbon::parse($p->time_absensi1)->format('Y-m-d H:i') : '-' }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($p->time_absensi2)
                            <img src="{{ public_path($p->ttd) }}" class="foto">
                            {{ $p->time_absensi2 ? \Carbon\Carbon::parse($p->time_absensi2)->addHours(7)->format('Y-m-d H:i') : '-' }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($p->time_absensi3)
                            <img src="{{ public_path($p->ttd) }}" class="foto">
                            {{ $p->time_absensi3 ? \Carbon\Carbon::parse($p->time_absensi3)->addHours(31)->format('Y-m-d H:i') : '-' }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($p->time_absensi4)
                            <img src="{{ public_path($p->ttd) }}" class="foto">
                            {{ $p->time_absensi4 ? \Carbon\Carbon::parse($p->time_absensi4)->addHours(31)->format('Y-m-d H:i') : '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
