@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">DPA</h5>
                    <form method="GET" action="{{ route('dpa.index') }}" class="d-flex align-items-center">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Type here..."
                                value="{{ request('search') }}">
                        </div>
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah DPA Baru
                        </a>
                    </form>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. DPA</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tujuan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Kegiatan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dpa as $index => $dpa)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $dpa->noDPA }}</td>
                                <td class="text-center">{{ $dpa->tujuan }}</td>
                                <td class="text-center">{{ $dpa->subKeg }}</td>
                                <td class="text-center">
                                    <i class="fas fa-trash-alt text-danger cursor-pointer"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $dpa->id }}').submit();"
                                        title="Delete"></i>
                                    <form id="delete-form-{{ $dpa->id }}" action="{{ route('dpa.destroy', $dpa->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $dpa->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $dpa->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $dpa->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dpa.update', $dpa->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $dpa->id }}">Edit DPA</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="noSPT" class="form-label">No. SPT</label>
                                                        <input type="text" name="noSPT" class="form-control" value="{{ $dpa->noSPT }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noSPPD" class="form-label">No. SPPD</label>
                                                        <input type="text" name="noSPPD" class="form-control" value="{{ $dpa->noSPPD }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tujuan" class="form-label">Tujuan</label>
                                                        <input type="text" name="tujuan" class="form-control" value="{{ $dpa->tujuan }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noRek" class="form-label">No. Rekening</label>
                                                        <input type="text" name="noRek" class="form-control" value="{{ $dpa->noRek }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="noDPA" class="form-label">No. DPA</label>
                                                        <input type="text" name="noDPA" class="form-control" value="{{ $dpa->noDPA }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="subKeg" class="form-label">Sub Kegiatan</label>
                                                        <input type="text" name="subKeg" class="form-control" value="{{ $dpa->subKeg }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tahun" class="form-label">Tahun</label>
                                                        <input type="text" name="tahun" class="form-control" value="{{ $dpa->tahun }}" required>
                                                    </div>
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
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('dpa.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah DPA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="noSPT" class="form-label">No. SPT</label>
                                <input type="text" name="noSPT" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="noSPPD" class="form-label">No. SPPD</label>
                                <input type="text" name="noSPPD" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <input type="text" name="tujuan" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="noRek" class="form-label">No. Rekening</label>
                                <input type="text" name="noRek" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="noDPA" class="form-label">No. DPA</label>
                                <input type="text" name="noDPA" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="subKeg" class="form-label">Sub Kegiatan</label>
                                <input type="text" name="subKeg" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="text" name="tahun" class="form-control" required>
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