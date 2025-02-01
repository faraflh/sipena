@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Dokumen</h5>
                    </div>
                    <div class="col-6 text-end"> 
                        <div class="d-inline-block position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline border-start-0" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="addNewDocBtn" data-bs-target="#createModal">
                           <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Dokumen Baru
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Kategori </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Alur </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Jenis Dokumen </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Aksi </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

     <!-- Create Modal -->
     <div class="modal fade" id="dokumenModal" tabindex="-1" aria-labelledby="dokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="dokumenForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="dokumenModalLabel">Tambah Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" >{{ $kat->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alur_id" class="form-label">Alur</label>
                            <select name="alur_id" class="form-control" id="alur_id" required>
                                <option value="">Pilih Alur</option>
                                @foreach($alur as $al)
                                    <option value="{{ $al->id }}">{{ $al->namaAlur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenisDokumen" class="form-label">Jenis Dokumen</label>
                            <input type="text" name="jenisDokumen" class="form-control" id="jenisDokumen" required>
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
                ajax: "{{ route('dokumen.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'kategori', name: 'kategori'},
                    {data: 'alur', name: 'alur'},
                    {data: 'jenisDokumen', name: 'jenisDokumen'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function(settings) {
                    $('.dataTables_paginate').find(' span a.paginate_button').addClass('page-link');
                }
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#addNewDocBtn').click(function () {
                $('#dokumenModalLabel').text('Tambah Dokumen');
                $('#dokumenForm')[0].reset();
                $('#dokumen_id').val('');
                $('#dokumenModal').modal('show');
            });

            $('#dokumenForm').submit(function (e) {
                e.preventDefault();
                var id = $('#dokumen_id').val();
                var url = id ? '{{ route("dokumen.update", ":id") }}'.replace(':id', id) : '{{ route("dokumen.store") }}';
                var method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#dokumenModal').modal('hide');
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
                var kategori_id = $(this).data('kategori_id');
                var alur_id = $(this).data('alur_id');
                var jenisDokumen = $(this).data('jenisdokumen');

                $('#dokumenModalLabel').text('Edit Dokumen');
                $('#dokumen_id').val(id);
                $('#kategori_id').val(kategori_id);
                $('#alur_id').val(alur_id);
                $('#jenisDokumen').val(jenisDokumen);
                $('#dokumenModal').modal('show');
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
                            url: '{{ route("dokumen.destroy", ":id") }}'.replace(':id', id),
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