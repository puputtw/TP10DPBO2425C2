<?php 
// views/buku_list.php
require_once 'views/template/header.php';

?>

<div class="content-header">
    <h2>Daftar Buku</h2>
    <a href="index.php?entity=buku&action=add" class="btn btn-primary">Tambah Buku</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Halaman</th>
            <th>Genre</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bukuList as $buku): ?>
            <tr>
                <td><?= htmlspecialchars($buku['judul']); ?></td>
                <td><?= htmlspecialchars($buku['penulis']); ?></td>
                <td><?= htmlspecialchars($buku['halaman']); ?></td>
                <td><?= htmlspecialchars($buku['genre']); ?></td>
                <td>
                    <a href="index.php?entity=buku&action=edit&id=<?= $buku['id_buku']; ?>" class="btn btn-edit">Edit</a>
                 
                    <a href="index.php?entity=buku&action=delete&id=<?= $buku['id_buku']; ?>" onclick="return confirm('Hapus buku ini?');" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>