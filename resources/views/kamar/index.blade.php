@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Data Kamar</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Data Kamar</li>
                        <li class="breadcrumb-item active">Data Kamar</li>
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
                        <div class="table-responsive">
                            <table id="tableKamar" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Nomor Kamar</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($data as $kamar)
                                        <tr>
                                            <td class="text-center align-middle">{{ $i++ }}</td>

                                            <td class="align-middle text-center">{{ $kamar->no_kamar }}</td>

                                            <td class="text-center align-middle">

                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-warning edit"
                                                        data-id="{{ $kamar->id }}">Edit</button>
                                                    <button class="btn btn-sm btn-danger hapus"
                                                        data-id="{{ $kamar->id }}">Hapus</button>
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

    <div class="modal fade" id="modalTambahKamar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="no_kamar" class="form-label">Nomor Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" placeholder="Contoh: 101">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="store">Simpan</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditKamar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label">Nomor Kamar</label>
                        <input type="text" id="edit_no_kamar" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="update">Update</button>
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

            $('#store').on('click', function() {

                let no_kamar = $('#no_kamar').val();

                $.ajax({
                    url: "/data-kamar/store",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_kamar: no_kamar
                    },

                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        });

                        $('#modalTambahKamar').modal('hide');
                        $('#no_kamar').val("");

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },

                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message ?? 'Terjadi kesalahan',
                        });
                    }
                });

            });

            $(document).on('click', '.edit', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "/data-kamar/edit",
                    data: {
                        id: id
                    },
                    type: "GET",
                    success: function(res) {

                        $('#edit_id').val(res.id);
                        $('#edit_no_kamar').val(res.no_kamar);

                        $('#modalEditKamar').modal('show');
                    },
                    error: function() {
                        Swal.fire("Error", "Gagal mengambil data", "error");
                    }
                });
            });

            $('#update').on('click', function() {

                let id = $('#edit_id').val();
                let no_kamar = $('#edit_no_kamar').val();

                $.ajax({
                    url: "/data-kamar/update",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_kamar: no_kamar,
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

                        $('#modalEditKamar').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },

                    error: function(xhr) {
                        Swal.fire("Gagal", xhr.responseJSON?.message ?? "Terjadi kesalahan",
                            "error");
                    }

                });

            });

            $(document).on('click', '.hapus', function() {

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
                                url: "/data-kamar/delete",
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
