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
    $sql = 'select * from salesforce001.account';


  //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示
      
      print($row['id'].' ');
      print($row['sfid'].' ');
      print($row['website'].' ');
      print($row['name'].' ');
      
     $id = $row['id'];
     $sfid=$row['sfid'];
     $schema='salesforce001';
     $firstname = $row['website'];
     $lastname = $row['name'];
   
      print("======salesforce001.account=========");
      //中間テーブル登録
   //   $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(id,sfid, schema,firstname,lastname,email) VALUES(:id,:sfid, :schema,:firstname,:lastname,:email)');
   //   $prepIns001->execute(array($id,$sfid,$schema,$firstname,$lastname,$email));
      
      
      
  }

  //B社データ処理（中間テーブル取り込み）
  //SQL作成
  $sql = 'select * from salesforce002.account';
    //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示

      print($row['id'].' ');
      print($row['sfid'].' ');
      print($row['website'].' ');
      print($row['name'].' ');
      
     $id = $row['id'];
     $sfid=$row['sfid'];
     $schema='salesforce001';
     $firstname = $row['website'];
     $lastname = $row['name'];
     
      print("======salesforce002.account=========");
      
      //中間テーブル登録
     // $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(id,sfid, schema,firstname,lastname,email) VALUES(:id,:sfid,:schema,:firstname,:lastname,:email)');
    //  $prepIns001->execute(array($id,$sfid,$schema,$firstname,$lastname,$email));
  }
  

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>