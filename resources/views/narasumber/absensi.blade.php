@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Absensi Narasumber</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Absensi Narasumber</li>
                        <li class="breadcrumb-item active">Absensi Narasumber</li>
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
                                        <th>Narasumber</th>
                                        <th>Satuan Kerja</th>
                                        <th>Pangkat</th>
                                        <th>Jabatan</th>
                                        <th>24 Nov</th>
                                        <th>25 Nov</th>
                                        <th>26 Nov</th>
                                        <th>27 Nov</th>
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

                                            <td class="text-center">
                                                @if ($item->time_absensi1)
                                                    <span class="badge bg-success">
                                                        {{ \Carbon\Carbon::parse($item->time_absensi1)->format('d-m-Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">Belum Absen</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($item->time_absensi2)
                                                    <span class="badge bg-success">
                                                        {{ \Carbon\Carbon::parse($item->time_absensi2)->format('d-m-Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">Belum Absen</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($item->time_absensi3)
                                                    <span class="badge bg-success">
                                                        {{ \Carbon\Carbon::parse($item->time_absensi3)->format('d-m-Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">Belum Absen</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($item->time_absensi4)
                                                    <span class="badge bg-success">
                                                        {{ \Carbon\Carbon::parse($item->time_absensi4)->format('d-m-Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">Belum Absen</span>
                                                @endif
                                            </td>



                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm editAbsensi"
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
                    <h5 class="modal-title">Edit Absensi Narasumber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="absensi_id">

                    <div class="mb-3">
                        <label>24 November</label>
                        <select id="absensi1" class="form-select">
                            <option value="">Tidak Hadir</option>
                            <option value="1">Hadir</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>25 November</label>
                        <select id="absensi2" class="form-select">
                            <option value="">Tidak Hadir</option>
                            <option value="1">Hadir</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>26 November</label>
                        <select id="absensi3" class="form-select">
                            <option value="">Tidak Hadir</option>
                            <option value="1">Hadir</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>27 November</label>
                        <select id="absensi4" class="form-select">
                            <option value="">Tidak Hadir</option>
                            <option value="1">Hadir</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="saveAbsensi">Simpan</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                autoWidth: false
            });

            $('.editAbsensi').on('click', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: "/absensi/get",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {

                        $('#absensi_id').val(res.id);

                        $('#absensi1').val(res.time_absensi1 ? 1 : "");
                        $('#absensi2').val(res.time_absensi2 ? 1 : "");
                        $('#absensi3').val(res.time_absensi3 ? 1 : "");
                        $('#absensi4').val(res.time_absensi4 ? 1 : "");

                        $('#modalAbsensi').modal('show');
                    }
                });

            });


            // Simpan
            $('#saveAbsensi').on('click', function() {

                let id = $('#absensi_id').val();

                $.ajax({
                    url: "/absensi/update/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        abs1: $('#absensi1').val(),
                        abs2: $('#absensi2').val(),
                        abs3: $('#absensi3').val(),
                        abs4: $('#absensi4').val(),
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
