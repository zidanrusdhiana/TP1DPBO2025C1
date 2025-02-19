from PetShop import PetShop

def main():
    # membuat objek listPetShop
    list_pet_shop = []

    # input jumlah data
    n = int(input("Masukkan jumlah data: "))

    print("Masukkan ID, Nama, Kategori, Harga:")
    for _ in range(n):
        # input data
        id, nama, kategori, harga = input().split()
        id = int(id)
        harga = int(harga)

        # membuat objek PetShop
        p = PetShop(id, nama, kategori, harga)
        # menambahkan objek PetShop ke listPetShop
        list_pet_shop.append(p)

    # tampikan data yang telah dimasukkan
    print("Data yang telah dimasukkan:")
    for p in list_pet_shop:
        p.tampilkan_data()
        print("-----------------------")

    pilihan = 0
    # pilihan manipulasi data
    while pilihan != 5:
        print()
        print("===========================")
        print("|      Pet Shop Menu      |")
        print("===========================")
        print("| 1. Tambah Data          |")
        print("| 2. Ubah Data            |")
        print("| 3. Hapus Data           |")
        print("| 4. Cari Data            |")
        print("| 5. Keluar               |")
        print("| 6. Tampilkan Semua Data |")
        print("===========================")
        pilihan = int(input("\nMasukkan pilihan: "))

        # menambahkan data baru
        if pilihan == 1:
            print("Masukkan ID, Nama, Kategori, Harga:")
            # input data
            id, nama, kategori, harga = input().split()
            id = int(id)
            harga = int(harga)

            # membuat objek PetShop
            p = PetShop(id, nama, kategori, harga)
            # menambahkan objek PetShop ke listPetShop
            list_pet_shop.append(p)

            print("Berhasil menambahkan data!")
        # mengubah data
        elif pilihan == 2:
            id = int(input("Masukkan ID Produk yang ingin diubah: "))
            nama = input("Masukkan Nama Produk: ")
            kategori = input("Masukkan Kategori: ")
            harga = int(input("Masukkan Harga: "))

            found = False
            i = 0
            # mencari data yang akan diubah
            while i < len(list_pet_shop) and not found:
                item = list_pet_shop[i]
                # jika id yang dicari ditemukan
                if item.get_id() == id:
                    # mengubah data menggunakan setter
                    item.set_nama(nama)
                    item.set_kategori(kategori)
                    item.set_harga(harga)
                    found = True
                i += 1

            if found:
                print("Berhasil mengubah data!")
            else:
                print("Data tidak ditemukan!")
        # menghapus data
        elif pilihan == 3:
            id = int(input("Masukkan ID yang ingin dihapus: "))

            found = False
            i = 0
            # mencari data yang akan dihapus
            while i < len(list_pet_shop) and not found:
                item = list_pet_shop[i]
                # jika id yang dicari ditemukan
                if item.get_id() == id:
                    # menghapus data
                    list_pet_shop.pop(i)
                    found = True
                i += 1

            if found:
                print("Berhasil menghapus data!")
            else:
                print("Data tidak ditemukan!")
        # mencari data
        elif pilihan == 4:
            nama = input("Masukkan Nama Produk yang ingin dicari: ")

            found = False
            i = 0
            while i < len(list_pet_shop) and not found:
                item = list_pet_shop[i]
                # jika nama yang dicari ditemukan
                if item.get_nama() == nama:
                    print("Detail Produk:")
                    print("-----------------------")
                    item.tampilkan_data()
                    print("-----------------------")
                    found = True
                i += 1

            if not found:
                print("Data tidak ditemukan!")
        # menampilkan semua data
        elif pilihan == 6:
            print("Data Pet Shop:")
            for p in list_pet_shop:
                p.tampilkan_data()
                print("-----------------------")


if __name__ == "__main__":
    main()