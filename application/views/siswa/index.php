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
            <?php
            $no = 1;
            foreach ($siswa as $s) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $s->name ?></td>
                        <td><?= $s->nip ?></td>
                        <td><?= $s->jenis_kelamin ?></td>
                        <td><?= $s->alamat ?></td>
                        <td><?= $s->tanggal_lahir ?></td>
                        <td><?= $s->nama_kelas ?></td>
                        <td>
                            <button data-toggle="modal" data-target="#edit<?= $s->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('siswa/destroy/' . $s->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="edit<?= $s->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/siswa/update/' . $s->id) ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Nama:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= $s->name ?>">
                            <?= form_error('name', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" id="nip" name="nip" class="form-control" value="<?= $s->nip ?>">
                            <?= form_error('nip', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Pria" <?= $s->jenis_kelamin == 'Pria' ? 'selected' : ''; ?>>Pria</option>
                                <option value="Wanita" <?= $s->jenis_kelamin == 'Wanita' ? 'selected' : ''; ?>>Wanita</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="4"><?= $s->alamat ?></textarea>
                            <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= $s->tanggal_lahir ?>">
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