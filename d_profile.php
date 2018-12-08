<?php
$egm=null;
$egc=null;
$result=null;
session_start();
if (isset($_SESSION['a1']) && !empty($_SESSION['a1'])){
  $dbh = null;
  try {
    include ("koneksi.php");
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare("
      SELECT 
      `id_pengguna`,
      `nama`,
      `alamat`,
      `kota`,
      `kode_pos`,
      `negara`,
      `telepon`,
      email,
      `catatan`
      FROM
      `v221_penumpang`
      WHERE email = ?;
    ");
    $sth->bindValue(1, $_SESSION["a1"], PDO::PARAM_STR);
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
?>
