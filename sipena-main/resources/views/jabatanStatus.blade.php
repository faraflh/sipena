@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Jabatan Status</h5>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Jabatan Status Baru</a>
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
                        <tr>
                            <td class="text-center numbering">1</td>
                            <td class="align-middle text-sm">
                                <span class="text-xs text-center font-weight-bold text-uppercase">Bendahara</span>
                            </td>
                            <td class="align-middle text-center">
                                <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                <a href="#editJabsusModal" class="edit" data-bs-toggle="modal">
                                    <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center numbering">2</td>
                            <td class="align-middle text-sm">
                                <span class="text-xs font-weight-bold text-uppercase">PPTK</span>
                            </td>
                            <td class="align-middle text-center">
                                <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                <i class="fas fa-pencil-alt ms-4 text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editJabsusModal" class="modal fade" tabindex="-1" aria-labelledby="editJabsusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editJabsusModalLabel">Edit Jabatan Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times cursor-pointer text-secondary"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="jabsusName" class="form-label">Nama Jabatan Status</label>
                                <input type="text" id="jabsusName" class="form-control" required>
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
