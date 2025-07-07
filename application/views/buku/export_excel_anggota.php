<table border="1" width="100%">
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
