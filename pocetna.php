<?php
session_start();
require_once("f.php");
if (isset($_GET['odjava'])) {
    unset($_SESSION['korIme']);
    unset($_SESSION['user']);
    unset($_SESSION['status']);
    session_destroy();
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
    <script type="text/javascript" src="mdb/js/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        /* #ves {
            border: 3px solid black;
            width: 500px;
            min-height: 150px;
            margin-bottom: 25px;
        } */
        .mainPic{
            float: right;
            width: 150px;
            height: 150px;
        }
        img{
            width: 18rem;
            height: 18rem;
        }
    </style>
</head>

<body>
    <h1>Pocetna</h1>

    <!-- echo '<div class="btn-group" role="group" aria-label="Basic example">';
echo '<a class="btn btn-primary" href="pocetna.php">Pocetna</a>';
echo '<a class="btn btn-primary" href="vesti.php">Vesti</a>';
echo '<a class="btn btn-primary" href="korisnici.php">Korisnici</a>';
echo '<a class="btn btn-primary" href="pocetna.php?odjava">Odjavite se</a>';
echo '</div>'; -->
    <?php
        loged();
    ?>
    <div id='odgPrijava'></div>
    <hr>
    <div id='vesti'></div>
    <script>
        var input = document.getElementById("pass");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("login").click();
            }
        });
    </script>
</body>

</html>