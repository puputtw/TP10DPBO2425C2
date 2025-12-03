<?php
require_once "config/Database.php";

class Pengguna
{
    private $conn;
    private $table = "pengguna";

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

    public function getById($id_pengguna)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_pengguna = :id_pengguna";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pengguna',  $id_pengguna);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $email)
    {
        $query = "INSERT INTO " . $this->table . " (nama, email) VALUES (:nama, :email)";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function update($id_pengguna, $nama, $email)
    {
        $query = "UPDATE " . $this->table . " SET nama = :nama, email = :email WHERE id_pengguna = :id_pengguna";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_pengguna', $id_pengguna);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function delete($id_pengguna)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_pengguna = :id_pengguna";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pengguna', $id_pengguna);
        return $stmt->execute();
    }
}
