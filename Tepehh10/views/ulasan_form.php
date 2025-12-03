<?php 
// views/ulasan_form.php
require_once 'views/template/header.php'; 
// Asumsi $bukuDetail, $id_buku_current, $bukuList, dan $data sudah dimuat dari index.php
?>

<div class="content-header">
    <h2><?= isset($data) ? 'Edit Ulasan' : 'Tambah Ulasan' ?> untuk "<?= htmlspecialchars($bukuDetail['judul'] ?? 'Buku'); ?>"</h2>
    <a href="index.php?entity=ulasan&action=list&id_buku=<?= $id_buku_current ?? $data['id_buku'] ?? '' ?>" class="btn btn-secondary">Kembali</a>
</div>

<div class="card form-container">
    <form action="index.php?entity=ulasan&action=<?= isset($data) ? 'update&id='.$data['id_ulasan'] : 'save' ?>" method="POST">

        <?php if (!isset($data) && empty($id_buku_current)): // MODE TAMBAH BARU GLOBAL ?>
            <div class="form-group">
                <label>Pilih Buku:</label>
                <select name="id_buku" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php 
                    // Asumsi $bukuList dimuat di index.php
                    foreach ($bukuList as $buku): ?>
                        <option value="<?= $buku['id_buku']; ?>">
                            <?= htmlspecialchars($buku['judul'] . ' - ' . $buku['penulis']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
        <?php else: // MODE EDIT atau MODE TAMBAH KHUSUS BUKU ?>
            <input type="hidden" name="id_buku" value="<?= $id_buku_current ?? $data['id_buku'] ?>">
            
            <?php if (isset($data)): // Jika Edit, tampilkan judul sebagai teks ?>
            <div class="form-group">
                <label>Buku:</label>
                <p><strong><?= htmlspecialchars($bukuDetail['judul'] ?? 'Judul Buku Tidak Ditemukan'); ?></strong></p>
            </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="form-group">
            <label>Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" value="<?= isset($data) ? htmlspecialchars($data['rating']) : '' ?>" required placeholder="Beri nilai 1 sampai 5">
        </div>
        
        <div class="form-group">
            <label>Catatan Review:</label>
            <textarea name="catatan" rows="3" required placeholder="Tuliskan pendapat Anda tentang buku ini"><?= isset($data) ? htmlspecialchars($data['catatan']) : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Favorite Quote :</label>
            <input type="text" name="favorite_quote" value="<?= isset($data) ? htmlspecialchars($data['favorite_quote']) : '' ?>" placeholder="Kutipan favorit Anda">
        </div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php require_once 'views/template/footer.php'; ?>