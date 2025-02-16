#pragma once
#include <bits/stdc++.h>
#include "PetShop.cpp"

using namespace std;

int main(){
    list<PetShop> listPetShop;
    int i, n = 0;
    int id, harga;
    string nama, kategori;

    cout << "Masukkan jumlah data: ";
    cin >> n;
    
    for(i = 0; i < n; i++){
        PetShop temp;

        cin >> id >> nama >> kategori >> harga;

        temp.setId(id);
        temp.setNama(nama);
        temp.setKategori(kategori);
        temp.setHarga(harga);

        PetShop::tambahData(listPetShop, temp);
    }

    cout << "Data yang telah dimasukkan:" << endl;
    PetShop::tampilkanSemuaData(listPetShop);

    int pilihan = 0;
    cout << "Pilihan: " << endl;
    cout << "1. Tambah Data" << endl;
    cout << "2. Ubah Data" << endl;
    cout << "3. Hapus Data" << endl;
    cout << "4. Cari Data" << endl;
    cout << "5. Keluar" << endl;
    
    while(pilihan != 5){
        cout << "\nMasukkan pilihan: ";
        cin >> pilihan;
        if(pilihan == 1){
            PetShop p;
            cout << "Masukkan ID: ";
            cin >> id;
            p.setId(id);

            cout << "Masukkan Nama Produk: ";
            cin >> nama;
            p.setNama(nama);

            cout << "Masukkan Kategori: ";
            cin >> kategori;
            p.setKategori(kategori);

            cout << "Masukkan Harga: ";
            cin >> harga;
            p.setHarga(harga);

            PetShop::tambahData(listPetShop, p);
        }
        else if(pilihan == 2){
            cout << "Masukkan ID Produk yang ingin diubah: ";
            cin >> id;

            cout << "Masukkan Nama Produk: ";
            cin >> nama;

            cout << "Masukkan Kategori: ";
            cin >> kategori;

            cout << "Masukkan Harga: ";
            cin >> harga;

            PetShop::ubahData(listPetShop, id, nama, kategori, harga);
        }
        else if(pilihan == 3){
            cout << "Masukkan ID yang ingin dihapus: ";
            cin >> id;
            PetShop::hapusData(listPetShop, id);
        }
        else if(pilihan == 4){
            cout << "Masukkan ID yang ingin dicari: ";
            cin >> id;
            PetShop::cariData(listPetShop, id);
        }

        if(pilihan != 4 && pilihan != 5){
            cout << "Data yang telah diubah: " << endl;
            PetShop::tampilkanSemuaData(listPetShop);
        }
    }

    return 0;
}