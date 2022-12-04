function Prepair() {
    k = 0;
    z = "poljeC";
    for(i = 7; i >= 0;i--){
        k++;
        document.getElementById("glavna").innerHTML += " <br>";
        for(j = 7; j >= 0;j--){
            k++;
            if(k % 2 == 0){
                z = "poljeB";
            }
            else{
                z = "poljeC"; 
            }
        document.getElementById("glavna").innerHTML +=
         "<a onclick = 'CheckMov(this);' id = "+[i,j]+" \
         class = "+z+"><img  src = 'imgs/0.png'></a>"; 
        }
    }

   for(i = 0; i < 8; i++){
       document.getElementById("6,"+i).innerHTML = "<img src='imgs/piunC.png'>";
       document.getElementById("6,"+i).name = "piunC";
       document.getElementById("1,"+i).innerHTML = "<img src='imgs/piunB.png'>";
       document.getElementById("1,"+i).name = "piunB"
   }

   for(i = 0; i < 8; i+=7){
        document.getElementById("7,"+i).innerHTML = "<img src='imgs/topC.png'>";
        document.getElementById("7,"+i).name = "topC";
        document.getElementById("7,"+i).classList.add("N");
        document.getElementById("0,"+i).innerHTML = "<img src='imgs/topB.png'>";
        document.getElementById("0,"+i).name = "topB"
        document.getElementById("0,"+i).classList.add("N");
   }

   for(i = 1; i < 7; i+=5){
        document.getElementById("7,"+i).innerHTML = "<img src='imgs/konjC.png'>";
        document.getElementById("7,"+i).name = "konjC";
        document.getElementById("0,"+i).innerHTML = "<img src='imgs/konjB.png'>";
        document.getElementById("0,"+i).name = "konjB"
   }

   for(i = 2; i < 6; i+=3){
        document.getElementById("7,"+i).innerHTML = "<img src='imgs/lovacC.png'>";
        document.getElementById("7,"+i).name = "lovacC";
        document.getElementById("0,"+i).innerHTML = "<img src='imgs/lovacB.png'>";
        document.getElementById("0,"+i).name = "lovacB"
   }

   document.getElementById("0,3").innerHTML = "<img src='imgs/kraljB.png'>";
   document.getElementById("0,3").name = "kraljB";
   document.getElementById("0,3").classList.add("N");
   document.getElementById("7,3").innerHTML = "<img src='imgs/kraljC.png'>";
   document.getElementById("7,3").name = "kraljC";
   document.getElementById("7,3").classList.add("N");

   document.getElementById("0,4").innerHTML = "<img src='imgs/kraljicaB.png'>";
   document.getElementById("0,4").name = "kraljicaB";
   document.getElementById("7,4").innerHTML = "<img src='imgs/kraljicaC.png'>";
   document.getElementById("7,4").name = "kraljicaC";

}
function PlayerMov(a){
    if(a == "B"){
        document.getElementById("potez").innerHTML = "Na potezu je CRNI";
    }
    else{
        document.getElementById("potez").innerHTML = "Na potezu je BELI";
    }

}



var mov = [];
var br = 0;
var lastMov1 = "C";
var Ampasan = [false, false];

const PromoteWhite = '<a><img name = "konjB" src="imgs/konjB.png" alt="" onclick = "Promote(this);"></a><a > <img name = "kraljicaB" src="imgs/kraljicaB.png" alt="" onclick = "Promote(this);"></a><a > <img name = "topB" src="imgs/topB.png" alt="" onclick = "Promote(this);"></a><a > <img name = "lovacB" src="imgs/lovacB.png" alt="" onclick = "Promote(this);"></a>'
const PromoteBlack = '<a><img name = "konjC" src="imgs/konjC.png" alt="" onclick = "Promote(this);"></a><a > <img name = "kraljicaC" src="imgs/kraljicaC.png" alt="" onclick = "Promote(this);"></a><a > <img name = "topC" src="imgs/topC.png" alt="" onclick = "Promote(this);"></a><a > <img name = "lovacC" src="imgs/lovacC.png" alt="" onclick = "Promote(this);"></a>'
var imeProma = "";
var PromotingFigure = "";
var Ampovi = Array();

