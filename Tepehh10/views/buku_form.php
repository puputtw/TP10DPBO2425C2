<?php 
// views/buku_form.php
require_once 'views/template/header.php'; 

?>

<div class="content-header">
    <h2><?= isset($data) ? 'Edit Buku' : 'Tambah Buku' ?></h2>
    <a href="index.php?entity=buku" class="btn btn-secondary">Kembali</a>
</div>

<div class="card form-container">
    <form action="index.php?entity=buku&action=<?= isset($data) ? 'update&id='.$data['id_buku'] : 'save' ?>" method="POST">
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" name="judul" value="<?= isset($data) ? htmlspecialchars($data['judul']) : '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Penulis:</label>
            <input type="text" name="penulis" value="<?= isset($data) ? htmlspecialchars($data['penulis']) : '' ?>">
        </div>
        
        <div class="form-group">
            <label>Jumlah Halaman:</label>
            <input type="number" name="halaman" value="<?= isset($data) ? htmlspecialchars($data['halaman']) : '' ?>">
        </div>

      <div class="form-group">
        <label>Genre:</label>
        <select name="genre" required>
            <option value="">-- Pilih Genre --</option>
            <?php 
        // Asumsi $bukuViewModel sudah diinisialisasi di index.php
        foreach ($bukuViewModel->genreOptions as $option): ?>
            <option 
                value="<?= $option ?>" 
                <?= (isset($data) && $data['genre'] == $option) ? 'selected' : '' ?>
            >
                <?= $option ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php require_once 'views/template/footer.php'; ?>