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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vesti</title>
    <link rel="stylesheet" href="mdb/css/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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
                            echo "<option value=$red->id>$red->naziv</option>";
                        }
                    }

                    ?>
                </select>
                <h4 class="text-center m-3">Detalji</h4>
                <div id='details' name='details' class="row m-4">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="0dlt" id="0dlt">
                            <label class="form-check-label" for="0dlt">
                                Kupatilo
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="1dlt" id="1dlt">
                            <label class="form-check-label" for="1dlt">
                                Kuhinja
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="2dlt" id="2dlt">
                            <label class="form-check-label" for="2dlt">
                                Dnevna soba
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="3dlt" id="3dlt">
                            <label class="form-check-label" for="3dlt">
                                Internet
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="4dlt" id="4dlt">
                            <label class="form-check-label" for="4dlt">
                                Klima
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="" id="10dlt">
                            <label class="form-check-label" for="10dlt">
                                TEST
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="" id="11dlt">
                            <label class="form-check-label" for="11dlt">
                                TEST
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="" id="12dlt">
                            <label class="form-check-label" for="12dlt">
                                TEST
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="" id="13dlt">
                            <label class="form-check-label" for="13dlt">
                                TEST
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="" id="14dlt">
                            <label class="form-check-label" for="14dlt">
                                TEST
                            </label>
                        </div>
                    </div>

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