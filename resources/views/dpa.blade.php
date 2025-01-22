@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">DPA</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah DPA Baru
                        </button>
                    </div>
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
                        @foreach($dpa as $index => $dpas)
                            <tr>
                            <td class="text-center">{{ ($dpa->currentPage() - 1) * $dpa->perPage() + $loop->iteration }}</td>
                            <td class="text-center">{{ $dpas->noDPA }}</td>
                                <td class="text-center">{{ $dpas->tujuan }}</td>
                                <td class="text-center">{{ $dpas->subKeg }}</td>
                                <td class="text-center">
                                    <i class="fas fa-trash-alt text-danger cursor-pointer"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $dpas->id }}').submit();"
                                       title="Delete"></i>
                                    <form id="delete-form-{{ $dpas->id }}" action="{{ route('dpa.destroy', $dpas->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $dpas->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $dpas->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $dpas->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dpa.update', $dpas->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $dpas->id }}">Edit DPA</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="noSPT" class="form-label">No. SPT</label>
                                                        <input type="text" name="noSPT" class="form-control" value="{{ $dpas->noSPT }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noSPPD" class="form-label">No. SPPD</label>
                                                        <input type="text" name="noSPPD" class="form-control" value="{{ $dpas->noSPPD }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tujuan" class="form-label">Tujuan</label>
                                                        <input type="text" name="tujuan" class="form-control" value="{{ $dpas->tujuan }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noRek" class="form-label">No. Rekening</label>
                                                        <input type="text" name="noRek" class="form-control" value="{{ $dpas->noRek }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="noDPA" class="form-label">No. DPA</label>
                                                        <input type="text" name="noDPA" class="form-control" value="{{ $dpas->noDPA }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="subKeg" class="form-label">Sub Kegiatan</label>
                                                        <input type="text" name="subKeg" class="form-control" value="{{ $dpas->subKeg }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tahun" class="form-label">Tahun</label>
                                                        <input type="text" name="tahun" class="form-control" value="{{ $dpas->tahun }}" required>
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
            <div class="card-footer d-flex justify-content-between align-items-baseline">
                <p class="text-xs font-weight-bold mb-0">Showing {{ $dpa->firstItem() }} to {{ $dpa->lastItem() }} of {{ $dpa->total() }} entries</p>
                {{ $dpa->links('pagination::bootstrap-5') }}
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
