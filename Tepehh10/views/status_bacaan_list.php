<?php 
// views/status_bacaan_list.php
require_once 'views/template/header.php';
// Asumsi $trackingList sudah dimuat dari StatusBacaanViewModel->getTrackingDashboard($id_pengguna)
?>

<div class="content-header">
    <h2>Dashboard Pelacakan Bacaan</h2>
    <a href="index.php?entity=status_bacaan&action=add" class="btn btn-primary">Tambah status</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Status</th>
            <th>Tgl Mulai</th>
            <th>Tgl Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trackingList as $tracking): ?>
            <tr>
                <td><?= htmlspecialchars($tracking['judul']); ?></td>
                <td><?= htmlspecialchars($tracking['penulis']); ?></td>
                <td><?= htmlspecialchars($tracking['status']); ?></td>
                <td><?= htmlspecialchars($tracking['start_date']); ?></td>
                <td><?= htmlspecialchars($tracking['finish_date'] ?? '-'); ?></td>
                <td>
                    <a href="index.php?entity=status_bacaan&action=edit&id=<?= $tracking['id_status_bacaan']; ?>" class="btn btn-edit">Edit</a>
                    
                    <a href="index.php?entity=status_bacaan&action=delete&id=<?= $tracking['id_status_bacaan']; ?>" onclick="return confirm('Hapus tracking ini?');" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>