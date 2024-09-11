<div class="card">
    <div class="card-header">
        <h3>Dashboard - Jumlah Siswa per Kelas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th>Kelas</th>
                    <th>Jumlah Siswa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kelas as $k) : ?>
                    <tr class="text-center">
                        <td><?= $k->nama_kelas ?></td>
                        <td><?= $k->student_count ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
