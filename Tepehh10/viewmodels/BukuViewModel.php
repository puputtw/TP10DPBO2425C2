<?php
require_once 'models/Buku.php';

class BukuViewModel
{
    private $buku;


    public $genreOptions = [
        'Fiksi', 
        'Fiksi Ilmiah',
        'Fantasi',
        'Romansa', 
        'Non-Fiksi',
        'Biografi',
        'Fiksi Sejarah'


    ]; 

    public function __construct()
    {
        $this->buku = new Buku();
    }

    public function getBukuList()
    {
        return $this->buku->getAll();
    }

    public function getBukuById($id_buku)
    {
        return $this->buku->getById($id_buku);
    }

    public function addBuku($judul, $penulis, $halaman, $genre)
    {
        return $this->buku->create($judul, $penulis, $halaman, $genre);
    }

    public function updateBuku($id_buku, $judul, $penulis, $halaman, $genre)
    {
        return $this->buku->update($id_buku, $judul, $penulis, $halaman, $genre);
    }

    public function deleteBuku($id_buku)
    {
        return $this->buku->delete($id_buku);
    }
}
