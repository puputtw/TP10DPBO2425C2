<?php 
// views/pengguna_form.php
require_once 'views/template/header.php'; 
// Menggunakan variabel $data sesuai permintaan Anda
?>

<div class="content-header">
    <h2><?= isset($data) ? 'Edit Pengguna' : 'Tambah Pengguna' ?></h2>
    <a href="index.php?entity=pengguna" class="btn btn-secondary">Kembali</a>
</div>

<div class="card form-container">
    <form action="index.php?entity=pengguna&action=<?= isset($data) ? 'update&id='.$data['id_pengguna'] : 'save' ?>" method="POST">
        
        <div class="form-group">
            <label>Nama Pengguna:</label>
            <input type="text" name="nama" value="<?= isset($data) ? htmlspecialchars($data['nama']) : '' ?>">
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= isset($data) ? htmlspecialchars($data['email']) : '' ?>">
        </div>
        
        <button type="submit" class="btn btn-success">Simpan Data</button>
    </form>
</div>

<?php require_once 'views/template/footer.php'; ?>