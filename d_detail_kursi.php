<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  if(isset($_GET['j'])&&isset($_GET['k'])){
    $j= $_GET["j"];
    $k= $_GET["k"];
    $dbh = null;
    try {
      include ("koneksi.php");
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare("
        SELECT 
        `nomor`,
        `catatan`
        FROM
        `v341_kursi` 
        WHERE `id_jadwal` = ?
        AND `id_kursi` = ?
        ");
      $sth->bindValue(1, $j, PDO::PARAM_STR);
      $sth->bindValue(2, $k, PDO::PARAM_STR);
      $sth->execute();
      $result=$sth->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      $egm=$e->getMessage();
      $egc=$e->getCode();
    }
    $dbh = null;
    $json=json_encode($result);
    echo "{\"data\":";
    echo $json;
    echo "}";
  }
}
?>
