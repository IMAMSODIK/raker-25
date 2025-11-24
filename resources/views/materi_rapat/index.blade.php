@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Materi Rapat</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Materi Rapat</li>
                        <li class="breadcrumb-item active">Materi Rapat</li>
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
                        <div class="table-responsive">
                            <table id="tableKamar" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th class="text-center align-middle">Judul</th>
                                        <th class="text-center align-middle">File Materi</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp

                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ $i++ }}</td>

                                            <td class="align-middle">{{ $item->nama_materi }}</td>

                                            <td class="text-center align-middle">

                                                @php
                                                    $ext = pathinfo($item->file, PATHINFO_EXTENSION);
                                                @endphp

                                                {{-- Jika PDF --}}
                                                @if ($ext == 'pdf')
                                                    <embed src="{{ asset('storage/' . $item->file) }}"
                                                        type="application/pdf" width="120px" height="120px" />
                                                @else
                                                    {{-- Preview gambar / file lain --}}
                                                    <img src="{{ asset('storage/' . $item->file) }}" width="120"
                                                        class="rounded border" alt="Preview">
                                                @endif

                                            </td>

                                            <td class="text-center align-middle">

                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Preview --}}
                                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                        class="btn btn-info btn-sm">
                                                        Preview
                                                    </a>

                                                    {{-- Tombol Download --}}
                                                    <a href="{{ asset('storage/' . $item->file) }}" download
                                                        class="btn btn-success btn-sm">
                                                        Download
                                                    </a>

                                                    <button class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $item->id }}">Hapus</button>
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
                    <h5 class="modal-title">Tambah Materi Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formTambahMateri" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label>Judul Materi</label>
                            <input type="text" name="nama_materi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>File Materi</label>
                            <input type="file" name="file" accept=".pdf,.ppt,.pptx" class="form-control" required>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button id="btnSimpan" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#tableKamar').DataTable({
                responsive: true,
                autoWidth: false
            });

            $("#btnSimpan").click(function() {

                let formData = new FormData($("#formTambahMateri")[0]);

                $.ajax({
                    url: "/materi-raker/store",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $("#btnSimpan").prop("disabled", true).text("Menyimpan...");
                    },
                    success: function(res) {

                        if (res.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $("#modalTambah").modal("hide");
                            $("#formTambahMateri")[0].reset();

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: err.responseJSON?.message || "Terjadi kesalahan"
                        });
                    },
                    complete: function() {
                        $("#btnSimpan").prop("disabled", false).text("Simpan");
                    }
                });
            });

            $(document).on("click", ".delete", function() {
                let id = $(this).data("id");

                Swal.fire({
                    title: "Hapus Materi?",
                    text: "Data dan file akan dihapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/materi-raker/delete",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(res) {
                                if (res.success) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Berhasil!",
                                        text: res.message,
                                        timer: 1500,
                                        showConfirmButton: false
                                    });

                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);

                                } else {
                                    Swal.fire("Gagal!", res.message, "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Error!", "Terjadi kesalahan server",
                                "error");
                            }
                        });

                    }
                });
            });

        });
    </script>
@endsection
