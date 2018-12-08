<?php
session_start();
if (!isset($_SESSION['a1']) && empty($_SESSION['a1'])){
  echo "<script>window.location.href = \"http://localhost/tp/v2/index.php#masuk\"</script> ";
}
$egm=null;
$egc=null;
$result=null;
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
<title>Profile</title>
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
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Beranda</a>
    <a href="#jadwal" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Jadwal</a>
    <a href="#profile" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Profile</a>
    <a href="#tiket" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Tiket</a>
    <a href="#tentang" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Tentang</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large" onclick="navToggle()">
    <a href="#jadwal" class="w3-bar-item w3-button w3-padding-large">Jadwal</a>
    <a href="#profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
    <a href="#tiket" class="w3-bar-item w3-button w3-padding-large">Tiket</a>
    <a href="#tentang" class="w3-bar-item w3-button w3-padding-large">Tentang</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Gairah Tiket Pesawat</h1>
  <p class="w3-xlarge">Sistem Informasi Tiket Pesawat</p>
  <a href="#jadwal" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Lihat Jadwal</a>
</header>

<!-- Jadwal -->
<div id="jadwal" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">

    <!-- From Cari Jadwal-->
    <div id="f_jadwal" class="w3-container w3-white w3-padding-16">
      <h2>Cari Jadwal Penerbangan</h2>
      <div class="w3-row-padding" style="margin:0 -16px;">
        <div class="w3-half"><label>Dari</label><input id="jk1" class="w3-input w3-border" type="text" placeholder="Kota Asal" value="" onchange="buka_cari_jadwal()"></div>
        <div class="w3-half"><label>Ke</label><input id="jk2" class="w3-input w3-border" type="text" placeholder="Kota Tujuan" value="" onchange="buka_cari_jadwal()"></div>
      </div>
      <p><button class="w3-button w3-dark-grey" onclick="buka_cari_jadwal()">Cari</button></p>
    </div>

    <!-- Cari Jadwal-->
    <div id="c_jadwal" class="w3-container w3-white w3-padding-16 w3-light-grey">
      <span onclick="tutup_cari_jadwal()" class="w3-button w3-right">&times;</span>
      <h2>Hasil Pencarian Jadwal Penerbangan</h2>
      Jumlah : <span id="sjcount" class="">0</span> baris
      <input type="hidden" readonly id="sjlimit" value="0" />
      <div class="w3-bar w3-border">
        <a href="javascript:void(0);" id="sja" onclick="g_cs_jadwal(0)" class="w3-button w3-border-right w3-left">&#10094;&#10094; </a>
        <a href="javascript:void(0);" id="sjb" onclick="g_cs_jadwal(1)" class="w3-button w3-border-right w3-left">&#10094;</a>
        <a href="javascript:void(0);" id="sjz" onclick="g_cs_jadwal(3)" class="w3-button w3-border-left w3-right">&#10095;&#10095;</a>
        <a href="javascript:void(0);" id="sjy" onclick="g_cs_jadwal(2)" class="w3-button w3-border-left w3-right">&#10095;</a>
      </div>
      <input id="sjx" class="w3-button w3-border-center w3-center" readonly type="text" value="1 Dari 0"/>
      <div class="w3-responsive">
        <table id="id_ds_jadwal" class="w3-table-all w3-hoverable">
          <tr class="w3-red">
            <th>ID Tiket</th>
            <th>Nama Maskapai</th>
            <th>Kota Asal</th>
            <th>Kota Tujuan</th>
            <th>Kelas</th>
            <th>Jadwal</th>
            <th>Nomor Kursi</th>
            <th>Detail</th>
          </tr>
          <tr w3-repeat="data">
            <td>{{id_jadwal}}</td>
            <td>{{nama_maskapai}}</td>
            <td>{{kota_asal}}</td>
            <td>{{kota_tujuan}}</td>
            <td>{{kelas}}</td>
            <td>{{jadwal}}</td>
            <td>{{sisa}}</td>
            <td><a href="jadwal.php?j={{id_jadwal}}" class="w3-button w3-padding-large w3-red">Detail</a></td>
          </tr>
        </table>
      </div>
    </div>

    <!-- Tampil Jadwal-->
    <div id="t_jadwal" class="w3-container w3-white w3-padding-16 myLink">
      <h2>Jadwal Penerbangan</h2>
      Jumlah : <span id="jcount" class="">0</span> baris
      <input type="hidden" readonly id="jlimit" value="0" />
      <div class="w3-bar w3-border">
        <a href="javascript:void(0);" id="ja" onclick="g_cd_jadwal(0)" class="w3-button w3-border-right w3-left">&#10094;&#10094; </a>
        <a href="javascript:void(0);" id="jb" onclick="g_cd_jadwal(1)" class="w3-button w3-border-right w3-left">&#10094;</a>
        <a href="javascript:void(0);" id="jz" onclick="g_cd_jadwal(3)" class="w3-button w3-border-left w3-right">&#10095;&#10095;</a>
        <a href="javascript:void(0);" id="jy" onclick="g_cd_jadwal(2)" class="w3-button w3-border-left w3-right">&#10095;</a>
      </div>
      <input id="jx" class="w3-button w3-border-center w3-center" readonly type="text" value="1 Dari 0"/>
      <div class="w3-responsive">
        <table id="id_d_jadwal" class="w3-table-all w3-hoverable">
          <tr class="w3-red">
            <th>ID Jadwal </th>
            <th>Nama Maskapai</th>
            <th>Kota Asal</th>
            <th>Kota Tujuan</th>
            <th>Kelas</th>
            <th>Jadwal</th>
            <th>Sisa</th>
            <th>Detail</th>
          </tr>
          <tr w3-repeat="data">
            <td>{{id_jadwal}}</td>
            <td>{{nama_maskapai}}</td>
            <td>{{kota_asal}}</td>
            <td>{{kota_tujuan}}</td>
            <td>{{kelas}}</td>
            <td>{{jadwal}}</td>
            <td>{{sisa}}</td>
            <td><a href="jadwal.php?j={{id_jadwal}}" class="w3-button w3-padding-large w3-red">Detail</a></td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Profile -->
