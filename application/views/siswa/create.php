<form id="formSiswa" method="POST">
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" class="form-control">
        <div id="error_name" class="text-small text-danger"></div>
    </div>

    <div class="form-group">
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" class="form-control">
        <div id="error_nip" class="text-small text-danger"></div>
    </div>

    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>
        <div id="error_jenis_kelamin" class="text-small text-danger"></div>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" class="form-control" rows="4"></textarea>
        <div id="error_alamat" class="text-small text-danger"></div>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
        <div id="error_tanggal_lahir" class="text-small text-danger"></div>
    </div>

    <div class="form-group">
        <label for="id_kelas">Kelas:</label>
        <select id="id_kelas" name="id_kelas" class="form-control">
            <option value="">Pilih Kelas</option>
            <?php foreach ($kelas as $k): ?>
                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
            <?php endforeach; ?>
        </select>
        <div id="error_id_kelas" class="text-small text-danger"></div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>

<script>
    $(document).ready(function() {
        $('#formSiswa').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "<?= base_url('/siswa/insert') ?>",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = "<?= base_url('siswa/index') ?>";
                            $('#formSiswa')[0].reset();
                        } else {
                            $('#error_name').html(response.errors.error_name);
                            $('#error_nip').html(response.errors.error_nip);
                            $('#error_jenis_kelamin').html(response.errors.error_jenis_kelamin);
                            $('#error_alamat').html(response.errors.error_alamat);
                            $('#error_tanggal_lahir').html(response.errors.error_tanggal_lahir);
                            $('#error_id_kelas').html(response.errors.error_id_kelas);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred. Please try again.');
                        console.log(error);
                    }
                });
            });
    });
</script>