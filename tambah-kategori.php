<?php 
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="Login.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">M U T U M A</a></h1>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-kategori.php">Daftar Kategori</a></li>
                    <li><a href="data-produk.php">Data Produk</a></li>
                    <li><a href="logout.php">keluar</a></li>
                </ul>
        </div>
    </header>
        <!-- content -->
            <div class="section">
                <div class="container">
                    <h3>Tambah Kategori</h3>
                    <div class="box">
                        <form action="" method="POST">
                            <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                            <input type="submit" name="submit" value="Tambah" class="btn">
                        </form>
                        <?php 
                            if(isset($_POST['submit'])){
                                $nama = ucwords($_POST['nama']);
                                $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (null, '".$nama."')");

                                if($insert){
                                    echo '<script>alert("Berhasil")</script>';
                                    echo '<script>window.location="data-kategori.php"</script>';
                                } else {
                                    echo 'gagal'.mysqli_error($conn);
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        
            <!-- footer -->
            <footer>
                <div class="container">
                    <small>Copy Right &copy; 2023 - M U T U M A</small>
                </div>
            </footer>
</body>
</html>