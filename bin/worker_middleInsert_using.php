<?php

//定数ファイルを読み込み
require('config.php');

//DB接続情報を取得
$dbopts = parse_url(getenv('DATABASE_URL'));

$DBHOST = $dbopts["host"];
$DBPORT = $dbopts["port"];
$DBNAME = ltrim($dbopts["path"],'/');
$DBUSER = $dbopts["user"];
$DBPASS = $dbopts["pass"];

try{
  //DB接続
  $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
  
     foreach ($schema as $value) {
   
       //検索対象スキーマ
       $schemaid = $value.'.vctr__using__c';

       
       //データ処理（中間テーブル取り込み）
       //SQL作成
       $sql = 'select * from '.$schemaid;

      //SQL実行
      foreach ($dbh->query($sql) as $row) {
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
       // if($isdeleted === " "){
       //    $isdeleted = false;
       // }
        $name = $row['name'];
        $vctr__groupcompany__c = $row['vctr__groupcompany__c'];
        $vctr__lead__c = $row['vctr__lead__c'];
        $vctr__optout__c = $row['vctr__optout__c'];
        $vctr__account__c = $row['vctr__account__c'];
        $vctr__contact__c = $row['vctr__contact__c'];
        
        
        print('======salesforce.using__c========='.$schemaid);
        //中間テーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_using__c(id,sfid, schema,isdeleted,name,vctr__groupcompany__c,vctr__lead__c,vctr__account__c,vctr__contact__c) VALUES(:id,:sfid, :schema,:isdeleted,:name,:vctr__groupcompany__c,:vctr__lead__c,:vctr__account__c,:vctr__contact__c)');
        $dbh->bindValue(':id',$id,PDO::PARAM_STR);
        $dbh->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $dbh->bindValue(':schema',$schema,PDO::PARAM_STR);
        $dbh->bindValue(':isdeleted',$isdeleted,PDO::PARAM_BOOL);
        $dbh->bindValue(':name',$name,PDO::PARAM_STR);
        $dbh->bindValue(':vctr__groupcompany__c',$vctr__groupcompany__c,PDO::PARAM_STR);
        $dbh->bindValue(':vctr__lead__c',$vctr__lead__c,PDO::PARAM_BOOL);
        $dbh->bindValue(':vctr__account__c',$vctr__account__c,PDO::PARAM_STR);
        $dbh->bindValue(':vctr__contact__c',$vctr__contact__c,PDO::PARAM_STR);
        $prepIns001->execute();
      //  $prepIns001->execute(array($id,$sfid,$schema,$isdeleted,$name,$vctr__groupcompany__c,$vctr__lead__c,$vctr__account__c,$vctr__contact__c));
        
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