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
   
  $sql = 'select id,sfid,isdeleted,name,vctr__groupcompany__c,vctr__lead__c,vctr__optout__c,vctr__account__c,vctr__contact__c from sfdcmiddle.middle_using__c ';
  
  $stmt  = $dbh->query($sql);

  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

        print($row['id'].' ');      
        print($row['sfid'].' ');     
        print('isdeleted:'.$row['isdeleted'].' ');
        print($row['name'].' ');
        print($row['vctr__groupcompany__c']);
        print($row['vctr__lead__c']);
        print($row['vctr__optout__c']);
        print($row['vctr__account__c']);
        print($row['vctr__contact__c']);
        
        $id = $row['id'];
        $sfid=$row['sfid'];
        $schema=$value;
        $isdeleted = $row['isdeleted'];
        $name = $row['name'];
        $vctr__groupcompany__c = $row['vctr__groupcompany__c'];
        $vctr__lead__c = $row['vctr__lead__c'];
        $vctr__optout__c = $row['vctr__optout__c'];
        $vctr__account__c = $row['vctr__account__c'];
        $vctr__contact__c = $row['vctr__contact__c'];
        
        
        print('======salesforce.using__c========='.$schemaid);
        //マスタテーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmaster.master_using__c(id,sfid,isdeleted,name,vctr__groupcompany__c,vctr__lead__c,vctr__optout__c,vctr__account__c,vctr__contact__c) VALUES(:id,:sfid,:isdeleted,:name,:vctr__groupcompany__c,:vctr__lead__c,:vctr__optout__c,:vctr__account__c,:vctr__contact__c)');
        $prepIns001->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns001->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns001->bindValue(':isdeleted',$isdeleted,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__groupcompany__c',$vctr__groupcompany__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__lead__c',$vctr__lead__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__optout__c',$vctr__optout__c,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':vctr__account__c',$vctr__account__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__contact__c',$vctr__contact__c,PDO::PARAM_STR);
        $prepIns001->execute();

  }

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>