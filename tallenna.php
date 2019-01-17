<?php
include_once 'inc/top.php';
?>

<main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
            <div>

<?php

$sukunimi = filter_input(INPUT_POST, 'sukunimi',FILTER_SANITIZE_STRING);
$etunimi = filter_input(INPUT_POST, 'etunimi',FILTER_SANITIZE_STRING);
$toimitusosoite = filter_input(INPUT_POST, 'toimitusosoite',FILTER_SANITIZE_STRING);


try {
    $tietokanta->beginTransaction();
    $sql = "insert into asiakas (sukunimi,etunimi,toimitusosoite)
        values (:sukunimi,:etunimi,:toimitusosoite);";

    $kysely = $tietokanta->prepare($sql);
    $kysely->bindValue(':sukunimi',$sukunimi,PDO::PARAM_STR);
    $kysely->bindValue(':etunimi',$etunimi,PDO::PARAM_STR);
    $kysely->bindValue(':toimitusosoite',$toimitusosoite,PDO::PARAM_STR);

    $kysely->execute();

    $asiakas_id = $tietokanta->lastInsertId();

    $sql = "insert into tilaus (asiakas_id) values (:asiakas_id)";
    $kysely = $tietokanta->prepare($sql);
    $kysely->bindValue(':asiakas_id',$asiakas_id,PDO::PARAM_INT);
    $kysely->execute();

    $tilaus_id = $tietokanta->lastInsertId();

    foreach ($_SESSION['kori'] as $tuote_id) {
        $sql = "insert into tilausrivi (tilaus_id,tuote_id) "
                . "values (:tilaus_id,:tuote_id)";
        $kysely = $tietokanta->prepare($sql);
        $kysely->bindValue(':tilaus_id',$tilaus_id,PDO::PARAM_INT);
        $kysely->bindValue(':tuote_id',$tuote_id,PDO::PARAM_INT);
        $kysely->execute(); 
    }

    unset($_SESSION['kori']);
    $tietokanta->commit();
    print "</br>";
    print "<p><br>Kiitos tilauksestasi!</p>";
}
catch (Exception $ex) {
    $tietokanta->rollback();
    print "<p>Häiriö verkkokaupassa, tilausta ei voitu tallentaa</p>";
}
include_once 'inc/bottom.php';
?>