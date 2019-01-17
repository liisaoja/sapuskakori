<?php
require_once 'inc/top.php';
$id = filter_input(INPUT_GET,'id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tuote_id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    array_push($_SESSION['kori'],$tuote_id);
    $id = $tuote_id;
}

$sql = "select * from tuote where id = $id";
$kysely = $tietokanta->query($sql);
if ($kysely) {
    $tietue = $kysely->fetch();
        print "<form action='" . $_SERVER['PHP_SELF']  
            . "' method='post'>";
    print "<input type='hidden' name='id' value='" . $tietue['id'] . "'>";
    print "<p>" . $tietue['nimi'] . "</p>";
    print "<p>" . $tietue['hinta'] . "€</p>";
    print "<button>Osta</button>";
    print "</form>";
}
require_once 'inc/bottom.php';
?>