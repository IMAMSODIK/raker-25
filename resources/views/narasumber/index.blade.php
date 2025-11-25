@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Daftar Narasumber</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Daftar Narasumber</li>
                        <li class="breadcrumb-item active">Daftar Narasumber</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row size-column">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3 d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKamar">
                            Tambah Data
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="table-container table-responsive">
                            <table id="dataTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Narasumber</th>
                                        <th class="text-center align-middle">No. Handphone</th>
                                        <th class="text-center align-middle" style="width: 15%">Satuan Kerja</th>
                                        <th class="text-center align-middle">Pangkat</th>
                                        <th class="text-center align-middle">Jabatan</th>
                                        <th class="text-center align-middle">Waktu Kedatangan</th>
                                        <th class="text-center align-middle">Maskapai</th>
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
                                            <td class="text-center align-middle">
                                                @if ($item->tanggal_kedatangan)
                                                    {{ \Carbon\Carbon::parse($item->tanggal_kedatangan)->translatedFormat('d F Y') }}
                                                @else
                                                    -
                                                @endif
                                                <br>
                                                @if ($item->jam_kedatangan)
                                                    {{ \Carbon\Carbon::parse($item->jam_kedatangan)->format('H:i') }}
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $item->maskapai }}</td>
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

    <!-- MODAL TAMBAH DATA -->
    <div class="modal fade" id="modalTambahKamar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="formTambah" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Narasumber</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Pangkat <span class="text-danger">*</span></label>
                                <input type="text" name="pangkat" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Satuan Kerja <span class="text-danger">*</span></label>
                                <input type="text" name="satker" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Kedatangan</label>
                                <input type="date" name="tanggal_kedatangan" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jam Kedatangan</label>
                                <input type="time" name="jam_kedatangan" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Maskapai</label>
                                <select name="maskapai" class="form-control" value="{{ old('maskapai') }}">
                                    <option value=""></option>
                                    <option value="Garuda Indonesia">Garuda Indonesia</option>
                                    <option value="Citilink">Citilink</option>
                                    <option value="Lion Air">Lion Air</option>
                                    <option value="Batik Air">Batik Air</option>
                                    <option value="Sriwijaya Air">Sriwijaya Air</option>
                                    <option value="Super Air Jet">Super Air Jet</option>
                                    <option value="Wings Air">Wings Air</option>
                                    <option value="Pelita Air">Pelita Air</option>
                                    <option value="Nam Air">Nam Air</option>
                                    <option value="TransNusa">TransNusa</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modalEditPeserta" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Narasumber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditPeserta" enctype="multipart/form-data">

                    <div class="modal-body">

                        <input type="hidden" id="edit_id" name="id">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Nama *</label>
                                <input type="text" name="nama" id="edit_nama" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>NIP *</label>
                                <input type="text" name="nip" id="edit_nip" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>No HP *</label>
                                <input type="text" name="no_hp" id="edit_no_hp" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Pangkat *</label>
                                <input type="text" name="pangkat" id="edit_pangkat" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Jabatan *</label>
                                <input type="text" name="jabatan" id="edit_jabatan" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Satuan Kerja *</label>
                                <input type="text" name="satker" id="edit_satker" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Kedatangan</label>
                                <input type="date" name="tanggal_kedatangan" id="edit_tanggal" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Jam Kedatangan</label>
                                <input type="time" name="jam_kedatangan" id="edit_jam" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Maskapai</label>
                                <select name="maskapai" id="edit_maskapai" class="form-control"
                                    value="{{ old('maskapai') }}">
                                    <option value=""></option>
                                    <option value="Garuda Indonesia">Garuda Indonesia</option>
                                    <option value="Citilink">Citilink</option>
                                    <option value="Lion Air">Lion Air</option>
                                    <option value="Batik Air">Batik Air</option>
                                    <option value="Sriwijaya Air">Sriwijaya Air</option>
                                    <option value="Super Air Jet">Super Air Jet</option>
                                    <option value="Wings Air">Wings Air</option>
                                    <option value="Pelita Air">Pelita Air</option>
                                    <option value="Nam Air">Nam Air</option>
                                    <option value="TransNusa">TransNusa</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Foto</label>
                                <input type="file" name="edit_foto" class="form-control">
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-update">Update</button>
                    </div>

                </form>

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

            $("#formTambah").on("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "/daftar-narasumber/store",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        $(".btn-simpan").prop("disabled", true).text("Menyimpan...");
                    },

                    success: function(response) {
                        $("#formTambah")[0].reset();

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $("#modalTambahKamar").modal('hide');

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },

                    error: function(xhr) {
                        let errorMessage = "";

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += value + "<br>";
                            });
                        } else {
                            errorMessage = "Terjadi kesalahan. Coba lagi.";
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Gagal Menyimpan",
                            html: errorMessage
                        });
                    },

                    complete: () => {
                        $(".btn-simpan").prop("disabled", false).text("Simpan");
                    }
                });
            });

            $(document).on("click", ".edit", function() {

                let id = $(this).data("id");

                $.ajax({
                    url: "/daftar-narasumber/edit",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {

                        $("#edit_id").val(res.id);
                        $("#edit_nama").val(res.nama);
                        $("#edit_nip").val(res.nip);
                        $("#edit_no_hp").val(res.no_hp);
                        $("#edit_pangkat").val(res.pangkat);
                        $("#edit_jabatan").val(res.jabatan);
                        $("#edit_satker").val(res.satker);
                        $("#edit_tanggal").val(res.tanggal_kedatangan);
                        $("#edit_jam").val(res.jam_kedatangan);
                        $("#edit_maskapai").val(res.maskapai);

                        $("#modalEditPeserta").modal("show");
                    },
                    error: function() {
                        Swal.fire("Error", "Tidak dapat mengambil data peserta", "error");
                    }
                });

            });

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            $("#formEditPeserta").on("submit", function(e) {
                e.preventDefault();

                let id = $("#edit_id").val();
                let formData = new FormData(this);

                $.ajax({
                    url: "/daftar-narasumber/update/" + id,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $(".btn-update").prop("disabled", true).text("Menyimpan...");
                    },

                    success: function(response) {

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                            timer: 1300,
                            showConfirmButton: false
                        });

                        $("#modalEditPeserta").modal("hide");

                        location.reload();
                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errorText = "";

                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorText += value + "<br>";
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Error",
                                html: errorText
                            });

                            return;
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi kesalahan pada server."
                        });
                    },

                    complete: function() {
                        $(".btn-update").prop("disabled", false).text("Update");
                    }
                });
            });

            $(document).on('click', '.delete', function() {

                let id = $(this).data('id');

                Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data kamar tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {

                        if (result.isConfirmed) {

                            $.ajax({
                                url: "/daftar-narasumber/delete",
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id: id
                                },

                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        timer: 1500,
                                        showConfirmButton: false
                                    });

                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                },

                                error: function(xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: xhr.responseJSON?.message ??
                                            "Terjadi kesalahan"
                                    });
                                }
                            });

                        }

                    });

            });

        });
    </script>
@endsection
