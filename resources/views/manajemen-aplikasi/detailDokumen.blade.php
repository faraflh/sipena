@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Detail Dokumen</h5>
                </div>
                <div class="col-6 text-end"> 
                    <div class="d-inline-block position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0" id="addNewDetailAlurBtn" data-bs-toggle="modal" data-bs-target="#detailAlurModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Detail Alur Baru
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Dokumen </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Alur </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Keterangan Alur </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Aksi </th>
                            </tr>
                        </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="detailAlurModal" tabindex="-1" aria-labelledby="detailAlurModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailDokumenForm">
                    @csrf
                    <input type="hidden" id="detail_dokumen_id" name="detail_dokumen_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailAlurModalLabel">Tambah Detail Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="aplikasi_id" class="form-label">Aplikasi</label>
                            <input name="aplikasi_id" id="aplikasi_id" class="form-control" required></
                        </div>
                        <div class="mb-3">
                            <label for="dokumen_id" class="form-label">Dokumen</label>
                            <select name="dokumen_id" class="form-control">
                                <option value="">Pilih Dokumen</option>
                                @foreach ($dokumen as $d)
                                    <option value="{{ $a['id'] }}">{{ $a['namaDokumen'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
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
    var aplikasi_id = "{{ $aplikasi_id }}"; // Ambil aplikasi_id yang telah difilter

    // Inisialisasi DataTable
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
        ajax: {
            url: "{{ route('manajemen-aplikasi.detailAlurData', ':id') }}".replace(':id', aplikasi_id),
            type: "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'aplikasi', name: 'aplikasi_id', orderable: true },
            { data: 'alur', name: 'alur_id', orderable: true },
            { data: 'keterangan_alur', name: 'keterangan_alur', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        drawCallback: function(settings) {
            $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');
        }
    });

    $('#customSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Saat menekan tombol Tambah
    $('#addNewDetailAlurBtn').click(function() {
        $('#detailAlurModalLabel').text('Tambah Detail Alur');
        $('#detailAlurForm')[0].reset();
        $('#detail_alur_id').val('');

        // Set value aplikasi_id otomatis dan buat select menjadi readonly
        $('#aplikasi_id').val(aplikasi_id).prop('disabled', true);

        $('#detailAlurModal').modal('show');
    });

    $('#detailAlurForm').submit(function(e) {
        e.preventDefault();
        var id = $('#detail_alur_id').val();
        var url = id ? '{{ route("detailAlur.update", ":id") }}'.replace(':id', id) : '{{ route("detailAlur.store") }}';
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#detailAlurModal').modal('hide');
                table.ajax.reload();
                toastr.success(response.success);
            },
            error: function() {
                toastr.error('Terjadi kesalahan.');
            }
        });
    });

    // Saat menekan tombol Edit
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        var alur_id = $(this).data('alur_id');
        var keterangan_alur = $(this).data('keterangan_alur');

        $('#detailAlurModalLabel').text('Edit Detail Alur');
        $('#detail_alur_id').val(id);
        $('#aplikasi_id').val(aplikasi_id).prop('disabled', true); // Pastikan aplikasi_id tetap sama dan disabled
        $('#alur_id').val(alur_id);
        $('#keterangan_alur').val(keterangan_alur);
        $('#detailAlurModal').modal('show');
    });

    // Saat menekan tombol Delete
    $(document).on('click', '.delete', function() {
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
                    url: '{{ route("detailAlur.destroy", ":id") }}'.replace(':id', id),
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        table.ajax.reload();
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                    },
                    error: function() {
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