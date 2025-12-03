<?php
require_once 'models/Ulasan.php';

class UlasanViewModel
{

    public function getAllUlasanWithBukuInfo()
{
     // Memanggil method di Ulasan Model yang akan melakukan JOIN
    return $this->ulasan->getAllJoinedWithBuku(); 
}
    private $ulasan;

    public $ratingOptions = [1, 2, 3, 4, 5];

    

    public function __construct()
    {
        $this->ulasan= new Ulasan();
    }

    public function getUlasanList()
    {
        return $this->ulasan->getAll();
    }

    public function getUlasanByBukuId($id_buku)
    {
        return $this->ulasan->getByBukuId($id_buku);
    }

    public function getUlasanById($id_ulasan)
    {
        return $this->ulasan->getById($id_ulasan);
    }

    public function addUlasan($id_buku, $rating, $catatan, $favorite_quote)
    {
        return $this->ulasan->create($id_buku, $rating, $catatan, $favorite_quote);
    }

    public function updateUlasan($id_ulasan, $rating, $catatan, $favorite_quote)
    {
        return $this->ulasan->update($id_ulasan, $rating, $catatan, $favorite_quote);
    }

    public function deleteUlasan($id_ulasan)
    {
        return $this->ulasan->delete($id_ulasan);
    }

    
}
