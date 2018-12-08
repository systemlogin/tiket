<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  if(isset($_GET['d'])){
    $dbh = null;
    try {
      include ("koneksi.php");
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare("
        SELECT 
        `nama_maskapai`,
        `nama_asal`,
        `alamat_asal`,
        `kota_asal`,
        `negara_asal`,
        `catatan_asal`,
        `nama_tujuan`,
        `alamat_tujuan`,
        `kota_tujuan`,
        `negara_tujuan`,
        `catatan_tujuan`,
        `nama_pesawat`,
        IF(`kelas`='1','Bisnis','Ekonomi') AS kelas,
        `jadwal`,
        `sisa`,
        `catatan` 
        FROM `v411_jadwal` 
        WHERE `id_jadwal` = ?;
      ");
      $sth->bindValue(1, $_GET["d"], PDO::PARAM_STR);
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
