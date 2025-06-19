<?php
session_start();
$host = '103.219.251.244'; 
$username = 'root';
$password = ''; 
$database = 'skincare'; 
$conn = mysqli_connect($host, $username, $password, $database);

if ($_GET["tag"] == "newp") {
    $pat = $_SESSION["k"];
    $_SESSION["k"] = [];
    foreach ($pat as $key => $value) {
        $sql = "INSERT INTO transaksi VALUES ('".$value["name"]."', '".$value["telp"]."', ".$value["stok"].", ".$value["id"].", NULL, ".$value["harga"].", '".$value["pname"]."')";
        $pw = mysqli_query($conn, $sql);
    }

    $name = $_SESSION["name"];
    $call = $_SESSION["call"];
    $sql = "SELECT * FROM konsumen WHERE name = '".$name."' AND telp = '".$call."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO konsumen VALUES (NULL,'".$call."', '".$name."')";
        $result = mysqli_query($conn, $sql);
    }
    header('Location: index.php');
}
?>
