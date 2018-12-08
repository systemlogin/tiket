<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  if(isset($_GET['a1']) && isset($_GET['a2'])){
    $a1=(int) $_GET["a1"];
    $a2=(int) $_GET["a2"];
    $dbh = null;
    try {
      include ("koneksi.php");
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare("
        SELECT
          `id_jadwal`,
          `nama_maskapai`,
          `kota_asal`,
          `kota_tujuan`,
          IF(`kelas`='1','Bisnis','Ekonomi') AS kelas,
          `jadwal`,
          `sisa`
        FROM `v411_jadwal`
        ORDER BY `jadwal` ASC, `id_jadwal` ASC
        LIMIT ? OFFSET ?;
        ");
      $sth->bindValue(1, $a1, PDO::PARAM_INT);
      $sth->bindValue(2, $a2, PDO::PARAM_INT);
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
