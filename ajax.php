<?php
    session_start();

    $db = mysqli_connect("localhost", "root", "", "pva_kol2_2021");

    if(!$db){
        echo "Greska sa konekcijom!". mysqli_connect_errno();

        echo "<br>". mysqli_connect_error();

        exit();
    }

    mysqli_query($db,"SET NAMES utf8");

    if(!isset($_GET['f'])){
        exit();
    }

    $f = $_GET['f'];


    if($f == "dodajVest"){

        $address_name = $_POST['address_name'];
        $address_num = $_POST['address_num'];
        $county = $_POST['county'];
        $city = $_POST['city'];
        $kategorija = $_POST['kategorija'];
        $comment = $_POST['comment'];
        $deposit = $_POST['deposit'];
        $rent = $_POST['rent'];
        $valuta = $_POST['valuta'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $details = $_POST['details'];
        $currUser = $_SESSION['korIme'];

        $sql = "INSERT INTO post 
        (address_name, address_number, county, city, 
        type, comment,deposit, rent, currency, 
        start_date, end_date, details, user) 
        
        VALUES ('$address_name','$address_num',	'$county','$city',	
        '$kategorija','$comment','$deposit','$rent','$valuta',	
        '$start_date','$end_date','$details', '$currUser')";
        $rez = mysqli_query($db, $sql);

        
        if(mysqli_affected_rows($db) > 0){
            //echo "Dodato vesti: ". mysqli_affected_rows($db);
            $sql = "select * 
            FROM post
            WHERE
            address_name = '$address_name' and
            address_number ='$address_num' and
            deleted = false";
            $rez = mysqli_query($db, $sql);
            $red = mysqli_fetch_object($rez);

            $currentPostId = $red->id;
            
            $picList = array();
            $arrInd = 0;
            $sql = "SELECT * FROM pictures WHERE user_id = $currUser and deleted = 0";
            $rez = mysqli_query($db, $sql);

            if(mysqli_num_rows($rez) > 0){
                while($red = mysqli_fetch_object($rez)){
                    $picList[$arrInd++] = $red->name;
                    echo "Dodato vesti: ".$picList[$arrInd-1];

                }
            }
            //echo "Broj vesti: ".$arrInd;
            for($i = 0; $i < $arrInd; $i++)
            {
                $sql = "INSERT INTO post_pictures (pic_name, post_id, deleted) VALUES ('$picList[$i]', '$currentPostId', '0')";
                $rez = mysqli_query($db, $sql);

                $sql = "UPDATE pictures SET deleted = 1 WHERE name = '$picList[$i]'";
                $rez = mysqli_query($db, $sql);


            }
            echo "<div class='alert-success'>Oglas uspesno dodat</div>";
        }
        else{
            echo "<div class='alert-danger'>Dodavanje nije uspesno</div>";
        }



        // $naslov = $_POST['naslov'];
        // $tekst = $_POST['tekst'];
        // $kategorija = $_POST['kategorija'];

        // $sql = "INSERT INTO vesti (naslov, tekst, kategorija) VALUES ('$naslov', '$tekst', '$kategorija')";
        // $rez = mysqli_query($db, $sql);

        // if(mysqli_affected_rows($db) > 0){
        //     echo "Dodato vesti: ". mysqli_affected_rows($db);
        // }
        // else{
        //     echo "Ni jedna vest nije dodata!";+
        // }
    }
    if($f == "del_img")
    {
        $img = $_POST['img'];
        $sql = "UPDATE pictures SET deleted = 1 WHERE id_pic = $img";
        $rez = mysqli_query($db, $sql);
        if(mysqli_affected_rows($db) > 0){
            echo "Uspesno obrisana slika";
        }
        else
        {
            echo "slika nije obrisana $img";
        }
    }
    if($f == "izmenaKor"){
        $id = $_POST['id'];
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $status = $_POST['status'];

        $sql = "UPDATE korisnici SET ime = '$ime', prezime = '$prezime', status = '$status' WHERE id = '$id'";

        if($_SESSION['korIme'] == $id || $_SESSION['status'] == "Administrator"){
            $rez = mysqli_query($db, $sql);

            if(mysqli_affected_rows($db) > 0){
            echo "izmenjeno korisnika: ". mysqli_affected_rows($db);
                if($_SESSION['korIme'] == $id){
                    $_SESSION['user'] = "$ime $prezime";
                    $_SESSION['status'] = $status;
                }
            }
            else{
            echo "Ni jedan korisnik nije izmenjen!";
            }

            
        }
        else{
            echo "Nemate prava na ovu izmenu!";
        }

        
    }
    if($f == "popuniKor"){
        $sql = "SELECT * FROM korisnici";
        $rez = mysqli_query($db, $sql);

        echo '<option value="0">--Izaberite korisnika--</option>';

        if(mysqli_num_rows($rez) > 0){
            while($red = mysqli_fetch_object($rez)){
                echo "<option value= $red->id_usr>$red->ime $red->prezime</option>";
            }
        }

    }
    if($f == "pop_img")
    {
        $sql = "SELECT * FROM pictures WHERE deleted = false";
        $rez = mysqli_query($db, $sql);

        if(mysqli_num_rows($rez) > 0){
            while($red = mysqli_fetch_object($rez)){
                echo "<div class = 'picdiv'>";
                echo "<div class = 'delbtn' onclick='delCurrImg($red->id_pic)'></div>";
                echo "<img src = '$red->name' width = '150' height = '150'>";
                echo "</div>";
            }
        }
    }
    if($f == "popuniKorisnike"){
        $id = $_POST['id'];

        $sql = "SELECT * FROM korisnici WHERE id_usr = '$id'";
        $rez = mysqli_query($db, $sql);

        $red = mysqli_fetch_object($rez);
        echo "$red->id_usr|$red->ime|$red->prezime|$red->status";

    }

    if($f == "odabirVesti"){
        $currUser = $_SESSION['korIme'];
        $sql = "SELECT * FROM post WHERE deleted = 0 and user = $currUser ORDER BY id DESC";
        $rez = mysqli_query($db, $sql);

        echo '<option value="0">--Izaberite post za brisanje--</option>';

        if(mysqli_num_rows($rez) > 0){
            while($red = mysqli_fetch_object($rez)){
                echo "<option value= $red->id>$red->address_name</option>";
            }
        }
    }
    if($f == "obrisi"){
        $id = $_POST['id'];
        $sql = "UPDATE post SET deleted = 1 WHERE id = '$id'";
        $rez = mysqli_query($db, $sql);

        if(mysqli_affected_rows($db) > 0){
            echo "Obrisano postova: ". mysqli_affected_rows($db);
        }
        else{
            echo "Ni jedna vest nije obrisana!";
        }
    }
    if($f == "popVesti"){
        $sql = "SELECT * FROM post as p JOIN currency c on p.currency = c.id_curr WHERE p.deleted = 0 ORDER BY p.id DESC";
        $rez = mysqli_query($db, $sql);

        if(mysqli_num_rows($rez) > 0){
            while($red = mysqli_fetch_object($rez)){
                echo "<div class='card' style='width: 26rem;'>";
                $sqlPics = "SELECT * FROM post_pictures WHERE deleted = 0 and post_id = $red->id LIMIT 1";
                $rezForPics = mysqli_query($db, $sqlPics );
                if (mysqli_num_rows($rezForPics) > 0) {
                    if ($picture = mysqli_fetch_object($rezForPics)) {
                        echo "<img class='card-img-top' src='$picture->pic_name' alt='' class='mainPic'>";
                    } else {
                        echo "<img src='' alt='NO PICTURE' class='mainPic'>";
                    }
                }
                else
                {
                    echo "<img src='' alt='NO PICTURE' class='mainPic'>";
                }
                
                echo "<div id = 'ves'  onclick = 'test($red->id)'>";
                echo '<h3 id="s" class="card-title">'.$red->address_name.'</h3>';
                echo '<div class="card-subtitle mb-2 text-muted">'.$red->type.'</div>';
                echo '<div class="card-text">'.$red->comment.'</div>';
                echo '<div>'.$red->city." ".$red->county.'</div>';
                echo '<div>'.$red->rent." ".$red->currency.'</div>';
                //echo '<div>'.$red->details.'</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
    if($f == "prijava"){
        $korIme = $_POST['korIme'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM korisnici WHERE korime = '$korIme'";
        $rez = mysqli_query($db, $sql);

        if(mysqli_num_rows($rez) > 0){
            $red = mysqli_fetch_object($rez);
            if($red->lozinka != $pass){
                echo "Lozinka za korisnika $red->ime $red->prezime nije ispravna!";
            }
            else{
                $_SESSION['korIme'] = $red->id_usr;
                $_SESSION['user'] = "$red->ime $red->prezime";
                $_SESSION['status'] = $red->status;
                echo "pocetna.php";
            }
        }
        else{
            echo "Korisnik ne postoji!";
        }
    }

?>
<script>
function test(id)
{    
    window.location.href = 'http://localhost/ivana/prikazStranica.php?vest='+id;  
}
</script>