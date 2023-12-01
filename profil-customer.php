<?php 
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="Login-customer.php"</script>';
    }
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
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
            <h1><a href="beranda.php">M U T U M A</a></h1>
                <ul>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="profil-customer.php">Profil</a></li>
                    <li><a href="logout-customer.php">keluar</a></li>
                </ul>
        </div>
    </header>
        <!-- content -->
            <div class="section">
                <div class="container">
                    <h3>Profil</h3>
                    <div class="box">
                        <form action="" method="POST">
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?=$d->admin_name?>" required>
                            <input type="text" name="user" placeholder="Username" class="input-control" value="<?=$d->username?>" required>
                            <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?=$d->admin_telp?>" required>
                            <input type="text" name="email" placeholder="Gmail" class="input-control" value="<?=$d->admin_gmail?>" required>
                            <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?=$d->admin_address?>" required>
                            <input type="submit" name="submit" value="Ubah Profil" class="btn">
                        </form>
                        <?php
                           if(isset($_POST['submit'])){
                            $nama   = $_POST['nama'];
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = $_POST['alamat'];

                            $query = mysqli_query($conn, "UPDATE tb_admin SET
                            admin_name = '".$nama."',
                            username = '".$user."',
                            admin_telp = '".$hp."',
                            admin_gmail = '".$email."',
                            admin_address = '".$alamat."'
                            WHERE admin_id = '".$d->admin_id."'");
                            if($query){
                                echo 'Berhasil';
                            } else {
                                echo 'Gagal' ,mysqli_error($conn);
                            }
                        }
                        ?>
                    </div>

                    <h3>Ubah password</h3>
                    <div class="box">
                        <form action="" method="POST">
                            <input type="password" name="pass1" placeholder="password Baru" class="input-control" required>
                            <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                            <input type="submit" name="ubah_password" value="Ubah password" class="btn">
                        </form>
                        <?php
                            if(isset($_POST['ubah_password'])){
                                $pass1 = $_POST['pass1'];
                                $pass2 = $_POST['pass2'];

                                if($pass2 != $pass1){
                                    echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
                                }else{
                                    $u_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '".MD5($pass1)."' WHERE admin_id = '".$d->admin_id."'");
                                    
                                    if($u_pass){
                                        echo '<script>alert("Ubah Password Berhasil")</script>';
                                        echo '<script>window.location ="profil-customer.php"</script>';
                                    }else{
                                        echo 'Gagal'.mysqli_error($conn);
                                    }
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