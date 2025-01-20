$(document).ready(function () {
    $('#createForm').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("jabatanStatus.store") }}',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                $('#createModal').modal('hide');
                $('#jabatanStatusTable').append(`
                    <tr id="row-${response.id}">
                        <td class="text-center">${response.index}</td>
                        <td class="text-center">${response.namaJabatanStatus}</td>
                        <td class="align-middle text-center">
                            <i class="fas fa-trash-alt text-danger cursor-pointer"
                                onclick="deleteJabatanStatus(${response.id})"></i>
                            <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#editModal-${response.id}">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </button>
                        </td>
                    </tr>
                `);
                $('#createForm')[0].reset();
                alert('Data berhasil ditambahkan.');
            },
            error: function (error) {
                console.error(error);
                alert('Gagal menambahkan data.');
            },
        });
    });
});

// Fungsi hapus data
function deleteJabatanStatus(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: `/jabatanStatus/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function () {
                $(`#row-${id}`).remove();
                alert('Data berhasil dihapus.');
            },
            error: function (error) {
                console.error(error);
                alert('Gagal menghapus data.');
            },
        });
    }
}
