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
            <tbody id=tbody_kelas>
            </tbody>
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
                    <input type="hidden" id="id">
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        loadKelasData();

        function loadKelasData() {
            $.ajax({
                url: '<?= base_url("kelas/getData") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var kelasTableBody = '';
                    var no = 1;

                    $.each(response, function(index, kelas) {
                        kelasTableBody += '<tr class="text-center">';
                        kelasTableBody += '<td>' + no++ + '</td>';
                        kelasTableBody += '<td>' + kelas.nama_kelas + '</td>';
                        kelasTableBody += '<td>' + kelas.wali_kelas + '</td>';
                        kelasTableBody += '<td>';
                        kelasTableBody += '<button data-id="' + kelas.id + '" class="btn btn-warning btn-sm editKelasBtn"><i class="fas fa-edit"></i></button> ';
                        kelasTableBody += '<button data-id="' + kelas.id + '" class="btn btn-danger btn-sm deleteKelasBtn"><i class="fas fa-trash"></i></button>';
                        kelasTableBody += '</td>';
                        kelasTableBody += '</tr>';
                    });

                    $('#tbody_kelas').html(kelasTableBody);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                    console.log(error);
                }
            });
        }
    });

    $(document).on('click', '.editKelasBtn', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url("kelas/edit") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.id);
                $('#nama_kelas').val(data.nama_kelas);
                $('#wali_kelas').val(data.wali_kelas);

                $('#editKelasModal').modal('show');
            }
        });
    });

    $('#editKelasForm').on('submit', function(e) {
        e.preventDefault();

        var id = $('#id').val();

        $.ajax({
            url: '<?= base_url("kelas/update") ?>/' + id,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response.status)
                if (response.status === 'success') {
                    window.location.href = "<?= base_url('kelas/index') ?>";
                    loadKelasData();
                    $('#editKelasModal').modal('hide');
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
                        loadKelasData();
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