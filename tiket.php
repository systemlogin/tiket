<!DOCTYPE html>
<html>
<title>Tiket</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/iconfont/material-icons.css">
<script src="js/w3.js"></script>
<body>
  <div id="profile" class="w3-row-padding w3-padding-64 w3-container" style="padding:128px 16px">
    <div class="w3-content">
      <div class="w3-container">
        <div id="id_d_detail_tiket">
          <div w3-repeat="data" class="w3-responsive">
            <table>
              <tr><td colspan="3"><h1>Tiket Pesawat</h1></td></tr>
              <tr><td colspan="3"><h3>Informasi Tiket</h3></td></tr>
              <tr><td>ID Tiket</td><td>:</td><td>{{id_tiket}}</td></tr>
              <tr><td>Catatan Tiket</td><td>:</td><td>{{catatan_tiket}}</td></tr>
              <tr><td colspan="3"><h3>Informasi Penumpang</h3></td></tr>
              <tr><td>Nama</td><td>:</td><td>{{nama}}</td></tr>
              <tr><td>Alamat</td><td>:</td><td>{{alamat}}</td></tr>
              <tr><td>Kota</td><td>:</td><td>{{kota}}</td></tr>
              <tr><td>Kode Pos</td><td>:</td><td>{{kode_pos}}</td></tr>
              <tr><td>Negara</td><td>:</td><td>{{negara}}</td></tr>
              <tr><td>Telepon</td><td>:</td><td>{{telepon}}</td></tr>
              <tr><td>Email</td><td>:</td><td>{{email}}</td></tr>
              <tr><td>Catatan</td><td>:</td><td>{{catatan}}</td></tr>
              <tr><td colspan="3"><h3>Informasi Asal</h3></td></tr>
              <tr><td>Nama Asal</td><td>:</td><td>{{nama_asal}}</td></tr>
              <tr><td>Alamat Asal</td><td>:</td><td>{{alamat_asal}}</td></tr>
              <tr><td>Kota Asal</td><td>:</td><td>{{kota_asal}}</td></tr>
              <tr><td>Negara Asal</td><td>:</td><td>{{negara_asal}}</td></tr>
              <tr><td>Catatan Informasi  Asal</td><td>:</td><td>{{catatan_asal}}</td></tr>
              <tr><td colspan="3"><h3>Informasi Tujuan</h3></td></tr>
              <tr><td>Nama Tujuan</td><td>:</td><td>{{nama_tujuan}}</td></tr>
              <tr><td>Alamat Tujuan</td><td>:</td><td>{{alamat_tujuan}}</td></tr>
              <tr><td>Kota Tujuan</td><td>:</td><td>{{kota_tujuan}}</td></tr>
              <tr><td>Negara  Tujuan</td><td>:</td><td>{{negara_tujuan}}</td></tr>
              <tr><td>Catatan Informasi Tujuan</td><td>:</td><td>{{catatan_tujuan}}</td></tr>
              <tr><td colspan="3"><h3>Informasi Penrebangan</h3></td></tr>
              <tr><td>Nama Maskapai</td><td>:</td><td>{{nama_maskapai}}</td></tr>
              <tr><td>Nama Pesawat</td><td>:</td><td>{{nama_pesawat}}</td></tr>
              <tr><td>Kelas Penerbangan</td><td>:</td><td>{{kelas}}</td></tr>
              <tr><td>Jadwal Keberangkatan</td><td>:</td><td>{{jadwal}}</td></tr>
              <tr><td>Catatan Informasi Perebangan</td><td>:</td><td>{{catatan_jadwal}}</td></tr>
              <tr><td colspan="3"><h3>Informasi Kursi Pesawat</h3></td></tr>
              <tr><td>Nomor Kursi</td><td>:</td><td>{{nomor_kursi}}</td></tr>
              <tr><td>Catata Informasi Kursi</td><td>:</td><td>{{catatan_kursi}}</td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
// mengambil data profile
w3.getHttpObject("d_detail_tiket.php?t=<?php echo $_GET['t']?>", d_detail_tiket);

function d_detail_tiket(myObject) {
  w3.displayObject("id_d_detail_tiket", myObject);
}
</script>

</body>
</html>
