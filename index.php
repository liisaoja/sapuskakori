
<?php include_once 'inc/top.php';?>

      
      <!--<div class="jumbotron jumbotron">-->
      <div class="container">
          <h1>Tervetuloa ruokaostoksille!</h1>
          <p>Sivustoltamme löydät kätevästi niin reseptit kuin tarvikkeet maukkaiden aterioiden valmistamiseen.<br>
          Reseptien ainesosat voit lisätä kätevästi yhdellä klikkauksella ostoskoriisi ja muokata korin sisältöä tarpeesi mukaan.
          </p>
          <p><a class="btn btn-primary btn-lg" href="eskauppa.php" role="button">Ruokakauppa &raquo;</a></p>
        </div>
      </div>
      </div>

<!--<main role="main">-->
      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-3">
            <h2>Syö kalaa 2-3 kertaa viikossa</h2>
            <p>Kala on ehdottomasti paras luonnollisen D-vitaamiinin lähde. Tällä viikolla olemme valinneet kalan lisukkeiksi maukkaita satokauden vihanneksia.</p>
             <p>
              <?php
                    $sql = "select nimi from resepti where id = '1'";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='btn btn-secondary' href='resepti.php?resepti_id=1" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    </p>
                    <br>
            <img src="img/uunilohi2.jpg" class="rounded-top"></img>
          </div>
          
            <div class=" col-sm-12 col-md-6 col-lg-3">
              <h2>Opiskelijan helpot</h2>
            <p>Terveellistä ja helppoa ruokaa pienelle budjetille. </p>
          <p>
             <?php
                    $sql = "select nimi from resepti where id = '8'";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='btn btn-secondary' href='resepti.php?resepti_id=8" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    </p>
                    <br>
                    <img src="img/kaurapuuro.jpg" class="rounded-top"></img>
          </div>
          
          <div class=" col-sm-12 col-md-6 col-lg-3">
            <h2>Kasvisruoka</h2>
            <p>Syksy on kurpitsan sesonkia. Kurpitsakeittoon käytetään satoisaa, kelta-oranssia myskikurpitsaa.</p>
             <p>
              <?php
                    $sql = "select nimi from resepti where id = '7'";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='btn btn-secondary' href='resepti.php?resepti_id=7" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    </p>
                    <br>
            <img src="img/kurpitsa2.jpg" class="rounded-top"></img>
          </div>
          
          <div class=" col-sm-12 col-md-6 col-lg-3">
            <h2>Päivän nopea</h2>
            <p>Helppo ja herkullinen arkiruoka One pot-pasta. Valmistus vie vain noin 30 minuuttia!</p>
            <p>
              <?php
                    $sql = "select nimi from resepti where id = '6'";
                    $kysely = $tietokanta->query($sql);
                    while ($tietue = $kysely->fetch()) {
                        print "<a class='btn btn-secondary' href='resepti.php?resepti_id=6" . $tietue['id'] . "'>" . $tietue['nimi'] . "</a>";
                    }
                    ?>
                    </p>
            <br>
            <img src="img/one_pot_pasta.jpg" class="rounded-top"></img>
          </div>
        </div>
        </div>

      

     <?php include_once 'inc/bottom.php';?>