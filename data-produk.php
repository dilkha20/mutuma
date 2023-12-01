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
                    <h3>Produk</h3>
                    <div class="box">
                        <p><a href="tambah-produk.php">Tambah Data</a></p>
                        <table border="1" cellspacing="0" class="table">
                            <thead>
                                <tr>
                                    <th width="60px">No</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category ON tb_product.category_id = tb_category.category_id ORDER BY tb_product.product_id DESC");

                                if(mysqli_num_rows($produk) > 0) {
                                    while ($row = mysqli_fetch_array($produk)) {
                                        // Your code to process each row goes here
                                    ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $row['category_name']?></td>
                                                <td><?php echo $row['product_name']?></td>
                                                <td>Rp. <?php echo number_format($row['product_price'])?></td>
                                                <td><a href="produk/<?php echo $row['product_image']?>" target="_blank"><img src="produk/<?php echo $row['product_image']?>" width="70px"></a></td>
                                                <td><?php echo ($row['product_status'] == 0)? 'Habis' : 'Ada' ?></td>
                                                <td>
                                                    <a href="edit-produk.php?id=<?php echo $row['product_id']?>">Edit</a> || 
                                                    <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm ('Yakin Hapus?')">Hapus</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="7">Tidak Ada Data</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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