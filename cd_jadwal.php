<?php
$egm=null;
$egc=null;
$result=null;
$dbh = null;
try {
  include ("koneksi.php");
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sth = $dbh->prepare("SELECT TABLE_ROWS as c FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'am_tp' AND TABLE_NAME = 't411_jadwal' ;");
  $sth->execute();
  $result=$sth->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $egm=$e->getMessage();
    $egc=$e->getCode();
}
$dbh = null;
$json=json_encode($result[0]);
echo $json;
?>
