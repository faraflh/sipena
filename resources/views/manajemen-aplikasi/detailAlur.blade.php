@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Detail Alur</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Detail Alur
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Aplikasi</th>
                            <th>Alur</th>
                            <th>Keterangan Alur</th>
                            <th class="text-center">Aksi</th>
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
                    <h5 class="modal-title">Tambah Detail Alur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="aplikasi_id" class="form-label">Aplikasi</label>
                        <select name="aplikasi_id" class="form-control" required>
                            <option value="">Pilih Aplikasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alur_id" class="form-label">Alur</label>
                        <select name="alur_id" class="form-control" required>
                            <option value="">Pilih Alur</option>
                            <!-- Options dynamically populated -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan_alur" class="form-label">Keterangan Alur</label>
                        <textarea name="keterangan_alur" class="form-control" required></textarea>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail Alur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_aplikasi_id" class="form-label">Aplikasi</label>
                        <select name="aplikasi_id" class="form-control" required>
                            <option value="">Pilih Aplikasi</option>
                            <!-- Options dynamically populated -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alur_id" class="form-label">Alur</label>
                        <select name="alur_id" class="form-control" required>
                            <option value="">Pilih Alur</option>
                            <!-- Options dynamically populated -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_keterangan_alur" class="form-label">Keterangan Alur</label>
                        <textarea name="keterangan_alur" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    const table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('detailAlur.index') }}",
        columns: [
            { data: 'id', className: 'text-center' },
            { data: 'aplikasi.nama' },
            { data: 'alur.nama' },
            { data: 'keterangan_alur' },
            { data: 'action', orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    // Create Detail Alur
    $('#createForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('detailAlur.store') }}',
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

    // Delete Detail Alur
    $(document).on('click', '.delete', function () {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this detail alur?')) {
            $.ajax({
                url: `/detailAlur/${id}`,
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
        $.get(`/detailAlur/${id}/edit`, function (data) {
            $('#editForm [name="aplikasi_id"]').val(data.aplikasi_id);
            $('#editForm [name="alur_id"]').val(data.alur_id);
            $('#editForm [name="keterangan_alur"]').val(data.keterangan_alur);
            $('#editForm').attr('data-id', id);
            $('#editModal').modal('show');
        });
    });

    // Update Detail Alur
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $.ajax({
            url: `/detailAlur/${id}`,
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
