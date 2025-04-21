@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Detail Dokumen / {{ $namaAplikasi }}</h5>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end flex-nowrap">
                    <div class="d-inline-block w-auto position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0 ms-2" id="addNewDetailDokumenBtn" data-bs-toggle="modal" data-bs-target="#detailDokumenModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Detail Dokumen
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dokumen</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Dokumen</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Surat</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="detailDokumenModal" tabindex="-1" aria-labelledby="detailDokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="detailDokumenForm">
                    @csrf
                    <input type="hidden" id="detail_dokumen_id" name="detail_dokumen_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailDokumenModalLabel">Tambah Detail Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="aplikasi_id" class="form-label">Aplikasi</label>
                                <input type="text" class="form-control" value="{{ $aplikasi->namaAplikasi }}" readonly>
                                <input type="hidden" name="aplikasi_id" id="aplikasi_id" value="{{ $aplikasi->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" name="namaDokumen" class="form-control" id="namaDokumen" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input type="file" name="file" class="form-control" id="file" required onchange="previewFile()">
                                <small id="file-name" class="form-text text-muted">Tidak ada file yang dipilih</small>
                            </div>
                            <div class="mb-3">
                                <label for="dokumen_id" class="form-label">Jenis Dokumen</label>
                                <select name="dokumen_id" class="form-select" id="dokumenid" required>
                                    <option value="" disabled selected>Pilih Dokumen</option>
                                    @foreach($dokumen as $doc)
                                    <option value="{{ $doc->id }}">{{ $doc->jenisDokumen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="noSurat" class="form-label">Nomor Surat</label>
                                <input type="text" name="noSurat" class="form-control" id="noSurat" required>
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <input type="text" name="perihal" class="form-control" id="perihal" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalSurat" class="form-label">Tanggal Surat</label>
                                <input type="date" name="tanggalSurat" class="form-control flatpickr" id="tanggalSurat" required>
                            </div>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">

    function previewFile() {
        var input = document.getElementById('file');
        var fileName = document.getElementById('file-name');

        if (input.files.length > 0) {
            fileName.textContent = "File yang dipilih: " + input.files[0].name;
        } else {
            fileName.textContent = "Tidak ada file yang dipilih";
        }
    }

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
                url: "{{ route('manajemen-aplikasi.detailDokumenData', ':id') }}".replace(':id', aplikasi_id),
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'namaDokumen',
                    name: 'namaDokumen'
                },
                {
                    data: 'dokumen',
                    name: 'dokumen'
                },
                {
                    data: 'tanggalSurat',
                    name: 'tanggalSurat'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            drawCallback: function(settings) {
                $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');
            },
        });

        flatpickr("#tanggalSurat", {
            dateFormat: "d-m-Y",
            allowInput: true
        });

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#addNewDetailDokumenBtn').click(function() {
            $('#detailDokumenModalLabel').text('Tambah Detail Dokumen');
            $('#detailDokumenForm')[0].reset();
            $('#detail_dokumen_id').val('');
            $('#aplikasi_id').val(aplikasi_id).prop('disabled', true);
            $('#namaDokumen').val(namadokumen);
            $('#file').val(file);
            $('#dokumen_id').val(dokumen_id);
            $('#noSurat').val(nosurat);
            $('#perihal').val(perihal);
            $('#tanggalSurat').val(tanggalsurat);
            $('#detailDokumenModal').modal('show');
        });

        $('#detailDokumenForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log([...formData]);
            var id = $('#detail_dokumen_id').val();
            var url = id ? '{{ route("detailDokumen.update", ":id") }}'.replace(':id', id) : '{{ route("detailDokumen.store") }}';
            var method = id ? 'POST' : 'POST';
            $('#aplikasi_id').prop('disabled', false);

            $.ajax({
                url: url,
                method: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#detailDokumenModal').modal('hide');
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
            var namaDokumen = $(this).data('namadokumen');
            var file = $(this).data('file');
            var dokumen_id = $(this).data('dokumen_id');
            var noSurat = $(this).data('nosurat');
            var perihal = $(this).data('perihal');
            var tanggalSurat = $(this).data('tanggalsurat');

            $('#detailDokumenModalLabel').text('Edit Detail Dokumen');
            $('#detail_dokumen_id').val(id);
            $('#aplikasi_id').val(aplikasi_id).prop('disabled', true);
            $('#namaDokumen').val(namaDokumen);
            $('#file').val(file);
            $('#dokumen_id').val(dokumen_id);
            $('#noSurat').val(noSurat);
            $('#perihal').val(perihal);
            $('#tanggalSurat').val(tanggalSurat);
            $('#detailDokumenModal').modal('show');
        });

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
                        url: '{{ route("detailDokumen.destroy", ":id") }}'.replace(':id', id),
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