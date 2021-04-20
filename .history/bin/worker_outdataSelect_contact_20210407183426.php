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
  
   //出力中間データ取り込み処理
   //SQL作成
   
    $sql = 'select middle.id as id,middle.sfid as sfid,middle.schema as schema,middle.firstname as firstname ,middle.lastname as lastname,middle.email as email,middle.vctr__vectorno__c as vctr__vectorno__c from sfdcmiddle.middle_contact middle ,sfdcmaster.master_contact master
              where middle.vctr__vectorno__c = master.vctr__vectorno__c
                and middle.firstname = master.firstname
                and middle.lastname = master.lastname
                and middle.email = master.email';
  
    $stmt  = $dbh->query($sql);
  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

      print($row['sfid'].' ');
      print($row['schema'].' ');
      print($row['firstname'].' ');
      print($row['lastname'].' ');
      print($row['email'].' ');
      print($row['vctr__vectorno__c'].' ');
    
    
     $id=$row['id'];    
     $sfid=$row['sfid'];
     $schema=$row['schema'];
     $firstname = $row['firstname'];
     $lastname = $row['lastname'];
     $email = $row['email'];
     $vctr__vectorno__c = $row['vctr__vectorno__c'];
     
     //出力中間テーブル登録
     $prepIns = $dbh->prepare('INSERT INTO sfdcmiddle.middle_out_contact(id,sfid,schema,firstname,lastname,email,vctr__vectorno__c) VALUES(:id,:sfid,:schema,:firstname,:lastname,:email,:vctr__vectorno__c)');
     $prepIns->execute(array($id,$sfid,$schema,$firstname,$lastname,$email,$vctr__vectorno__c));
   
  }

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>