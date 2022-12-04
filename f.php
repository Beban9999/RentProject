<?php
    function prijavljen(){
        if(isset($_SESSION['korIme']) and isset($_SESSION['user']) and isset($_SESSION['status'])){
            return true;
        }
        else{
            return false;
        }
    }

    function loged()
    {
        if (prijavljen()) {
            // echo "Prijavljeni ste kao {$_SESSION['user']} ({$_SESSION['status']})<br>";
            // echo '<div class="btn-group" role="group" aria-label="Basic example">';
            // echo '<a class="btn btn-primary" href="pocetna.php">Pocetna</a>';
            // echo '<a class="btn btn-primary" href="vesti.php">Vesti</a>';
            // echo '<a class="btn btn-primary" href="korisnici.php">Korisnici</a>';
            // echo '<a class="btn btn-primary" href="pocetna.php?odjava">Odjavite se</a>';
            // echo '</div>';
        
        
        
            echo '
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="imgs/Screenshot_1.png" class="rounded-circle" height="25" alt="Black and White Portrait of a Man"
                            loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="pocetna.php?odjava">Sign Out</a>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="pocetna.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vesti.php">Add</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
        
                </div>
        
            </div>
        </nav>
            
            ';
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        } 
        else {
            // echo '<input type="text" name="korIme" id="korIme" placeholder="Unesite korisnicko ime">';
            // echo '<input type="password" name="pass" id="pass" placeholder="Unesite lozinku">';
            // echo '<button id = "login" name = "login">Prijavite se</button>';
            echo '
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex">
                    <input type="text" name="korIme" id="korIme" class="form-control me-2" placeholder="Username">
                    <input class="form-control me-2" type="password" name="pass" id="pass" placeholder="Unesite lozinku">
                    <button id = "login" name = "login" class="btn btn-outline-success">Login</button>
                </form>
                </div>
            </div>
            </nav>
            ';
        }
    }
?>