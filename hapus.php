<?php
    include 'koneksi.php';

    if (isset($_GET['idk'])) {
        $categoryId = mysqli_real_escape_string($conn, $_GET['idk']);

        // Use prepared statement to prevent SQL injection
        $delete = mysqli_prepare($conn, "DELETE FROM tb_category WHERE category_id = ?");
        mysqli_stmt_bind_param($delete, "s", $categoryId);
        $result = mysqli_stmt_execute($delete);

        if ($result) {
            echo "<script>alert('Hapus Data Berhasil');</script>";
        } else {
            echo "<script>alert('Failed to delete data');</script>";
            // You might want to log or handle the error more gracefully
        }

        // Close the prepared statement
        mysqli_stmt_close($delete);

        echo "<script>window.location = 'data-kategori.php'</script>";
    }

    if (isset($_GET['idp'])) {
        $productId = mysqli_real_escape_string($conn, $_GET['idp']);

        // Use prepared statement to prevent SQL injection
        $delete = mysqli_prepare($conn, "DELETE FROM tb_product WHERE product_id = ?");
        mysqli_stmt_bind_param($delete, "s", $productId); // Corrected variable name
        $result = mysqli_stmt_execute($delete);

        if ($result) {
            echo "<script>alert('Hapus Data Berhasil');</script>";
        } else {
            echo "<script>alert('Failed to delete data');</script>";
            // You might want to log or handle the error more gracefully
        }

        // Close the prepared statement
        mysqli_stmt_close($delete);

        echo "<script>window.location = 'data-produk.php'</script>";
    }
?>
