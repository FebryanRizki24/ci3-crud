<form id="formKelas" method="POST">
    <div class="form-group">
        <label for="nama_kelas">Nama Kelas:</label>
        <input type="text" id="nama_kelas" name="nama_kelas" class="form-control">
        <div class="text-small text-danger" id="error_nama_kelas"></div>
    </div>

    <div class="form-group">
        <label for="wali_kelas">Wali Kelas:</label>
        <input type="text" id="wali_kelas" name="wali_kelas" class="form-control">
        <div class="text-small text-danger" id="error_wali_kelas"></div>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>

<script>
    $(document).ready(function() {
        $('#formKelas').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?= base_url('/kelas/insert') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = "<?= base_url('kelas/index') ?>";
                        $('#formKelas')[0].reset();
                    } else {
                        $('#error_nama_kelas').html(response.errors.error_nama_kelas);
                        $('#error_wali_kelas').html(response.errors.error_wali_kelas);
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