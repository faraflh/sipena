@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Jabatan Kegiatan</h5>
                    </div>
<<<<<<< HEAD
                    <div class="col-6 text-end d-flex align-items-center justify-content-end flex-nowrap">
                        <div class="d-inline-block w-auto position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewJabKegBtn" data-bs-target="#createModal">
                           <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Jabatan Kegiatan
=======
                    <div class="col-6 text-end">
                        <div class="d-inline-block position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="addNewJabKegBtn" data-bs-target="#createModal">
                           <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Jabatan Kegiatan Baru
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pegawai <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan Status <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="jabatanKegiatanForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Jabatan Kegiatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="pegawai_id" class="form-label">Pegawai</label>
                                <select name="pegawai_id" id="pegawai_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Pegawai</option>
                                    @foreach($pegawai as $pgw)
                                        <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategori as $ktg)
                                        <option value="{{ $ktg->id }}">{{ $ktg->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan_status_id" class="form-label">Jabatan Status</label>
                                <select name="jabatan_status_id" id="jabatan_status_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Jabatan Status</option>
                                    @foreach($jabatanStatus as $jabSus)
                                        <option value="{{ $jabSus->id }}">{{ $jabSus->namaJabatanStatus }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="jabatan_kegiatan_id" id="jabatan_kegiatan_id">
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
                order: [],
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    paginate: {
                        previous: '<span class="prev-icon page-link">‹</span>',
                        next: '<span class="next-icon page-link">›</span>',
                    },
                    search: ''
                },
                dom: 'lrtip',
                ajax: "{{ route('jabatanKegiatan.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pegawai', name: 'pegawai', orderable: true},
                    {data: 'kategori', name: 'kategori', orderable: true},
                    {data: 'jabatan_status', name: 'jabatan_status', orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function(settings) {
                    $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');

                }
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#addNewJabKegBtn').click(function () {
                $('#createModalLabel').text('Tambah Jabatan Kegiatan');
                $('#jabatanKegiatanForm')[0].reset();
                $('#jabatan_kegiatan_id').val('');
                $('#createModal').modal('show');
            });

            $('#jabatanKegiatanForm').submit(function (e) {
                e.preventDefault();
                var id = $('#jabatan_kegiatan_id').val();
                var url = id ? '{{ route("jabatanKegiatan.update", ":id") }}'.replace(':id', id) : '{{ route("jabatanKegiatan.store") }}';
                var method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#createModal').modal('hide');
                        table.ajax.reload();
                        toastr.success(response.success);
                    },
                    error: function (error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).data('id');
                var pegawai_id = $(this).data('pegawai_id');
                var kategori_id = $(this).data('kategori_id');
                var jabatan_status_id = $(this).data('jabatan_status_id');

                $('#createModalLabel').text('Edit Jabatan Kegiatan');
                $('#jabatan_kegiatan_id').val(id);
                $('#pegawai_id').val(pegawai_id);
                $('#kategori_id').val(kategori_id);
                $('#jabatan_status_id').val(jabatan_status_id);
                $('#createModal').modal('show');
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
                            url: '{{ route("jabatanKegiatan.destroy", ":id") }}'.replace(':id', id),
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