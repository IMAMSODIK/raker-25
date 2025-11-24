@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Pembayaran</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Absensi Peserta</li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row size-column">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-container table-responsive">
                            <table id="tableAbsensi" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Peserta</th>
                                        <th>Satuan Kerja</th>
                                        <th>Pangkat</th>
                                        <th>Jabatan</th>
                                        <th>Jumlah Malam</th>
                                        <th>Tipe Kamar</th>
                                        <th>Total</th>
                                        <th>Status Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>

                                            <!-- Peserta -->
                                            <td class="align-middle">
                                                <strong>{{ $item->nama }}</strong><br>
                                                <small>NIP: {{ $item->nip }}</small>
                                            </td>

                                            <td>{{ $item->satker }}</td>
                                            <td class="text-center">{{ $item->pangkat }}</td>
                                            <td>{{ $item->jabatan }}</td>

                                            <td>Jumlah Malam</td>
                                            <td>Tipe Kamar</td>
                                            <td>Total</td>
                                            <td>Status Bayar</td>

                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm edit"
                                                    data-id="{{ $item->id }}">
                                                    Edit
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAbsensi" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Pembayaran Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="absensi_id">

                    <div class="mb-3">
                        <label>Nama Peserta</label>
                        <input type="text" class="form-control" id="nama" readonly>
                    </div>

                    <div class="mb-3">
                        <label>NIP Peserta</label>
                        <input type="text" class="form-control" id="nip" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Tipe Kamar</label>
                        <input type="text" class="form-control" id="status_kamar" readonly>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label>Lama Menginap</label>
                                <input type="text" class="form-control" id="durasi">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label>Harga Permalam</label>
                                <input type="text" class="form-control" id="harga_permalam" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label>Total Harga</label>
                                <input type="text" class="form-control" id="total_harga" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Metode Pembayaran</label>
                        <select class="form-select" id="metode">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="bb">
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="saveAbsensi">Simpan Pembayaran</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatRupiah(angka) {
            return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $(document).ready(function() {
            $('#tableAbsensi').DataTable({
                responsive: true,
                autoWidth: false
            });

            $("#durasi").on("input", function(){
                let val = $("#durasi").val();
                let harga = $("#harga_permalam").val();
                let angka = parseInt(harga.replace(/[^0-9]/g, ""));

                $("#total_harga").val(formatRupiah(val * angka));
            })

            $(document).on("click", ".edit", function(){
                let id = $(this).data('id');

                $.ajax({
                    url: "/pembayaran/get",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let status_kamar = res.status_kamar += " ";
                        status_kamar += (res.status_kamar == 'Single') ? '(Rp. 699.000)' : '(Rp. 930.000)';
                        $('#absensi_id').val(res.id);
                        $("#nama").val(res.nama);
                        $("#nip").val(res.nip);
                        $("#status_kamar").val(status_kamar);
                        $("#harga_permalam").val((res.status_kamar == 'Single') ? '(Rp. 699.000)' : '(Rp. 930.000)')

                        $('#modalAbsensi').modal('show');
                    },
                    error: function() {
                        Swal.fire("Error", "Gagal mengambil data", "error");
                    }
                });
            })

            // Simpan
            $('#saveAbsensi').on('click', function() {

                let id = $('#absensi_id').val();

                $.ajax({
                    url: "/pembayaran/update/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        jumlah_malam: $('#durasi').val(),
                        metode_bayar: $('#metode').val(),
                        bukti_bayar: $('#bb').val(),
                    },
                    success: function(res) {
                        Swal.fire("Berhasil", res.message, "success").then(() => location
                            .reload());
                    },
                    error: function() {
                        Swal.fire("Error", "Gagal menyimpan absensi", "error");
                    }
                });

            });

        });
    </script>
@endsection
