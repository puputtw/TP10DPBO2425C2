<?php 
// views/status_bacaan_form.php
require_once 'views/template/header.php'; 
// Asumsi $bukuList dimuat untuk dropdown buku di mode CREATE
// Asumsi $statusBacaanViewModel sudah dimuat untuk statusOptions
?>

<div class="content-header">
    <h2><?= isset($data) ? 'Update Status Bacaan' : 'Mulai Tracking Buku' ?></h2>
    <a href="index.php?entity=status_bacaan" class="btn btn-secondary">Kembali</a>
</div>

<div class="card form-container">
    <form action="index.php?entity=status_bacaan&action=<?= isset($data) ? 'update&id='.$data['id_status_bacaan'] : 'save' ?>" method="POST">
        
        <?php if (!isset($data)): // Mode CREATE: perlu pilih buku dan ID pengguna (asumsi 1) ?>
            <input type="hidden" name="id_pengguna" value="1">
            <div class="form-group">
                <label>Pilih Buku:</label>
                <select name="id_buku" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php 
                    // Asumsi $bukuList sudah dimuat dari BukuViewModel
                    foreach ($bukuList as $buku): ?>
                        <option value="<?= $buku['id_buku']; ?>">
                            <?= htmlspecialchars($buku['judul'] . ' - ' . $buku['penulis']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label>Status:</label>
            <select name="status" required>
                <?php 
                foreach ($statusBacaanViewModel->statusOptions as $option): ?>
                    <option value="<?= $option ?>" <?= (isset($data) && $data['status'] == $option) ? 'selected' : '' ?>>
                        <?= $option ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Tanggal Mulai:</label>
            <input type="date" name="start_date" value="<?= isset($data) ? htmlspecialchars($data['start_date']) : date('Y-m-d') ?>" required>
        </div>
        
        <div class="form-group">
            <label>Tanggal Selesai (Opsional):</label>
            <input type="date" name="finish_date" value="<?= isset($data) ? htmlspecialchars($data['finish_date']) : '' ?>">
        </div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php require_once 'views/template/footer.php'; ?>