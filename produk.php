<?php 
error_reporting(0);
include 'koneksi.php';

$kontak = mysqli_query($conn, "SELECT admin_telp, admin_gmail, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);

// Check if a row was returned
if ($a) {
    $adminTelephone = $a->admin_telp;
    $adminEmail = $a->admin_gmail;
    $adminAddress = $a->admin_address;

    // Now you can use $adminTelephone, $adminEmail, and $adminAddress as needed
} else {
    // Handle the case where no row was returned
    echo "No data found for admin_id = 2";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="" >
    <!-- Include Google Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Your other head elements go here -->
    <!-- Include the following CSS styles for the burger icon and dropdown menu -->
        <style>
        .burger-icon {
            cursor: pointer;
            padding: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            color: #333;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        </style>
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
            <!-- search -->
            <div class="search">
                <div class="container">
                    <form action="produk.php">
                        <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search']?>">
                        <input type="hidden" name="kat" value="<?php echo $_GET['kat']?>">
                        <input type="submit" name="cari" value="Cari" >
                    </form>
                </div>
            </div>
                 <!-- new product -->
            <div class="section">
                <div class="container">
                    <h3>Produk</h3>
                    <div class="box">
                    <?php
                        if ($_GET['search'] != '' || $_GET['kat'] != '') {
                            $where = "AND product_name LIKE '%" . $_GET['search'] . "%'";

                            if ($_GET['kat'] != '') {
                                $where .= " AND category_id = " . $_GET['kat'];
                            }
                        }

                        $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");

                        if (mysqli_num_rows($produk) > 0) {
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                                <a href="detail-produk.php?id=<?php echo $row['product_id']; ?>">
                                    <!-- Your content goes here -->
                                    <div class="col-4"> 
                                        <p>
                                            <a href="detail-produk.php?id=<?php echo $row['product_id']; ?>">
                                                <img src="produk/<?php echo $row['product_image']; ?>" width="225px" height="200px" alt="Product Image">
                                            </a>
                                        </p>
                                        <p class="nama"><?php echo $row['product_name']; ?></p>
                                        <p class="harga">Rp. <?php echo number_format($row['product_price'], 0, ',', '.'); ?></p>
                                        
                                        <!-- Add to Cart button -->
                                    </div>
                                    <!-- End of your content -->
                                </a>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="3">Tidak Ada Data</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <footer>
                <div class="container">
                    <h4>Alamat</h4>
                    <p><?php echo $a->admin_address?></p>
                    <h4>Email</h4>
                    <p><?php echo $a->admin_gmail?></p>
                    <h4>No Hp</h4>
                    <p><?php echo $a->admin_telp?></p>
                    <small>Copy Right &copy; 2023 - M U T U M A</small>
                </div>
            </footer>

                <!-- Include the following JavaScript to toggle the dropdown menu -->
                <script>
                function toggleDropdown() {
                    var dropdown = document.getElementById("myDropdown");
                    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
                }
                </script>
</script>
</body>
</html>