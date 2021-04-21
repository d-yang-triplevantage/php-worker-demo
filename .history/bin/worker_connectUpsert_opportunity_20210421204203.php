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


  $sql = 'select * from  sfdcmiddle.middle_out_opportunity';

  $stmt  = $dbh->query($sql);


  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

        print($row['id'].' ');
        print($row['sfid'].' ');
        print($row['schema'].' ');
        print($row['accountid'].' ');
        print($row['name'].' ');
        print($row['contactid']);
        print($row['vctr__ownercompany__c']);
        print($row['vctr__shareng__c']);
        print($row['vctr__vectorno__c']);

        $schema=$row['schema'];


        $id = $row['id'];
        $sfid=$row['sfid'];
        $accountid = $row['accountid'];
        $name = $row['name'];
        $contactid = $row['contactid'];
        $vctr__ownercompany__c = $row['vctr__ownercompany__c'];
        $vctr__shareng__c = $row['vctr__shareng__c'];
        $vctr__vectorno__cI = $row['vctr__vectorno__c'];
        $vctr__vectorno__cU = $row['vctr__vectorno__c'];

     //   $id_U = $row['id'];
     //   $sfid_U=$row['sfid'];
     //   $isdeleted_U = $row['isdeleted'];
     //   $name_U = $row['name'];
     //   $vctr__groupcompany__c_U = $row['vctr__groupcompany__c'];
     //   $vctr__lead__c_U = $row['vctr__lead__c'];
     //   $vctr__optout__c_U = $row['vctr__optout__c'];
     //   $vctr__account__c_U = $row['vctr__account__c'];
     //   $vctr__contact__c_U = $row['vctr__contact__c'];

         $schemaid = $schema.'.opportunity';
         //テスト用
         if($schema == 'salesforce001'){
         //heroku connectテーブル登録&更新

        $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,accountid,name,contactid,vctr__ownercompany__c,vctr__shareng__c,vctr__vectorno__c) VALUES(:id,:sfid,:accountid,:name,:contactid,:vctr__ownercompany__c,:vctr__shareng__c,:vctr__vectorno__cI)
         on conflict(id) do update set vctr__vectorno__c=:vctr__vectorno__cU');
        $prepIns->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns->bindValue(':accountid',$accountid,PDO::PARAM_STR);
        $prepIns->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns->bindValue(':contactid',$contactid,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__ownercompany__c',$vctr__ownercompany__c,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__shareng__c',$vctr__shareng__c,PDO::PARAM_BOOL);
        $prepIns->bindValue(':vctr__vectorno__cI',$vctr__vectorno__cI,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__vectorno__cU',$vctr__vectorno__cU,PDO::PARAM_STR);
        $prepIns->execute();
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