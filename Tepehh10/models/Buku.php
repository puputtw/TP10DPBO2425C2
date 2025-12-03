<?php
require_once "config/Database.php";

class Buku
{
    private $conn;
    private $table = "buku";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_buku)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_buku = :id_buku";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($judul, $penulis, $halaman, $genre)
    {
        $query = "INSERT INTO " . $this->table . " (judul, penulis, halaman, genre) VALUES (:judul, :penulis, :halaman, :genre)";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':penulis', $penulis);
        $stmt->bindParam(':halaman', $halaman);
        $stmt->bindParam(':genre', $genre);
        return $stmt->execute();
    }

    public function update($id_buku, $judul, $penulis, $halaman, $genre)
    {
        $query = "UPDATE " . $this->table . " SET judul = :judul, penulis = :penulis, halaman = :halaman, genre = :genre WHERE id_buku = :id_buku";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':penulis', $penulis);
        $stmt->bindParam(':halaman', $halaman);
        $stmt->bindParam(':genre', $genre);
        return $stmt->execute();
    }

    public function delete($id_buku)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_buku = :id_buku";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_buku', $id_buku);
        return $stmt->execute();
    }
}
