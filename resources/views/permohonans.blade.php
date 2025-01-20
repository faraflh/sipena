@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Permohonan</h5>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table pegawai align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pemohon</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIP</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Aplikasi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permohonan as $index => $item)
                            <tr>
                                <td class="text-center">{{ ($permohonan->currentPage() - 1) * $permohonan->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->nama_pemohon }}</td>
                                <td class="text-center">{{ $item->nip }}</td>
                                <td>{{ $item->nama_aplikasi }}</td>
                                <td class="text-center">
                                    <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"></i>

                                    <form id="delete-form-{{ $item->id }}"
                                          action="{{ route('permohonans.destroy', $item->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('permohonans.index', $item->id) }}" class="edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-eye ms-4 text-dark cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                    </a>

                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Detail Permohonan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
                        <input type="text" name="nama_pemohon" class="form-control" value="{{ $item->nama_pemohon }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="number" name="nip" class="form-control" value="{{ $item->nip }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="number" name="nomor_telepon" class="form-control" value="{{ $item->nomor_telepon }}" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="nama_opd" class="form-label">Nama OPD</label>
                        <input type="text" name="nama_opd" class="form-control" value="{{ $item->nama_opd }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama_aplikasi" class="form-label">Nama Aplikasi Rekening</label>
                        <input type="text" name="nama_aplikasi" class="form-control" value="{{ $item->nama_aplikasi }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $item->email }}" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-baseline">
                <p class="text-xs font-weight-bold mb-0">Showing {{ $permohonan->firstItem() }} to {{ $permohonan->lastItem() }} of {{ $permohonan->total() }} entries</p>
                {{ $permohonan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
