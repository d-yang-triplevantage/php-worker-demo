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
   
   
  $sql = 'select * from  sfdcmiddle.middle_out_account';
  
  $stmt  = $dbh->query($sql);

  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示
      
      print($row['id'].' ');
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
     $vectorno__cI = $row['vctr__vectorno__c'];
     $vectorno__cU = $row['vctr__vectorno__c'];
     
     //$schemaid = $schema.'.account';
     
     //テスト用
     $schema='salesforce001';
     $schemaid = $schema.'.account';

           //heroku connectテーブル登録
         if ($schema === 'salesforce001'){
           //テスト用
           $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,website,name,vctr__vectorno__c) VALUES(:id,:sfid,:website,:name,:vectorno__cI)  on conflict(id) do update set  vctr__vectorno__c=:vectorno__cU');
           $prepIns->execute(array($id,$sfid,$website,$name,$vectorno__cI,$vectorno__cU));

          // $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,website,name,vctr__vectorno__c) VALUES(:id,:sfid,:website,:name,:vectorno__cI)  on conflict(id) do update set  vctr__vectorno__c=:vectorno__cU');
          // $prepIns->execute(array($id,$sfid,$website,$name,$vectorno__cI,$vectorno__cU));
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