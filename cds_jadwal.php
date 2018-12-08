<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  if(isset($_GET['a1']) && isset($_GET['a2'])){
    $a1= $_GET["a1"];
    $a2= $_GET["a2"];
    $dbh = null;
    try {
      include ("koneksi.php");
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare("
      	SELECT COUNT(id_jadwal) as c
        FROM `v411_jadwal` 
        WHERE `kota_asal` LIKE CONCAT('%',?,'%') AND `kota_tujuan` LIKE CONCAT('%',?,'%');
      ");
      $sth->bindValue(1, $a1, PDO::PARAM_STR);
      $sth->bindValue(2, $a2, PDO::PARAM_STR);
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
}
?>