<div id="profile" class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-container">
      <div id="id_d_profile" class="w3-margin-bottom">
        <ul class="w3-ul w3-border w3-center w3-hover-shadow" w3-repeat="data">
          <li class="w3-red w3-xlarge w3-padding-32">Profile</li>
          <li class="w3-padding-16">Informasi penumpang</li>
          <li class="w3-padding-16 w3-red">Email</li><li class="w3-padding-16">{{email}}</li>
          <li class="w3-padding-16 w3-red">Nama</li><li class="w3-padding-16">{{nama}}</li>
          <li class="w3-padding-16 w3-red">Alamat</li><li class="w3-padding-16">{{alamat}}</li>
          <li class="w3-padding-16 w3-red">Kota</li><li class="w3-padding-16">{{kota}}</li>
          <li class="w3-padding-16 w3-red">Kode Pos</li><li class="w3-padding-16">{{kode_pos}}</li>
          <li class="w3-padding-16 w3-red">Negara</li><li class="w3-padding-16">{{negara}}</li>
          <li class="w3-padding-16 w3-red">Telepon</li><li class="w3-padding-16">{{telepon}}</li>
          <li class="w3-padding-16 w3-red">Catatan</li><li class="w3-padding-16">{{catatan}}</li>
          <li class="w3-light-grey w3-padding-24">
            <a href="p_keluar.php" class="w3-button w3-padding-large w3-red">Keluar</a>
          </li>        
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- tiket -->
<div id="tiket" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <!-- Tampil Tiket-->
    <div id="t_jadwal" class="w3-container w3-white w3-padding-16 myLink">
      <h2>Riwayat Tiket Penerbangan</h2>
      Jumlah : <span id="tcount" class="">0</span> baris
      <input type="hidden" readonly id="tlimit" value="0" />
      <div class="w3-bar w3-border">
        <a href="javascript:void(0);" id="ta" onclick="g_cd_tiket(0)" class="w3-button w3-border-right w3-left">&#10094;&#10094; </a>
        <a href="javascript:void(0);" id="tb" onclick="g_cd_tiket(1)" class="w3-button w3-border-right w3-left">&#10094;</a>
        <a href="javascript:void(0);" id="tz" onclick="g_cd_tiket(3)" class="w3-button w3-border-left w3-right">&#10095;&#10095;</a>
        <a href="javascript:void(0);" id="ty" onclick="g_cd_tiket(2)" class="w3-button w3-border-left w3-right">&#10095;</a>
      </div>
      <input id="tx" class="w3-button w3-border-center w3-center" readonly type="text" value="1 Dari 0"/>
      <div class="w3-responsive">
        <table id="id_d_tiket" class="w3-table-all w3-hoverable">
          <tr class="w3-red">
            <th>ID Jadwal </th>
            <th>Nama Maskapai</th>
            <th>Kota Asal</th>
            <th>Kota Tujuan</th>
            <th>Kelas</th>
            <th>Jadwal</th>
            <th>Sisa</th>
            <th>Detail</th>
          </tr>
          <tr w3-repeat="data">
            <td>{{id_tiket}}</td>
            <td>{{nama_maskapai}}</td>
            <td>{{kota_asal}}</td>
            <td>{{kota_tujuan}}</td>
            <td>{{kelas}}</td>
            <td>{{jadwal}}</td>
            <td>{{nomor_kursi}}</td>
            <td><a target="_blank" href="tiket.php?t={{id_tiket}}" class="w3-button w3-padding-large w3-red">Detail</a></td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Tentang -->
