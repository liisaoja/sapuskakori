<?php
if (!isset($_SESSION['kori'])) {
    $_SESSION['kori'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $tuote_idt = filter_input(INPUT_POST,'id');
    $idt = explode(",",$tuote_idt);
    foreach ($idt as $id) {
        array_push($_SESSION['kori'],$id);
    }
    header("location: kauppa.php");
    exit;
}
?>
<?php require_once 'inc/top.php'?>
<?php
$resepti_id = filter_input(INPUT_GET,'resepti_id',FILTER_SANITIZE_NUMBER_INT);

if (!$resepti_id) {
    $resepti_id = 1;
}
?>

<main role="main">
      <div class="jumbotron">
        <div class="container">
            <div>

<?php
$resepti_nimi = '';
$sql = "select nimi from resepti where id = $resepti_id";
$kysely = $tietokanta->query($sql);
if ($kysely) {
    $tietue = $kysely->fetch();
    $resepti_nimi = $tietue['nimi'];
}
print "<h4>$resepti_nimi</h4>";
?>

<?php
$sql= "SELECT nimi, maara FROM tuote INNER JOIN ainesosa ON ainesosa.tuote_id = tuote.id WHERE resepti_id = $resepti_id;";
$kysely = $tietokanta->query($sql);
            
            print "<table>";
            print "<tr>";
            print "<th>Ainesosa</th>";
            print "<th>Määrä</th>";
            print "</tr>";
    while ($tietue = $kysely->fetch()) {
    print "<tr>";
    print "<td>" . $tietue[nimi] . "</td>";
    print "<td>" . $tietue[maara] . "</td>";
    print "</tr>";
    // print $tietue['nimi'] . ', ' . $tietue['maara'] . "<br>";
               
            }
print "</table>";
print "</br>";
?>
<?php

$sql = "select * from resepti where id = $resepti_id";      
$kysely = $tietokanta->query($sql);

while ($tietue = $kysely->fetch()) {
    print "<form action='" . $_SERVER['PHP_SELF']  
            . "' method='post'>";
    print "<input type='hidden' name='id' value='" . $tietue['id'] . "'>";
    // print "<h4>" . $tietue['nimi'] . "</h4>";
    print "<strong>Valmistus</strong>";
    print "<p>" . $tietue['ohje'] . "</p>";
    print "<strong>Ravintosisältö/ 100g</strong>";
    print "<p>" . $tietue['ravintoarvot'] . "</p>";
    print '<img src="img/' . $tietue['kuva'] . '">';
    print "<br>";
    // print "<button>Osta</button>";
    print "</form>";
    print "<hr>";
}
?>



<?php
$sql= "SELECT tuote_id FROM ainesosa WHERE resepti_id = $resepti_id;"; 
$kysely = $tietokanta->query($sql);
//$tietue = $kysely->fetch();
//$id = $tietue;

print "<form action='" . $_SERVER['PHP_SELF']  
             . "' method='post'>";
print "<input type='hidden' name='id' value='";
$idt = '';
while ($tietue = $kysely->fetch()) {
    if (strlen($idt) > 0) {
        $idt.=',';
    }
    $idt.=  $tietue['tuote_id'];
}
print $idt;
print  "'>";
print "<button>Lisää ainekset ostoskoriin</button>";
print "</form>";

?>

            </div>


<?php require_once 'inc/bottom.php'?>