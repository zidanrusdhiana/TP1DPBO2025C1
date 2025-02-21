<?php
include 'PetShop.php';

// memulai session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // mendapatkan data yang dikirimkan
    $action = $_POST['action'];
    $id = $_POST['id'];
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
    $gambar = isset($_FILES['gambar']) ? $_FILES['gambar'] : null;

    // mengecek aksi yang dilakukan

    // jika aksi adalah create
    if ($action == 'create') {
        // buat objek baru
        $petShop = new PetShop($id, $nama, $kategori, $harga);
        // upload gambar
        if ($gambar) {
            $petShop->uploadGambar($gambar);
        }
        // simpan objek ke dalam session
        $_SESSION['listPetShop'][] = $petShop;
    }
    // jika aksi adalah update
    elseif ($action == 'update') {
        // cari objek yang akan diupdate
        foreach ($_SESSION['listPetShop'] as $petShop) {
            if ($petShop->getId() == $id) {
                // set data yang diubah
                $petShop->setNama($nama);
                $petShop->setKategori($kategori);
                $petShop->setHarga($harga);
                if ($gambar && $gambar['name']) {
                    $petShop->uploadGambar($gambar);
                }
                break;
            }
        }
    }
    // jika aksi adalah delete
    elseif ($action == 'delete') {
        // cari objek yang akan dihapus
        foreach ($_SESSION['listPetShop'] as $key => $petShop) {
            if ($petShop->getId() == $id) {
                // hapus objek dari session
                unset($_SESSION['listPetShop'][$key]);
                break;
            }
        }
    }
}

// inisialisasi session listPetShop untuk menyimpan data petshop
if (!isset($_SESSION['listPetShop'])) {
    $_SESSION['listPetShop'] = [];
}

// data pencarian produk
$searchResults = [];
if (isset($_GET['search'])) {
    // mendapatkan data pencarian
    $search = $_GET['search'];
    // mencari data yang sesuai dengan pencarian berdasarkan nama produk
    $searchResults = array_filter($_SESSION['listPetShop'], function($petShop) use ($search) {
        return stripos($petShop->getNama(), $search) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 p-6" x-data="{ showModal: false, editData: {} }">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">PetShop</h1>
        
        <!-- Form Pencarian -->
        <form action="index.php" method="get" class="mb-6">
            <div class="mb-4">
                <label for="search" class="block text-sm font-medium text-gray-700">Cari berdasarkan nama</label>
                <input type="text" name="search" id="search" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Cari</button>
        </form>

        <!-- Hasil Pencarian -->
        <?php if (!empty($searchResults)): ?>
            <h2 class="text-xl font-bold mb-4">Hasil Pencarian</h2>
            <table class="min-w-full bg-white mb-6">
                <thead>
                    <tr>
                        <th class="py-2">ID</th>
                        <th class="py-2">Nama</th>
                        <th class="py-2">Kategori</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2">Gambar</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($searchResults as $petShop): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $petShop->getId() ?></td>
                            <td class="border px-4 py-2"><?= $petShop->getNama() ?></td>
                            <td class="border px-4 py-2"><?= $petShop->getKategori() ?></td>
                            <td class="border px-4 py-2"><?= $petShop->getHarga() ?></td>
                            <td class="border px-4 py-2"><img src="<?= $petShop->getGambar() ?>" alt="Gambar Produk" class="w-16 h-16"></td>
                            <td class="border px-4 py-2">
                                <button @click="showModal = true; editData = { id: '<?= $petShop->getId() ?>', nama: '<?= $petShop->getNama() ?>', kategori: '<?= $petShop->getKategori() ?>', harga: '<?= $petShop->getHarga() ?>' }" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Edit</button>
                                <form action="index.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $petShop->getId() ?>">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Form Tambah Data -->
        <form action="index.php" method="post" enctype="multipart/form-data" class="mb-6">
            <input type="hidden" name="action" value="create">
            <div class="mb-4">
                <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" name="id" id="id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="text" name="harga" id="harga" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Pilih gambar untuk diupload</label>
                <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Upload</button>
        </form>

        <!-- Tabel Seluruh Data -->
        <h2 class="text-xl font-bold mb-4">Seluruh Data</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">ID</th>
                    <th class="py-2">Nama</th>
                    <th class="py-2">Kategori</th>
                    <th class="py-2">Harga</th>
                    <th class="py-2">Gambar</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['listPetShop'] as $petShop): ?>
                    <tr>
                        <!-- Menampilkan data produk -->
                        <td class="border px-4 py-2"><?= $petShop->getId() ?></td>
                        <td class="border px-4 py-2"><?= $petShop->getNama() ?></td>
                        <td class="border px-4 py-2"><?= $petShop->getKategori() ?></td>
                        <td class="border px-4 py-2"><?= $petShop->getHarga() ?></td>
                        <td class="border px-4 py-2"><img src="<?= $petShop->getGambar() ?>" alt="Gambar Produk" class="w-16 h-16"></td>
                        <td class="border px-4 py-2">
                            <button @click="showModal = true; editData = { id: '<?= $petShop->getId() ?>', nama: '<?= $petShop->getNama() ?>', kategori: '<?= $petShop->getKategori() ?>', harga: '<?= $petShop->getHarga() ?>' }" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Edit</button>
                            <form action="index.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $petShop->getId() ?>">
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <!-- Modal Edit Data -->
        <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Data</h3>
                            <div class="mt-2">
                                <form action="index.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" x-model="editData.id">
                                    <div class="mb-4">
                                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" name="nama" id="nama" x-model="editData.nama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="mb-4">
                                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                        <input type="text" name="kategori" id="kategori" x-model="editData.kategori" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="mb-4">
                                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                                        <input type="text" name="harga" id="harga" x-model="editData.harga" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="mb-4">
                                        <label for="gambar" class="block text-sm font-medium text-gray-700">Pilih gambar untuk diupload</label>
                                        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
                                        <button type="button" @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>