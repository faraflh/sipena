@extends('partials.dashboardLayout')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Pegawai</h5>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end flex-nowrap">
                    <div class="d-inline-block w-auto position-relative">
                        <i class="fas fa-search position-absolute search-icon"></i>
                        <input type="text" id="customSearch" class="form-control d-inline" placeholder="Search...">
                    </div>
                    <button class="btn bg-gradient-dark mb-0 ms-2" data-bs-toggle="modal" id="addNewPegawaiBtn" data-bs-target="#pegawaiModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Pegawai Baru
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
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pegawai <i class="fas fa-sort"></i></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP <i class="fas fa-sort"></i></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email <i class="fas fa-sort"></i></th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="pegawaiForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="nip_nik" class="form-label">NIP</label>
                                <input type="text" name="nip_nik" class="form-control" id="nip_nik" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan_pegawai_id" class="form-label">Jabatan Pegawai</label>
                                <select name="jabatan_pegawai_id" class="form-select" id="jabatan_pegawai_id" required>
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    @foreach($jabatanPegawai as $j)
                                    <option value="{{ $j->id }}">{{ $j->namaJabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" name="bank" class="form-control" id="bank" required>
                            </div>
                            <div class="mb-3">
                                <label for="namaRek" class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" name="namaRek" class="form-control" id="namaRek" required>

                            </div>
                            <div class="mb-3">
                                <label for="noRek" class="form-label">Nomor Rekening</label>
                                <input type="text" name="noRek" class="form-control" id="noRek" required>
                            </div>
                            <div class="mb-3">
                                <label for="golongan_id" class="form-label">Golongan</label>
                                <select name="golongan_id" class="form-select" id="golongan_id" required>
                                    <option value="" disabled selected>Pilih Golongan</option>
                                    @foreach($golongan as $k)
                                    <option value="{{ $k->id }}">{{ $k->namaGolPang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="pegawai_id" name="pegawai_id">
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
            ajax: "{{ route('pegawai.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama', orderable: true},
                {data: 'nip_nik', name: 'nip_nik', orderable: true},
                {data: 'email', name: 'email', orderable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            drawCallback: function(settings) {
                $('.dataTables_paginate').find('span a.paginate_button').addClass('page-link');
            }
        });

        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#addNewPegawaiBtn').click(function() {
            $('#createModalLabel').text('Tambah Pegawai');
            $('#pegawaiForm')[0].reset();
            $('#pegawai_id').val('');
            $('#createModal').modal('show');
        });

        $('#pegawaiForm').submit(function(e) {
            e.preventDefault();
            var id = $('#pegawai_id').val();
            var url = id ? '{{ route("pegawai.update", ":id") }}'.replace(':id', id) : '{{ route("pegawai.store") }}';
            var method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    $('#createModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.success);
                },
                error: function(error) {
                    toastr.error('Terjadi kesalahan.');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var nip_nik = $(this).data('nip_nik');
            var email = $(this).data('email');
            var namaRek = $(this).data('namarek');
            var noRek = $(this).data('norek');
            var bank = $(this).data('bank');
            var golongan_id = $(this).data('golongan_id');
            var jabatan_pegawai_id = $(this).data('jabatan_pegawai_id');

            $('#createModalLabel').text('Edit Pegawai');
            $('#pegawai_id').val(id);
            $('#nama').val(nama);
            $('#nip_nik').val(nip_nik);
            $('#email').val(email);
            $('#namaRek').val(namaRek);
            $('#noRek').val(noRek);
            $('#bank').val(bank);
            $('#golongan_id').val(golongan_id);
            $('#jabatan_pegawai_id').val(jabatan_pegawai_id);
            $('#createModal').modal('show');
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
                        url: '{{ route("pegawai.destroy", ":id") }}'.replace(':id', id),
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
