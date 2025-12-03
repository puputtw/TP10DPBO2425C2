<?php
require_once "config/Database.php";

class StatusBacaan
{
    private $conn;
    private $table = "status_bacaan";

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

    public function getById($id_status_bacaan)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_status_bacaan = :id_status_bacaan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_status_bacaan', $id_status_bacaan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_pengguna, $id_buku, $status, $start_date, $finish_date)
    {
        $query = "INSERT INTO " . $this->table . " (id_pengguna, id_buku, status, start_date, finish_date) VALUES (:id_pengguna, :id_buku, :status, :start_date, :finish_date)";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_pengguna', $id_pengguna);
        $stmt->bindParam(':id_buku', $id_buku);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':finish_date', $finish_date);

        return $stmt->execute();
    }

    public function update($id_status_bacaan, $status, $start_date, $finish_date)
    {
        $query = "UPDATE " . $this->table . " SET status = :status, start_date = :start_date, finish_date = :finish_date WHERE id_status_bacaan = :id_status_bacaan";
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':id_status_bacaan', $id_status_bacaan);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':finish_date', $finish_date);
        return $stmt->execute();
    }

    public function delete($id_status_bacaan)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_status_bacaan = :id_status_bacaan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_status_bacaan', $id_status_bacaan);
        return $stmt->execute();
    }

    // Fungsi khusus untuk menampilkan dashboard (JOINED data)
    public function getJoinedStatusByPenggunaId($id_pengguna) {
        $query = "
            SELECT sb.*, b.judul, b.penulis, b.halaman
            FROM " . $this->table . " sb
            JOIN buku b ON sb.id_buku = b.id_buku
            WHERE sb.id_pengguna = :id_pengguna
            ORDER BY sb.status DESC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pengguna', $id_pengguna);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

