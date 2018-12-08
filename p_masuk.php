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
    $sth = $dbh->prepare("SELECT `f111_pengguna`(?, ?) AS masuk;");
    $sth->bindValue(1, $_POST["a1"], PDO::PARAM_STR);
    $sth->bindValue(2, $_POST["a2"], PDO::PARAM_STR);
    $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $egm=$e->getMessage();
    $egc=$e->getCode();
  }
  $dbh = null;
}
?>

<!DOCTYPE html>
<html>
<title>Masuk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<body>
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <?php
      session_start();
      if($result[0]["masuk"] > 0){
        $_SESSION["a1"] = $_POST["a1"];
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
      } else if(is_null($egc)) {
      ?>
      <div class="w3-container w3-yellow">
      <h2>Pesan</h2>
      </div>
      <div class="w3-container">
        <p>Email atau Sandi Salah</p>
      </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button type="button" class="w3-button w3-yellow" onclick="myFunction()">Masuk Lagi</button>
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
    echo "window.location.href = \"http://localhost/tp/v2/profile.php\"";    
  } else {
    echo "window.location.href = \"http://localhost/tp/v2/index.php#masuk\"";
  }
  ?>
}
</script>     
</body>
</html>

