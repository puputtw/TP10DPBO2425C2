<?php

// 1. INCLUDE VIEWMODELS (LAPISAN MEDIATOR)
require_once 'viewmodels/PenggunaViewModel.php';
require_once 'viewmodels/BukuViewModel.php';
require_once 'viewmodels/StatusBacaanViewModel.php';
require_once 'viewmodels/UlasanViewModel.php';


// AMBIL DAN SANITASI PARAMETER URL

// Menggunakan filter_input untuk keamanan dasar
$entity = filter_input(INPUT_GET, 'entity', FILTER_SANITIZE_STRING) ?? 'status_bacaan';
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'list';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Parameter ID khusus
$id_buku_param = filter_input(INPUT_GET, 'id_buku', FILTER_VALIDATE_INT);

// ASUMSI: ID Pengguna yang sedang login adalah 1 (untuk demo dashboard)
$current_user_id = 1; 



// 3. ROUTING LOGIC (SWITCH ENTITY)

switch ($entity) {
    
    // ENTITAS: PENGGUNA
    case 'pengguna':
        $penggunaViewModel = new PenggunaViewModel();
        switch ($action) {
            case 'list':
                $penggunaList = $penggunaViewModel->getPenggunaList();
                require_once 'views/pengguna_list.php';
                break;

            case 'add':
                require_once 'views/pengguna_form.php';
                break;

            case 'save':
                $penggunaViewModel->addPengguna($_POST['nama'], $_POST['email']);
                header("Location: index.php?entity=pengguna");
                exit;

            case 'edit':
                $data = $penggunaViewModel->getPenggunaById($id);
                require_once 'views/pengguna_form.php';
                break;

            case 'update':
                $penggunaViewModel->updatePengguna($id, $_POST['nama'], $_POST['email']);
                header("Location: index.php?entity=pengguna");
                exit;

            case 'delete':
                $penggunaViewModel->deletePengguna($id);
                header("Location: index.php?entity=pengguna");
                exit;
                
            default:
                echo "<h1>Invalid action for Pengguna.</h1>";
                break;
        }
        break;

    // ENTITAS: BUKU
    case 'buku':
        $bukuViewModel = new BukuViewModel();
        switch ($action) {
            case 'list':
                $bukuList = $bukuViewModel->getBukuList();
                require_once 'views/buku_list.php';
                break;

            case 'add':
                require_once 'views/buku_form.php';
                break;

            case 'save':
                $bukuViewModel->addBuku($_POST['judul'], $_POST['penulis'], $_POST['halaman'], $_POST['genre']);
                header("Location: index.php?entity=buku");
                exit;

            case 'edit':
                $data = $bukuViewModel->getBukuById($id);
                require_once 'views/buku_form.php';
                break;

            case 'update':
                $bukuViewModel->updateBuku($id, $_POST['judul'], $_POST['penulis'], $_POST['halaman'], $_POST['genre']);
                header("Location: index.php?entity=buku");
                exit;

            case 'delete':
                $bukuViewModel->deleteBuku($id);
                header("Location: index.php?entity=buku");
                exit;
                
            default:
                echo "<h1>Invalid action for Buku.</h1>";
                break;
        }
        break;

    // ENTITAS: STATUS BACAAN (DASHBOARD TRACKING)
    case 'status_bacaan':
        $statusBacaanViewModel = new StatusBacaanViewModel();
        $bukuViewModel = new BukuViewModel();
        
        switch ($action) {
            case 'list':
                // Memuat data gabungan untuk dashboard tracking (perbaikan sebelumnya)
                $trackingList = $statusBacaanViewModel->getTrackingDashboard($current_user_id);
                require_once 'views/status_bacaan_list.php';
                break;

            case 'add':
                // Memuat daftar buku untuk dropdown di form
                $bukuList = $bukuViewModel->getBukuList(); 
                require_once 'views/status_bacaan_form.php';
                break;

            case 'save':
                // Asumsi finish_date bisa NULL jika status bukan 'Finished'
                $finish_date = empty($_POST['finish_date']) ? NULL : $_POST['finish_date'];

                $statusBacaanViewModel->addStatusBacaan(
                    $current_user_id, 
                    $_POST['id_buku'], 
                    $_POST['status'], 
                    $_POST['start_date'], 
                    $finish_date
                );
                header("Location: index.php?entity=status_bacaan");
                exit;

            case 'edit':
                $data = $statusBacaanViewModel->getStatusBacaanById($id);
                // Memuat detail buku untuk tampilan di form edit
                $bukuDetail = $bukuViewModel->getBukuById($data['id_buku']); 
                require_once 'views/status_bacaan_form.php';
                break;

            case 'update':
                 // Asumsi finish_date bisa NULL jika status bukan 'Finished'
                $finish_date = empty($_POST['finish_date']) ? NULL : $_POST['finish_date'];

                $statusBacaanViewModel->updateStatusBacaan(
                    $id, 
                    $_POST['status'], 
                    $_POST['start_date'], 
                    $finish_date
                );
                header("Location: index.php?entity=status_bacaan");
                exit;

            case 'delete':
                $statusBacaanViewModel->deleteStatusBacaan($id);
                header("Location: index.php?entity=status_bacaan");
                exit;
                
            default:
                echo "<h1>Invalid action for Status Bacaan.</h1>";
                break;
        }
        break;

    // ENTITAS: ULASAN
    case 'ulasan':
        $ulasanViewModel = new UlasanViewModel();
        $bukuViewModel = new BukuViewModel();
        
        switch ($action) {
            
            case 'list': 
                if (!$id_buku_param) {
                    // MODE GLOBAL (index.php?entity=ulasan&action=list)
                    $ulasanList = $ulasanViewModel->getAllUlasanWithBukuInfo(); // Ambil SEMUA ulasan + Judul Buku (JOIN)
                    $bukuDetail = null; // Tandai sebagai mode global (digunakan di views/ulasan_list.php)
                } else {
                    // MODE PER BUKU (index.php?entity=ulasan&action=list&id_buku
                    $bukuDetail = $bukuViewModel->getBukuById($id_buku_param);
                    $ulasanList = $ulasanViewModel->getUlasanByBukuId($id_buku_param);
                }
                require_once 'views/ulasan_list.php'; // Menggunakan file tunggal
                break;
            
            case 'add':
                $bukuList = $bukuViewModel->getBukuList();
                $id_buku_current = $id_buku_param;
                
                // Judul Form harus menampilkan "Pilih Buku" jika mode global (tanpa id_buku)
                if ($id_buku_current) {
                    $bukuDetail = $bukuViewModel->getBukuById($id_buku_current);
                } else {
                    $bukuDetail = ['judul' => 'Pilih Buku'];
                }
                
                require_once 'views/ulasan_form.php'; //Mengarah ke Gambar Pertama
                break;
                
            case 'save':
                $ulasanViewModel->addUlasan($_POST['id_buku'], $_POST['rating'], $_POST['catatan'], $_POST['favorite_quote']);
                // Setelah menyimpan, kembalikan ke list per buku
                header("Location: index.php?entity=ulasan&action=list&id_buku=" . $_POST['id_buku']); 
                exit;

            case 'edit':
                $data = $ulasanViewModel->getUlasanById($id);
                $bukuDetail = $bukuViewModel->getBukuById($data['id_buku']); 
                require_once 'views/ulasan_form.php';
                break;

            case 'update':
                $ulasanViewModel->updateUlasan($id, $_POST['rating'], $_POST['catatan'], $_POST['favorite_quote']);
                header("Location: index.php?entity=ulasan&action=list&id_buku=" . $_POST['id_buku']);
                exit;

            case 'delete':
                $ulasanDetail = $ulasanViewModel->getUlasanById($id);
                $id_buku_redirect = $ulasanDetail['id_buku'];
                $ulasanViewModel->deleteUlasan($id);
                
                // Redireksi tergantung mode asal
                if (isset($_GET['redirect']) && $_GET['redirect'] == 'global') {
                    header("Location: index.php?entity=ulasan&action=list"); // Kembali ke list global
                } else {
                    header("Location: index.php?entity=ulasan&action=list&id_buku=" . $id_buku_redirect); // Kembali ke list per buku
                }
                exit;
                
            default:
                echo "<h1>Invalid action for Ulasan.</h1>";
                break;
        }
        break;
        
    // DEFAULT ERROR
    default:
        // Arahkan ke halaman status bacaan (dashboard) sebagai halaman default
        header("Location: index.php?entity=status_bacaan&action=list");
        exit;
        break;
}
?>