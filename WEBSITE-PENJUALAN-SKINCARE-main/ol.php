<!DOCTYPE html>
<html>

<head>
    <title>Data Produk</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="./il.php" class="nav-link">Transaksi</a></li>
            <li class="nav-item"><a href="./ol.php" class="nav-link">Produk</a></li>
            <?php if(!empty($_SESSION["name"])):?>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal"
                    data-bs-target="#Keranjang">Keranjang</a></li>
            <?php endif;?>
        </ul>
    </header>
    <div class="container">
        <h1>Data Produk</h1>

        <?php
        // Membuat koneksi ke database
        $servername = "103.219.251.244";
        $username = "lahorasm_root";
        $password = "@Lgarin211";
        $dbname="lahorasm_root2";;
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        
        // Menampilkan data produk dari tabel
        $sql = "SELECT * FROM produk";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table class='table'>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Merek</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Deskripsi Singkat</th>
                        <!--<th>Deskripsi Lengkap</th>-->   
                        <th>Aksi</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["Nama"]."</td>
                        <td>".$row["MEREK"]."</td>
                        <td>".$row["beli"]."</td>
                        <td>".$row["jual"]."</td>
                        <td>".$row["stok"]."</td>
                        <td>".$row["kategori"]."</td>
                        <td>".$row["img"]."</td>
                        <td>".$row["desksing"]."</td>
                        <!--<td>".$row["deslong"]."</td>-->
                        <td>
                            <a href='#editModal' data-toggle='modal' data-id='".$row["id"]."'>Edit</a>
                            <a href='#deleteModal' data-toggle='modal' data-id='".$row["id"]."'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data produk.";
        }
        
        // Menutup koneksi
        $conn->close();
        ?>

        <a href="#" data-toggle="modal" data-target="#addModal">Tambah Produk</a>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah produk -->
                    <form method="post" action="insert.php">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" class="form-control" id="merek" name="merek" required>
                        </div>
                        <div class="form-group">
                            <label for="beli">Harga Beli</label>
                            <input type="text" class="form-control" id="beli" name="beli" required>
                        </div>
                        <div class="form-group">
                            <label for="jual">Harga Jual</label>
                            <input type="text" class="form-control" id="jual" name="jual" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="img">Gambar</label>
                            <input type="text" class="form-control" id="img" name="img" required>
                        </div>
                        <div class="form-group">
                            <label for="desksing">Deskripsi Singkat</label>
                            <input type="text" class="form-control" id="desksing" name="desksing" required>
                        </div>
                        <div class="form-group">
                            <label for="deslong">Deskripsi Lengkap</label>
                            <textarea name="deslong" class="form-control" id="deslong" cols="40" rows="10"></textarea>
                            <!-- <input type="text" class="form-control" id="deslong" name="deslong" required> -->
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form edit produk -->
                    <form method="post" action="update.php">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-nama">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-merek">Merek</label>
                            <input type="text" class="form-control" id="edit-merek" name="merek" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-beli">Harga Beli</label>
                            <input type="text" class="form-control" id="edit-beli" name="beli" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-jual">Harga Jual</label>
                            <input type="text" class="form-control" id="edit-jual" name="jual" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-stok">Stok</label>
                            <input type="text" class="form-control" id="edit-stok" name="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-kategori">Kategori</label>
                            <input type="text" class="form-control" id="edit-kategori" name="kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-img">Gambar</label>
                            <input type="text" class="form-control" id="edit-img" name="img" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-desksing">Deskripsi Singkat</label>
                            <input type="text" class="form-control" id="edit-desksing" name="desksing" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-deslong">Deskripsi Lengkap</label>
                            <input type="text" class="form-control" id="edit-deslong" name="deslong" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Produk -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                    <form method="post" action="delete.php">
                        <input type="hidden" id="delete-id" name="id">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
    // Mengambil data ID produk saat tombol Edit di klik
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#edit-id').val(id);
    });

    // Mengambil data ID produk saat tombol Delete di klik
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#delete-id').val(id);
    });
    </script>
</body>

</html>