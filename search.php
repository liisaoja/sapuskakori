<?php include_once 'inc/top.php';?>

<main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
            <div>
<?php
//  $tietokanta->beginTransaction();
try {
    $tietokanta = new PDO('mysql:host=localhost;dbname=verkkokauppa;charset=utf8','root','');
} catch (Exception $ex) {
    print "<p>Häiriö tietokantayhteydessä.</p>"; 

if (isset($_POST['submit'])) {
    if(isset($_GET['go'])) {
        if(preg_match("/A-Z | a-z+/", $_POST['ainesosa'])) {
            $name=$_POST['ainesosa'];
             
             
          $tietokanta=sql_select_tietokanta("tuote"); 
 //-query  the database table 
         $sql="SELECT  nimi FROM tuote WHERE nimi LIKE '%" . $name ."%'"; 
// 12	  //-run  the query against the mysql query function 
         $result=sql_query($sql); 
// 14	  //-create  while loop and loop through result set 
        while($row=mysql_fetch_array($result)){ 
       $nimi  =$row['nimi']; 
        $ID=$row['ID']; 
// 19	  //-display the result of the array 
  echo "<ul>\n"; 
 echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$nimi .  "</a></li>\n"; 
echo "</ul>"; 
  } 
 } 
else{ 
 echo  "<p>Please enter a search query</p>"; 
  } 
  } 
	  };

?>
<?php include_once 'inc/bottom.php';?>
