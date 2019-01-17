<?php
include_once 'inc/top.php';
?>
<div class="jumbotron">
        <div class="container">
<style>
    label,button {display: block;}
</style>
<h3>Tilaa</h3>
<form action="tallenna.php" method="post">
    <label>Sukunimi</label>
    <input name="sukunimi" maxlength="100">
    <label>Etunimi</label>
    <input name="etunimi" maxlength="100">
    <label>Tilauksen toimitusosoite</label>
    <input name="toimitusosoite" maxlength="500">
    <button>Tilaa</button>
</form>
</div>
</div>
<?php
include_once 'inc/bottom.php';
?>