<?php
$pdo=new PDO("mysql:dbname=am_tp;host=localhost","root","");
$statement=$pdo->prepare("SELECT 
  `id_pengguna`,
  `email`,
  `sandi` 
FROM
  `am_tp`.`t111_pengguna`
  ;");
//where `id_pengguna` = ?

//$statement->bindValue(1, $_GET['id'], PDO::PARAM_STR);
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
$json=json_encode($results);
echo "{\"data\":";
echo $json;
echo "}";
?>