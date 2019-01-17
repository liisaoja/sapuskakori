<?php 
include_once 'inc/top.php';



if (isset($_GET['poista'])) {
    unset($_SESSION['kori']);
}

if (isset($_GET['tuoteryhma_id'])) {
    $tuoteryhma_id = filter_input(INPUT_GET,'tuoteryhma_id',FILTER_SANITIZE_NUMBER_INT);
}


if (!isset($_SESSION['kori'])) {
    $_SESSION['kori'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tuote_id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    array_push($_SESSION['kori'],$tuote_id);
}

?>
<main role="main">
<div class="jumbotron">
        <div class="container-fluid">
<h3>Verkkokauppa</h3>

<div class="row">
<div class="col-sm-9">
<div class="row">

<?php

$sql = "SELECT * FROM tuote ORDER BY RAND( ) LIMIT 6";      
$kysely = $tietokanta->query($sql);
// $i = 1;

// print "<div style='overflow-x:auto'>";
// print "<table cellpadding='15'>";

while ($tietue = $kysely->fetch()) {
   
    //     if($i == 1){
    //     print "<tr>";
    //  }
       print "<div class='col-md-12 col-lg-6 col-xl-4'>";
        print "<form action='" . $_SERVER['PHP_SELF']  
                . "' method='post'>";
        print "<input type='hidden' name='id' value='" . $tietue['id'] . "'>";
        print "<p>" . $tietue['nimi'] . '';
        print  "<br>". $tietue['hinta'] . "€</br>";
        print '<img src="img/' . $tietue['Kuva'] . '">';
        print "<br>";
        print "<button>Osta</button></br>";
        print "</form>";
        print "</div>";
        
        // if ($i == 3){
        // $i=1;
        // print "</div>";
        //  }
        // else {
        //      $i++;
        //  }
    }
   
//  print "</table>"; 
 print "</div>";
 
?>
</div>
<div class="col-sm-3">
    <h4>Ostoskori</h4>
    <?php
    if (isset($_SESSION['kori'])) {
        $summa = 0;
        foreach ($_SESSION['kori'] as $tuote_id) {
            //print "$tuote_id<br />";
            $sql = "select * from tuote where id = $tuote_id";
            $kysely = $tietokanta->query($sql);
            $tuote = $kysely->fetch();
            $summa+=$tuote['hinta'];
            print $tuote['nimi'] . ', ' . $tuote['hinta'] . ' €<br />';
        }
        print "<hr>";
        print "<p><strong>Yhteensä $summa €</strong></p>";
        
        print "<a href='" . $_SERVER['PHP_SELF'] . "?poista=true'>Tyhjennä</a>";
        if (count($_SESSION['kori']) > 0) {
            print "<a href='tilaa.php'>&nbsp;Tilaa</a>";
        }
    }
    
    ?>
</div>
</div>
</div>
</div>
</main>
<?php include_once 'inc/bottom.php';?>