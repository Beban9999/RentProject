<?php
    session_start();
    require_once("f.php");
    if(!prijavljen()){
        echo "Morate biti prijavljeni<br>";
        echo "<a href = 'pocetna.php'>Prijavite se</a>";
    }
    $db = mysqli_connect("localhost", "root", "", "renta");

    if(!$db){
        echo "Greska sa konekcijom!". mysqli_connect_errno();

        echo "<br>". mysqli_connect_error();

        exit();
    }

    mysqli_query($db,"SET NAMES utf8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korisnici</title>
    <script src = "js/jquary.js"></script>
    <script src = "js/funkcije.js"></script>
</head>
<body>
    <h1>Korisnici</h1>
    <?php
        loged();
    ?>
    <hr>
    <h3>Izmena korisnika</h3>
    <br>
    <select name="korisnici" id="korisnici"></select><br><br>
    <button id = 'prikaziKor' name = 'prikaziKor'>Prikazi podatke</button><br>
    <div id = 'odgPrikazKor'></div><br><br>
    <input type="text" name="idKor" id="idKor"><br><br>
    <input type="text" name="imeKor" id="imeKor"><br><br>
    <input type="text" name="prezimeKor" id="prezimeKor"><br><br>
    <select name="statusKor" id="statusKor">
        <option value="0">--Izaberite status--</option>
        <option value="Administrator">Administrator</option>
        <option value="Korisnik">Korisnik</option>
    </select><br><br>
    <button id = 'izmeniKor'>Izmena</button>
    <div id ='odgIzmenaKor'></div>
    
</body>
</html>