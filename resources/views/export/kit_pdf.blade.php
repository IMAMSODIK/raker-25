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

    <h2>DAFTAR PENERIMAAN KIT PESERTA KONSINYERING BOPTN 2025</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Pangkat</th>
                <th>Jabatan</th>
                <th>Satker</th>
                <th>Foto</th>
                <th>Penerimaan Kit</th>
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
                        @if($p->foto)
                            <img src="{{ public_path('storage/' . $p->foto) }}" class="foto">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($p->kit)
                            ID Card: {{ $p->kit->id_card ? '[v]' : '[v]' }} <br>
                            Tas: {{ $p->kit->tas ? '[v]' : '[v]' }} <br>
                            Topi: {{ $p->kit->topi ? '[v]' : '[v]' }} <br>
                            Baju: {{ $p->kit->baju ? '[v]' : '[v]' }}
                        @else
                            ID Card: [v]<br>
                            Tas: [v]<br>
                            Topi: [v]<br>
                            Baju: [v]
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
