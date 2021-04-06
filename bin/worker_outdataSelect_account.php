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
   
    $sql = 'select middle.id as id,middle.sfid as sfid,middle.schema as schema,middle.website as website ,middle.name as name,middle.vctr__vectorno__c as vctr__vectorno__c from sfdcmiddle.middle_account middle ,sfdcmaster.master_account master
              where middle.vctr__vectorno__c = master.vctr__vectorno__c
                and middle.website = master.website
                and middle.name = master.name';
  
    $stmt  = $dbh->query($sql);
  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

      print($row['sfid'].' ');
      print($row['schema'].' ');
      print($row['website'].' ');
      print($row['name'].' ');
      print($row['vctr__vectorno__c'].' ');
    
    
     $id=$row['id'];    
     $sfid=$row['sfid'];
     $schema=$row['schema'];
     $website = $row['website'];
     $name = $row['name'];
     $vctr__vectorno__c = $row['vctr__vectorno__c'];
     
     //出力中間テーブル登録
     $prepIns = $dbh->prepare('INSERT INTO sfdcmiddle.middle_out_account(id,sfid,schema,website,name,vctr__vectorno__c) VALUES(:id,:sfid,:schema,:website,:name,:vctr__vectorno__c)');
     $prepIns->execute(array($id,$sfid,$schema,$website,$name,$vctr__vectorno__c));
   
  }

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>