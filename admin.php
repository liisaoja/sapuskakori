<?php
include_once 'inc/top.php';
$sql = "SELECT asiakas.id as asikasid,asiakas.sukunimi,asiakas.etunimi,
tilaus.id as tilausid,tilaus.tilattu,tuote.nimi,tuote.hinta from asiakas
INNER JOIN tilaus ON asiakas.id=tilaus.asiakas_id
INNER JOIN tilausrivi ON tilaus.id=tilausrivi.tilaus_id
INNER JOIN tuote ON tilausrivi.tuote_id=tuote.id ORDER BY tilaus.id";

$kysely = $tietokanta->query($sql);
print "<table class='table'>";
print "<tr>";
print "<th>Asiakas</th>";
print "<th>Tilaus id</th>";
print "<th>Tuote</th>";
print "<th>Hinta</th>";
print "</tr>";
$tilaus_id = 0;
while ($tietue = $kysely->fetch()) {
    print "<tr>";
    if ($tilaus_id != $tietue['tilausid']) {
        print "<td>" . $tietue['sukunimi'] . ", " . $tietue['etunimi']  . "</td>";
    }
    else {
        print "<td></td>";
    }
    $tilaus_id = $tietue['tilausid'];
    print "<td>" . $tietue['tilausid'] . "</td>";
    print "<td>" . $tietue['nimi'] . "</td>";
    print "<td>" . $tietue['hinta'] . "</td>";
    print "</tr>";
}
print "</table>";



include_once 'inc/bottom.php';
?>