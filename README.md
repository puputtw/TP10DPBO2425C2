# TP10DPBO2425C2


## Janji:
   Saya Putri Ramadhani dengan NIM 2410975 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO). 
   Untuk itu saya tidak akan melakukan kecurangan seperti yang telah dispesifikasikan, Aamiin.

## Desain Program:
  <img width="1203" height="586" alt="Cuplikan layar 2025-12-03 070144" src="https://github.com/user-attachments/assets/4fd503c1-7086-4f0b-b220-29af44f66d2e" />

   Program ini adalah sebuah sistem dengan konsep atau arsitektur MVVM yang membantu mengelola bacaan atau book tracker, program ini memungkinkan pengguna untuk mengelola:
  - Data Buku  
  - Status Bacaan  
  - Ulasan / Review  
  - Rating & Favorite Quote

## Tabel yang dibuat:

   1. Tabel pengguna
      
      tabel ini menyimpan informasi akun pengguna yaitu:
      -id_pengguna
      -nama
      -email
      
   3. Tabel Buku
    
      tabel yang menyimpan seluruh data buku milik pengguna, atribut yang ada yaitu:
      -id_buku
      -judul
      -penulis
      -hakaman
      -genre

   4. Tabel StatusBacaan
      
      tabel yang mencatatat progres user membaca buku, terdiri dari:
      -id_status_bacaan
      -id_pengguna yang mana memiliki relasi foreign key ke tabel penggguna
      -id_buku fk ke tabel buku
      -status, peacakan bacaan, misal: plan to read, finished dan in progres
      -start_date, tanggal mulai baca atau rencana baca
      -finish_date, tanggal selsai baca ynag mana juga bisa null jika belum selsai membaca suatu
        buku

   6. Tabel Ulasan, yang mana menyimpan review atau catatan pembaca mengenai buku yang dibacanya
      
      -id_ulasan
      -id_buku relasi fk ke tabel buku
      -rating, dari 1-5 pada sebuah buku yang dibaca
      -catatan, catatan singkat tentang buku yang dibaca
      -favorite_quote, queotos favorit yang disuka dari buku yang dibaca


       Peogram menggunakan pola arsitektur MVVM yang memiliki komponen yang terdiri dari:
      
          **Model
            Yang bertanggung jawab kepada struktur data, operasi CRUD ke database, koneksi database
      
          **View
             Bagian yang menampilkan data ke pengguna.View hanya menerima data melalui
             viewModel dan tidak langsung berhubungan dengan database

           **ViewModel
              Menjadi pengelola state, pemroses data, dan mediator antara View dan Model. ViewModel
              memungkinkan UI untuk bereaksi secara otomatis terhadap perubahan data melalui data binding
          
          
## Alur Program:

    - User mengakses melalui index.php
    - Index memanggil viewmodel
       Contoh: jika entity=buku, maka index memanggil BukuViewModel
       ViewModel bertugas mengambil data dari Model dan menyiapkannya ke View
    - ViewModel mengambil atau mengolah data dari Model
      Model melakukan query database menggunakan PDO  
      contoh: Buku->getAll() 
              Ulasan->getByBukuId($id_buku)        
    - View menerima data dari ViewModel
      view menampilkan:  daftar buku
                         detail buku 
                         daftar pengguna
                         daftar status bacaan
                         daftar ulasan
                         form tambah/edit data
                           
   - User melakukan aksi (CRUD) Contoh alur tombol:
     
      Tambah Buku → entity=buku&action=add
      Edit Status Bacaan → entity=status&action=edit&id=
      Lihat Ulasan Buku → entity=ulasan&action=list&id_buku=.
      Index.php memproses aksi tersebut, lalu:
      Memanggil fungsi ViewModel → Model (insert/update/delete)
   

      
                              
      




## Dokumentasi:
