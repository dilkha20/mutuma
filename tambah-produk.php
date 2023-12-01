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
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
                    <h3>Tambah Produk</h3>
                    <div class="box">
                        <form action="" method="POST" enctype="multipart/form-data">
                           <select class="input-control" name="kategori" required>
                                <option value="">--pilih--</option>
                                <?php 

                                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC ");
                                    while($r = mysqli_fetch_array($kategori)){
                                
                                ?>
                                <option value="<?php echo $r['category_id']?>"><?php echo $r['category_name']?></option>
                                <?php } ?>
                           </select>
                                
                                <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                                <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                                <input type="file" name="gambar" class="input-control" required>
                                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
                                <script>
                                    CKEDITOR.replace('deskripsi');
                                </script>
                                <select class="input-control" name="status">
                                    <option value="">--pilih--</option>
                                    <option value="1">Ada</option>
                                    <option value="0">Habis</option>
                                <input type="submit" name="submit" value="Tambah" class="btn">
                        </form>
                        <?php 
                            if(isset($_POST['submit'])){
                               
                                // print_r($_FILES['gambar']);
                                // menampung inputan dari form
                                $kategori   = $_POST['kategori'];
                                $nama       = $_POST['nama'];
                                $harga      = $_POST['harga'];
                                $deskripsi  = $_POST['deskripsi'];
                                $status     = $_POST['status'];
                                // menampung data file yang diupload
                                $filename = $_FILES['gambar']['name'];
                                $tmp_name = $_FILES['gambar']['tmp_name'];

                                $type1 = explode('.', $filename);
                                $type2 = $type1[1];
                                $newname = 'produk'.time().'.'.$type2;

                                // menampung data format file yang diizinkan
                                $tipe_diizinkan = array('jpg','jpeg','png','gif');
                                
                                // validasi format file
                                if(!in_array($type2, $tipe_diizinkan)){
                                // jika format file tidak ada di dalam tipe diizinkan
                                    echo '<script>alert("Format file tidak diizinkan")</script>';
                                }else{
                                    // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                                    // proses upload file sekaligus insert ke database
                                    move_uploaded_file($tmp_name, './produk/' .$newname);

                                    $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(null,'".$kategori."','".$nama."','".$harga."','".$deskripsi."','".$newname."','".$status."', null)");
                                    
                                    if($insert){
                                        echo '<script>alert("Data Tersimpan")</script>';
                                        echo '<script>window.location="data-produk.php"</script>';
                                    }else{
                                        echo 'Gagal Tersimpan'.mysqli_error($conn);
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
</body>
</html>