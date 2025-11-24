@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kit Acara</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Kit Acara</li>
                        <li class="breadcrumb-item active">Kit Acara</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row size-column">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKamar">
                            Tambah Data
                        </button>
                    </div> --}}
                    <div class="col-12">
                        <div class="table-container table-responsive">
                            <table id="dataTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" rowspan="2">No</th>
                                        <th class="text-center align-middle" rowspan="2">Peserta</th>
                                        <th class="text-center align-middle" rowspan="2">No. Handphone</th>
                                        <th class="text-center align-middle" rowspan="2">Status Registrasi</th>
                                        <th class="text-center align-middle" rowspan="2" style="width: 15%">Satuan Kerja</th>
                                        <th class="text-center align-middle" rowspan="2">Pangkat</th>
                                        <th class="text-center align-middle" rowspan="2">Jabatan</th>
                                        <th class="text-center align-middle" colspan="4">Kit</th>
                                        <th class="text-center align-middle" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle">ID Card</th>
                                        <th class="text-center align-middle">Topi</th>
                                        <th class="text-center align-middle">Baju</th>
                                        <th class="text-center align-middle">Tas</th>
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
                                            <td class="align-middle">{{ $item->satker }}</td>
                                            <td class="text-center align-middle">{{ $item->pangkat }}</td>
                                            <td class="align-middle">{{ $item->jabatan }}</td>
                                            <td class="text-center align-middle">
                                                @if ($item->kit && $item->kit->id_card)
                                                    <span class="badge bg-success">Sudah</span>
                                                @else
                                                    <span class="badge bg-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                @if ($item->kit && $item->kit->topi)
                                                    <span class="badge bg-success">Sudah</span>
                                                @else
                                                    <span class="badge bg-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                @if ($item->kit && $item->kit->baju)
                                                    <span class="badge bg-success">Sudah</span>
                                                @else
                                                    <span class="badge bg-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                @if ($item->kit && $item->kit->tas)
                                                    <span class="badge bg-success">Sudah</span>
                                                @else
                                                    <span class="badge bg-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">

                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn btn-sm btn-warning edit"
                                                        data-id="{{ $item->id }}">
                                                        Edit
                                                    </button>

                                                    <button class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $item->id }}">
                                                        Hapus
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

    <!-- Modal Edit Peserta -->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Data Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formEdit">

                        <input type="hidden" id="edit_id">

                        <div class="row mb-3">
                            <div class="col">
                                <label>Nama</label>
                                <input type="text" id="edit_nama" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label>NIP</label>
                                <input type="text" id="edit_nip" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Satuan Kerja</label>
                            <input type="text" id="edit_satker" class="form-control" readonly>
                        </div>

                        <hr>

                        <h6>Kit</h6>
                        <div class="row">
                            <div class="col-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_id_card">
                                    ID Card
                                </label>
                            </div>

                            <div class="col-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_topi">
                                    Topi
                                </label>
                            </div>

                            <div class="col-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_baju">
                                    Baju
                                </label>
                            </div>

                            <div class="col-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_tas">
                                    Tas
                                </label>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-warning" id="btnUpdate">Update</button>
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

            $(document).on("click", ".edit", function() {

                let id = $(this).data("id");

                $.ajax({
                    url: "/kit-peserta/get",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $("#edit_id").val(res.id);
                        $("#edit_nama").val(res.nama);
                        $("#edit_nip").val(res.nip);
                        $("#edit_satker").val(res.satker);

                        $("#edit_id_card").prop("checked", res.kit?.id_card == 1);
                        $("#edit_topi").prop("checked", res.kit?.topi == 1);
                        $("#edit_baju").prop("checked", res.kit?.baju == 1);
                        $("#edit_tas").prop("checked", res.kit?.tas == 1);

                        $("#modalEdit").modal("show");
                    }
                });
            });

            $("#btnUpdate").click(function() {

                Swal.fire({
                    title: "Yakin ingin mengupdate?",
                    text: "Data peserta & kit akan disimpan.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, update!",
                    cancelButtonText: "Batal"
                }).then((result) => {

                    if (result.isConfirmed) {

                        let id = $("#edit_id").val();

                        $.ajax({
                            url: "/kit-peserta/update/" + id,
                            type: "PUT",
                            data: {
                                nama: $("#edit_nama").val(),
                                nip: $("#edit_nip").val(),
                                id_card: $("#edit_id_card").is(":checked") ? 1 : 0,
                                topi: $("#edit_topi").is(":checked") ? 1 : 0,
                                baju: $("#edit_baju").is(":checked") ? 1 : 0,
                                tas: $("#edit_tas").is(":checked") ? 1 : 0,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                if (res.success) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Berhasil",
                                        text: "Data berhasil diperbarui!"
                                    }).then(() => {
                                        $("#modalEdit").modal("hide");
                                        location.reload();
                                    });

                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Gagal",
                                        text: res.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Kesalahan Server",
                                    text: xhr.responseJSON?.message ??
                                        "Terjadi kesalahan sistem."
                                });
                            }
                        });

                    }
                });
            });

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");

                Swal.fire({
                    title: "Reset Kit?",
                    text: "Semua item kit peserta ini akan dikembalikan ke belum diterima.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, reset!",
                    cancelButtonText: "Batal"
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/kit-peserta/reset/" + id,
                            type: "PUT",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {

                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "KIT peserta berhasil direset!"
                                }).then(() => {
                                    location.reload();
                                });

                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: xhr.responseJSON?.message ??
                                        "Terjadi kesalahan."
                                });
                            }
                        });

                    }

                });

            });
        });
    </script>
@endsection
