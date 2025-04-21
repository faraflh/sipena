@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Alur</h5>
                    </div>
<<<<<<< HEAD
                    <div class="col-6 d-flex align-items-center justify-content-end flex-nowrap"> 
                        <div class="d-inline-block w-auto position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewAlurBtn" data-bs-target="#createModal">
=======
                    <div class="col-6 text-end"> 
                        <div class="d-inline-block position-relative">
                            <i class="fas fa-search position-absolute search-icon"></i>
                            <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                        </div>
                        <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="addNewAlurBtn" data-bs-target="#createModal">
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
                           <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Alur Baru
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 sorting" data-sort="namaAlur"> Nama Alur <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Aksi </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

     <!-- Create Modal -->
     <div class="modal fade" id="alurModal" tabindex="-1" aria-labelledby="alurModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="alurForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="alurModalLabel">Tambah Alur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaAlur" class="form-label">Nama Alur</label>
                            <input type="text" name="namaAlur" class="form-control" id="namaAlur" required>
                            <input type="hidden" name="alur_id" id="alur_id">
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
                order: [],
                language: {
                    paginate: {
                        previous: '<span class="prev-icon page-link" >‹</span>',
                        next: '<span class="next-icon page-link" >›</span>',
                    },
                    search: ''
                },
                dom: 'lrtip',
                ajax: "{{ route('alur.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                    {data: 'namaAlur', name: 'namaAlur', orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function(settings) {
                    $('.dataTables_paginate').find(' span a.paginate_button').addClass('page-link');
                }
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#addNewAlurBtn').click(function () {
                $('#alurModalLabel').text('Tambah Alur');
                $('#alurForm')[0].reset();
                $('#alur_id').val('');
                $('#alurModal').modal('show');
            });

            $('#alurForm').submit(function (e) {
                e.preventDefault();
                var id = $('#alur_id').val();
                var url = id ? '{{ route("alur.update", ":id") }}'.replace(':id', id) : '{{ route("alur.store") }}';
                var method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#alurModal').modal('hide');
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
                var namaAlur = $(this).data('namaalur');
                $('#alurModalLabel').text('Edit Alur');
                $('#alur_id').val(id);
                $('#namaAlur').val(namaAlur);
                $('#alurModal').modal('show');
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
                            url: '{{ route("alur.destroy", ":id") }}'.replace(':id', id),
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