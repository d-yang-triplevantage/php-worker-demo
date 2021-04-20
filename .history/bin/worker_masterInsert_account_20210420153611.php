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
   
  
    $sql = 'select a.sfid as asfid,a.schema as aschema,b.sfid as bsfid,b.schema as bschema,b.website as bwebsite,b.name as bname from sfdcmiddle.middle_account a ,sfdcmiddle.middle_account b
               where a.website = b.website
                 and a.name = b.name
                 and  a.schema != b.schema';
  
  $stmt  = $dbh->query($sql);

  $keynew = ['',''];
  $keyold = ['',''];
  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

      print($row['asfid'].' ');      
      print($row['aschema'].' ');
      print($row['bsfid'].' ');      
      print($row['bschema'].' ');
      print($row['bwebsite'].' ');
      print($row['bname'].' ');
     $asfid=$row['asfid'];
     $aschema=$row['aschema'];
     $bsfid=$row['bsfid'];
     $bschema=$row['bschema'];
     $website = $row['bwebsite'];
     $name = $row['bname'];
     

     if ($row === reset($stmt)){
         $keynew = [$website,$name];
         print($keynew[0].' ');
         print($keynew[1].' ');
     }
     if ($keynew === $keyold){
        //$keynewに新レコードを設定
        $keynew = [$website,$name];
     }else{
          if($row === end($stmt)){
             //keyoldデータ登録
             print('=======keyoldのデータ登録=最後====');
           //中間テーブル登録
           //$vctr__vectorno__c = 'A9999001';
           $vctr__vectorno__c = seqget('account');
           $website=$keynew[0];
           $name=$keynew[1];
           $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_account(website,name,vctr__vectorno__c) VALUES(:website,:name,:vctr__vectorno__c)');
           $prepIns->execute(array($website,$name,$vctr__vectorno__c));
           
           //中間テーブルに統合IDを反映
          $sqlUpdate = 'update sfdcmiddle.middle_account set vctr__vectorno__c=:vctr__vectorno__c WHERE website = :website and name=:name';
          $stmtUpdate = $dbh->prepare($sqlUpdate);
          
          $stmtUpdate->execute(array($vctr__vectorno__c,$website,$name));
           
         }else{
             //keyoldのデータ登録
             print('=======keyoldのデータ登録=====');
           //中間テーブル登録
           //$vctr__vectorno__c = 'A9999001';
           $vctr__vectorno__c = seqget('account');
           $website=$keynew[0];
           $name=$keynew[1];
           $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_account(website,name,vctr__vectorno__c) VALUES(:website,:name,:vctr__vectorno__c)');
           $prepIns->execute(array($website,$name,$vctr__vectorno__c));
           
           //中間テーブルに統合IDを反映
          $sqlUpdate = 'update sfdcmiddle.middle_account set vctr__vectorno__c=:vctr__vectorno__c WHERE website = :website and name=:name';
          $stmtUpdate = $dbh->prepare($sqlUpdate);
          
          $stmtUpdate->execute(array($vctr__vectorno__c,$website,$name));
           
           
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