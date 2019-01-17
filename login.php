<?php
include_once 'inc/top.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tunnus = filter_input(INPUT_POST,'tunnus',FILTER_SANITIZE_STRING);
    $salasana = md5(filter_input(INPUT_POST,'salasana',FILTER_SANITIZE_STRING));
    $sql = "select * from kayttaja where tunnus=:tunnus and salasana=:salasana";
    $kysely = $tietokanta->prepare($sql);
    $kysely->bindValue(':tunnus',$tunnus,PDO::PARAM_STR);
    $kysely->bindValue(':salasana',$salasana,PDO::PARAM_STR);
    $kysely->execute();
    $kayttaja = $kysely->fetch();
    
    if ($kayttaja) {
        header("location: admin.php");
        exit;
    }
    else {
        header("location: login.php");
        exit;
    }
    
}

?>
<h3>Kirjaudu</h3>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
    <div>
        <label>Tunnus</label>
        <input name="tunnus">
    </div>
    <div>
        <label>Salasana</label>
        <input name="salasana" type="password">
    </div>
    <div>
        <button>Kirjaudu</button>
    </div>
</form>
<?php
include_once 'inc/bottom.php';
?>
