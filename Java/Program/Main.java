import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Main{
    public static void main(String[] args){
        // membuat objek listPetShop
        List<PetShop> listPetShop = new ArrayList<>();
        // membuat objek scanner
        Scanner scanner = new Scanner(System.in);

        // input jumlah data
        System.out.print("Masukkan jumlah data: ");
        int n = scanner.nextInt();

        System.out.println("Masukkan ID, Nama, Kategori, Harga:");
        for(int i = 0; i < n; i++){
            // input data
            int id = scanner.nextInt();
            String nama = scanner.next();
            String kategori = scanner.next();
            int harga = scanner.nextInt();

            // membuat objek PetShop
            PetShop p = new PetShop(id, nama, kategori, harga);
            // menambahkan objek PetShop ke listPetShop
            listPetShop.add(p);
        }

        // tampikan data yang telah dimasukkan
        System.out.println("Data yang telah dimasukkan:");
        for(PetShop p : listPetShop){
            p.tampilkanData();
            System.out.println("-----------------------");
        }

        int pilihan = 0;
        // pilihan manipulasi data
        while(pilihan != 5){
            System.out.println();
            System.out.println("===========================");
            System.out.println("|      Pet Shop Menu      |");
            System.out.println("===========================");
            System.out.println("| 1. Tambah Data          |");
            System.out.println("| 2. Ubah Data            |");
            System.out.println("| 3. Hapus Data           |");
            System.out.println("| 4. Cari Data            |");
            System.out.println("| 5. Keluar               |");
            System.out.println("| 6. Tampilkan Semua Data |");
            System.out.println("===========================");
            System.out.print("\nMasukkan pilihan: ");

            pilihan = scanner.nextInt();
            // menambahkan data baru
            if(pilihan == 1){
                System.out.println("Masukkan ID, Nama, Kategori, Harga:");
                // input data
                int id = scanner.nextInt();
                String nama = scanner.next();
                String kategori = scanner.next();
                int harga = scanner.nextInt();

                // membuat objek PetShop
                PetShop p = new PetShop(id, nama, kategori, harga);
                // menambahkan objek PetShop ke listPetShop
                listPetShop.add(p);

                System.out.println("Berhasil menambahkan data!");
            }
            // mengubah data
            else if(pilihan == 2){
                System.out.print("Masukkan ID Produk yang ingin diubah: ");
                int id = scanner.nextInt();
                System.out.print("Masukkan Nama Produk: ");
                String nama = scanner.next();
                System.out.print("Masukkan Kategori: ");
                String kategori = scanner.next();
                System.out.print("Masukkan Harga: ");
                int harga = scanner.nextInt();

                boolean found = false;
                int i = 0;
                // mencari data yang akan diubah
                while(i < listPetShop.size() && !found){
                    PetShop item = listPetShop.get(i);
                    // jika id yang dicari ditemukan
                    if(item.getId() == id){
                        // mengubah data menggunakan setter
                        item.setNama(nama);
                        item.setKategori(kategori);
                        item.setHarga(harga);
                        found = true;
                    }
                    i++;
                }

                if(found){
                    System.out.println("Berhasil mengubah data!");
                }
                else{
                    System.out.println("Data tidak ditemukan!");
                }
            }
            // menghapus data
            else if(pilihan == 3){
                System.out.print("Masukkan ID yang ingin dihapus: ");
                int id = scanner.nextInt();
                
                boolean found = false;
                int i = 0;
                // mencari data yang akan dihapus
                while(i < listPetShop.size() && !found){
                    PetShop item = listPetShop.get(i);
                    // jika id yang dicari ditemukan
                    if(item.getId() == id){
                        // menghapus data
                        listPetShop.remove(i);
                        found = true;
                    }
                    i++;
                }

                if(found){
                    System.out.println("Berhasil menghapus data!");
                }
                else{
                    System.out.println("Data tidak ditemukan!");
                }
            }
            // mencari data
            else if(pilihan == 4){
                System.out.print("Masukkan Nama Produk yang ingin dicari: ");
                String nama = scanner.next();
                
                boolean found = false;
                int i = 0;
                while(i < listPetShop.size() && !found){
                    PetShop item = listPetShop.get(i);
                    // jika nama yang dicari ditemukan
                    if(item.getNama().equals(nama)){
                        System.out.println("Detail Produk:");
                        System.out.println("-----------------------");
                        item.tampilkanData();
                        System.out.println("-----------------------");
                        found = true;
                    }
                    i++;
                }

                if(!found){
                    System.out.println("Data tidak ditemukan!");
                }
            }
            // menampilkan semua data
            else if(pilihan == 6){
                System.out.println("Data Pet Shop:");
                for(PetShop p : listPetShop){
                    p.tampilkanData();
                    System.out.println("-----------------------");
                }
            }
        }

        // menutup scanner
        scanner.close();
    }
}