<?php
session_start();
session_regenerate_id();
$tietokanta = null;     
try {
    $tietokanta = new PDO('mysql:host=localhost;dbname=verkkokauppa;charset=utf8','root','');
} catch (Exception $ex) {
    print "<p>Häiriö tietokantayhteydessä.</p>";                        
    // header("location: virhe.php");
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="css/style.css">
    
    <title>SapuskaKori</title>


  </head>
  
<div class="jumbotron">
        <!--<div class="container-fluid">-->
  <img src="img/sapuskakoribanneri.jpg">

  <body>
<div class="container">
 
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <!--<a class="navbar-brand" href="#">Navbar</a>-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Etusivulle <span class="sr-only">(current)</span></a>
          </li>
         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reseptit</a>
            <div class="dropdown-menu">
              <?php
                    $sql = "select * from resepti order by nimi";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='dropdown-item' href='resepti.php?resepti_id=" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    
                  </div>
                  </li>
              
               <li class="nav-item">
            <a class="nav-link" href="eskauppa.php">Ruokakauppa</a>
          </li>
          
           <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tuoteryhmät</a>                    
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    $sql = "select * from tuoteryhma order by nimi";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='dropdown-item' href='kauppa.php?tuoteryhma_id=" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    
                  </div>
            </div>
          </li>
        </ul>
        
        
      
    </nav>
    </div>