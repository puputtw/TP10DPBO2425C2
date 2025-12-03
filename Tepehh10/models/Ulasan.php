<?php
require_once "config/Database.php";

class Ulasan
{
    private $conn;
    private $table = "ulasan";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllJoinedWithBuku()
{
    $query = "
        SELECT 
            u.*, 
            b.judul, 
            b.penulis, 
            b.id_buku 
        FROM ulasan u
        JOIN buku b ON u.id_buku = b.id_buku
        ORDER BY u.id_ulasan DESC"; // Urutkan berdasarkan tanggal terbaru

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_ulasan)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_ulasan = :id_ulasan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ulasan', $id_ulasan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_buku, $rating, $catatan, $favorite_quote)
    {
        $query = "INSERT INTO " . $this->table . " (id_buku, rating, catatan, favorite_quote) VALUES (:id_buku, :rating, :catatan, :favorite_quote)";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':catatan', $catatan);
        $stmt->bindParam(':favorite_quote', $favorite_quote);

        return $stmt->execute();
    }

    public function update($id_ulasan, $rating, $catatan, $favorite_quote)
    {
        $query = "UPDATE " . $this->table . " SET rating = :rating, catatan= :catatan, favorite_quote = :favorite_quote WHERE id_ulasan = :id_ulasan";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_ulasan', $id_ulasan);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':catatan', $catatan);
        $stmt->bindParam(':favorite_quote', $favorite_quote);
        return $stmt->execute();
    }

    public function delete($id_ulasan)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_ulasan = :id_ulasan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ulasan', $id_ulasan);
        return $stmt->execute();
    }
    // Fungsi READ (Baca semua ulasan untuk BUKU TERTENTU)
    public function getByBukuId($id_buku) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_buku = :id_buku ORDER BY id_ulasan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

