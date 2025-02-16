#include <iostream>
#include <string>
#include <list>

using namespace std;

class PetShop{
    private:
        int id;
        string nama;
        string kategori;
        int harga;
    
    public:
    PetShop(){
    }

    PetShop(int i, string n, string k, int h){
        id = i;
        nama = n;
        kategori = k;
        harga = h;
    }

    void setId(int i){
        id = i;
    }

    void setNama(string n){
        nama = n;
    }

    void setKategori(string k){
        kategori = k;
    }

    void setHarga(int h){
        harga = h;
    }

    int getId(){
        return id;
    }

    string getNama(){
        return nama;
    }

    string getKategori(){
        return kategori;
    }

    int getHarga(){
        return harga;
    }

    void tampilkanData(){
        cout << "ID         : " << id << endl;
        cout << "Nama       : " << nama << endl;
        cout << "Kategori   : " << kategori << endl;
        cout << "Harga      : " << harga << endl;
        cout << "--------------------------" << endl;
    }

    static void tampilkanSemuaData(list<PetShop>& data){
        for(auto& item : data){
            item.tampilkanData();
        }
    }

    static void tambahData(list<PetShop>& data, PetShop p){
        data.push_back(p);
    }

    static void ubahData(list<PetShop>& data, int id, string nama, string kategori, int harga){
        auto it = data.begin();
        int flag = 0;
        while(it != data.end() && flag == 0){
            if(it->getId() == id){
                it->setNama(nama);
                it->setKategori(kategori);
                it->setHarga(harga);
                flag = 1;
            }
            ++it;
        }
        if(flag == 0){
            cout << "Data tidak ditemukan" << endl;
        }
    }

    static void hapusData(list<PetShop>& data, int id){
        auto it = data.begin();
        int flag = 0;
        while(it != data.end() && flag == 0){
            if(it->getId() == id){
                data.erase(it);
                flag = 1;
            }
            ++it;
        }
        if(flag == 0){
            cout << "Data tidak ditemukan" << endl;
        }
    }

    static void cariData(list<PetShop>& data, int id){
        auto it = data.begin();
        int flag = 0;
        while(it != data.end() && flag == 0){
            if(it->getId() == id){
                it->tampilkanData();
                flag = 1;
            }
            ++it;
        }
        if(flag == 0){
            cout << "Data tidak ditemukan" << endl;
        }
    }

    ~PetShop(){
    }
};