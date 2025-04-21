@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Jabatan Status</h5>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end flex-nowrap">
                    <div class="d-inline-block w-auto position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewJabatanStatusBtn" data-bs-target="#createModal">
                       <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Jabatan Status
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Jabatan Status <i class="fas fa-sort"></i> </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="jabatanStatusModal" tabindex="-1" aria-labelledby="jabatanStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="jabatanStatusForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="jabatanStatusModalLabel">Tambah Jabatan Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaJabatanStatus" class="form-label">Nama Jabatan Status</label>
                            <input type="text" name="namaJabatanStatus" class="form-control" id="namaJabatanStatus" required>
                            <input type="hidden" name="jabatan_status_id" id="jabatan_status_id">
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
                    previous: '<span class="prev-icon page-link">‹</span>',
                    next: '<span class="next-icon page-link">›</span>',
                },
                search: ''
            },
            dom: 'lrtip',
            ajax: "{{ route('jabatanStatus.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namaJabatanStatus', name: 'namaJabatanStatus', orderable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            drawCallback: function(settings) {
                $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');
            }
        });

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#addNewJabatanStatusBtn').click(function () {
            $('#jabatanStatusModalLabel').text('Tambah Jabatan Status');
            $('#jabatanStatusForm')[0].reset();
            $('#jabatan_status_id').val('');
            $('#jabatanStatusModal').modal('show');
        });

        $('#jabatanStatusForm').submit(function (e) {
            e.preventDefault();
            var id = $('#jabatan_status_id').val();
            var url = id ? '{{ route("jabatanStatus.update", ":id") }}'.replace(':id', id) : '{{ route("jabatanStatus.store") }}';
            var method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function (response) {
                    $('#jabatanStatusModal').modal('hide');
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
            var namaJabatanStatus = $(this).data('namajabatanstatus');
            $('#jabatanStatusModalLabel').text('Edit Jabatan Status');
            $('#jabatan_status_id').val(id);
            $('#namaJabatanStatus').val(namaJabatanStatus);
            $('#jabatanStatusModal').modal('show');
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
                        url: '{{ route("jabatanStatus.destroy", ":id") }}'.replace(':id', id),
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