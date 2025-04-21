@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Detail Tim / {{ $namaAplikasi }}</h5>
                    <h5 class="mb-0"></h5>
                </div>
                <div class="col-6 text-end align-items-center justify-content-end"> 
                    <div class="d-inline-block w-auto position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0 ms-2" id="addNewDetailTimBtn" data-bs-toggle="modal" data-bs-target="#detailTimModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Detail Tim Baru
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Pegawai <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Jabatan Kegiatan <i class="fas fa-sort"></i> </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Aksi </th>
                            </tr>
                        </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="detailTimModal" tabindex="-1" aria-labelledby="detailTimModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailTimForm">
                    @csrf
                    <input type="hidden" id="detail_tim_id" name="detail_tim_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailTimModalLabel">Tambah Detail Tim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="aplikasi_id" class="form-label">Aplikasi</label>
                            <input type="text" class="form-control" value="{{ $aplikasi->namaAplikasi }}" readonly>
                            <input type="hidden" name="aplikasi_id" id="aplikasi_id" value="{{ $aplikasi->id }}">
                            </div>
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select name="pegawai_id" class="form-select" id="pegawai_id" required>
                            <option value="" disabled selected>Pilih Pegawai</option>
                                @foreach($pegawai as $pgw)
                                    <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan_kegiatan_id" class="form-label">Jabatan Kegiatan</label>
                            <select name="jabatan_kegiatan_id" class="form-select" id="jabatan_kegiatan_id" required>
                            <option value="" disabled selected>Pilih Jabatan Kegiatan</option>
                                @foreach($jabatanKegiatan as $jabKeg)
                                    <option value="{{ $jabKeg->id }}">{{ $jabKeg->id }}</option>
                                @endforeach
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
    var aplikasi_id = "{{ $aplikasi_id }}"; 


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
            url: "{{ route('manajemen-aplikasi.detailTimData', ':id') }}".replace(':id', aplikasi_id),
            type: "GET",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false },
            { data: 'pegawai', name: 'pegawai', orderable: true, searchable: true },
            { data: 'jabatan_kegiatan_id', name: 'jabatan_kegiatan_id', orderable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        drawCallback: function(settings) {
            $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');
        }
    });

    $('#customSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    $('#addNewDetailTimBtn').click(function() {
        $('#detailTimModalLabel').text('Tambah Detail Tim');
        $('#detailTimForm')[0].reset();
        $('#detail_tim_id').val('');
        $('#aplikasi_id').val(aplikasi_id).prop('disabled', true);
        $('#detailTimModal').modal('show');
    });

    $('#detailTimForm').submit(function(e) {
        e.preventDefault();
        var id = $('#detail_tim_id').val();
        var url = id ? '{{ route("detailTim.update", ":id") }}'.replace(':id', id) : '{{ route("detailTim.store") }}';
        var method = id ? 'PUT' : 'POST';
        $('#aplikasi_id').prop('disabled', false);

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                console.log('Response dari server:', response);
                $('#detailTimModal').modal('hide');
                table.ajax.reload();
                toastr.success(response.success);
            },
            error: function() {
                toastr.error('Terjadi kesalahan.');
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        var aplikasi_id = $(this).data('aplikasi_id');
        var pegawai_id = $(this).data('pegawai_id');
        var jabatan_kegiatan_id = $(this).data('jabatan_kegiatan_id');

    console.log('Edit Data:', pegawai_id, jabatan_kegiatan_id);

        $('#detailTimModalLabel').text('Edit Detail Tim');
        $('#detail_tim_id').val(id);
        $('#aplikasi_id').val(aplikasi_id).prop('disabled', true); 
        $('#pegawai_id').val(pegawai_id);
        $('#jabatan_kegiatan_id').val(jabatan_kegiatan_id);
        $('#detailTimModal').modal('show');
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
                    url: '{{ route("detailTim.destroy", ":id") }}'.replace(':id', id),
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