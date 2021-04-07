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
  
  //A社データ処理（中間テーブル取り込み）
   //SQL作成
  //$sql = 'select LastName,FirstName,Email from salesforce001.Lead';
    $sql = 'select * from salesforce001.Lead';
  //SQL例
  //$sql = 'select * from "SchemeName"."TableName"';

  //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示

      print($row['firstname'].' ');      
      print($row['lastname'].' ');
      print($row['sfid'].' ');
      print($row['email']);
     $id = $row['id'];
     $sfid=$row['sfid'];
     $schema='salesforce001';
     $firstname = $row['firstname'];
     $lastname = $row['lastname'];
     $email = $row['email'];    
      print("======salesforce001.Lead=========");
      //中間テーブル登録
      $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(id,sfid, schema,firstname,lastname,email) VALUES(:id,:sfid, :schema,:firstname,:lastname,:email)');
      $prepIns001->execute(array($id,$sfid,$schema,$firstname,$lastname,$email));
      
      
      
  }

  //B社データ処理（中間テーブル取り込み）
  //SQL作成
  //$sql = 'select LastName,FirstName,Email from salesforce002.Lead';
  $sql = 'select * from salesforce002.Lead';
    //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示

      print($row['firstname'].' ');      
      print($row['lastname'].' ');
      print($row['sfid'].' ');      
      print($row['email']);
     $id=$row['id'];
     $sfid=$row['sfid'];
     $schema='salesforce002';
     $firstname = $row['firstname'];
     $lastname = $row['lastname'];
     $email = $row['email'];    
      print("======salesforce002.Lead=========");
      
      //中間テーブル登録
      $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(id,sfid, schema,firstname,lastname,email) VALUES(:id,:sfid,:schema,:firstname,:lastname,:email)');
      $prepIns001->execute(array($id,$sfid,$schema,$firstname,$lastname,$email));
  }
  

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>