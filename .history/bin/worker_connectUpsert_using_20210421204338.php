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
   
   
  $sql = 'select * from  sfdcmiddle.middle_out_using__c';
  
  $stmt  = $dbh->query($sql);

  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示
      
        print($row['id'].' ');      
        print($row['sfid'].' ');  
        print($row['schema'].' '); 
        print($row['isdeleted'].' ');
        print($row['name'].' ');
        print($row['vctr__groupcompany__c']);
        print($row['vctr__lead__c']);
        print($row['vctr__optout__c']);
        print($row['vctr__account__c']);
        print($row['vctr__contact__c']);
    

        $schema=$row['schema'];
        
        
        $id = $row['id'];
        $sfid=$row['sfid'];
        $isdeleted = $row['isdeleted'];
        $name = $row['name'];
        $vctr__groupcompany__c = $row['vctr__groupcompany__c'];
        $vctr__lead__c = $row['vctr__lead__c'];
        $vctr__optout__c = $row['vctr__optout__c'];
        $vctr__account__c = $row['vctr__account__c'];
        $vctr__contact__c = $row['vctr__contact__c'];
         
     //   $id_U = $row['id'];
     //   $sfid_U=$row['sfid'];
     //   $isdeleted_U = $row['isdeleted'];
     //   $name_U = $row['name'];
     //   $vctr__groupcompany__c_U = $row['vctr__groupcompany__c'];
     //   $vctr__lead__c_U = $row['vctr__lead__c'];
     //   $vctr__optout__c_U = $row['vctr__optout__c'];
     //   $vctr__account__c_U = $row['vctr__account__c'];
     //   $vctr__contact__c_U = $row['vctr__contact__c'];
     
         $schemaid = $schema.'.vctr__using__c';

         //heroku connectテーブル登録
         //テスト用複数環境できたら、IF判定を外す
         if($schema == 'salesforce001'){
        $prepIns = $dbh->prepare('INSERT INTO '.$schemaid.' (id,sfid,isdeleted,name,vctr__groupcompany__c,vctr__lead__c,vctr__optout__c,vctr__account__c,vctr__contact__c) VALUES(:id,:sfid,:isdeleted,:name,:vctr__groupcompany__c,:vctr__lead__c,:vctr__optout__c,:vctr__account__c,:vctr__contact__c) 
         on conflict(id) do update set isdeleted=:isdeleted ,name=:name ,vctr__groupcompany__c=:vctr__groupcompany__c ,vctr__lead__c=:vctr__lead__c, vctr__optout__c=:vctr__optout__c ,vctr__account__c=:vctr__account__c ,vctr__contact__c=:vctr__contact__c');
        $prepIns->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns->bindValue(':isdeleted',$isdeleted,PDO::PARAM_BOOL);
        $prepIns->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__groupcompany__c',$vctr__groupcompany__c,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__lead__c',$vctr__lead__c,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__optout__c',$vctr__optout__c,PDO::PARAM_BOOL);
        $prepIns->bindValue(':vctr__account__c',$vctr__account__c,PDO::PARAM_STR);
        $prepIns->bindValue(':vctr__contact__c',$vctr__contact__c,PDO::PARAM_STR);
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