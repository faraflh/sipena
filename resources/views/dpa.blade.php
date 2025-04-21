@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">DPA</h5>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end flex-nowrap">
                    <div class="d-inline-block w-auto position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline border-start-0" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewDpaBtn" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah DPA Baru
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. DPA <i class="fas fa-sort"></i> </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tujuan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Kegiatan <i class="fas fa-sort"></i> </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="dpaModal" tabindex="-1" aria-labelledby="dpaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="dpaForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="dpaModalLabel">Tambah DPA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="noSPT" class="form-label">No. SPT</label>
                                <input type="text" name="noSPT" class="form-control" id="noSPT" required>
                            </div>
                            <div class="mb-3">
                                <label for="noSPPD" class="form-label">No. SPPD</label>
                                <input type="text" name="noSPPD" class="form-control" id="noSPPD" required>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <input type="text" name="tujuan" class="form-control" id="tujuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="noRek" class="form-label">No. Rekening</label>
                                <input type="text" name="noRek" class="form-control" id="noRek" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="noDPA" class="form-label">No. DPA</label>
                                <input type="text" name="noDPA" class="form-control" id="noDPA" required>
                            </div>
                            <div class="mb-3">
                                <label for="subKeg" class="form-label">Sub Kegiatan</label>
                                <input type="text" name="subKeg" class="form-control" id="subKeg" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="text" name="tahun" class="form-control" id="tahun" required>
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
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.DataTable.ext.pager.numbers_length = 4;
        var table = $('.tabel').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                paginate: {
                    previous: '<span class="prev-icon page-link">‹</span>',
                    next: '<span class="next-icon page-link">›</span>',
                },
                search: ''
            },
            dom: 'lrtip',
            ajax: "{{ route('dpa.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'noDPA',
                    name: 'noDPA',
                    orderable: true
                },
                {
                    data: 'tujuan',
                    name: 'tujuan'
                },
                {
                    data: 'subKeg',
                    name: 'subKeg',
                    orderable: true
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
            }
        });

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#addNewDpaBtn').click(function() {
            $('#dpaModalLabel').text('Tambah DPA');
            $('#dpaForm')[0].reset();
            $('#dpa_id').val('');
            $('#dpaModal').modal('show');
        });

        $('#dpaForm').submit(function(e) {
            e.preventDefault();
            var id = $('#dpa_id').val();
            var url = id ? '{{ route("dpa.update", ":id") }}'.replace(':id', id) : '{{ route("dpa.store") }}';
            var method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                type: id ? 'POST' : 'POST', // Laravel hanya menerima POST untuk form submission
                data: $(this).serialize() + "&_method=" + (id ? 'PUT' : 'POST'),
                success: function(response) {
                    $('#dpaModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.success);
                },
                error: function(error) {
                    toastr.error('Something went wrong!');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            var noSPT = $(this).data('nospt');
            var noSPPD = $(this).data('nosppd');
            var tujuan = $(this).data('tujuan');
            var noRek = $(this).data('norek');
            var noDPA = $(this).data('nodpa');
            var subKeg = $(this).data('subkeg');
            var tahun = $(this).data('tahun');
            $('#dpaModalLabel').text('Edit DPA');
            $('#dpa_id').val(id);
            $('#noSPT').val(noSPT);
            $('#noSPPD').val(noSPPD);
            $('#tujuan').val(tujuan);
            $('#noRek').val(noRek);
            $('#noDPA').val(noDPA);
            $('#subKeg').val(subKeg);
            $('#tahun').val(tahun);
            $('#dpaModal').modal('show');
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
                        url: '{{ route("dpa.destroy", ":id") }}'.replace(':id', id),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(error) {
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