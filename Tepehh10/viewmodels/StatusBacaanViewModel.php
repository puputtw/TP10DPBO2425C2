<?php
require_once 'models/StatusBacaan.php';

class StatusBacaanViewModel
{
    private $status_bacaan;

    public $statusOptions = [
        'In Progress', 
        'Finished', 
        'Plan to Read'
    ];

    public function __construct()
    {
        $this->status_bacaan = new StatusBacaan();
    }

    // 🔥 FIX B (Method): Tambahkan method ini untuk dipanggil di index.php
    public function getTrackingDashboard($id_pengguna) {
        // Method ini memanggil fungsi JOINED di Model
        return $this->status_bacaan->getJoinedStatusByPenggunaId($id_pengguna); 
    }

    public function getStatusBacaanList()
    {
        return $this->status_bacaan->getAll();
    }

    public function getStatusBacaanById($id_status_bacaan)
    {
        return $this->status_bacaan->getById($id_status_bacaan);
    }

    public function addStatusBacaan($id_pengguna, $id_buku, $status, $start_date, $finish_date)
    {
        return $this->status_bacaan->create($id_pengguna, $id_buku, $status, $start_date, $finish_date);
    }

    public function updateStatusBacaan($id_status_bacaan, $status, $start_date, $finish_date)
    {
        return $this->status_bacaan->update($id_status_bacaan, $status, $start_date, $finish_date);
    }

    public function deleteStatusBacaan($id_status_bacaan)
    {
        return $this->status_bacaan->delete($id_status_bacaan);
    }
}
