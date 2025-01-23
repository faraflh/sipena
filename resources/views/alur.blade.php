@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Alur</h5>
                        <form method="GET" action="{{ route('alur.index') }}" class="d-flex align-items-center">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Type here..."
                                value="{{ request('search') }}">
                        </div>
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Alur Baru
                        </a>
                    </form>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table alur align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                No
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Alur
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alur as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center text">{{ $item->namaAlur }}</td>
                                <td class="align-middle text-center">
                                    <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"></i>

                                    <form id="delete-form-{{ $item->id }}"
                                          action="{{ route('alur.destroy', $item->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="{{ route('alur.update', $item->id) }}" class="edit" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                 aria-labelledby="editModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('alur.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Alur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="namaAlur{{ $item->id }}" class="form-label">Nama Alur</label>
                                                    <input type="text" id="namaAlur{{ $item->id }}" name="namaAlur" class="form-control" value="{{ $item->namaAlur }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
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
                    <form action="{{ route('alur.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama alur" class="form-label">Nama Alur</label>
                                <input type="text" name="namaAlur" class="form-control" required>
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

{{--@extends('partials.dbFooter')--}}