<div id="tentang" class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-padding-64 w3-center">
      <h1>Tentang Aplikasi Ini</h1>
      <img src="w3images/avatar3.png" class="w3-margin w3-circle" alt="Person" style="width:50%">
      <div class="w3-left-align w3-padding-large">
        <p><center>Aplikasi ini dibuat sebagai tugas akhir mata kuliah Sistem Kedirgantaraan</center></p>
      </div>
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
  var x = document.getElementById("navDemo");
  w3.toggleClassElement(x,"w3-show","w3-hide");
}

// mengambil data jadwal
g_cd_jadwal();
// mengambil data profile
w3.getHttpObject("d_profile.php", d_profile);

function d_profile(myObject) {
  w3.displayObject("id_d_profile", myObject);
}
tutup_cari_jadwal();
function tutup_cari_jadwal() {
  var x = document.getElementById("c_jadwal");
  w3.hideElement(x);
}
function buka_cari_jadwal() {
  var x = document.getElementById("c_jadwal");
  w3.showElement(x);
  g_cs_jadwal();
}
//get count search jadwal
function g_cs_jadwal(str) {
  var xmlhttp = new XMLHttpRequest();
  var k1= document.getElementById("jk1").value;
  var k2= document.getElementById("jk2").value;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      ccount = JSON.parse(this.responseText);
      document.getElementById("sjcount").innerHTML = ccount.c;
      vs_jadwal(str);
    }
  };
  xmlhttp.open("GET", "cds_jadwal.php?a1="+k1+"&a2="+k2, true);
  xmlhttp.send();
}
//view search jadwal
function vs_jadwal(str){
  var count = document.getElementById("sjcount");
  var limit = document.getElementById("sjlimit");
  var aa = document.getElementById("sja");
  var bb = document.getElementById("sjb");
  var xx = document.getElementById("sjx");
  var yy = document.getElementById("sjy");
  var zz = document.getElementById("sjz");
  var elimit = parseInt(limit.getAttribute("value"));
  var ecount = parseInt(count.innerHTML);
  switch (str) {
    case 0:
    elimit=0;
    break;
    case 1:
    elimit=elimit-10;
    break;
    case 2:
    elimit=elimit+10;
    break;
    case 3:
    elimit=ecount-(ecount%10);
    if(ecount%10===0){
      elimit=ecount-10;
    }
    break;
  }
  gs_jadwal(elimit);
  limit.setAttribute("value", elimit);
  if(elimit<10){
    w3.hideElement(aa);
    w3.hideElement(bb);
  } else {
    w3.showElement(aa);
    w3.showElement(bb);
  }
  if(elimit+10>=ecount){
    w3.hideElement(yy);
    w3.hideElement(zz);
  } else {
    w3.showElement(yy);
    w3.showElement(zz);
  }
  elimit=((elimit)-(elimit%10))/10 + 1;
  if(ecount%10===0){
    ecount/=10;
  }else {
    ecount=((ecount)-(ecount%10))/10 + 1; 
  }
  xx.setAttribute("value", elimit+" Dari "+ecount);
}
//get search jadwal
function gs_jadwal(str) {
  var k1= document.getElementById("jk1").value;
  var k2= document.getElementById("jk2").value;
  w3.getHttpObject("ds_jadwal.php?a1="+k1+"&a2="+k2+"&b1=10&b2="+str, ds_jadwal);
}
//display search jadwal
function ds_jadwal(myObject) {
  w3.displayObject("id_ds_jadwal", myObject);
}

