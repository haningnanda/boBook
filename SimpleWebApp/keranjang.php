<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }
    $file = file_get_contents("books.json");
    $json_decoded = json_decode($file);
    $url = 'url-foto';

    if(isset($_GET['ubah'])){
        $jml = $_GET['jumlah'];
        $id = $_GET['idproduk'];
        $myfile = fopen("cart.txt", "a") or die("Unable to open file!");

        $file = fopen("cart.txt","r");
        $i=0;
        while(! feof($file)) {
            $arr= fgets($file);
            $array[$i] = explode(" ",$arr);
            if($array[$i][0]==$_SESSION['username']){
                if($array[$i][1]==$id){
                    fwrite($myfile, $_SESSION['username']." ");
                    fwrite($myfile, $id." ");
                    fwrite($myfile, $jml."\n");
                    $file_out = file("cart.txt");
                    unset($file_out[$i]);
                    file_put_contents("cart.txt", implode("", $file_out));
                    break;
                }
            }
            $i++;
        }
        fclose($file);
        fclose($myfile);
        header('Location: keranjang.php');
    }
    if(isset($_GET['remove'])){
        $id = $_GET['idproduk'];
        $file = fopen("cart.txt","r");
        $i=0;
        while(! feof($file)) {
            $arr= fgets($file);
            $array[$i] = explode(" ",$arr);
            if($array[$i][0]==$_SESSION['username']){
                if($array[$i][1]==$id){
                    $file_out = file("cart.txt");
                    unset($file_out[$i]);
                    file_put_contents("cart.txt", implode("", $file_out));
                    break;
                }
            }
            $i++;
        }
        fclose($file);
        header('Location: keranjang.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Keranjang</title>
</head>
<body>
    <ul>
        <li style="float: left; color: white; font-size: 45px; font-weight: bold; padding-left: 10px;">BoBook.</li>
        <li class="keluar" ><a href="logout.php">Keluar</a></li>
        <li><a href="#" class="active">Keranjang</a></li>
        <li><a href="catalog.php" >Catalog</a></li>
        <li><a href="#">Hai! <?php echo($_SESSION['username']);?></a></li>
    </ul>

    <!-- Judul -->
    <h1 style="color: white; text-align: center;">Keranjang</h1>
    <hr color="orange" size="7px" width="30%">
    <br>
    <!-- --- -->
    <div class="content">
        <?php
            $lines = file('cart.txt',FILE_IGNORE_NEW_LINES);
            $i=0;
            $count = 0;
            $total=0;
            foreach ($lines as $line) {
                $array[$i] = explode(" ",$line);
                if($array[$i][0]==$_SESSION['username']):
                    $count++;
                    $idx =$array[$i][1];?>
                    <div class="book">
                        <img src="<?php echo $json_decoded->books[$idx]->primer->$url?>">
                        <div class="keterangan">
                            <p><?php echo $json_decoded->books[$idx]->judul ?></p>
                            <p>@IDR <?php echo $json_decoded->books[$idx]->primer->harga?></p>
                            <form action="" method='GET'>
                                <input type="hidden" name="idproduk" value="<?php echo $idx ?>">
                                <input type="number" style="width:30px;" min="1" max="9" name="jumlah" value="<?php echo $array[$i][2];?>">
                                <input type="submit" name="ubah">
                            </form>
                            <p>Harga : IDR <?php echo($json_decoded->books[$idx]->primer->harga*$array[$i][2]);?></p>
                            <?php $total += $json_decoded->books[$idx]->primer->harga*$array[$i][2];?>
                            <form action="" method='GET'>
                                <input type="hidden" name="idproduk" value="<?php echo $idx ?>">
                                <button style="color:red;" name="remove">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <?php
                    $i++;
                endif;
                $i++;
            }
            if($count==0):?>
                <div style="background-color:white; margin: 10px; padding: 10px;">
                    <p style="color:rgba(128, 128, 128, 0.5); text-align:center;">Anda belum memiliki buku di keranjang</p>
                </div>
            <?php
            endif;
        ?>
        <div class="total">
            <p>Total : IDR <?php echo($total); ?> </p>
        </div>
    </div>
</body>
</html>