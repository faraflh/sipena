@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Kegiatan</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Kegiatan Baru
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="kegiatansTable">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nama Kegiatan</th>
                            <th class="text-center">Keterangan</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="createForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaKegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" name="namaKegiatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    // Initialize DataTable
    const table = $('#kegiatansTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('kegiatan.data') }}',
        columns: [
            { data: 'id', className: 'text-center' },
            { data: 'namaKegiatan' },
            { data: 'keterangan', className: 'text-center' },
            { data: 'status' },
            { data: 'actions', orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    // Create Kegiatan
    $('#createForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('manajemen-aplikasi.kegiatan.store') }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#createModal').modal('hide');
                $('#createForm')[0].reset();
                table.ajax.reload();
                alert(response.success);
            },
            error: function (xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Delete Kegiatan
    $(document).on('click', '.delete', function () {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this kegiatan?')) {
            $.ajax({
                url: `/manajemen-aplikasi/kegiatan/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function (response) {
                    table.ajax.reload();
                    alert(response.success);
                },
                error: function () {
                    alert('Something went wrong!');
                }
            });
        }
    });

    // Open and populate Edit Modal
    $(document).on('click', '.edit', function () {
        const id = $(this).data('id');
        $.get(`/kegiatan/${id}/edit`, function (data) {
            $('#editForm [name="namaKegiatan"]').val(data.namaKegiatan);
            $('#editForm [name="keterangan"]').val(data.keterangan);
            $('#editForm [name="status"]').val(data.status);
            $('#editForm').attr('data-id', id);
            $('#editModal').modal('show');
        });
    });

    // Update Kegiatan
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $.ajax({
            url: `/kegiatan/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function (response) {
                $('#editModal').modal('hide');
                table.ajax.reload();
                alert(response.success);
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });
});
</script>
@endsection
