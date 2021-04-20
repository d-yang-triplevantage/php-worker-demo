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
        $vctr__vectorno__c = 'OPP990001';

        //マスタテーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmaster.master_opportunity(id,sfid,accountid,name,contactid,vctr__ownercompany__c,vctr__shareng__c,vctr__vectorno__c) VALUES(:id,:sfid,:accountid,:name,:contactid,:vctr__ownercompany__c,:vctr__shareng__c,:vctr__vectorno__c)');
        $prepIns001->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns001->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns001->bindValue(':accountid',$accountid,PDO::PARAM_STR);
        $prepIns001->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns001->bindValue(':contactid',$contactid,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__ownercompany__c',$vctr__ownercompany__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__shareng__c',$vctr__shareng__c,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':vctr__vectorno__c',$vctr__vectorno__c,PDO::PARAM_STR);
        $prepIns001->execute();

        //中間テーブルに統合IDを反映
        $sqlUpdate = 'update sfdcmiddle.middle_opportunity set vctr__vectorno__c=:vctr__vectorno__c WHERE sfid = :sfid and id=:id';
        $stmtUpdate = $dbh->prepare($sqlUpdate);
        $stmtUpdate->bindValue(':id',$id,PDO::PARAM_INT);
        $stmtUpdate->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $stmtUpdate->bindValue(':vctr__vectorno__c',$vctr__vectorno__c,PDO::PARAM_STR);
        $stmtUpdate->execute();

  }

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;
?>