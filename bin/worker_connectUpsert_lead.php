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
      print($row['vectorno__c'].' ');
    
    
     $id=$row['id'];    
     $sfid=$row['sfid'];
     $schema=$row['schema'];
     $firstname = $row['firstname'];
     $lastname = $row['lastname'];
     $email = $row['email'];
     $companyI = $row['company'];
     $vectorno__cI = $row['vectorno__c'];
     $companyU = $row['company'];
     $vectorno__cU = $row['vectorno__c'];
     
     $schemaid = $schema.'.Lead';

           //heroku connectテーブル登録
 
           $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,firstname,lastname,email,company,vectorno__c) VALUES(:id,:sfid,:firstname,:lastname,:email,:companyI,:vectorno__cI)  on conflict(id) do update set company=:companyU, vectorno__c=:vectorno__cU');
           $prepIns->execute(array($id,$sfid,$firstname,$lastname,$email,$companyI,$vectorno__cI,$companyU,$vectorno__cU));
         //ここまで  
         //  insert into salesforce001.Lead(id,sfid,firstname,lastname,email,company,vectorno__c) values (:id,:sfid,:firstname,:lastname,:email,:company,:vectorno__c)
         //  on conflict(id)
         //  do update set company=:company, vectorno__c=:vectorno__c;
      
  }


}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>