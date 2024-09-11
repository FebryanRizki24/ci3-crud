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
                            <button data-toggle="modal" data-target="#edit<?= $k->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('kelas/destroy/' . $k->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>


<!-- Modal Edit -->
<?php foreach ($kelas as $k) : ?>
    <div class="modal fade" id="edit<?= $k->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/kelas/update/' . $k->id) ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas:</label>
                            <input type="text" id="nama_kelas" name="nama_kelas" class="form-control" value="<?= $k->nama_kelas ?>">
                            <?= form_error('nama_kelas', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="wali_kelas">Wali Kelas:</label>
                            <input type="text" id="wali_kelas" name="wali_kelas" class="form-control" value="<?= $k->wali_kelas ?>">
                            <?= form_error('wali_kelas', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>