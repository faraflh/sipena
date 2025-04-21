@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Manajemen Aplikasi</h5>
                    </div>
                    <div class="col-6 text-end d-flex align-items-center justify-content-end flex-nowrap"> 
                        <div class="d-inline-block w-auto position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline border-start-0" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewAplikasiBtn" data-bs-target="#createModal">
                           <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Aplikasi Baru
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                <table class="table tabel align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Aplikasi <i class="fas fa-sort"></i> </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelola Tim</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelola Dokumen</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelola Alur</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>

     <!-- Create Modal -->
     <div class="modal fade" id="aplikasiModal" tabindex="-1" aria-labelledby="aplikasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="aplikasiForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="aplikasiModalLabel">Tambah Aplikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaAplikasi" class="form-label">Nama Aplikasi</label>
                            <input type="text" name="namaAplikasi" class="form-control" id="namaAplikasi" required>
                            <input type="hidden" name="aplikasi_id" id="aplikasi_id">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" name="url" class="form-control" id="url" required>
                       </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.DataTable.ext.pager.numbers_length = 4;
            var table = $('.tabel').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    paginate: {
                        previous: '<span class="prev-icon page-link" >‹</span>',
                        next: '<span class="next-icon page-link" >›</span>',
                    },
                    search: ''
                },
                dom: 'lrtip',
                ajax: "{{ route('manajemen-aplikasi.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaAplikasi', name: 'namaAplikasi', orderable: true},
                    {data: 'keterangan', name: 'keterangan'},
                    {data: 'kelola_tim', name: 'kelola_tim', orderable: false, searchable: false},
                    {data: 'kelola_dokumen', name: 'kelola_dokumen', orderable: false, searchable: false},
                    {data: 'kelola_alur', name: 'kelola_alur', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function(settings) {
                    $('.dataTables_paginate').find(' span a.paginate_button').addClass('page-link');
                }
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#addNewAplikasiBtn').click(function () {
                $('#aplikasiModalLabel').text('Tambah Aplikasi');
                $('#aplikasiForm')[0].reset();
                $('#aplikasi_id').val('');
                $('#aplikasiModal').modal('show');
            });

            $('#aplikasiForm').submit(function (e) {
                e.preventDefault();
                console.log($(this).serialize());
                var id = $('#aplikasi_id').val();
                var url = id ? '{{ route("manajemen-aplikasi.update", ":id") }}'.replace(':id', id) : '{{ route("manajemen-aplikasi.store") }}';
                var method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#aplikasiModal').modal('hide');
                        table.ajax.reload();
                        toastr.success(response.success);
                    },
                    error: function (error) {
                        console.log(error.responseJSON);
                        toastr.error('Something went wrong!');
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).data('id');
                var namaAplikasi = $(this).data('namaaplikasi');
                var keterangan = $(this).data('keterangan');
                var url = $(this).data('url');
                var status = $(this).data('status');
                $('#aplikasiModalLabel').text('Edit Aplikasi');
                $('#aplikasi_id').val(id);
                $('#namaAplikasi').val(namaAplikasi);
                $('#keterangan').val(keterangan);
                $('#url').val(url);
                $('#status').val(status);
                $('#aplikasiModal').modal('show');
            });

            $(document).on('click', '.delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#388da8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("manajemen-aplikasi.destroy", ":id") }}'.replace(':id', id),
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Terhapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );
                            },
                            error: function (error) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush