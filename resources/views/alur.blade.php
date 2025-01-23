@extends('partials.dashboardLayout')

@section('content')

<style>
    /* Kurangi ukuran font di tabel */
    .tabel {
        font-size: 12px; /* Sesuaikan ukuran font */
    }

    /* Perkecil padding antar sel */
    .tabel td, .tabel th {
        padding: 0px 2px; /* Sesuaikan padding vertikal dan horizontal */
    }

  
    /* Jika ingin menyelaraskan teks ke tengah */
    .tabel td {
        vertical-align: middle; /* Teks rata tengah secara vertikal */
    }

    .btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
</style>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Alur</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="addNewAlurBtn" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Alur Baru
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table tabel align-items-center mb-0" border='1'>
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Alur
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data diisi oleh DataTables -->
                        </tbody>
                    </table>
                </div>
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
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('alur.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaAlur', name: 'namaAlur'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            $('#addNewAlurBtn').click(function () {
                $('#alurModalLabel').text('Tambah Alur');
                $('#alurForm')[0].reset();
                $('#alur_id').val('');
                $('#alurModal').modal('show');
            });

            // Save or Update Alur
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

            // Edit Alur
            $(document).on('click', '.edit', function () {
                var id = $(this).data('id');
                var namaAlur = $(this).data('namaAlur');

                $('#alurModalLabel').text('Edit Alur');
                $('#alur_id').val(id);
                $('#namaAlur').val(namaAlur);
                $('#alurModal').modal('show');
            });

            // Delete Alur
            $(document).on('click', '.delete', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
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
