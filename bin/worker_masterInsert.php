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
  
  //マスタ取り込み処理
   //SQL作成
  //$sql = 'select a.sfid as asfid,a.schema as aschema,b.sfid as bsfid,b.schema as bschema,b.lastname as blistname,b.firstname as bfirstname,b.email as bemail
               from "sfdcmiddle"."middle_lead" a ,"sfdcmiddle"."middle_lead" b 
               where a.lastname = b.lastname
                   and a.firstname = b.firstname
                   and a.email = b.email
                   and  a.schema != b.schema';

  //SQL例
  //$sql = 'select * from "SchemeName"."TableName"';

  //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示

      print($row['asfid']);      
      print($row['aschema']);
      print($row['bsfid']);      
      print($row['bschema']);
      print($row['bemail']);
      print($row['blastname']);
      print($row['bfirstname']);
     $asfid=$row['asfid'];
     $aschema=$row['aaschema'];
     $bsfid=$row['bsfid'];
     $bschema=$row['baschema'];
     $firstname = $row['blistname'];
     $lastname = $row['bfirstname'];
     $email = $row['bemail'];

      //中間テーブル登録
      //$prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(sfid, schema,firstname,lastname,email) VALUES(:sfid, :schema,:firstname,:lastname,:email)');
     // $prepIns001->execute(array($sfid,$schema,$firstname,$lastname,$email));
      
      
      
  }


}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>