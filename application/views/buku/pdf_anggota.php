<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Anggota (PDF)</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Anggota</h3>
    <table>
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
</body>
</html>
