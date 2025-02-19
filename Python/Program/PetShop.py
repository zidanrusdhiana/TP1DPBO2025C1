# membuat class PetShop
class PetShop:
    # constructor
    def __init__(self, id=None, nama=None, kategori=None, harga=None):
        # variabel yang digunakan
        self.id = id
        self.nama = nama
        self.kategori = kategori
        self.harga = harga

    # setter dan getter

    # setter id
    def set_id(self, id):
        self.id = id

    # setter nama produk
    def set_nama(self, nama):
        self.nama = nama

    # setter kategori
    def set_kategori(self, kategori):
        self.kategori = kategori

    # setter harga
    def set_harga(self, harga):
        self.harga = harga

    # getter id
    def get_id(self):
        return self.id

    # getter nama produk
    def get_nama(self):
        return self.nama

    # getter kategori
    def get_kategori(self):
        return self.kategori

    # getter harga
    def get_harga(self):
        return self.harga

    # method untuk menampilkan data
    def tampilkan_data(self):
        print(f"ID         : {self.id}")
        print(f"Nama       : {self.nama}")
        print(f"Kategori   : {self.kategori}")
        print(f"Harga      : {self.harga}")