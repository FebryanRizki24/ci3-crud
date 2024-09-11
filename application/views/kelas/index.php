<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('kelas/create') ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus"> Tambah Kelas</i> </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            foreach ($kelas as $k) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $k->nama_kelas ?></td>
                        <td><?= $k->wali_kelas ?></td>
                        <td>
                            <button data-id="<?= $k->id ?>" class="btn btn-warning btn-sm editKelasBtn"><i class="fas fa-edit"></i></button>
                            <button data-id="<?= $k->id ?>" class="btn btn-danger btn-sm deleteKelasBtn"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editKelasModal" tabindex="-1" aria-labelledby="editKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editKelasForm">
                    <input type="hidden" id="edit_id">
                    <div class="form-group">
                        <label for="edit_nama_kelas">Nama Kelas:</label>
                        <input type="text" id="edit_nama_kelas" name="nama_kelas" class="form-control">
                        <div class="text-small text-danger" id="error_nama_kelas"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit_wali_kelas">Wali Kelas:</label>
                        <input type="text" id="edit_wali_kelas" name="wali_kelas" class="form-control">
                        <div class="text-small text-danger" id="error_wali_kelas"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.editKelasBtn', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url("kelas/edit") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#edit_id').val(data.id);
                $('#edit_nama_kelas').val(data.nama_kelas);
                $('#edit_wali_kelas').val(data.wali_kelas);

                $('#editKelasModal').modal('show');
            }
        });
    });

    $('#editKelasForm').on('submit', function(e) {
        e.preventDefault();

        var id = $('#edit_id').val();

        $.ajax({
            url: '<?= base_url("kelas/update") ?>/' + id,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response.status)
                if (response.status === 'success') {
                    window.location.href = "<?= base_url('kelas/index') ?>";
                    $('#editKelasModal').modal('hide');
                    loadKelasData();
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

    $(document).on('click', '.deleteKelasBtn', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?= base_url("kelas/destroy") ?>/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = "<?= base_url('kelas/index') ?>";
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    });
</script>