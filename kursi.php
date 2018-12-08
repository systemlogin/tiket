<?php
$j=(int) $_GET["j"];
$k=(int) $_GET["k"];
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
    $sth = $dbh->prepare("SELECT `id_pengguna` FROM `v221_penumpang` WHERE email = ?;");
    $sth->bindValue(1, $_SESSION["a1"], PDO::PARAM_STR);
    $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $egm=$e->getMessage();
    $egc=$e->getCode();
  }
}
?>
<!DOCTYPE html>
<html>
<title>Kursi</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/iconfont/material-icons.css">
<script src="js/w3.js"></script>
<body>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="navToggle()" title="Toggle Navigation Menu"><i class="material-icons">menu</i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Beranda</a>
    <a href="jadwal.php?j=<?php echo $j;?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Kembali</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navBar" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large" onclick="navToggle()">
    <a href="jadwal.php?j=<?php echo $j;?>" class="w3-bar-item w3-button w3-padding-large">Kembali</a>
  </div>
</div>
<!-- Masuk -->
<div id="masuk" class="w3-row-padding w3-padding-64 w3-container" style="padding:128px 16px">
  <div class="w3-content">
    <div class="w3-container">
      <h2>Booking Kursi</h2>
      <div id="id_d_detail_kursi">
        <div w3-repeat="data">
          <p>Nomor Kursi : {{nomor}}</p>
          <p>Catatan Kursi : {{catatan}}</p>
        </div>
      </div>
      <form action="p_booking.php" method="post">
        <?php
        if(isset($result[0]["id_pengguna"])){
        ?>
        <p><input type="hidden" required name="j" value="<?php echo $j;?>"> </p>
        <p><input type="hidden" required name="k" value="<?php echo $k;?>"> </p>
        <p><input type="hidden" required name="p" value="<?php echo $result[0]["id_pengguna"];?>"> </p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Catatan Booking" required name="c" maxlength="6000"></p>
        <p><button class="w3-button w3-black w3-padding-large" type="submit">Booking</button></p>
        <?php
        } else {
        ?>
        <p><a href="index.php#masuk" class="w3-button w3-black w3-padding-large">Masuk</a></p>
        <?php
        }
        ?>
      </form>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">KELOMPOK 2</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function navToggle() {
  var x = document.getElementById("navBar");
  w3.toggleClassElement(x,"w3-show","w3-hide");
}

// mengambil data detail jadwal
w3.getHttpObject("d_detail_kursi.php?j=<?php echo $j;?>&k=<?php echo $k;?>", d_kursi);
function d_kursi(myObject) {
  w3.displayObject("id_d_detail_kursi", myObject);
}

</script>
</body>
</html>
