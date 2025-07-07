<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Anggota</title>
    <link rel="stylesheet" href="<?= base_url('assets/user/css/bootstrap.css'); ?>">
</head>
<body>
    <div class="container">
        <h3 class="text-center mb-4">Laporan Data Anggota</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($anggota as $a): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['email']; ?></td>
                    <td><?= $a['role_id'] == 1 ? 'Admin' : 'Member'; ?></td>
                    <td><?= $a['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                    <td><?= date('d F Y', strtotime($a['tanggal_input'])); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
            window.print();
        </script>
    </div>
</body>
</html>
