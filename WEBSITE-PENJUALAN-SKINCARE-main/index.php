<?php 
  session_start();
  if(!isset($_SESSION["k"])){
    $_SESSION["k"]=[];
  }
  if(!empty($_GET["stok"])){
    if(sizeof($_SESSION["k"])>=0){
      $_GET["harga"]=$_GET["harga"]*$_GET["stok"];
      array_push($_SESSION["k"],$_GET);
      $a=0;
      foreach ($_SESSION["k"] as $key => $value) {
        $a+=$value["harga"];
      }
      $_SESSION["TotalHarga"]=$a;
    }
  }
  else if (!empty($_GET["name"]) && !empty($_GET["telp"])) {
    $_SESSION["name"]= $_GET["name"];
    $_SESSION["call"]= $_GET["telp"];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  $host = '103.219.251.244'; // Ganti dengan host database Anda
  $username = 'lahorasm_root'; // Ganti dengan username database Anda
  $password = '@Lgarin211'; // Ganti dengan password database Anda
  $database = 'lahorasm_root2'; // Ganti dengan nama database Anda

  $conn = mysqli_connect($host, $username, $password, $database);
  $result;
  function dd($data)
  {
    var_dump($data);die;
  }
  $query = "SELECT * FROM produk";
  if(isset($_GET["M"])){
    $query = "SELECT * FROM produk WHERE MEREK LIKE '%".$_GET["M"]."%'";
  }else if(isset($_GET["K"])){
    $query = "SELECT * FROM produk WHERE kategori LIKE '%".$_GET["K"]."%'";
  }
  $result = $conn->query($query);
  $result2=$result;
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="lgarin211">
    <meta name="generator" content="Hugo 0.112.5">
    <title>SKINCARE</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://lgarin211.github.io/assets/img/profile-img.jpg"
        sizes="180x180">
    <link rel="icon" href="https://lgarin211.github.io/assets/img/profile-img.jpg" sizes="32x32"
        type="image/png">
    <link rel="icon" href="https://lgarin211.github.io/assets/img/profile-img.jpg" sizes="16x16"
        type="image/png">
    <link rel="mask-icon" href="https://lgarin211.github.io/assets/img/profile-img.jpg"
        color="#FDCEDF">
    <link rel="icon" href="https://lgarin211.github.io/assets/img/profile-img.jpg">
    <meta name="theme-color" content="#FDCEDF">
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(252, 0, 0, 0.1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #FDCEDF;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #F2BED1;
        --bs-btn-hover-border-color: #F2BED1;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #F2BED1;
        --bs-btn-active-border-color: #F2BED1;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bg-wp {
        background-color: #F8E8EE;
        color: #090580;
    }

    .bg-wp2 {
        background-color: #FDCEDF;
        color: #090580;
    }

    .text-body-fiji {
        color: #46458C;
    }

    .text-body-fiji2 {
        color: #090580;
    }
    </style>
</head>

<body>
    <header class="d-flex justify-content-center py-3 fixed-top bg-dark">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#about" class="nav-link" data-bs-toggle="modal" data-bs-target="#ABOUTMODAL">About Us</a></li>
            <li class="nav-item"><a href="#M" class="nav-link">Brend</a></li>
            <li class="nav-item"><a href="#K" class="nav-link">Categori</a></li>
            <?php if(!empty($_SESSION["name"])):?>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal"
                    data-bs-target="#Keranjang">Keranjang</a></li>
            <?php endif;?>
        </ul>
    </header>

    <main class="bg-wp2">
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">WELCOME TO KINAN STORE</h1>
                    <p class="lead text-body-fiji">Discover the radiance within at Kinan Skincare Store.</p>
                    <p>
                        <?php if(empty($_SESSION["name"])):?>
                        <a href="#" class="btn btn-primary my-2" data-bs-toggle="modal"
                            data-bs-target="#LOGINMODAL">LOGIN</a>
                        <?php else:?>
                    <h3>Hello <?= $_SESSION["name"];?></h3>
                    <!-- Modal -->
                    <?php if(!empty($_SESSION['k'])):?>
                    <div class="modal fade" id="Keranjang" tabindex="-1" aria-labelledby="KeranjangLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content bg-wp2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="KeranjangLabel">Keranjang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5 col-lg-4 order-md-last">
                                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-primary">Keranjangmu</span>
                                                <span
                                                    class="badge bg-primary rounded-pill"><?=sizeof($_SESSION["k"])?></span>
                                            </h4>
                                            <ul class="list-group mb-3">
                                                <?php foreach ($_SESSION['k'] as $key => $value):?>
                                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                                    <div>
                                                        <h6 class="my-0"><?=$value['pname']?></h6>
                                                        <small
                                                            class="text-body-secondary"><?= $value["stok"]."x"?></small>
                                                    </div>
                                                    <span class="text-body-secondary">Rp. <?=$value["harga"]?></span>
                                                </li>
                                                <?php endforeach; ?>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Total (IDR)</span>
                                                    <strong>Rp. <?=$_SESSION["TotalHarga"]?></strong>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-7 col-md-lg-8">
                                            <div class="container card bg-wp">
                                                <h4 class="mb-3">Payment</h4>
                                                <div class="my-3">
                                                    <div class="form-check">
                                                        <input id="credit" name="paymentMethod" type="radio"
                                                            class="form-check-input" checked="" required="">
                                                        <label class="form-check-label" for="credit">Credit card</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="debit" name="paymentMethod" type="radio"
                                                            class="form-check-input" required="">
                                                        <label class="form-check-label" for="debit">Debit card</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="COD" name="paymentMethod" type="radio"
                                                            class="form-check-input" required="">
                                                        <label class="form-check-label" for="COD">COD</label>
                                                    </div>
                                                </div>
                                                <div class="row gy-3">
                                                    <div class="col-md-6">
                                                        <label for="cc-name" class="form-label">Name on card</label>
                                                        <input type="text" class="form-control" id="cc-name"
                                                            placeholder="" required="">
                                                        <small class="text-body-fiji">Full name as displayed on
                                                            card</small>
                                                        <div class="invalid-feedback">
                                                            Name on card is required
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="cc-number" class="form-label">Credit card
                                                            number</label>
                                                        <input type="text" class="form-control" id="cc-number"
                                                            placeholder="" required="">
                                                        <div class="invalid-feedback">
                                                            Credit card number is required
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="cc-expiration" class="form-label">Expiration</label>
                                                        <input type="text" class="form-control" id="cc-expiration"
                                                            placeholder="" required="">
                                                        <div class="invalid-feedback">
                                                            Expiration date required
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="cc-cvv" class="form-label">CVV</label>
                                                        <input type="text" class="form-control" id="cc-cvv"
                                                            placeholder="" required="">
                                                        <div class="invalid-feedback">
                                                            Security code required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="./Transaksi.php?tag=newp" type="button" class="btn btn-primary">BELI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;endif;?>
                    </p>
                </div>
            </div>
        </section>
        <!-- LOGIN -->
        <div class="modal fade" id="LOGINMODAL" tabindex="-1" aria-labelledby="LOGINMODALLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-wp2">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="LOGINMODALLabel">Login</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET">
                        <div class="modal-body">
                            <h4>Nama Anda</h4>
                            <input type="text" class="form-control" name="name">
                            <h4>Nomor Telpon</h4>
                            <input type="text" class="form-control" name="telp">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">login</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

        <div class="album py-5 bg-wp">
            <div class="container">
                <div class="pl">
                    <div class="card bg-wp">
                        <div class="row">
                            <div class="col-6" style="margin-bottom: 2vh;">
                                <h5>FILTER BY MEREK</h5>
                                <select name="" id="M" class="form-select" onchange="fex()">
                                    <option value="">PILIH</option>
                                    <option value="">Semua</option>
                                    <?php 
                                        $sql = "SELECT * FROM view_merek";
                                        $result = $conn->query($sql);
                                        foreach($result as $row):
                                    ?>
                                    <option value="<?=$row["MEREK"]?>"><?=$row["MEREK"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-6" style="margin-bottom: 2vh;">
                                <h5>FILTER BY kategori</h5>
                                <select name="" id="K" class="form-select" onchange="bil()">
                                    <option value="">PILIH</option>
                                    <option value="">Semua</option>
                                    <?php 
                                        $sql = "SELECT * FROM kategori";
                                        $result = $conn->query($sql);
                                        foreach($result as $row):
                                    ?>
                                    <option value="<?=$row["kategori"]?>"><?=$row["kategori"]?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <!-- load result2 -->
                    <?php while($row = $result2->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card bg-wp2 shadow-sm <?=$row["MEREK"]?> <?=$row["kategori"]?>">
                            <img src="<?=$row['img']?>" alt="" style="height: 50vh;object-fit: cover;">
                            <div class="card-body">
                                <h3><?=$row["Nama"]?></h3>
                                <p class="card-text"><?=$row["desksing"]?>
                                    <hr>Rp.<?=$row["jual"]?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-dan ger"
                                            data-bs-toggle="modal" data-bs-target="#VIEW<?=$row['id']?>">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#PurcePatView<?=$row['id']?>">Buy</button>
                                    </div>
                                    <small class="text-body-secondary"><?=$row["MEREK"]?></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal DETAIL -->
                    <div class="modal fade" id="VIEW<?=$row['id']?>" tabindex="-1"
                        aria-labelledby="VIEWLabel<?=$row['id']?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-wp2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="VIEWLabel">Detail</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?=$row["deslong"]?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal VIEW -->
                    <div class="modal fade" id="PurcePatView<?=$row['id']?>" tabindex="-1" aria-labelledby="PurcePat"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-wp2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="PurcePat">Purce's</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="GET" action="">
                                        <h4>Nama Anda</h4>
                                        <input type="text" class="form-control" name="name"
                                            value="<?=$_SESSION["name"]?>" readonly>
                                        <h4>Nomor Telpon</h4>
                                        <input type="text" class="form-control" name="telp"
                                            value="<?= $_SESSION["call"]?>" readonly>
                                        <h4>Banyak</h4>
                                        <input type="number" class="form-control" name="stok">
                                        <input type="hidden" name="id" value="<?=$row['id']?>">
                                        <input type="hidden" name="harga" value="<?=$row['jual']?>">
                                        <input type="hidden" name="pname" value="<?=$row["Nama"]?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="ABOUTMODAL" tabindex="-1" aria-labelledby="ABOUTMODALLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ABOUTMODALLabel">ABOUS US</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h3 class="content-title">Your Online Beauty Destination</h3>
                            <div class="content-text">
                                <p> Kinan Store is Indonesia's trusted and most complete online shopping destination
                                    offering authentic beauty products e.g. make up, skin care, hair care, fragrance and
                                    beauty tools serving women across Indonesia. </p>
                            </div>
                            <h3 class="content-title">Only The Authentic and BPOM Certified</h3>
                            <div class="content-text">
                                <p> Quality and authenticity of beauty product is akin to the importance of taking care
                                    of your own skin, a necessity to all women and Kinan Store takes it very seriously.
                                    Usage of non-original or fraudulent beauty products could lead to permanent skin
                                    damage. </p>
                                <p> This has prompted Kinan Store to collaborate directly with authorized national
                                    distributors and brand owners in Indonesia to ensure that every product you purchase
                                    from Kinan Store are original and authentic, with the certification from Badan Pengawas
                                    Obat dan Makanan ('BPOM'). </p>
                                <p> Quality assurance of product storage is performed directly by Kinan Store's own
                                    operations management with compliance to international standards and storage
                                    guideline by the brand owners. </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h3 class="content-title">Delivery Guaranteed</h3>
                            <div class="content-text">
                                <p> Excellent service is shopping necessity. With our own storage facility, Kinan Store
                                    ensures that product delivery is performed smoothly and product return can be
                                    completed hassle-free. </p>
                            </div>
                            <h3 class="content-title">Your Daily Read of All Things Beauty</h3>
                            <div class="content-text">
                                <p> Inspired to be your trusted beauty advisor, Kinan Store presents you the Beauty
                                    Journal, an online beauty media portal dedicated for women to explore and develop
                                    their own unique beauty style, while receiving the latest information on trend and
                                    brand developments. </p>
                                <p>We hope you enjoy your shopping experience with Kinan Store.</p>
                                <strong>For more information and suggestions, please email to cs@sociolla.com</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @2023 PT.Kinan skin Indonesia. All rights reserved.
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-wp2 py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">
                2023 &copy;PT.Kinan skin Indonesia. All rights reserved.
            </p>
        </div>
    </footer>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
    function fex() {
        window.location.href = "./index.php?M=" + document.getElementById("M").value;
    }

    function bil() {
        window.location.href = "./index.php?K=" + document.getElementById("K").value;
    }
    </script>
</body>

</html>