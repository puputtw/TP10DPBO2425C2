<?php 
// views/pengguna_list.php
require_once 'views/template/header.php';
// Asumsi $penggunaList sudah dimuat dari PenggunaViewModel->getPenggunaList()
?>

<div class="content-header">
    <h2>Daftar Pengguna</h2>
    <a href="index.php?entity=pengguna&action=add" class="btn btn-primary">Tambah Pengguna</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($penggunaList as $pengguna): ?>
            <tr>
                <td><?= htmlspecialchars($pengguna['id_pengguna']); ?></td>
                <td><?= htmlspecialchars($pengguna['nama']); ?></td>
                <td><?= htmlspecialchars($pengguna['email']); ?></td>
                <td>
                    <a href="index.php?entity=pengguna&action=edit&id=<?= $pengguna['id_pengguna']; ?>" class="btn btn-edit">Edit</a>
                    <a href="index.php?entity=pengguna&action=delete&id=<?= $pengguna['id_pengguna']; ?>" onclick="return confirm('Hapus pengguna ini?');" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>