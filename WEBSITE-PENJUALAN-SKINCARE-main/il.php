<!DOCTYPE html>
<html>

<head>
    <title>Data Konsumen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <h2>Data Konsumen</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Telepon</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $host = '103.219.251.244';
                $username = 'lahorasm_root';
                $password = '@Lgarin211';
                $database = 'lahorasm_root2';
                $conn = mysqli_connect($host, $username, $password, $database);
                if (!$conn) {
                    die("Koneksi gagal: " . mysqli_connect_error());
                }

                // Query untuk mendapatkan data konsumen
                $query = "SELECT * FROM konsumen";
                $result = mysqli_query($conn, $query);

                // Tampilkan data konsumen
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['telp']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td><button class='btn btn-primary' onclick='showModal(\"".$row['name']."\")'>Lihat Detail</button></td>";
                    echo "</tr>";
                }

                // Tutup koneksi
                mysqli_close($conn);
                ?>
            </tbody>
        </table>

        <!-- Modal untuk menampilkan detail transaksi -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama User</th>
                                    <th>Nomor Telepon</th>
                                    <th>Stok</th>
                                    <th>ID Produk</th>
                                    <th>ID Transaksi</th>
                                    <th>Total Harga</th>
                                    <th>Nama Produk</th>
                                </tr>
                            </thead>
                            <tbody id="modal-body"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function showModal(name) {
        // Menggunakan AJAX untuk mendapatkan data transaksi berdasarkan nama konsumen
        $.ajax({
            url: "get_transactions.php",
            type: "POST",
            data: {
                name: name
            },
            success: function(response) {
                $("#modal-body").html(response);
                $("#myModal").modal("show");
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    </script>
</body>

</html>