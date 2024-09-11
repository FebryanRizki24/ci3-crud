<form action="<?= base_url('/kelas/insert') ?>" method="POST">
    <div class="form-group">
        <label for="nama_kelas">Nama Kelas:</label>
        <input type="text" id="nama_kelas" name="nama_kelas" class="form-control">
        <?= form_error('nama_kelas', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="wali_kelas">Wali Kelas:</label>
        <input type="text" id="wali_kelas" name="wali_kelas" class="form-control">
        <?= form_error('wali_kelas', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>
