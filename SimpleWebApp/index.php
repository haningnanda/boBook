<?php
    session_start();
    $error=NULL;
    if(isset($_POST['submit'])){
        $in_userid=$_POST['username'];
        $in_password=$_POST['password'];
        $lines = file('datauser.txt',FILE_IGNORE_NEW_LINES);
        $i = 0;
        foreach ($lines as $line){
            $user[$i] = explode(":",$line);
            if($user[$i][0]==$in_userid){
                if($user[$i][1]==$in_password){
                    $_SESSION['username']=$in_userid;
                    header("Location: catalog.php");
                    break;
                }
                break;
            }
            $i++;
        }
        $error="<p>Username/password salah</p>";
        echo "<script> window.onload = function() {
            login();
        }; </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
</head>
<body>
    <ul>
        <li><a onclick="login()">Masuk</a></li>
        <li><a onclick="login()">Keranjang</a></li>
        <li><a onclick="login()">Catalog</a></li>
        <li><a onclick="login()">Hai!</a></li>
    </ul>
    <div class="isi">
        <img src="images/trans.png">
        <div class="keterangan">
            <h1>Selamat datang di BoBook !</h1>
            <h3>Toko buku sederhana yang bisa membuat Anda menjadi sedikit lebih berguna.</h3>
            <button class="mulai" onclick="login()">Mulai</button>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-isi">
            <span class="close">&times;</span>
            <div class="loginpage">
                <h1 style="text-align: center;">Masuk</h1>
                <form action="" method="POST">
                    <input type="text" placeholder="username" name="username" required>
                    <br>
                    <input type="password" placeholder="password" name="password" required>
                    <br>
                    <div class = "error"><?= $error; ?></div>
                    <br><br>
                    <button name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="index.js"></script>
</body>
</html>