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

  $sql = 'select id,sfid, schema,accountid,name,contactid,vctr__ownercompany__c,vctr__shareng__c from sfdcmiddle.middle_opportunity ';

  $stmt  = $dbh->query($sql);


  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

        print($row['id'].' ');
        print($row['sfid'].' ');
        print('accountid:'.$row['accountid'].' ');
        print($row['name'].' ');
        print($row['contactid']);
        print($row['vctr__ownercompany__c']);
        print($row['vctr__shareng__c']);

        $id = $row['id'];
        $sfid=$row['sfid'];
        $accountid = $row['accountid'];
        $name = $row['name'];
        $contactid = $row['contactid'];
        $vctr__ownercompany__c = $row['vctr__ownercompany__c'];
        $vctr__shareng__c = $row['vctr__shareng__c'];
        $vctr__vectorno__c = 'O990001'

        print('======salesforce.middle_opportunity========='.' ');

        //マスタテーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmaster.master_opportunity(id,sfid,isdeleted,name,vctr__groupcompany__c,vctr__lead__c,vctr__optout__c,vctr__account__c,vctr__contact__c,vctr__vectorno__c) VALUES(:id,:sfid,:isdeleted,:name,:vctr__groupcompany__c,:vctr__lead__c,:vctr__optout__c,:vctr__account__c,:vctr__contact__c,:vctr__vectorno__c)');
        $prepIns001->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns001->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns001->bindValue(':isdeleted',$isdeleted,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__groupcompany__c',$vctr__groupcompany__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__lead__c',$vctr__lead__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__optout__c',$vctr__optout__c,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':vctr__account__c',$vctr__account__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__contact__c',$vctr__contact__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__vectorno__c',$vctr__vectorno__c,PDO::PARAM_STR);
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