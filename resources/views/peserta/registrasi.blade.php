@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Registrasi Peserta</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Registrasi Peserta</li>
                        <li class="breadcrumb-item active">Registrasi Peserta</li>
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
                            <table id="dataTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Peserta</th>
                                        <th class="text-center align-middle">No. Handphone</th>
                                        <th class="text-center align-middle" style="width: 15%">Satuan Kerja</th>
                                        <th class="text-center align-middle">Pangkat</th>
                                        <th class="text-center align-middle">Jabatan</th>
                                        <th class="text-center align-middle">Email</th>
                                        <th class="text-center align-middle">Pendidikan Terakhir</th>
                                        <th class="text-center align-middle">Status Registrasi</th>
                                        <th class="text-center align-middle">Tandan Tangan</th>
                                        <th class="text-center align-middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $index = 1; @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ $index++ }}</td>
                                            <td class="align-middle">
                                                <div class="row align-items-center">

                                                    <!-- Foto -->
                                                    <div class="col-4 text-center">
                                                        <img width="70%" src="{{ asset('storage') . '/' . $item->foto }}"
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
                                            <td class="align-middle">{{ $item->no_hp }}</td>
                                            <td class="align-middle">{{ $item->satker }}</td>
                                            <td class="text-center align-middle">{{ $item->pangkat }}</td>
                                            <td class="align-middle">{{ $item->jabatan }}</td>
                                            <td class="align-middle">{{ $item->email }}</td>
                                            <td class="align-middle">{{ $item->pendidikan_terkahir }}</td>
                                            <td class="text-center align-middle">
                                                @if ($item->time_registrasi)
                                                    <span class="badge bg-success">
                                                        Sudah Registrasi<br>
                                                        <small>{{ \Carbon\Carbon::parse($item->time_registrasi)->format('d-m-Y H:i') }}</small>
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Belum Registrasi
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <img width="100%" src="{{ asset('') . $item->ttd }}"
                                                        class="img-fluid rounded" alt="Tandan Tangan">
                                            </td>
                                            <td class="text-center align-middle">

                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-sm btn-warning edit"
                                                        data-id="{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                </div>

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

    <div class="modal fade" id="modalEditRegistrasi" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Status Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label>Status Registrasi</label>
                        <select id="edit_status" class="form-select">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Sudah Registrasi</option>
                            <option value="0">Belum Registrasi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Registrasi</label>
                        <input type="date" id="edit_tanggal" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Jam Registrasi</label>
                        <input type="time" id="edit_jam" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="btnUpdateRegistrasi">Simpan</button>
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

            $(document).on("click", ".edit", function(){
                let id = $(this).data('id');

                $.ajax({
                    url: "/peserta/get-registrasi", // endpoint ambil data
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {

                        $('#edit_id').val(res.id);

                        if (res.time_registrasi) {
                            $('#edit_status').val(1);
                            let dt = res.time_registrasi.split(" ");

                            $('#edit_tanggal').val(dt[0]);
                            $('#edit_jam').val(dt[1].substring(0, 5));
                        } else {
                            $('#edit_status').val(0);
                            $('#edit_tanggal').val("");
                            $('#edit_jam').val("");
                        }

                        $('#modalEditRegistrasi').modal('show');
                    },
                    error: function() {
                        Swal.fire("Error", "Gagal mengambil data registrasi!", "error");
                    }
                });
            })

            $('#btnUpdateRegistrasi').on('click', function() {

                let id = $('#edit_id').val();

                $.ajax({
                    url: "/peserta/update-registrasi/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: $('#edit_status').val(),
                        tanggal: $('#edit_tanggal').val(),
                        jam: $('#edit_jam').val(),
                    },
                    success: function(res) {
                        Swal.fire("Berhasil", res.message, "success");
                        $('#modalEditRegistrasi').modal('hide');
                        setTimeout(() => location.reload(), 800);
                    },
                    error: function() {
                        Swal.fire("Error", "Gagal menyimpan data", "error");
                    }
                });

            });

        });
    </script>
@endsection
