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


  $sql = 'select * from  sfdcmiddle.middle_out_lead';

  $stmt  = $dbh->query($sql);

  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

      print($row['id'].' ');
      print($row['sfid'].' ');
      print($row['schema'].' ');
      print($row['firstname'].' ');
      print($row['lastname'].' ');
      print($row['email'].' ');
      print($row['company'].' ');
      print($row['vctr__vectorno__c'].' ');

     $id=$row['id'];
     $sfid=$row['sfid'];
     $schema=$row['schema'];
     $firstname = $row['firstname'];
     $lastname = $row['lastname'];
     $email = $row['email'];
     $companyI = $row['company'];
     $vectorno__cI = $row['vctr__vectorno__c'];
     $companyU = $row['company'];
     $vectorno__cU = $row['vctr__vectorno__c'];

     $schemaid = $schema.'.Lead';
      if ($schema == 'salesforce001') {
           //heroku connectテーブル登録
           $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,firstname,lastname,email,company,vctr__vectorno__c) VALUES(:id,:sfid,:firstname,:lastname,:email,:companyI,:vectorno__cI)  on conflict(id) do update set company=:companyU, vctr__vectorno__c=:vectorno__cU');
           $prepIns->execute(array($id,$sfid,$firstname,$lastname,$email,$companyI,$vectorno__cI,$companyU,$vectorno__cU));
          }
  }


}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>