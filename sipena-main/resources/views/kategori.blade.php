@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Kategori</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Kategori Baru
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kategori</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $index => $kategori)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $kategori->namaKategori }}</td>
                            <td class="text-center">
                                <i class="fas fa-trash-alt text-danger cursor-pointer"
                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{ $kategori->id }}').submit();"
                                   title="Delete"></i>
                                <form id="delete-form-{{ $kategori->id }}" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $kategori->id }}">
                                    <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" title="Edit"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kategori->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $kategori->id }}">Edit Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaKategori" class="form-label">Nama Kategori</label>
                                                <input type="text" name="namaKategori" class="form-control" value="{{ $kategori->namaKategori }}" required>
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
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="namaKategori" class="form-control" required>
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
