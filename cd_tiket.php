<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  $dbh = null;
  try {
  	include ("koneksi.php");
  	$dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare("SELECT COUNT(`id_tiket`) AS c FROM `v412_tiket` WHERE `id_penumpang` = ?;");
    $sth->bindValue(1, $_GET["d"], PDO::PARAM_STR);
    $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
      $egm=$e->getMessage();
      $egc=$e->getCode();
  }
  $dbh = null;
  $json=json_encode($result[0]);
  echo $json;
}
?>