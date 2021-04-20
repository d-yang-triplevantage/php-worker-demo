<?php

//取引先ID、取引先責任者IDを取得関数
function  getid($strSeqInput,$strSchema,$strid){

$dbopts = parse_url(getenv('DATABASE_URL'));

$DBHOST = $dbopts["host"];
$DBPORT = $dbopts["port"];
$DBNAME = ltrim($dbopts["path"],'/');
$DBUSER = $dbopts["user"];
$DBPASS = $dbopts["pass"];

try{
    //DB接続
    $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
    $str_space = '';
    $sql = "";

    //取引先IDを取得
     if($strSeqInput == 'account'){
      $sql .= "select b.id as accid,b.sfid as accsfid,b.schema as accschema from sfdcmiddle.middle_account a ,sfdcmiddle.middle_account b where b.schema != $strSchema and a.sfid = $strSchema and  a.vctr__vectorno__c = b.vctr__vectorno__c and a.vctr__vectorno__c !=:str_space";
     }
    //取引先責任者IDを取得
     if($strSeqInput == 'contact'){
      $sql .= "select b.id as conid,b.sfid as consfid,b.schema as conschema  from sfdcmiddle.middle_contact a ,sfdcmiddle.middle_contact b  where b.schema != $strSchema and a.sfid = $strid   and  a.vctr__vectorno__c = b.vctr__vectorno__c  and a.vctr__vectorno__c !=:str_space";
     }


    $stmt  = $dbh->query($sql);

    $nextvalValue = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print('  ==='.$nextvalValue[0]['nextval'].' ');
    $strSeq=$nextvalValue[0]['nextval'];

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;

//取得結果を返し
return $strid;

}

//テスト用
//$strSeqInput='lead';
//$strSeqInput='account';
//$strSeqInput='contact';
//$strSeqInput='opportunity';
//$seqget = seqget($strSeqInput);
//print("seqget=".$seqget);

?>