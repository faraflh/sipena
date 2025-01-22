@extends('partials.dashboardLayout')

@section('content')
<div class="container">
    <h1>Detail Alur</h1>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Detail Alur
    </button>
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aplikasi</th>
                <th>Alur</th>
                <th>Keterangan Alur</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" method="POST" action="{{ route('detailAlur.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Detail Alur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="aplikasi_id" class="form-label">Aplikasi</label>
                            <select name="aplikasi_id" id="aplikasi_id" class="form-control" required>
                                <option value="">Pilih Aplikasi</option>
                                <!-- Render aplikasi options -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alur_id" class="form-label">Alur</label>
                            <select name="alur_id" id="alur_id" class="form-control" required>
                                <option value="">Pilih Alur</option>
                                <!-- Render alur options -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_alur" class="form-label">Keterangan Alur</label>
                            <textarea name="keterangan_alur" id="keterangan_alur" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Detail Alur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_aplikasi_id" class="form-label">Aplikasi</label>
                            <select name="aplikasi_id" id="edit_aplikasi_id" class="form-control" required>
                                <option value="">Pilih Aplikasi</option>
                                <!-- Render aplikasi options -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alur_id" class="form-label">Alur</label>
                            <select name="alur_id" id="edit_alur_id" class="form-control" required>
                                <option value="">Pilih Alur</option>
                                <!-- Render alur options -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_keterangan_alur" class="form-label">Keterangan Alur</label>
                            <textarea name="keterangan_alur" id="edit_keterangan_alur" class="form-control" required></textarea>
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
</div>

<script>
    $(document).ready(function () {
        const table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('detailAlur.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'aplikasi.nama', name: 'aplikasi.nama' },
                { data: 'alur.nama', name: 'alur.nama' },
                { data: 'keterangan_alur', name: 'keterangan_alur' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Load data to edit modal
        $(document).on('click', '.edit-btn', function () {
            const url = $(this).data('url');
            $('#editForm').attr('action', url);
            const data = $(this).data('detail');
            $('#edit_aplikasi_id').val(data.aplikasi_id);
            $('#edit_alur_id').val(data.alur_id);
            $('#edit_keterangan_alur').val(data.keterangan_alur);
            $('#editModal').modal('show');
        });
    });
</script>
@endsection