function Promote(pickedOpt){
    imeProma = pickedOpt.name;
    PromotingFigure.name = imeProma;
    PromotingFigure.innerHTML = "<img src='imgs/"+imeProma+".png'>";
    document.getElementById("izbor").innerHTML = "";
    document.getElementById("promotion").style.visibility = "hidden";
}



function CheckMov(a) {
    if (br == 2) {
        br = 0;
        mov = [];
    }
    mov[br++] = a;
    if (br == 1) {
        tucena = [];
        tucena[0] = a;
        obojena = [];
        stareBoje = [];
        brojacBoja = 0;
        for (var i = 0; i < 8; i++) {
            for (var j = 0; j < 8; j++) {
                tucena[1] = document.getElementById(i + "," + j);
                if ((CanMove(tucena, 0) || Eat(tucena, 0)) && (tucena[0].name.charAt(tucena[0].name.length - 1)) != lastMov1) {
                    obojena[brojacBoja] = document.getElementById(i + "," + j);
                    stareBoje[brojacBoja] = document.getElementById(i + "," + j).style.backgroundColor;
                    let newCol = (document.getElementById(i + "," + j).classList.contains("poljeB")) ? "rgb(224, 112, 112)" : "rgb(148, 93, 93)";
                    document.getElementById(i + "," + j).style.backgroundColor = newCol;
                    brojacBoja++;
                }
            }
        }
    }
    console.log(mov);
    if (br == 2) {
        for (var i = 0; i < brojacBoja; i++) {
            obojena[i].style.backgroundColor = stareBoje[i];
        }
    }
    if (br == 2 && (mov[0].name.charAt(mov[0].name.length - 1)) != lastMov1) {
        var ret = document.getElementById("telo").innerHTML;
        var pov = lastMov1;
        if (mov[1].name == "") {
            CanMove(mov, 1);
        }
        else {
            Eat(mov, 1);
        }
        if (mov[0].name == "") mov[0].classList.remove("N");
        if (document.getElementById("telo").innerHTML != ret) {
            if (Ampasan[1]) {
                for (var i = 0; i < Ampovi.length; i++) {
                    Ampovi[i].classList.remove("Amp");
                }
                Ampasan[1] = false;
            }
        }
        if (Ampasan[0]) {
            Ampasan[1] = true;
            Ampasan[0] = false;
        }
        var kingCheckB = document.getElementsByName("kraljB")[0];
        var kingCheckC = document.getElementsByName("kraljC")[0];
        var checker = (kingCheckB.name.charAt(parseInt(kingCheckB.name.length) - 1) == lastMov1) ? kingCheckB : kingCheckC;
        var zaProveru = []; zaProveru[0] = checker; zaProveru[1] = checker;
        if (Tuceno(zaProveru)) {
            document.getElementById("telo").innerHTML = ret;
            lastMov1 = pov;
        }
        if (mov[1].name == "piunB" && mov[1].id[0] == 7) {
            document.getElementById("izbor").innerHTML = PromoteWhite;
            document.getElementById("promotion").style.visibility = "visible";
            PromotingFigure = mov[1];
        }
        if (mov[1].name == "piunC" && mov[1].id[0] == 0) {
            document.getElementById("izbor").innerHTML = PromoteBlack;
            document.getElementById("promotion").style.visibility = "visible";
            PromotingFigure = mov[1];
        }
    }
}
function Tuceno(a){
    var niz = [];
    niz[1] = a[1];
    var i;
    var j;
    var staroIme;
    if (a[0].name == "kraljB") {
        staroIme = niz[1].name; niz[1].name = "ludiKraljB";
        var x = document.getElementsByName("kraljC")[0];
        x.name = "ludiKraljC";
        for (i = 0; i < 8; i++) {
            for (j = 0; j < 8; j++) {
                if (document.getElementById(i + "," + j).name.charAt(parseInt(document.getElementById(i + "," + j).name.length) - 1) == "C") {
                    niz[0] = document.getElementById(i + "," + j);
                    if (niz[0].name == "piunC") {
                        niz[1].name = "kraljB";
                        if (Eat(niz, 0)) {
                            niz[1].name = staroIme;
                            x.name = "kraljC";
                            return true;
                        }
                    }
                    else {
                        if (CanMove(niz, 0) || Eat(niz, 0)) {
                            niz[1].name = staroIme;
                            x.name = "kraljC";
                            return true;
                        }
                    }
                }
            }
        }
        niz[1].name = staroIme;
        x.name = "kraljC";
        return false;
    }
    if (a[0].name == "kraljC") {
        staroIme = niz[1].name; niz[1].name = "ludiKraljC";
        var x = document.getElementsByName("kraljB");
        x.name = "ludiKraljB";
        for (i = 0; i < 8; i++) {
            for (j = 0; j < 8; j++) {
                if (document.getElementById(i + "," + j).name.charAt(parseInt(document.getElementById(i + "," + j).name.length) - 1) == "B") {
                    niz[0] = document.getElementById(i + "," + j);
                    if (niz[0].name == "piunB") {
                        niz[1].name = "kraljC";
                        if (Eat(niz, 0)) {
                            niz[1].name = staroIme;
                            x.name = "kraljB";
                            return true;
                        }
                    }
                    else {
                        if (CanMove(niz, 0) || Eat(niz, 0)) {
                            niz[1].name = staroIme;
                            x.name = "kraljB";
                            return true;
                        }
                    }
                }
            }
        }
        niz[1].name = staroIme;
        x.name = "kraljB";
        return false;
    }
}





