<?php 
// views/ulasan_list.php (Mendukung Global & Per-Buku)
require_once 'views/template/header.php';
// ASUMSI:
// 1. $ulasanList dimuat (berisi hasil JOIN di mode Global)
// 2. $bukuDetail bernilai ARRAY (Mode Per Buku) atau NULL/empty (Mode Global)
?>

<div class="content-header">
    <?php if (!empty($bukuDetail)): ?>
        <h2>Ulasan untuk Buku: <?= htmlspecialchars($bukuDetail['judul'] ?? 'Tidak Ditemukan'); ?></h2>
        <a 
            href="index.php?entity=ulasan&action=add&id_buku=<?= $bukuDetail['id_buku']; ?>" 
            class="btn btn-primary"
        >
            Tambahkan Ulasan
        </a>
    <?php else: ?>
        <h2>Daftar Semua Ulasan</h2>
        <a 
            href="index.php?entity=ulasan&action=add" 
            class="btn btn-primary"
        >
            Tambah Ulasan Baru
        </a>
    <?php endif; ?>
</div>

<table class="data-table">
    <thead>
        <tr>
            <?php if (empty($bukuDetail)): ?>
                <th>Judul Buku</th>
            <?php endif; ?>
            
            <th>Rating</th>
            <th>Catatan</th>
            <th>Favorite Quote</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($ulasanList)): ?>
            <?php foreach ($ulasanList as $ulasan): ?>
                <tr>
                    <?php if (empty($bukuDetail)): ?>
                        <td>
                            <a href="index.php?entity=ulasan&action=list&id_buku=<?= $ulasan['id_buku']; ?>">
                                <strong><?= htmlspecialchars($ulasan['judul'] ?? 'N/A'); ?></strong><br>
                                <small>Oleh: <?= htmlspecialchars($ulasan['penulis'] ?? 'N/A'); ?></small>
                            </a>
                        </td>
                    <?php endif; ?>
                    
                    <td><?= htmlspecialchars($ulasan['rating']); ?>/5</td>
                    <td><?= htmlspecialchars($ulasan['catatan']); ?></td>
                    <td><?= htmlspecialchars($ulasan['favorite_quote']); ?></td>
                    <td>
                        <a href="index.php?entity=ulasan&action=edit&id=<?= $ulasan['id_ulasan']; ?>" class="btn btn-edit">Edit</a>
                        <a 
                            href="index.php?entity=ulasan&action=delete&id=<?= $ulasan['id_ulasan']; ?>&redirect=<?= empty($bukuDetail) ? 'global' : 'perbuku&id_buku=' . $ulasan['id_buku'] ?>" 
                            onclick="return confirm('Hapus ulasan ini?');" 
                            class="btn btn-danger"
                        >
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= empty($bukuDetail) ? '5' : '4' ?>" style="text-align: center;">Belum ada ulasan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>