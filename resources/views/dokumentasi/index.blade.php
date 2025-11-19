@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Dokuementasi Acara</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dokuementasi Acara</li>
                        <li class="breadcrumb-item active">Dokuementasi Acara</li>
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            Tambah Data
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="table-container table-responsive">
                            <table id="dataTable" class="table table-striped table-hover" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Judul</th>
                                        <th>Gambar</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $index = 1; @endphp

                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ $index++ }}</td>

                                            <td class="align-middle">{{ $item->judul }}</td>

                                            <td class="text-center align-middle">
                                                <img src="{{ asset('storage/dokumentasi/' . $item->file) }}" alt="Foto"
                                                    class="img-thumbnail" style="width: 120px; height: auto;">
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ asset('storage/dokumentasi/' . $item->file) }}"
                                                        target="_blank" class="btn btn-primary btn-sm">
                                                        Preview
                                                    </a>
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

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumentasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formTambah" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label>Judul Dokumentasi</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>File Dokumentasi (Bisa Banyak)</label>
                            <input type="file" name="file[]" id="file" class="form-control" accept="image/*"
                                multiple required>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="btnSave" class="btn btn-primary">Simpan</button>
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

            $("#btnSave").click(function() {

                let formData = new FormData($("#formTambah")[0]);

                $.ajax({
                    url: "/dokumentasi-raker/store",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Menyimpan...",
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function(res) {
                        Swal.close();

                        if (res.status) {
                            Swal.fire("Berhasil", res.message, "success");
                            $("#modalTambah").modal("hide");
                            $("#formTambah")[0].reset();
                            location.reload();
                        } else {
                            Swal.fire("Gagal", "Terjadi kesalahan.", "error");
                        }
                    },
                    error: function(err) {
                        Swal.close();

                        if (err.status === 422) {
                            let errorMsg = "";
                            $.each(err.responseJSON.errors, function(key, val) {
                                errorMsg += val + "<br>";
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Gagal",
                                html: errorMsg
                            });

                        } else {
                            Swal.fire("Error", "Terjadi kesalahan server.", "error");
                        }
                    }
                });

            });

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");

                Swal.fire({
                    title: "Hapus?",
                    text: "Data ini akan dihapus permanen.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/dokumentasi-raker/delete",
                            type: "POST",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                id: id
                            },
                            success: function(res) {
                                if (res.status) {
                                    Swal.fire("Berhasil!", res.message, "success").then(
                                        () => {
                                            location.reload();
                                        });
                                } else {
                                    Swal.fire("Gagal!", res.message, "error");
                                }
                            }
                        });

                    }
                });

            });


        });
    </script>
@endsection
