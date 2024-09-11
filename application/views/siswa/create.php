<form action="<?= base_url('/siswa/insert') ?>" method="POST">
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" class="form-control">
        <?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" class="form-control">
        <?= form_error('nip', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>
        <?= form_error('jenis_kelamin', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" class="form-control" rows="4"></textarea>
        <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
        <?= form_error('date', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="id_kelas">Kelas:</label>
        <select id="id_kelas" name="id_kelas" class="form-control">
            <option value="">Pilih Kelas</option>
            <?php foreach ($kelas as $k): ?>
                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('id_kelas', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>
