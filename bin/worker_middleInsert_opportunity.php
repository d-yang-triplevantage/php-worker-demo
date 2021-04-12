<?php

//定数ファイルを読み込み
//require('config.php');
$schema =['salesforce001'];

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
       $schemaid = $value.'.opportunity';

       
       //データ処理（中間テーブル取り込み）
       //SQL作成
       $sql = 'select * from '.$schemaid;

      //SQL実行
      foreach ($dbh->query($sql) as $row) {
        //指定Columnを一覧表示

        print($row['id'].' ');      
        print($row['sfid'].' ');     
        print('accountid:'.$row['accountid'].' ');
        print($row['name'].' ');
        print($row['contactid']);
        print($row['vctr__groupcompany__c']);
        print($row['vctr__shareng__c']);

        
        $id = $row['id'];
        $sfid=$row['sfid'];
        $schema=$value;
        $accountid = $row['accountid'];
        $name = $row['name'];
        $contactid = $row['contactid'];
        $vctr__groupcompany__c = $row['vctr__groupcompany__c'];
        $vctr__shareng__c = $row['vctr__shareng__c'];
        
        
        print('======salesforce.opportunity=========');
        //中間テーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_opportunity(id,sfid, schema,accountid,name,contactid,vctr__groupcompany__c,vctr__shareng__c) VALUES(:id,:sfid, :schema,:accountid,:name,:contactid,:vctr__groupcompany__c,:vctr__shareng__c)');
        $prepIns001->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns001->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns001->bindValue(':schema',$schema,PDO::PARAM_STR);
        $prepIns001->bindValue(':accountid',$accountid,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns001->bindValue(':contactid',$contactid,PDO::PARAM_STR);       
        $prepIns001->bindValue(':vctr__groupcompany__c',$vctr__groupcompany__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__shareng__c',$vctr__shareng__c,PDO::PARAM_STR);
        $prepIns001->execute();
        
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