<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }
    if(isset($_GET['submit_jml'])){
        $idproduk = $_GET['idproduk'];
        $jml = $_GET['submit_jml'];
        $myfile = fopen("cart.txt", "a") or die("Unable to open file!");

        $file = fopen("cart.txt","r");
        $i=0;
        $found = 0;
        while(! feof($file)) {
            $arr= fgets($file);
            $array[$i] = explode(" ",$arr);
            if($array[$i][0]==$_SESSION['username']){
                if($array[$i][1]==$idproduk){
                    fwrite($myfile, $_SESSION['username']." ");
                    fwrite($myfile, $idproduk." ");
                    fwrite($myfile, $array[$i][2]+$jml."\n");
                    $file_out = file("cart.txt");
                    unset($file_out[$i]);
                    file_put_contents("cart.txt", implode("", $file_out));
                    $found = 1;
                    break;
                }
            }
            $i++;
        }
        if($found==0){
            fwrite($myfile, $_SESSION['username']." ");
            fwrite($myfile, $idproduk." ");
            fwrite($myfile, $jml."\n");
        }
        fclose($myfile);
        header('Location: catalog.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="catalog.css">
</head>
<body>
    <ul>
        <li style="float: left; color: white; font-size: 45px; font-weight: bold; padding-left: 10px;">BoBook.</li>
        <li class="keluar" ><a href="logout.php">Keluar</a></li>
        <li><a href="keranjang.php">Keranjang</a></li>
        <li><a href="#" class="active">Catalog</a></li>
        <li><a href="#">Hai, <?php echo($_SESSION['username']);?>!</a></li>
    </ul>

        <!-- Judul -->
        <h1 style="color: white; text-align: center;">Daftar Buku</h1>
        <hr color="orange" size="7px" width="30%">
        <div id="container"></div>
        <!-- --- -->
    
        <!-- Pop-up -->
        <div id="modal" class="modal">
        <div class="modal-isi">
            <span class="close">&times;</span>
            <div id="isi">
                <!-- Cek CSS -->
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur provident quis eaque veniam voluptatibus ratione nisi repudiandae nostrum. Iste dolore alias quidem recusandae? Ut delectus labore quo voluptates aperiam numquam rem accusantium. Placeat ipsum, provident, distinctio amet impedit fuga perferendis quas aperiam, nesciunt voluptas asperiores! Aliquam magni laborum sed totam, nobis minus facere fugit eveniet harum accusantium blanditiis quod libero expedita inventore architecto id dolores sit veritatis fugiat ratione nisi, molestias omnis quasi. Molestias corporis ducimus minus non, aperiam ea necessitatibus magnam sunt, nulla quae saepe alias quibusdam voluptatem corrupti?</p>
                <!-- --- -->
            </div>
        </div>
        <!-- --- -->
        </div>
        <script src="main.js"></script>
</body>
</html>