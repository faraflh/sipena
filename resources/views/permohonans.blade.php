@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Permohonan</h5>
                </div>
                <div class="col-6 text-end">
                    <div class="d-inline-block position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline " placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table tabel align-items-center text-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama
                                Pemohon <i class="fas fa-sort"></i> </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama
                                Aplikasi <i class="fas fa-sort"></i> </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status <i class="fas fa-sort"></i> </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Generate Code <i class="fas fa-sort"></i> </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Detail Permohonan -->
    <div class="modal fade" id="permohonanModal" tabindex="-1" aria-labelledby="permohonanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permohonanModalLabel">Detail Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" class="form-control" id="namaPemohon" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="nomorTelepon" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Nama OPD</label>
                                <input type="text" class="form-control" id="namaOpd" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Aplikasi</label>
                                <input type="text" class="form-control" id="namaAplikasi" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="text-center" id="actionButtons"></div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
            ajax: "{{ route('permohonans.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_pemohon',
                    name: 'nama_pemohon',
                    orderable: true
                },
                {
                    data: 'nama_aplikasi',
                    name: 'nama_aplikasi',
                    orderable: true
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true
                },
                {
                    data: 'generate_code',
                    name: 'generate_code',
                    orderable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            drawCallback: function(settings) {
                $('.dataTables_paginate').find(' span a.paginate_button').addClass('page-link');
            }
        });

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });


        $(document).on('click', '.view', function() {
            var id = $(this).data('id');
            $.get("{{ url('permohonans') }}/" + id, function(data) {
                $('#namaPemohon').val(data.nama_pemohon);
                $('#nip').val(data.nip);
                $('#nomorTelepon').val(data.nomor_telepon);
                $('#namaOpd').val(data.nama_opd);
                $('#namaAplikasi').val(data.nama_aplikasi);
                $('#email').val(data.email);

                var actionButtons = '';

                if (!data.status) {
                    actionButtons = '<button class="btn btn-terima me-2 update-status" data-id="' + data.id + '" data-status="Diterima">Terima</button>' +
                        '<button class="btn btn-danger update-status" data-id="' + data.id + '" data-status="Ditolak">Tolak</button>';
                } else if (data.status === 'Diterima') {
                    actionButtons = '<button class="btn btn-terima disabled">Diterima</button>';
                } else if (data.status === 'Ditolak') {
                    actionButtons = '<button class="btn btn-danger disabled">Ditolak</button>';
                }

                $('#actionButtons').html(actionButtons);
                $('#permohonanModal').modal('show');
            });
        });

        // AJAX untuk Update Status
        $(document).on('click', '.update-status', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');

            $.ajax({
                url: "{{ route('permohonans.updateStatus', ':id') }}".replace(":id", id),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(response) {
                    $('#permohonanModal').modal('hide'); // Tutup modal
                    $('.tabel').DataTable().ajax.reload(); // Refresh DataTable agar status berubah
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan, coba lagi.');
                }
            });
        });
    });
</script>
@endpush