g_cd_jadwal(0);
//get count data jadwal
function g_cd_jadwal(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      count = JSON.parse(this.responseText);
      document.getElementById("jcount").innerHTML = count.c;
      vd_jadwal(str);
    }
  }
  xmlhttp.open("GET", "cd_jadwal.php", true);
  xmlhttp.send();
}
//view data jadwal
function vd_jadwal(str){
  var count = document.getElementById("jcount");
  var limit = document.getElementById("jlimit");
  var aa = document.getElementById("ja");
  var bb = document.getElementById("jb");
  var xx = document.getElementById("jx");
  var yy = document.getElementById("jy");
  var zz = document.getElementById("jz");
  var elimit = parseInt(limit.getAttribute("value"));
  var ecount = parseInt(count.innerHTML);
  switch (str) {
    case 0:
    elimit=0;
    break;
    case 1:
    elimit=elimit-10;
    break;
    case 2:
    elimit=elimit+10;
    break;
    case 3:
    elimit=ecount-(ecount%10);
    if(ecount%10===0){
      elimit=ecount-10;
    }
    break;
  }
  gd_jadwal(elimit);
  limit.setAttribute("value", elimit);
  if(elimit<10){
    w3.hideElement(aa);
    w3.hideElement(bb);
  } else {
    w3.showElement(aa);
    w3.showElement(bb);
  }
  if(elimit+10>=ecount){
    w3.hideElement(yy);
    w3.hideElement(zz);
  } else {
    w3.showElement(yy);
    w3.showElement(zz);
  }
  elimit=((elimit)-(elimit%10))/10 + 1;
  if(ecount%10===0){
    ecount/=10;
  }else {
    ecount=((ecount)-(ecount%10))/10 + 1; 
  }
  xx.setAttribute("value", elimit+" Dari "+ecount);
}
//get data jadwal
function gd_jadwal(str) {
  w3.getHttpObject("d_jadwal.php?a1=10&a2="+str, dd_jadwal);
}
//display data jadwal
function dd_jadwal(myObject) {
  w3.displayObject("id_d_jadwal", myObject);
}

//tiket
g_cd_tiket(0);
//get count data tiket
function g_cd_tiket(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      count = JSON.parse(this.responseText);
      document.getElementById("tcount").innerHTML = count.c;
      vd_tiket(str);
    }
  }
  xmlhttp.open("GET", "cd_tiket.php?d="+<?php echo $result[0]["id_pengguna"];?>, true);
  xmlhttp.send();
}
//view data tiket
function vd_tiket(str){
  var count = document.getElementById("tcount");
  var limit = document.getElementById("tlimit");
  var aa = document.getElementById("ta");
  var bb = document.getElementById("tb");
  var xx = document.getElementById("tx");
  var yy = document.getElementById("ty");
  var zz = document.getElementById("tz");
  var elimit = parseInt(limit.getAttribute("value"));
  var ecount = parseInt(count.innerHTML);
  switch (str) {
    case 0:
    elimit=0;
    break;
    case 1:
    elimit=elimit-10;
    break;
    case 2:
    elimit=elimit+10;
    break;
    case 3:
    elimit=ecount-(ecount%10);
    if(ecount%10===0){
      elimit=ecount-10;
    }
    break;
  }
  gd_tiket(elimit);
  limit.setAttribute("value", elimit);
  if(elimit<10){
    w3.hideElement(aa);
    w3.hideElement(bb);
  } else {
    w3.showElement(aa);
    w3.showElement(bb);
  }
  if(elimit+10>=ecount){
    w3.hideElement(yy);
    w3.hideElement(zz);
  } else {
    w3.showElement(yy);
    w3.showElement(zz);
  }
  elimit=((elimit)-(elimit%10))/10 + 1;
  if(ecount%10===0){
    ecount/=10;
  }else {
    ecount=((ecount)-(ecount%10))/10 + 1; 
  }
  xx.setAttribute("value", elimit+" Dari "+ecount);
}
//get data tiket
function gd_tiket(str) {
  w3.getHttpObject("d_tiket.php?a1=10&a2="+str+"&d="+<?php echo $result[0]["id_pengguna"];?>, dd_tiket);
}
//display data tiket
function dd_tiket(myObject) {
  w3.displayObject("id_d_tiket", myObject);
}

</script>

</body>
</html>
