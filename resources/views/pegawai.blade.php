@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pegawai</h5>
                    <form method="GET" action="{{ route('pegawai.index') }}" class="d-flex align-items-center">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Type here..."
                                value="{{ request('search') }}">
                        </div>
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Pegawai Baru
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table pegawai align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIP</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $index => $item)
                        <tr>
                            <td class="text-center">{{ ($pegawai->currentPage() - 1) * $pegawai->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->nip_nik }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="text-center">
                                <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"></i>

                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('pegawai.destroy', $item->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('pegawai.update', $item->id) }}" class="edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                </a>

                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <form action="{{ route('pegawai.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $item->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nip_nik" class="form-label">NIP</label>
                                                    <input type="text" name="nip_nik" class="form-control"
                                                        value="{{ $item->nip_nik }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $item->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="idJabatanPegawai" class="form-label">Jabatan Pegawai</label>

                                                    <select name="jabatan_pegawai_id" class="form-select" required>
                                                        <option value="" disabled selected>Pilih Jabatan</option>
                                                        @foreach($jabatanPegawai as $j)
                                                        <option value="{{ $j->id }}" {{ $item->jabatan_pegawai_id == $j->id ? 'selected' : '' }}>
                                                            {{ $j->namaJabatan }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="bank" class="form-label">Bank</label>
                                                    <input type="text" name="bank" class="form-control"
                                                        value="{{ $item->bank }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="namaRek" class="form-label">Nama Pemilik
                                                        Rekening</label>
                                                    <input type="text" name="namaRek" class="form-control"
                                                        value="{{ $item->namaRek }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="noRek" class="form-label">Nomor Rekening</label>
                                                    <input type="text" name="noRek" class="form-control"
                                                        value="{{ $item->noRek }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="golongan_id" class="form-label">Golongan</label>
                                                    <select name="golongan_id" class="form-select" required>
                                                        @foreach($golongan as $k)
                                                        <option value="{{ $k->id }}" {{ $item->golongan_id == $k->id ? 'selected' : '' }}>
                                                            {{ $k->namaGolPang }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-info">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-baseline">
            <p class="text-xs font-weight-bold mb-0">Showing {{ $pegawai->firstItem() }} to {{ $pegawai->lastItem() }} of {{ $pegawai->total() }} entries</p>
            {{ $pegawai->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="nip_nik" class="form-label">NIP</label>
                                <input type="text" name="nip_nik" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="idJabatanPegawai" class="form-label">Jabatan Pegawai</label>
                                <select name="jabatan_pegawai_id" class="form-select" required>
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
                                <input type="text" name="bank" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="namaRek" class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" name="namaRek" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="noRek" class="form-label">Nomor Rekening</label>
                                <input type="text" name="noRek" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="golongan_id" class="form-label">Golongan</label>
                                <select name="golongan_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Golongan</option>
                                    @foreach($golongan as $k)
                                    <option value="{{ $k->id }}">{{ $k->namaGolPang }}</option>
                                    @endforeach
                                </select>
                            </div>
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
</div>
@endsection