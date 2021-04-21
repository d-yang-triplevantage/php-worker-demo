<?php

//統合No設定用のSEQを取得
require('commseqSelect.php');
//require_once('commseqSelect.php');

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
   
   $sql = 'select a.sfid as asfid,a.schema as aschema,b.sfid as bsfid,b.schema as bschema,b.lastname as blastname,b.firstname as bfirstname,b.email as bemail from sfdcmiddle.middle_contact a ,sfdcmiddle.middle_contact b
               where a.lastname = b.lastname
                   and a.firstname = b.firstname
                   and a.email = b.email
                   and  a.schema != b.schema';
  
  $stmt  = $dbh->query($sql);

  $keynew = ['','',''];
  $keyold = ['','',''];
  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

     print($row['asfid'].' ');      
     print($row['aschema'].' ');
     print($row['bsfid'].' ');      
     print($row['bschema'].' ');
     print($row['bemail'].' ');
     print($row['blastname'].' ');
     print($row['bfirstname'].' ');
     $asfid=$row['asfid'];
     $aschema=$row['aschema'];
     $bsfid=$row['bsfid'];
     $bschema=$row['bschema'];
     $lastname = $row['blastname'];
     $firstname = $row['bfirstname'];
     $email = $row['bemail'];
     

     if ($row === reset($stmt)){
         $keynew = [$firstname,$lastname,$email];
         print($keynew[0].' ');
         print($keynew[1].' ');
         print($keynew[2].' ');
     }
     if ($keynew === $keyold){
        //$keynewに新レコードを設定
        $keynew = [$firstname,$lastname,$email];
     }else{
          if($row === end($stmt)){
             //keyoldデータ登録
             print('=======keyoldのデータ登録=最後====');
            //中間テーブル登録
            //$vctr__vectorno__c = 'C9999001';
            $vctr__vectorno__c = seqget('contact');
            $firstname=$keynew[0];
            $lastname=$keynew[1];
            $email=$keynew[2];
            $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_contact(firstname,lastname,email,vctr__vectorno__c) VALUES(:firstname,:lastname,:email,:vctr__vectorno__c)');
            $prepIns->execute(array($firstname,$lastname,$email,$vctr__vectorno__c));
           
            //中間テーブルに統合IDを反映
            $sqlUpdate = 'update sfdcmiddle.middle_contact set vctr__vectorno__c=:vctr__vectorno__c WHERE firstname = :firstname and lastname=:lastname and email=:email';
            $stmtUpdate = $dbh->prepare($sqlUpdate);
            $stmtUpdate->execute(array($vctr__vectorno__c,$firstname,$lastname,$email));
           
         }else{
             //keyoldのデータ登録
             print('=======keyoldのデータ登録=====');
            //中間テーブル登録
            //$vctr__vectorno__c = 'C9999001';
            $vctr__vectorno__c = seqget('contact');
            $firstname=$keynew[0];
            $lastname=$keynew[1];
            $email=$keynew[2];
            $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_contact(firstname,lastname,email,vctr__vectorno__c) VALUES(:firstname,:lastname,:email,:vctr__vectorno__c)');
            $prepIns->execute(array($firstname,$lastname,$email,$vctr__vectorno__c));
           
            //中間テーブルに統合IDを反映
            $sqlUpdate = 'update sfdcmiddle.middle_contact set vctr__vectorno__c=:vctr__vectorno__c WHERE firstname = :firstname and lastname=:lastname and email=:email';
            $stmtUpdate = $dbh->prepare($sqlUpdate);
            $stmtUpdate->execute(array($vctr__vectorno__c,$firstname,$lastname,$email));
           
            //keyoldにkeynewを設定
            $keyold = $keynew;
       }
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