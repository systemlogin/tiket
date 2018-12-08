<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "GET") {
  if(isset($_GET['t'])){
    $dbh = null;
    try {
      include ("koneksi.php");
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare("
SELECT 
  `a`.`id_tiket`,
  `a`.`nama_maskapai`,
  `a`.`nama_asal`,
  `a`.`alamat_asal`,
  `a`.`kota_asal`,
  `a`.`negara_asal`,
  `a`.`catatan_asal`,
  `a`.`nama_tujuan`,
  `a`.`alamat_tujuan`,
  `a`.`kota_tujuan`,
  `a`.`negara_tujuan`,
  `a`.`catatan_tujuan`,
  `a`.`nama_pesawat`,
  IF(`a`.`kelas`='1','Bisnis','Ekonomi') AS kelas,
  `a`.`jadwal`,
  `a`.`catatan_jadwal`,
  `a`.`nomor_kursi`,
  `a`.`catatan_kursi`,
  `a`.`catatan_tiket`,
  `a`.`id_penumpang`,
  `b`.`nama`,
  `b`.`alamat`,
  `b`.`kota`,
  `b`.`kode_pos`,
  `b`.`negara`,
  `b`.`telepon`,
  `b`.`email`,
  `b`.`catatan` 
FROM
  (
    `v412_tiket` `a` 
    JOIN `v221_penumpang` `b` 
      ON (
        (
          `a`.`id_penumpang` = `b`.`id_pengguna`
        )
      )
  ) 
WHERE `a`.`id_tiket` = ? ;
      ");
      $sth->bindValue(1, $_GET["t"], PDO::PARAM_STR);
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
