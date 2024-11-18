<div class="modal fade" id="modalHapus<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Apakah Anda Yakin Menghapus Data ini?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                    <button type="submit" class="btn btn-danger" name="delete-data">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>