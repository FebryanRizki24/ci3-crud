<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('siswa/create') ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus"> Tambah Siswa</i> </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nip</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id=tbody_siswa>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="editSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSiswaModalLabel">Edit Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editSiswaForm">
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <div class="text-small text-danger" id="error_name"></div>
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="text" id="nip" name="nip" class="form-control">
                        <div class="text-small text-danger" id="error_nip"></div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria" >Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <div class="text-small text-danger" id="error_jenis_kelamin"></div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="4"></textarea>
                        <div class="text-small text-danger" id="error_alamat"></div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
                        <div class="text-small text-danger" id="error_tanggal_lahir"></div>
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas:</label>
                        <select id="id_kelas" name="id_kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="text-small text-danger" id="error_id_kelas"></div>
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
        loadSiswaData();

        function loadSiswaData() {
            $.ajax({
                url: '<?= base_url("siswa/getData") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var siswaTableBody = '';
                    var no = 1;

                    $.each(response, function(index, siswa) {
                        siswaTableBody += '<tr class="text-center">';
                        siswaTableBody += '<td>' + no++ + '</td>';
                        siswaTableBody += '<td>' + siswa.name + '</td>';
                        siswaTableBody += '<td>' + siswa.nip + '</td>';
                        siswaTableBody += '<td>' + siswa.jenis_kelamin + '</td>';
                        siswaTableBody += '<td>' + siswa.alamat + '</td>';
                        siswaTableBody += '<td>' + siswa.tanggal_lahir + '</td>';
                        siswaTableBody += '<td>' + siswa.nama_kelas + '</td>';
                        siswaTableBody += '<td>';
                        siswaTableBody += '<button data-id="' + siswa.id + '" class="btn btn-warning btn-sm editSiswaBtn"><i class="fas fa-edit"></i></button> ';
                        siswaTableBody += '<button data-id="' + siswa.id + '" class="btn btn-danger btn-sm deleteSiswaBtn"><i class="fas fa-trash"></i></button>';
                        siswaTableBody += '</td>';
                        siswaTableBody += '</tr>';
                    });

                    $('#tbody_siswa').html(siswaTableBody);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                    console.log(error);
                }
            });
        }
    });

    $(document).on('click', '.editSiswaBtn', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url("siswa/edit") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#nip').val(data.nip);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#alamat').val(data.alamat);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#id_kelas').val(data.id_kelas);

                $('#editSiswaModal').modal('show');
            }
        });
    });

    $('#editSiswaForm').on('submit', function(e) {
        e.preventDefault();

        var id = $('#id').val();

        $.ajax({
            url: '<?= base_url("siswa/update") ?>/' + id,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response.status)
                if (response.status === 'success') {
                    window.location.href = "<?= base_url('siswa/index') ?>";
                    loadSiswaData();
                    $('#editSiswaModal').modal('hide');
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

    $(document).on('click', '.deleteSiswaBtn', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?= base_url('siswa/destroy') ?>/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    console.log(response.status);
                    if (response.status === 'success') {
                        window.location.href = "<?= base_url('siswa/index') ?>";
                        loadSiswaData();
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