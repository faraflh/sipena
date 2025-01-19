@extends('partials.dashboardLayout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Jabatan Kegiatan</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Jabatan Kegiatan
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table pegawai align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pegawai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jabatanKegiatan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->pegawai->nama ?? '-' }}</td>
                            <td>{{ $item->kategori->namaKategori ?? '-'}}</td>
                            <td class="text-center">{{ $item->jabStatus->namajabStatus ?? '-'}}</td>
                            <td class="align-middle text-center">
                                <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"></i>

                                    <form id="delete-form-{{ $item->id }}"
                                          action="{{ route('jabatanKegiatan.destroy', $item->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="{{ route('jabatanKegiatan.update', $item->id) }}" class="edit" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                    </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1" aria-labelledby="editJakKegModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('jabatanKegiatan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Jabatan Kegiatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="pegawai_id" class="form-label">Pegawai</label>
                                                <input type="text" name="pegawai_nama"
                                                class="form-control"
                                                value="{{ $item->pegawai->nama ?? '' }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori_id" class="form-label">Kategori</label>
                                                <input type="text" name="kategori_nama"
                                                class="form-control"
                                                value="{{ $item->kategori->namaKategori ?? '' }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="namajabStatus{{ $item->id }}" class="form-label">Nama Jabatan Status</label>
                                                <input type="text" id="namajabStatus{{ $item->id }}" name="namajabStatus" class="form-control"
                                                    value="{{ $item->jabStatus->namajabStatus }}" required>                            
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

    <!-- Add Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('jabatanKegiatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Jabatan Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select id="pegawai_id" name="pegawai_id" class="form-select" required>
                            <option value="" selected disabled>Pilih Pegawai</option>
                            @foreach($pegawai as $pgw)
                                <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                            @endforeach
                        </select>
                            <!-- <input type="text" id="pegawai" name="pegawai" class="form-control" required> -->
                        </div>
                        <div class="form-group mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->namaKategori }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="kategori" name="kategori" class="form-control" required> -->
                        </div>
                        <div class="form-group mb-3">
                            <label for="jabStatus" class="form-label">Jabatan Status</label>
                            <select id="jabStatus" name="jabStatus" class="form-select" required>
                                <option value="" selected disabled>Pilih Jabatan Status</option>
                                @foreach($jabatanStatus as $jab)
                                    <option value="{{ $jab->namaJabatanStatus }}">{{ $jab->namaJabatanStatus }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="jabStatus" name="jabStatus" class="form-control" required> -->
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
</div>
@endsection