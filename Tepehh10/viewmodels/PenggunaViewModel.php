<?php
require_once 'models/Pengguna.php';

class PenggunaViewModel
{
    private $pengguna;

    public function __construct()
    {
        $this->pengguna = new Pengguna();
    }

    public function getPenggunaList()
    {
        return $this->pengguna->getAll();
    }

    public function getPenggunaById($id_pengguna)
    {
        return $this->pengguna->getById($id_pengguna);
    }

    public function addPengguna($nama, $email)
    {
        return $this->pengguna->create($nama, $email);
    }

    public function updatePengguna($id_pengguna, $nama, $email)
    {
        return $this->pengguna->update($id_pengguna, $nama, $email);
    }

    public function deletePengguna($id_pengguna)
    {
        return $this->pengguna->delete($id_pengguna);
    }
}
