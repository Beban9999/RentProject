const mapProperties = new Map();
mapProperties.set("address_name", "Adresa");
mapProperties.set("address_num", "Broj");
mapProperties.set("county", "Opstina");
mapProperties.set("city", "Grad");
mapProperties.set("kategorija", "Kategorija");
mapProperties.set("rent", "Renta");
mapProperties.set("valuta", "Valuta");

$(document).ready(function(){

    if(document.getElementById("vesti")){
        $.post("ajax.php?f=popVesti",function(response){
            $("#vesti").html(response);
        })
    };
    if(document.getElementById("delVest")){
        PopuniVesti();
    };
    if(document.getElementById("korisnici")){
        PopuniKorisnike();
    };
    $('form').ajaxForm(function(){
        PopuniSlike();
    });
    $("#dodajVest").click(function(){
        let address_name = $("#address_name").val();
        let address_num = $("#address_num").val();
        let county = $("#county").val();
        let city = $("#city").val();
        let kategorija = $("#kategorija").val();

        let comment = $("#comment").val();
        let deposit = $("#deposit").val();
        let rent = $("#rent").val();
        let valuta = $("#valuta").val();



        let start_date = $("#start_date").val();
        let end_date = $("#end_date").val();

        let details = 0;
        //DETALJI
        for(i = 0; i < 5; i++)
        {
            let currDtl = $("#"+i+"dlt").is(":checked");
            if(currDtl == true) details |= 1 << i;
        }
        console.log(address_name, address_num, county, city, kategorija, comment,
            deposit, rent, valuta, start_date, end_date, details);
        // //DEBUG
        $notset = 0;
        if(address_name == "")
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("address_name")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        if(address_num == "")
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("address_num")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        if(county == "")
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("county")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        if(city == "")
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("city")+") nije unet</div>");
         
                $notset+=1;
                return false;
        }
        if(kategorija == 0)
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("kategorija")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        if(rent == 0)
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("rent")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        if(valuta == "0")
        {
            $("#odgDodaj").html("<div class='alert-danger'>Obavezno polje ("+mapProperties.get("valuta")+") nije uneto</div>");
                $notset+=1;
                return false;
        }
        
        if($notset != 0)
        {
            return false;
        }


        if(start_date == "") start_date = null;
        if(end_date == "") end_date = null;
        if(address_name == "" || address_num == "" || county == "" || 
            city == "" || kategorija == 0 || rent == 0 || valuta == "0"){
                $("#odgDodaj").html("Morate popuniti sva polja!");
                return false;
        }
        $("#odgDodaj").html("");
        $.post("ajax.php?f=dodajVest", 
        {address_name:address_name, address_num:address_num,county:county
        ,city:city, kategorija:kategorija,comment:comment
        ,deposit:deposit, rent:rent,valuta:valuta
        ,start_date:start_date, end_date:end_date,details:details,}, 
        
        
        
        function(response){
            // $("input").val("");
            // $("#tekst").val("");
            // $("#kategorija").val("0");
            PopuniVesti();
            $("#odgDodaj").html(response);
        })
    });
    $("#obrisiVest").click(function(){
        let id = $("#delVest").val();

        if(id == 0){
            $("#odgDel").html("Niste izabrali vest!");
            return false;
        }

        $.post("ajax.php?f=obrisi", {id:id}, function(response){
            $("#odgDel").html(response);
            PopuniVesti();
        })
    });
    $("#izmeniKor").click(function(){
        let id = $("#idKor").val();
        let ime = $("#imeKor").val();
        let prezime = $("#prezimeKor").val();
        let status = $("#statusKor").val();

        if(id == "" || ime == "" || prezime == "" || status == "0"){
            $("#odgIzmenaKor").html("Morate popuniti sve podatke");
            return false;
        }
        $.post("ajax.php?f=izmenaKor", {id:id, ime:ime, prezime:prezime, status:status}, function(response){
            $("input").val("");
            $("#statusKor").val("0");
            $("#odgIzmenaKor").html(response);
            PopuniKorisnike();
        })
    })
    $("#prikaziKor").click(function(){
        let id = $("#korisnici").val();

        if(id == 0){
            $("#odgPrikazKor").html("Morate izabrati korisnika!");
            return false;
        }
        $("#odgPrikazKor").html("");
        $.post("ajax.php?f=popuniKorisnike", {id:id}, function(response){
            let odg = response.split("|");
            $("#idKor").val(odg[0]);
            $("#imeKor").val(odg[1]);
            $("#prezimeKor").val(odg[2]);
            $("#statusKor").val(odg[3]);
        })
    })
    $("#login").click(function(){
        let korIme = $("#korIme").val();
        let pass = $("#pass").val();

        console.log(korIme, pass);
        if(korIme == "" || pass == ""){
            $("#odgPrijava").html("Morate uneti sve podatke!");
            return false;
        }
        $.post("ajax.php?f=prijava",{korIme:korIme, pass:pass}, function(response){
            if(response.startsWith("pocetna.php")){
                window.location.assign("pocetna.php");
                
            }
            else{
                $("#odgPrijava").html(response); 
            }
        })

    });

    
})
function delCurrImg(img) {
    $.post("ajax.php?f=del_img", { img: img }, function (response) {
        $("#odgDelImg").html(response);
        PopuniSlike();

    })
}
function PopuniKorisnike(){
    $.post("ajax.php?f=popuniKor", function(response){
        $("#korisnici").html(response);
    })
}

function PopuniVesti(){
    $.post("ajax.php?f=odabirVesti", function(response){
        $("#delVest").html(response);
    })
}

function PopuniSlike()
{
    $.post("ajax.php?f=pop_img",function(response){
        $("#prev_img").html(response);
    })
}
