<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        body {
        background-image: url('wkwk.jpeg');
        background-size: cover;
      }

    </style>
    <title>Document</title>
</head>
<body>
    <!--page login-->
    <div class="page-login">

        <!--box-->
        <div class="box box-login">
        
            <!--box header-->
            <div class="box-header text-senter">
                <h2>Register</h2>
            </div>

            <!--box body-->
            <div class="box-body">

                <!--form login-->
                <form action="" method="POST">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" placeholder="Username" class="input-control">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" placeholder="Password" class="input-control">
                    </div>

                    <input type="submit" name="submit" value="Simpan" class="btn">

                </form>

                <?php
    if (isset($_POST['submit'])) {
        session_start();
        include 'koneksi.php';

        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);

        // Hash the password (consider using more secure methods like bcrypt)
        $hashedPassword = md5($pass);

        // Use INSERT INTO to add a new record to the tb_admin table
        $query = "INSERT INTO tb_admin (username, password) VALUES ('$user', '$hashedPassword')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>alert("Data inserted successfully")</script>';
            // Optionally, redirect to another page or perform additional actions
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>
            
            </div>

            <!--box footer-->
            <div class="box-footer text-senter">
                <a href="Login.php"> Login? </a>
            </div>

        </div>
    </div>   
</body>
</html>