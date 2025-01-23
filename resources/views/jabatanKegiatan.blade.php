@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jabatan Kegiatan</h5>
                    <form method="GET" action="{{ route('jabatanKegiatan.index') }}" class="d-flex align-items-center">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Type here..."
                                value="{{ request('search') }}">
                        </div>
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Jabatan Kegiatan
                        </a>
                    </form>
                </div>
            </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pegawai</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jabatanKegiatan as $index => $jabKeg)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $jabKeg->pegawai->nama }}</td>
                                <td class="text-center">{{ $jabKeg->kategori->namaKategori }}</td>
                                <td class="text-center">{{ $jabKeg->jabatanStatus->namaJabatanStatus }}</td>
                                <td class="text-center">
                                    <i class="fas fa-trash-alt text-danger cursor-pointer"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $jabKeg->id }}').submit();"
                                       title="Delete"></i>
                                    <form id="delete-form-{{ $jabKeg->id }}" action="{{ route('jabatanKegiatan.destroy', $jabKeg->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editJabKegModal{{ $jabKeg->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editJabKegModal{{ $jabKeg->id }}" tabindex="-1" aria-labelledby="editJabKegModalLabel{{ $jabKeg->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('jabatanKegiatan.update', $jabKeg->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editJabKegModalLabel{{ $jabKeg->id }}">Edit Jabatan Kegiatan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="pegawai" class="form-label">Pegawai</label>
                                                    <select name="pegawai_id" class="form-control" required>
                                                        @foreach($pegawai as $pgw)
                                                            <option value="{{ $pgw->id }}" {{ $jabKeg->pegawai_id == $pgw->id ? 'selected' : '' }}>
                                                                {{ $pgw->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select name="kategori_id" class="form-control" required>
                                                        @foreach($kategori as $ktg)
                                                            <option value="{{ $ktg->id }}" {{ $jabKeg->kategori_id == $ktg->id ? 'selected' : '' }}>
                                                                {{ $ktg->namaKategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jabatanStatus" class="form-label">Jabatan Status</label>
                                                    <select name="jabatan_status_id" class="form-control" required>
                                                        @foreach($jabatanStatus as $jabSus)
                                                            <option value="{{ $jabSus->id }}" {{ $jabKeg->jabatan_status_id == $jabSus->id ? 'selected' : '' }}>
                                                                {{ $jabSus->namaJabatanStatus }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-info">Save</button>
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
                <p class="text-xs font-weight-bold mb-0">Showing {{ $jabatanKegiatan->firstItem() }} to {{ $jabatanKegiatan->lastItem() }} of {{ $jabatanKegiatan->total() }} entries</p>
                {{ $jabatanKegiatan->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createJabKegModal" tabindex="-1" aria-labelledby="createJabKegModalLabel" aria-hidden="true">
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
                    <form action="{{ route('jabatanKegiatan.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createJabKegModalLabel">Tambah Jabatan Kegiatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="pegawai" class="form-label">Pegawai</label>
                                <select name="pegawai_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Pegawai</option>
                                    @foreach($pegawai as $pgw)
                                        <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategori as $ktg)
                                        <option value="{{ $ktg->id }}">{{ $ktg->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jabatanStatus" class="form-label">Jabatan Status</label>
                                <select name="jabatan_status_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jabatan Status</option>
                                    @foreach($jabatanStatus as $jabSus)
                                        <option value="{{ $jabSus->id }}">{{ $jabSus->namaJabatanStatus }}</option>
                                    @endforeach
                                </select>
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
