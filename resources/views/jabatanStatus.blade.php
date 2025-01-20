@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Jabatan Status</h5>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0"data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Jabatan Status</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Jabatan Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($jabatanStatus as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center text">{{ $item->namaJabatanStatus }}</td>
                            <td class="align-middle text-center">
                                <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"></i>

                                    <form id="delete-form-{{ $item->id }}"
                                          action="{{ route('jabatanStatus.destroy', $item->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="{{ route('jabatanStatus.update', $item->id) }}" class="edit" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                    </a>
                            </td>
                        </tr>
                                        
                        <!-- Edit Modal -->
                        <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1" aria-labelledby="editJabsusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('jabatanStatus.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Jabatan Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="namaJabatanStatus{{ $item->id }}" class="form-label">Nama Jabatan Status</label>
                                                <input type="text" id="namaJabatanStatus{{ $item->id }}" name="namaJabatanStatus" class="form-control"
                                                    value="{{ $item->namaJabatanStatus }}" required>                            
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
                <p class="text-xs font-weight-bold mb-0">Showing {{ $jabatanStatus->firstItem() }} to {{ $jabatanStatus->lastItem() }} of {{ $jabatanStatus->total() }} entries</p>
                {{ $jabatanStatus->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="createForm" action="{{ route('jabatanStatus.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Jabatan Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama jabatanStatus" class="form-label">Nama Jabatan Status</label>
                                <input type="text" name="namaJabatanStatus" class="form-control" required>
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

@push('scripts')
<script src="{{ 'js/ajax.js' }}"></script>
@endpush
