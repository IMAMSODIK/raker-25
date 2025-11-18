@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Pengaturan Kamar</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Pengaturan Kamar</li>
                        <li class="breadcrumb-item active">Pengaturan Kamar</li>
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
                        <div class="table-responsive">
                            <table id="tableKamar" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Nomor Kamar</th>
                                        <th>Peserta</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($data as $kamar)
                                        <tr>
                                            <td class="text-center align-middle">{{ $i++ }}</td>

                                            <td class="align-middle text-center">{{ $kamar->no_kamar }}</td>
                                            <td class="align-middle">
                                                @if ($kamar->peserta->count() === 0)
                                                    <span class="badge bg-secondary">Kosong</span>
                                                @else
                                                    @foreach ($kamar->peserta as $p)
                                                        <span class="badge bg-info">
                                                            {{ $p->nama }} <br>
                                                            <small>{{ $p->satker }}</small>
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </td>


                                            <td class="text-center align-middle">

                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-warning edit"
                                                        data-id="{{ $kamar->id }}">Edit</button>
                                                    <button class="btn btn-sm btn-danger kosongkan"
                                                        data-id="{{ $kamar->id }}">Kosongkan</button>
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

    <div class="modal fade" id="modalEditKamar" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <input type="text" id="edit_no_kamar" class="form-control" readonly>
                    </div>

                    <h5 class="mb-2">Pilih Peserta (Minimal 1 - Maksimal 2)</h5>

                    <table id="tablePilihPeserta" class="table table-bordered table-hover" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Satker</th>
                            </tr>
                        </thead>

                        <tbody></tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="update" class="btn btn-success">Simpan</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableKamar').DataTable({
                responsive: true,
                autoWidth: false
            });

            let tablePeserta = $('#tablePilihPeserta').DataTable({
                select: {
                    style: 'multi' // bisa pilih lebih dari 1
                },
                lengthChange: false,
                pageLength: 5
            });

            tablePeserta.on('user-select', function(e, dt, type, cell, originalEvent) {

                let selected = tablePeserta.rows({
                    selected: true
                }).count();

                if (selected >= 2) {
                    e.preventDefault();
                    Swal.fire(
                        "Maksimal 2 penghuni",
                        "Anda tidak dapat memilih lebih dari 2 peserta.",
                        "warning"
                    );
                }

            });

            $('.edit').on('click', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: "/pengaturan-kamar/edit",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {

                        $('#edit_id').val(res.kamar.id);
                        $('#edit_no_kamar').val(res.kamar.no_kamar);

                        tablePeserta.clear().draw();

                        $.each(res.peserta, function(i, item) {
                            tablePeserta.row.add([
                                item.nama,
                                item.nip,
                                item.satker
                            ]).node().dataset.id = item.id;
                        });

                        tablePeserta.draw();

                        tablePeserta.rows().every(function() {
                            let rowId = $(this.node()).data('id');

                            if (res.penghuni_ids.includes(rowId)) {
                                this.select();
                            }
                        });

                        $('#modalEditKamar').modal('show');
                    }
                });
            });


            $('#update').on('click', function() {

                let selectedRows = tablePeserta.rows({
                    selected: true
                }).nodes();
                let penghuni = [];

                selectedRows.each(function(row) {
                    penghuni.push($(row).data('id'));
                });

                if (penghuni.length < 1) {
                    Swal.fire("Minimal 1 peserta", "Pilih minimal 1 penghuni kamar.", "warning");
                    return;
                }

                if (penghuni.length > 2) {
                    Swal.fire("Maksimal 2 peserta", "Isi kamar tidak boleh lebih dari 2 orang.", "warning");
                    return;
                }

                $.ajax({
                    url: "/pengaturan-kamar/update",
                    type: "POST",
                    data: {
                        id: $('#edit_id').val(),
                        penghuni: penghuni,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        Swal.fire("Berhasil", res.message, "success")
                            .then(() => location.reload());
                    }
                });

            });

            $(document).on('click', '.kosongkan', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: "Kosongkan kamar?",
                    text: "Semua penghuni kamar ini akan dipindahkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, kosongkan!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/pengaturan-kamar/kosongkan",
                            type: "POST",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {

                                if (res.status) {
                                    Swal.fire("Berhasil", res.message, "success");
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);

                                } else {
                                    Swal.fire("Error", res.message, "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Error", "Gagal mengosongkan kamar.",
                                "error");
                            }
                        });

                    }
                });
            });

        });
    </script>
@endsection