function CanMove(a,check){  
    Bcheck = false;

    //Kraljica
    if (a[0].name == "kraljicaB" || a[0].name == "kraljicaC") {
        if (a[0].id[0] == a[1].id[0]) {
            start = parseInt(a[0].id[2]);
            dest = parseInt(a[1].id[2]);
            console.log("Start ", start, "Dest", dest, " horizontal");
            z = true;
            if (start == dest) z = false;
            if (start > dest) {
                for (i = parseInt(start) - 1; i > dest; i--) {
                    if (document.getElementById(a[0].id[0] + "," + i).name != "") {
                        z = false;
                    }
                }
            }
            else if (start < dest) {
                for (i = parseInt(start) + 1; i < dest; i++) {
                    if (document.getElementById(a[0].id[0] + "," + i).name != "") {
                        z = false;
                    }
                }
            }
            if (z) {
                if ((a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) && a[1].name != "") {
                    Bcheck = EatSwap(a, check);
                }
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
            }
        }
        else if (a[0].id[2] == a[1].id[2]) {
            start = parseInt(a[0].id[0]);
            dest = parseInt(a[1].id[0]);
            console.log("Start ", start, "Dest", dest, "vertical");
            z = true;
            if (start == dest) z = false;
            if (start > dest) {
                for (i = parseInt(start) - 1; i > dest; i--) {
                    if (document.getElementById(i + "," + a[0].id[2]).name != "") {
                        z = false;
                    }
                }
            }
            else if (start < dest) {
                for (i = parseInt(start) + 1; i < dest; i++) {
                    if (document.getElementById(i + "," + a[0].id[2]).name != "") {
                        z = false;
                    }
                }
            }
            if (z) {
                if ((a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) && a[1].name != "") {
                    Bcheck = EatSwap(a, check);
                }
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
            }
        }
        var iStart = parseInt(a[0].id[0]);
        var jStart = parseInt(a[0].id[2]);

        var iDest = parseInt(a[1].id[0]);
        var jDest = parseInt(a[1].id[2]);

        var Start = iStart + jStart;
        var Dest = iDest + jDest;

        var zLov = true;
        if ((iDest + jDest) == (iStart + jStart)) {
            if ((iDest - jDest) > (iStart - jStart)) {
                var i = iDest - 1;
                var j = jDest + 1;
                while ((i - j) > (iStart - jStart)) {
                    if (document.getElementById(i + "," + j).name != "") {
                        zLov = false;
                        break;
                    }
                    i--;
                    j++;
                }
            }
            else if ((iStart - jStart) > (iDest - jDest)) {
                var i = iDest + 1;
                var j = jDest - 1;

                while ((i - j) < (iStart - jStart)) {
                    if (document.getElementById(i + "," + j).name != "") {
                        zLov = false;
                        break;
                    }
                    i++;
                    j--;
                }
            }
            if (zLov) {
                if ((a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) && a[1].name != "") {
                    Bcheck = EatSwap(a, check);
                }
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
            }
        }
        else if ((iDest - jDest) == (iStart - jStart)) {

            if ((Dest > Start)) {
                var i = iDest - 1;
                var j = jDest - 1;
                while ((i + j) > Start) {
                    if (document.getElementById(i + "," + j).name != "") {
                        zLov = false;
                        break;
                    }
                    i--;
                    j--;
                }
            }
            else if (Start > Dest) {
                var i = iDest + 1;
                var j = jDest + 1;
                while ((i + j) < Start) {
                    if (document.getElementById(i + "," + j).name != "") {
                        zLov = false;
                        break;
                    }
                    i++;
                    j++;
                }
            }
            if (zLov) {
                if ((a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) && a[1].name != "") {
                    Bcheck = EatSwap(a, check);
                }
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
            }
        }
    }




    //Lovac
    if(a[0].name == "lovacB" || a[0].name == "lovacC"){
        var iStart = parseInt(a[0].id[0]);
        var jStart = parseInt(a[0].id[2]);

        var iDest = parseInt(a[1].id[0]);
        var jDest = parseInt(a[1].id[2]);

        var Start = iStart + jStart;
        var Dest = iDest + jDest;

        var zLov = true;

        if((iDest + jDest) == (iStart + jStart)){
            if((iDest - jDest) > (iStart - jStart)){
                var i = iDest - 1;
                var j = jDest + 1;

                while((i-j) > (iStart - jStart)){
                    if(document.getElementById(i+","+j).name != ""){
                        zLov = false;
                        break;
                    }
                    i--;
                    j++;
                }
            }
            else if((iStart - jStart) > (iDest - jDest)){
                var i = iDest + 1;
                var j = jDest - 1;

                while((i-j) < (iStart - jStart)){
                    if(document.getElementById(i+","+j).name != ""){
                        zLov = false;
                        break;
                    }
                    i++;
                    j--;
                }

            }
            if(zLov){
                if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                    Bcheck = EatSwap(a,check);
               }
               if(a[1].name == ""){
                   Bcheck = Swap(a,check);
               }
                 
            }
        }
        else if((iDest - jDest) == (iStart - jStart)){

            if((Dest > Start)){
                var i = iDest-1;
                var j = jDest-1;
                while((i+j) > Start){
                    if(document.getElementById(i+","+j).name != ""){
                        zLov = false;
                        break;
                    }
                    i--;
                    j--;
                }

            }
            else if(Start > Dest){
                var i = iDest+1;
                var j = jDest+1;
                while((i+j) < Start){
                    if(document.getElementById(i+","+j).name != ""){
                        zLov = false;
                        break;
                    }
                    i++;
                    j++;
                }
            }
            if(zLov){
                if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                    Bcheck = EatSwap(a,check);
               }
               if(a[1].name == ""){
                   Bcheck = Swap(a,check);
               }  
            }
        }
    }



    //Kralj ludi
    if (a[0].name == "ludiKraljB" || a[0].name == "ludiKraljC") {
        if (a[1].id[0] == a[0].id[0]) {
            if (a[1].id[2] == parseInt(a[0].id[2]) + 1 || a[1].id[2] == parseInt(a[0].id[2]) - 1) {
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
                else if (a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) {
                    Bcheck = EatSwap(a, check);
                }
            }
        }
        if (a[1].id[0] == parseInt(a[0].id[0]) + 1 || a[1].id[0] == parseInt(a[0].id[0]) - 1) {
            if (a[1].id[2] == parseInt(a[0].id[2]) + 1 || a[1].id[2] == parseInt(a[0].id[2]) - 1 || a[1].id[2] == parseInt(a[0].id[2])) {
                if (a[1].name == "") {
                    Bcheck = Swap(a, check);
                }
                else if (a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) {
                    Bcheck = EatSwap(a, check);
                }
            }
        }
    }


    //Kralj
    if (a[0].name == "kraljB" || a[0].name == "kraljC") {
        if (a[1].id[0] == a[0].id[0]) {
            if (a[1].id[2] == parseInt(a[0].id[2]) - 2) {
                if (document.getElementById(a[0].id[0] + "," + 0).classList.contains("N") && a[0].classList.contains("N")) {
                    console.log("MALA ROKADA");
                    var midP = document.getElementById(a[0].id[0] + "," + 2);
                    if (midP.name == "" && a[1].name == "") {
                        var pomCheck = [a[0], midP];
                        if (Tuceno(pomCheck) == false) {
                            Bcheck = Swap(a, check);
                            Swap([document.getElementById(a[0].id[0] + "," + 0), midP], check);
                        }
                    }
                }
            }
            if (a[1].id[2] == parseInt(a[0].id[2]) + 2) {
                if (document.getElementById(a[0].id[0] + "," + 7).classList.contains("N") && a[0].classList.contains("N")) {

                    var midP = document.getElementById(a[0].id[0] + "," + 4);
                    if (midP.name == "" && a[1].name == "" && document.getElementById(a[0].id[0] + "," + 6).name == "") {
                        var pomCheck = [a[0], midP];
                        if (Tuceno(pomCheck) == false) {
                            Bcheck = Swap(a, check);
                            Swap([document.getElementById(a[0].id[0] + "," + 7), midP], check);
                        }
                    }
                }
            }
            if (a[1].id[2] == parseInt(a[0].id[2]) + 1 || a[1].id[2] == parseInt(a[0].id[2]) - 1) {
                if (Tuceno(a) == false) {
                    if (a[1].name == "") {
                        Bcheck = Swap(a, check);
                    }
                    else if (a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) {
                        Bcheck = EatSwap(a, check);
                    }
                }
            }
        }
        if (a[1].id[0] == parseInt(a[0].id[0]) + 1 || a[1].id[0] == parseInt(a[0].id[0]) - 1) {
            if (a[1].id[2] == parseInt(a[0].id[2]) + 1 || a[1].id[2] == parseInt(a[0].id[2]) - 1 || a[1].id[2] == parseInt(a[0].id[2])) {

                if (Tuceno(a) == false) {
                    if (a[1].name == "") {
                        Bcheck = Swap(a, check);
                    }
                    else if (a[1].name.charAt(parseInt(a[1].name.length) - 1) != a[0].name.charAt(parseInt(a[0].name.length) - 1)) {
                        Bcheck = EatSwap(a, check);
                    }
                }

            }
        }
    }


    //Konj
    //-------------------------------------------------------------------------------
    if(a[0].name == "konjB" || a[0].name == "konjC"){
        posX = a[0].id[0];
        posY = a[0].id[2];
        if(a[1].id[0] == parseInt(posX)+2 || a[1].id[0] == parseInt(posX)-2){
            if(a[1].id[2] == parseInt(posY)+1 || a[1].id[2] == parseInt(posY)-1){
                if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                    Bcheck = EatSwap(a,check);
                }
                if(a[1].name == ""){
                    Bcheck = Swap(a,check);
                }
            }
        }
        if(a[1].id[0] == parseInt(posX)+1 || a[1].id[0] == parseInt(posX)-1){ 
            if(a[1].id[2] == parseInt(posY)+2 || a[1].id[2] == parseInt(posY)-2){
                if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                    Bcheck = EatSwap(a,check);
                }
                if(a[1].name == ""){
                    Bcheck = Swap(a,check);
                }
                
            }
        }

    }
    //-------------------------------------------------------------------------------
    
    //Top
    //-------------------------------------------------------------------------------
    //Horizntal
    if(a[0].name == "topC" || a[0].name == "topB"){ 
        if(a[0].id[0] == a[1].id[0]){
            start = parseInt(a[0].id[2]);
            dest = parseInt(a[1].id[2]);
           console.log("Start ",start, "Dest", dest, " horizontal");
        z = true;
        if(start == dest) z = false;
        if(start > dest){
            for(i = parseInt(start)-1; i > dest; i--){
                if(document.getElementById(a[0].id[0]+","+i).name != ""){
                    z = false;
                }
            }
        }
        else if(start < dest){
            for(i = parseInt(start)+1; i < dest; i++){
                if(document.getElementById(a[0].id[0]+","+i).name != ""){
                    z = false;
                }
            }
        }
        if(z){
            if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                 Bcheck = EatSwap(a,check);
            }
            if(a[1].name == ""){
                 Bcheck = Swap(a,check);
            }
            }
        }
        else if(a[0].id[2] == a[1].id[2]){
            start = parseInt(a[0].id[0]);
            dest = parseInt(a[1].id[0]);
           console.log("Start ",start, "Dest", dest, "vertical");
        z = true;
        if(start == dest) z = false;
        if(start > dest){
            for(i = parseInt(start)-1; i > dest; i--){
                if(document.getElementById(i+","+a[0].id[2]).name != ""){
                    z = false;
                }
            }
        }
        else if(start < dest){
            for(i = parseInt(start)+1; i < dest; i++){
                if(document.getElementById(i+","+a[0].id[2]).name != ""){
                    z = false; 
                }
            }
        }
        if(z){
            if((a[1].name.charAt(parseInt(a[1].name.length)-1) != a[0].name.charAt(parseInt(a[0].name.length)-1)) && a[1].name != ""){
                 Bcheck = EatSwap(a,check);
            }
            if(a[1].name == ""){
                 Bcheck = Swap(a,check);
            }
        }
        }
    }
    //-------------------------------------------------------------------------------

    //Crni Piun
    //-------------------------------------------------------------------------------
    if(a[0].name == "piunC"){
        if(a[0].classList.contains("Amp") && a[1].classList.contains("Amp") && a[1].name == ""){

            Bcheck = Swap(a,check);

            if(check){
                console.log(document.getElementById((parseInt(a[1].id[0])-1)+","+a[1].id[2]));
              document.getElementById((parseInt(a[1].id[0])+1)+","+a[1].id[2]).name = "";
              document.getElementById((parseInt(a[1].id[0])+1)+","+a[1].id[2]).innerHTML = "<img src = 'imgs/0.png'>";
            }
            
            
        }
        if(a[0].id[2] == a[1].id[2]){
            if(a[1].id[0] == (a[0].id[0] - 1)){
                Bcheck = Swap(a,check); 
            }
        }
        if(a[0].id[0] == 6 && document.getElementById((parseInt(a[0].id[0])-1)+","+a[0].id[2]).name == ""){
            if(a[1].id[0] == (a[0].id[0] - 2) && a[0].id[2] == a[1].id[2]){
                Bcheck = Swap(a,check);
                var l = parseInt(a[1].id[0]);
                var d = parseInt(a[1].id[2]);
    
                
                
    
                if((d+1) != 8){
                  var lPesak = document.getElementById(l+","+(d+1));
                if(lPesak.name == "piunB" && check){
                    lPesak.classList.add("Amp");
                    document.getElementById((parseInt(a[0].id[0])-1)+","+a[0].id[2]).classList.add("Amp");
                    Ampasan[0] = true;
                    Ampovi.push(document.getElementById((parseInt(a[0].id[0])-1)+","+a[0].id[2])) ;
                    Ampovi.push(lPesak);
                }  
                }
                
                if((d-1) != -1){
                   var dPesak = document.getElementById(l+","+(d-1));
                if(dPesak.name == "piunB" && check ){
                    dPesak.classList.add("Amp");
                    document.getElementById((parseInt(a[0].id[0])-1)+","+a[0].id[2]).classList.add("Amp");
                    Ampasan[0] = true;
                    Ampovi.push(document.getElementById((parseInt(a[0].id[0])-1)+","+a[0].id[2]));
                    Ampovi.push(dPesak);
                } 
                }
                
     
            }
        }       
    }
    //-------------------------------------------------------------------------------

    //Beli Piun
    //-------------------------------------------------------------------------------
    if(a[0].name == "piunB"){
        if(a[0].classList.contains("Amp") && a[1].classList.contains("Amp") && a[1].name == ""){
            Bcheck = Swap(a,check);
            if(check){
                console.log(document.getElementById((parseInt(a[1].id[0])+1)+","+a[1].id[2]));
              document.getElementById((parseInt(a[1].id[0])-1)+","+a[1].id[2]).name = "";
              document.getElementById((parseInt(a[1].id[0])-1)+","+a[1].id[2]).innerHTML = "<img src = 'imgs/0.png'>";
            } 
        }
        if(a[0].id[2] == a[1].id[2]){
            if(a[1].id[0] == (parseInt(a[0].id[0]) + 1)){ 
                Bcheck = Swap(a,check);
          }
        }
      if(a[0].id[0] == 1 && document.getElementById((parseInt(a[0].id[0])+1)+","+a[0].id[2]).name == ""){
          if(a[1].id[0] == (parseInt(a[0].id[0]) + 2) && a[1].id[2] == a[0].id[2]){
            Bcheck = Swap(a,check);
            var l = parseInt(a[1].id[0]);
            var d = parseInt(a[1].id[2]);
            if((d+1) != 8){
              var lPesak = document.getElementById(l+","+(d+1));
            if(lPesak.name == "piunC" && check){
                lPesak.classList.add("Amp");
                document.getElementById((parseInt(a[0].id[0])+1)+","+a[0].id[2]).classList.add("Amp");
                Ampasan[0] = true;
                Ampovi.push(document.getElementById((parseInt(a[0].id[0])+1)+","+a[0].id[2]));
                Ampovi.push(lPesak);
                }  
            }
            if((d-1) != -1){
               var dPesak = document.getElementById(l+","+(d-1));
            if(dPesak.name == "piunC" && check ){
                dPesak.classList.add("Amp");
                document.getElementById((parseInt(a[0].id[0])+1)+","+a[0].id[2]).classList.add("Amp");
                Ampasan[0] = true;
                Ampovi.push(document.getElementById((parseInt(a[0].id[0])+1)+","+a[0].id[2]));
                Ampovi.push(dPesak);
                } 
            }
            
 
          }
      }
    }
    //-------------------------------------------------------------------------------

    return Bcheck;

}
function Eat(a,check){ 
    Bcheck = false;
    //Kraljica
    if(a[0].name == "kraljicaB" || a[0].name == "kraljicaC"){
        Bcheck = CanMove(a,check);
    }
    //Lovac
    if(a[0].name == "lovacB" || a[0].name == "lovacC"){
       Bcheck = CanMove(a,check);
    }
    //Kralj
    if(a[0].name == "kraljB" || a[0].name == "kraljC"){
        Bcheck = CanMove(a,check);
    }
    if(a[0].name == "ludiKraljB" || a[0].name == "ludiKraljC"){
        Bcheck = CanMove(a,check);
    }
    //Crni piun
    if(a[0].name == "piunC" && (a[1].name).charAt(parseInt(a[1].name.length)-1) == "B"){
        
        if(a[0].id[0] == parseInt(a[1].id[0])+1){
                if(a[0].id[2] == parseInt(a[1].id[2])+1 || a[0].id[2] == parseInt(a[1].id[2])-1){
                    Bcheck = EatSwap(a,check);
                }
            }
    }
    //Beli piun
    if(a[0].name == "piunB" && (a[1].name).charAt(parseInt(a[1].name.length)-1) == "C"){
        if(a[0].id[0] == parseInt(a[1].id[0])-1){
                if(a[0].id[2] == parseInt(a[1].id[2])+1 || a[0].id[2] == parseInt(a[1].id[2])-1){
                    Bcheck = EatSwap(a,check);
                }
            }
    }
    //Topovi
    //------------------------------------------------------------------------------------------------
    if((a[0].name == "topC" || a[0].name == "topB")){
        Bcheck = CanMove(a,check);
    }
    //Konj
    if(a[0].name == "konjC" || a[0].name == "konjB"){
        Bcheck = CanMove(a,check);
    }
    return Bcheck;
}
function EatSwap(a,check){
    if(check == 1){
        lastMov1 = a[0].name.charAt(parseInt(a[0].name.length)-1);
        PlayerMov(lastMov1);
        a[1].innerHTML = a[0].innerHTML;
        a[1].name = a[0].name;
        a[0].innerHTML = "<img src = 'imgs/0.png'>";
        a[0].name = "";
    }
    else{
        return true;
    }  
}
function Swap(a,check){
    if(check == 1){
       lastMov1 = a[0].name.charAt(parseInt(a[0].name.length)-1);
        PlayerMov(lastMov1);
        pom = a[1].innerHTML;
        a[1].innerHTML = a[0].innerHTML;
        a[0].innerHTML = pom; 
        pom = a[1].name;
        a[1].name = a[0].name;
        a[0].name = pom;  
    }
    else{
        return true
    }  
}























  


