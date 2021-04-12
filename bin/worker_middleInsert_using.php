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

        print($row['firstname'].' ');      
        print($row['lastname'].' ');
        print($row['sfid'].' ');
        print($row['email']);
        $id = $row['id'];
        $sfid=$row['sfid'];
        $schema=$value;
        $IsDeleted = $row['IsDeleted'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        
        
        print('======salesforce.lead========='.$schemaid);
        //中間テーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_using__c(id,sfid, schema,IsDeleted,Name,vctr__GroupCompany__c,vctr__Lead__c,vctr__Account__c,vctr__Contact__c) VALUES(:id,:sfid, :schema,:IsDeleted,:Name,:vctr__GroupCompany__c,vctr__Lead__c,vctr__Account__c,vctr__Contact__c)');
        $prepIns001->execute(array($id,$sfid,$schema,$IsDeleted,$Name,$vctr__GroupCompany__c,$vctr__Lead__c,$vctr__Account__c,$vctr__Contact__c));
        
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