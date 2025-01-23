@extends('partials.dashboardLayout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Dokumen</h5>
                        <form method="GET" action="{{ route('dokumen.index') }}" class="d-flex align-items-center">
                        <div class="input-group me-3">
                            <span class="input-group-text text-body">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Type here..."
                                value="{{ request('search') }}">
                        </div>
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Dokumen Baru
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Dokumen</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alur</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dokumen as $index => $doc)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $doc->kategori->namaKategori }}</td>
                                <td class="text-center">{{ $doc->jenisDokumen }}</td>
                                <td class="text-center">{{ $doc->alur->namaAlur }}</td>
                                <td class="text-center">
                                    <i class="fas fa-trash-alt text-danger cursor-pointer"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $doc->id }}').submit();"
                                       title="Delete"></i>
                                    <form id="delete-form-{{ $doc->id }}" action="{{ route('dokumen.destroy', $doc->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editDokumenModal{{ $doc->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" title="Edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editDokumenModal{{ $doc->id }}" tabindex="-1" aria-labelledby="editDokumenModalLabel{{ $doc->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dokumen.update', $doc->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editDokumenModalLabel{{ $doc->id }}">Edit Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select name="kategori_id" class="form-control" required>
                                                        @foreach($kategori as $k)
                                                            <option value="{{ $k->id }}" {{ $doc->kategori_id == $k->id ? 'selected' : '' }}>
                                                                {{ $k->namaKategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenisDokumen" class="form-label">Jenis Dokumen</label>
                                                    <input type="text" name="jenisDokumen" class="form-control" value="{{ $doc->jenisDokumen }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alur" class="form-label">Alur</label>
                                                    <select name="alur_id" class="form-control" required>
                                                        @foreach($alur as $a)
                                                            <option value="{{ $a->id }}" {{ $doc->alur_id == $a->id ? 'selected' : '' }}>
                                                                {{ $a->namaAlur }}
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
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createDokumenModal" tabindex="-1" aria-labelledby="createDokumenModalLabel" aria-hidden="true">
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
                    <form action="{{ route('dokumen.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDokumenModalLabel">Tambah Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenisDokumen" class="form-label">Jenis Dokumen</label>
                                <input type="text" name="jenisDokumen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="alur" class="form-label">Alur</label>
                                <select name="alur_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Alur</option>
                                    @foreach($alur as $a)
                                        <option value="{{ $a->id }}">{{ $a->namaAlur }}</option>
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
