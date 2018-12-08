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
    $sth = $dbh->prepare("
      CALL `t211_m`(
        '1',
        NULL,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        '00000000000000000000'
        );
      ");
    $sth->bindValue(1, $_POST["a1"], PDO::PARAM_STR);
    $sth->bindValue(2, $_POST["a2"], PDO::PARAM_STR);
    $sth->bindValue(3, $_POST["b1"], PDO::PARAM_STR);
    $sth->bindValue(4, $_POST["b2"], PDO::PARAM_STR);
    $sth->bindValue(5, $_POST["b3"], PDO::PARAM_STR);
    $sth->bindValue(6, $_POST["b4"], PDO::PARAM_STR);
    $sth->bindValue(7, $_POST["b5"], PDO::PARAM_STR);
    $sth->bindValue(8, $_POST["b6"], PDO::PARAM_STR);
    $sth->bindValue(9, $_POST["b7"], PDO::PARAM_STR);
    $result=$sth->execute();
  } catch(PDOException $e) {
    $egm=$e->getMessage();
    $egc=$e->getCode();
  }
  $dbh = null;
  /*
  echo "egm : ".$egm."<br/>";
  echo "egc : ".$egc."<br/>";
  echo "result : ";
  print_r($result);
  echo "<br/>";
  echo "var_dump result : ";
  var_dump($result);
  echo "<br/>";
  */
}

?>
<!DOCTYPE html>
<html>
<title>Daftar</title>
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
        <button type="button" class="w3-button w3-green" onclick="myFunction()">Masuk</button>
      </div>
      <?php
      } else if($egc==23000) {
      ?>
      <div class="w3-container w3-yellow">
      <h2>Pesan</h2>
      </div>
      <div class="w3-container">
        <p>Email "<?php echo $_POST["a1"];?>" sudah terdaftar</p>
        <p>Kode Kesalahan : <?php echo $egc;?></p>
        <p>Pesan Kesalahan : <?php echo $egm;?></p>
      </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button type="button" class="w3-button w3-yellow" onclick="myFunction()">Daftar Lagi</button>
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
    echo "window.location.href = \"http://localhost/tp/v2/index.php#masuk\"";    
  } else {
    echo "window.location.href = \"http://localhost/tp/v2/index.php#daftar\"";
  }
  ?>
}

</script>     
</body>
</html>

