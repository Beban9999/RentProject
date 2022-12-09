<?php
session_start();
require_once("f.php");
if (isset($_GET['odjava'])) {
    unset($_SESSION['korIme']);
    unset($_SESSION['user']);
    unset($_SESSION['status']);
    session_destroy();
    header("Location: http://localhost/ivana/pocetna.php"); //Za sada hardcode path
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocetna</title>
    <script src="js/jquary.js"></script>
    <script src="js/jquary.form.js"></script>
    <script src="js/funkcije.js"></script>
    <link rel="stylesheet" href="mdb/css/mdb.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>

        .mainPic{
            float: right;
            width: 150px;
            height: 150px;
        }
    </style>
</head>

<body>
    <h1>Pocetna</h1>
    <?php
        loged();
    ?>
    <div id='odgPrijava'></div>
    <!-- <hr> -->
    <div class="container-fluid">
        <div id='vesti' class='row'></div>
    </div>
    <script>
        var input = document.getElementById("pass");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("login").click();
            }
        });
    </script>
    <script type="text/javascript" src="mdb/js/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>