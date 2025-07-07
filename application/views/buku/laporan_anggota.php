<div class="container-fluid">
    <h3 class="text-dark mb-4"><?= $judul; ?></h3>

    <a href="<?= base_url('laporan/cetak_anggota'); ?>" target="_blank" class="btn btn-sm btn-primary mb-3">
        <i class="fas fa-print"></i> Print
    </a>
    <a href="<?= base_url('laporan/pdf_anggota'); ?>" target="_blank" class="btn btn-sm btn-warning mb-3">
        <i class="fas fa-file-pdf"></i> Download PDF
    </a>
    <a href="<?= base_url('laporan/excel_anggota'); ?>" class="btn btn-sm btn-success mb-3">
        <i class="fas fa-file-excel"></i> Export ke Excel
    </a>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="thead-light">
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
                <?php $i = 1; foreach ($anggota as $a) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $a['nama']; ?></td>
                        <td><?= $a['email']; ?></td>
                        <td><?= $a['role_id'] == 2 ? 'Member' : 'Admin'; ?></td>
                        <td><?= $a['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td><?= date('d F Y', strtotime($a['tanggal_input'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
