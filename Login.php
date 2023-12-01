
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        body {
        background-image: url('wkwk.jpeg');
        background-size: cover;
      }

    </style>
</head>
<body>
    <!--page login-->
    <div class="page-login">

        <!--box-->
        <div class="box box-login">
        
            <!--box header-->
            <div class="box-header text-senter">
                <h2>Login</h2>
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

                    <input type="submit" name="submit" value="Login" class="btn">

                </form>

                <?php

                    if(isset($_POST['submit'])){
                        session_start();
                        include 'koneksi.php';
                        
                        $user = $_POST['user'];
                        $pass = $_POST['pass'];

                        $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
                        if(mysqli_num_rows($cek) > 0){
                            $d = mysqli_fetch_object($cek);
                            $_SESSION['status_login'] = true;
                            $_SESSION['a_global'] = $d->admin_name;
                            $_SESSION['id'] = $d->admin_id;
                            echo '<script>window.location = "dashboard.php"</script>';
                        }else{
                            echo '<script>alert("Username atau password tidak ditemukan!")</script>';
                        }
                    }
                ?>
            
            </div>

            <!--box footer-->
            <div class="box-footer text-senter">
                <a href="Register.php"> Sign up? </a>
            </div>

        </div>
    </div>   
</body>
</html>