
<?php
$d = include "Projets.php";

if(isset($_GET["q"])){
  $q= $_GET["q"];
  $doc = searchVille($q);
  echo analyse($doc);
}
else {
  $doc = searchAll();
  echo analyse($doc);
}
?>
