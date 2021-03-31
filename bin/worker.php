<?php

$dbopts = parse_url(getenv('DATABASE_URL'));

$DBHOST = $dbopts["host"];
$DBPORT = $dbopts["port"];
$DBNAME = ltrim($dbopts["path"],'/');
$DBUSER = $dbopts["user"];
$DBPASS = $dbopts["pass"];

try{
  //DB接続
  $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
   //SQL作成
  $sql = 'select LastName,FirstName from salesforce001.Lead';
  //SQL例
  //$sql = 'select * from "SchemeName"."TableName"';

  //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示

      print($row['firstname']);      
      print($row['lastname']);
      $name = $row['lastname'];
      print($name);

  }

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>