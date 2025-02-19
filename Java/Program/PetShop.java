// membuat class PetShop
public class PetShop{
    // variabel yang digunakan
    private int id;
    private String nama;
    private String kategori;
    private int harga;

    // constructor
    public PetShop(){
    }

    public PetShop(int id, String nama, String kategori, int harga){
        this.id = id;
        this.nama = nama;
        this.kategori = kategori;
        this.harga = harga;
    }

    // setter dan getter

    // setter id
    public void setId(int id){
        this.id = id;
    }

    // setter nama produk
    public void setNama(String nama){
        this.nama = nama;
    }

    // setter kategori
    public void setKategori(String kategori){
        this.kategori = kategori;
    }

    // setter harga
    public void setHarga(int harga){
        this.harga = harga;
    }

    // getter id
    public int getId(){
        return id;
    }

    // getter nama produk
    public String getNama(){
        return nama;
    }

    // getter kategori
    public String getKategori(){
        return kategori;
    }

    // getter harga
    public int getHarga(){
        return harga;
    }

    // method untuk menampilkan data
    public void tampilkanData(){
        System.out.println("ID         : " + id);
        System.out.println("Nama       : " + nama);
        System.out.println("Kategori   : " + kategori);
        System.out.println("Harga      : " + harga);
    }
}