<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    echo "Morate biti prijavljeni! <a href = 'pocetna.php'>Prijavite se</a>";
    exit();
}
$db = mysqli_connect("localhost", "root", "", "pva_kol2_2021");

if (!$db) {
    echo "Greska sa konekcijom!" . mysqli_connect_errno();

    echo "<br>" . mysqli_connect_error();

    exit();
}

mysqli_query($db, "SET NAMES utf8");
?>

<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'bmp'); // valid extensions
$path = 'uploads/'; // upload directory

if (!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;

    // check's valid format
    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {
            echo "<img src='$path' />";
            //include database configuration file
            //insert form data in the database
            $insert = $db->query("INSERT pictures (name, user_id) VALUES ('" . $path . "', '". $_SESSION['korIme']."')");

            //echo $insert?'ok':'err';
        }
    } 
    else {
        echo 'invalid';
    }
}
?>