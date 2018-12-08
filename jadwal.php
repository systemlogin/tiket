<?php
    $j=(int) $_GET["j"];
?>
<!DOCTYPE html>
<html>
<title>Jadwal</title>
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
    <a href="#detail_jadwal" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Detail Jadwal</a>
    <a href="#kursi" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Kursi</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navBar" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large" onclick="navToggle()">
    <a href="#detail_jadwal" class="w3-bar-item w3-button w3-padding-large">Detail Jadwal</a>
    <a href="#kursi" class="w3-bar-item w3-button w3-padding-large">Kursi</a>
  </div>
</div>

<!-- Detail Jadwal -->
<div id="detail_jadwal" class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-container">
      <div id="id_d_detail_jadwal" class="w3-margin-bottom">
        <ul class="w3-ul w3-border w3-center w3-hover-shadow" w3-repeat="data">
          <li class="w3-red w3-xlarge w3-padding-32">Detail Jadwal</li>
          <li class="w3-padding-16">Informasi Detail Jadwal</li>
          <li class="w3-red w3-xlarge w3-padding-32">Informasi Asal</li>
          <li class="w3-padding-16">Data Asal</li>
          <li class="w3-padding-16 w3-red">Nama Asal</li><li class="w3-padding-16">{{nama_asal}}</li>
          <li class="w3-padding-16 w3-red">Alamat Asal</li><li class="w3-padding-16">{{alamat_asal}}</li>
          <li class="w3-padding-16 w3-red">Kota Asal</li><li class="w3-padding-16">{{kota_asal}}</li>
          <li class="w3-padding-16 w3-red">Negara Asal</li><li class="w3-padding-16">{{negara_asal}}</li>
          <li class="w3-padding-16 w3-red">Catatan Informasi Asal</li><li class="w3-padding-16">{{catatan_asal}}</li>
          <li class="w3-red w3-xlarge w3-padding-32">Informasi Tujuan</li>
          <li class="w3-padding-16">Data Tujuan</li>
          <li class="w3-padding-16 w3-red">Nama Tujuan</li><li class="w3-padding-16">{{nama_tujuan}}</li>
          <li class="w3-padding-16 w3-red">Alamat Tujuan</li><li class="w3-padding-16">{{alamat_tujuan}}</li>
          <li class="w3-padding-16 w3-red">Kota Tujuan</li><li class="w3-padding-16">{{kota_tujuan}}</li>
          <li class="w3-padding-16 w3-red">Negara Tujuan</li><li class="w3-padding-16">{{negara_tujuan}}</li>
          <li class="w3-padding-16 w3-red">Catatan Informasi Tujuan</li><li class="w3-padding-16">{{catatan_tujuan}}</li>
          <li class="w3-red w3-xlarge w3-padding-32">Informasi Penerbangan</li>
          <li class="w3-padding-16">Data Penerbangan</li>
          <li class="w3-padding-16 w3-red">Nama Maskapai</li><li class="w3-padding-16">{{nama_maskapai}}</li>
          <li class="w3-padding-16 w3-red">Nama Pesawat</li><li class="w3-padding-16">{{nama_pesawat}}</li>
          <li class="w3-padding-16 w3-red">Kelas</li><li class="w3-padding-16">{{kelas}}</li>
          <li class="w3-padding-16 w3-red">Jadwal</li><li class="w3-padding-16">{{jadwal}}</li>
          <li class="w3-padding-16 w3-red">Sisa Kuri</li><li class="w3-padding-16">{{sisa}}</li>
          <li class="w3-padding-16 w3-red">Catatan Informasi Penerbangan</li><li class="w3-padding-16">{{catatan}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Kursi -->
<div id="kursi" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <!-- Tampil Jadwal-->
    <div id="t_jadwal" class="w3-container w3-white w3-padding-16 myLink">
      <h2>Kursi</h2>
      Jumlah : <span id="kcount" class="">0</span> baris
      <input type="hidden" readonly id="klimit" value="0" />
      <div class="w3-bar w3-border">
        <a href="javascript:void(0);" id="ka" onclick="g_cd_kursi(0)" class="w3-button w3-border-right w3-left">&#10094;&#10094; </a>
        <a href="javascript:void(0);" id="kb" onclick="g_cd_kursi(1)" class="w3-button w3-border-right w3-left">&#10094;</a>
        <a href="javascript:void(0);" id="kz" onclick="g_cd_kursi(3)" class="w3-button w3-border-left w3-right">&#10095;&#10095;</a>
        <a href="javascript:void(0);" id="ky" onclick="g_cd_kursi(2)" class="w3-button w3-border-left w3-right">&#10095;</a>
      </div>
      <input id="kx" class="w3-button w3-border-center w3-center" readonly type="text" value="1 Dari 0"/>
      <div class="w3-responsive">
        <table id="id_d_kursi" class="w3-table-all w3-hoverable">
          <tr class="w3-red">
            <th>ID Kursi </th>
            <th>Nomor</th>
            <th>Catatan</th>
            <th>Detail</th>
          </tr>
          <tr w3-repeat="data">
            <td>{{id_kursi}}</td>
            <td>{{nomor}}</td>
            <td>{{catatan}}</td>
            <td><a href="kursi.php?j=<?php echo $j;?>&k={{id_kursi}}" class="w3-button w3-padding-large w3-red">Detail</a></td>
          </tr>
        </table>
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
  var x = document.getElementById("navBar");
  w3.toggleClassElement(x,"w3-show","w3-hide");
}

// mengambil data detail jadwal
w3.getHttpObject("d_detail_jadwal.php?d="+<?php echo $j;?>, d_profile);

function d_profile(myObject) {
  w3.displayObject("id_d_detail_jadwal", myObject);
}

g_cd_kursi(0);
//get count data jadwal
function g_cd_kursi(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      count = JSON.parse(this.responseText);
      document.getElementById("kcount").innerHTML = count.c;
      vd_kursi(str);
    }
  }
  xmlhttp.open("GET", "cd_kursi.php?d="+<?php echo $j;?>, true);
  xmlhttp.send();
}

//view data jadwal
function vd_kursi(str){
  var count = document.getElementById("kcount");
  var limit = document.getElementById("klimit");
  var aa = document.getElementById("ka");
  var bb = document.getElementById("kb");
  var xx = document.getElementById("kx");
  var yy = document.getElementById("ky");
  var zz = document.getElementById("kz");
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
  gd_kursi(elimit);
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
function gd_kursi(str) {
  w3.getHttpObject("d_kursi.php?a1=10&a2="+str+"&j=<?php echo $j;?>", dd_kursi);
}
//display data jadwal
function dd_kursi(myObject) {
  w3.displayObject("id_d_kursi", myObject);
}

</script>
</body>
</html>
