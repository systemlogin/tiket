<?php
$egm=null;
$egc=null;
$result=null;
$srm=$_SERVER["REQUEST_METHOD"];
if ($srm == "POST") {
  $dbh = null;
  try {
    include ("koneksi.php");
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare("INSERT INTO `t412_tiket` VALUE (?, ?, ?, ?);");
    $sth->bindValue(1, $_POST["j"], PDO::PARAM_STR);
    $sth->bindValue(2, $_POST["k"], PDO::PARAM_STR);
    $sth->bindValue(3, $_POST['p'], PDO::PARAM_STR);
    $sth->bindValue(4, $_POST["c"], PDO::PARAM_STR);
    $result=$sth->execute();
  } catch(PDOException $e) {
    $egm=$e->getMessage();
    $egc=$e->getCode();
  }
  $dbh = null;
}
?>

<!DOCTYPE html>
<html>
<title>Booking</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<body>
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <?php
      if($result){
      ?>
      <div class="w3-container w3-green">
      <h2>Pesan</h2>
      </div>
      <div class="w3-container">
        <p>Berhasil</p>
      </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button type="button" class="w3-button w3-green" onclick="myFunction()">Lanjut</button>
      </div>
      <?php
      } else if($egc=="23000") {
      ?>
      <div class="w3-container w3-yellow">
      <h2>Pesan</h2>
      </div>
      <div class="w3-container">
        <p>Kursi Ini Sudah Dibooking</p>
      </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button type="button" class="w3-button w3-yellow" onclick="myFunction()">Coba Yang Lagi</button>
      </div>
      <?php
      } else {
      ?>
      <div class="w3-container w3-red">
      <h2>Pesan</h2>
      </div>
      <div class="w3-container">
        <p>Kode Kesalahan : <?php echo $egc;?></p>
        <p>Pesan Kesalahan : <?php echo $egm;?></p>
      </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button type="button" class="w3-button w3-red" onclick="myFunction()">Mengerti</button>
      </div>
      <?php
      }
      ?>
    </div>
  </div>
<script>
document.getElementById('id01').style.display='block';
function myFunction(){
  document.getElementById('id01').style.display='none';
  <?php
  if($result){
    echo "window.location.href = \"http://localhost/tp/v2/profile.php#tiket\"";    
  } else {
    echo "window.location.href = \"http://localhost/tp/v2/jadwal.php?j=".$_POST["j"]."\"";
  }
  ?>
}
</script>     
</body>
</html>