<?php
class PetShop {
    // atribut yang digunakan
    private $id;
    private $nama;
    private $kategori;
    private $harga;
    private $gambar;

    // constructor
    public function __construct($id = null, $nama = null, $kategori = null, $harga = null, $gambar = null) {
        $this->id = $id;
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    // setter dan getter

    // setter id
    public function setId($id) {
        $this->id = $id;
    }

    // setter nama produk
    public function setNama($nama) {
        $this->nama = $nama;
    }

    // setter kategori
    public function setKategori($kategori) {
        $this->kategori = $kategori;
    }

    // setter harga
    public function setHarga($harga) {
        $this->harga = $harga;
    }

    // setter gambar
    public function setGambar($gambar) {
        $this->gambar = $gambar;
    }

    // getter id
    public function getId() {
        return $this->id;
    }

    // getter nama produk
    public function getNama() {
        return $this->nama;
    }

    // getter kategori
    public function getKategori() {
        return $this->kategori;
    }

    // getter harga
    public function getHarga() {
        return $this->harga;
    }

    // getter gambar
    public function getGambar() {
        return $this->gambar;
    }

    // method untuk upload gambar
    public function uploadGambar($file) {
        $target_dir = "images/";
        
        // buat direktori untuk menyimpan file image
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // buat nama file gambar
        $unique_name = $target_dir . time() . '_' . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $unique_name)) {
            $this->setGambar($unique_name);
        }
            
    }
}
?>