<?php
session_start();
require_once("f.php");
$db = mysqli_connect("localhost", "root", "", "renta");

if (!$db) {
    echo "Greska sa konekcijom!" . mysqli_connect_errno();

    echo "<br>" . mysqli_connect_error();

    exit();
}

mysqli_query($db, "SET NAMES utf8");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <title>NovaVest</title>
    <style>
        .allPics
        {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>

    <?php
    


    $curr =  $_GET['vest'];
    $sql = "SELECT * FROM post 
    JOIN kategorije k on k.id_type = post.type
    JOIN currency c on c.id_curr = post.currency
    WHERE deleted = 0 and id = $curr ORDER BY id DESC";
    $rez = mysqli_query($db, $sql);


    $red = mysqli_fetch_object($rez);
    echo "<div id = 'ves'>";
    echo "<h1 id='s'>Posebna strana</h1>";
    loged();
    echo "<br><br>";
    echo "<h3 id='s'>$red->address_name</h3>";
    echo "<div>$red->comment</div>";
    echo "<div>$red->type_name</div>";
    echo "<div>$red->city $red->county</div>";
    echo "<div>$red->rent $red->name</div>";
    echo "<div>$red->details</div>";
    if(!$red->start_date[0] == "0")
    {
        echo "<div>START DATUM: $red->start_date</div>";
    }
    if(!$red->end_date[0] == "0")
    {
        echo "<div>END DATUM: $red->end_date</div>";
    }
    $sqlPics = "SELECT * FROM post_pictures WHERE deleted = 0 and post_id = $red->id";
                $rezForPics = mysqli_query($db, $sqlPics );
                if(mysqli_num_rows($rezForPics) > 0)
                {
                    while($picture = mysqli_fetch_object($rezForPics))
                        echo "<img src='$picture->pic_name' alt='' class='allPics'>";
                }
    echo "</div>";
    ?>
</body>

</html>