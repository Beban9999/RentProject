<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    echo "Morate biti prijavljeni! <a href = 'pocetna.php'>Prijavite se</a>";
    exit();
}
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
    <title>Vesti</title>
    <!-- Nice placeholders -->
    <link rel="stylesheet" href="test.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>
<style>
    .picdiv {
        display: inline;
    }
</style>

<body>
    <h1>Vesti</h1>
    <?php
    loged();
    ?>
    <div class="container">
        <h3 class="text-center m-3">Nova objava</h3>
        <div class="row m-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" class="form-control" name="address_name" id="address_name">
                    <label class="form-label" for="address_name">Adresa</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="number" class="form-control" name="address_num" id="address_num">
                    <label class="form-label" for="address_num">Broj</label>
                </div>
            </div>
        </div>
        <div class="row m-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" class="form-control mb-3" name="county" id="county">
                    <label class="form-label" for="county">Opstina</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" class="form-control mb-3" name="city" id="city">
                    <label class="form-label" for="city">Grad</label>
                </div>
            </div>
        </div>
        <div class="row m-4">
            <div class="col">
                <select name="kategorija" class="form-control form-select" id="kategorija">
                    <?php
                    $sql = "SELECT * FROM kategorije";
                    $rez = mysqli_query($db, $sql);

                    if (mysqli_num_rows($rez) > 0) {
                        while ($red = mysqli_fetch_object($rez)) {
                            echo "<option value=$red->id_type>$red->type_name</option>";
                        }
                    }

                    ?>
                </select>
                <h4 class="text-center m-3">Detalji</h4>
                <div id='details' name='details' class="row m-4">
                    <?php
                         $sql = "SELECT * FROM details";
                         $rez = mysqli_query($db, $sql);
                         $details = array();
                         echo '<div class="col">';
                         $countRows = 0;
                         if (mysqli_num_rows($rez) > 0) {
                            while ($red = mysqli_fetch_object($rez)) {
                                $details[$red->id_detail] = $red->detail_name;
                                $indexDetail = $red->id_detail-1;
                                echo '<div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="'.$indexDetail.'dlt" id="'.$indexDetail.'dlt">
                                        <label class="form-check-label" for="'.$indexDetail.'dlt">
                                            '.$red->detail_name.'
                                        </label>
                                    </div>';
                                    $countRows++;
                                    if($countRows == 5){
                                        echo '</div>
                                        <div class="col">';
                                        $countRows = 0;
                                    }
                            }
                        }
                        echo '</div>';
                    ?>
    
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <textarea name="comment" class="form-control" id="comment" cols="30" rows="10"></textarea>
                    <label class="form-label" for="comment">Opis</label>
                </div>

            </div>
        </div>
        
        <div class="row m-4">
            <div class="col">
                <select name="valuta" id="valuta" class="form-control form-select">
                    <option value="0">Valuta</option>
                    <?php
                    $sql = "SELECT * FROM currency";
                    $rez = mysqli_query($db, $sql);

                    if (mysqli_num_rows($rez) > 0) {
                        while ($red = mysqli_fetch_object($rez)) {
                            echo "<option value=$red->id_curr>$red->name ($red->currency)</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="number" class='form-control' name="rent" id="rent">
                    <label class="form-label" for="rent">Renta</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="number" class='form-control' name="deposit" id="deposit">
                    <label class="form-label" for="deposit">Depozit</label>
                </div>
            </div>
        </div>




        <div id='datumi' name='datumi' class="row m-4">
            <div class="col">
                Datum dolaska<input type="date" class="form-control" name='start_date' id='start_date'>
            </div>
            <div class="col">
                Datum izlaska<input type="date" class="form-control" name='end_date' id='end_date'>
            </div>
        </div>



        

        <h4 class="text-center m-3">Slike</h4>
        <div class="row m-4">
            <div class="col">
                <div class="input-group m-3 text-end">

                    <div id='img_div' name='img_div'>

                        <form id="form_img" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                            <input id="uploadImage" type="file" class="form-control" accept="image/*" name="image" />
                            <input class="btn btn-success text-end" type="submit" value="Upload" id='upl_img' name='upl_img'>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id='prev_img' name='prev_img'></div>


            </div>
        </div>
        <div class="text-center">
            <button id='dodajVest' class="btn btn-primary mb-3 text-center">Snimi</button>
        </div>
        <div id='odgDodaj'></div>
        <div id='odgDelImg' class='alert-warning'></div>
    </div>



    <script type="text/javascript" src="mdb/js/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/jquary.js"></script>
    <script src="js/jquary.form.js"></script>
    <script src="js/funkcije.js"></script>
</body>

</html>