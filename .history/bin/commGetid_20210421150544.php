<?php

//取引先ID、取引先責任者IDを取得関数
function  getShareid($strSeqInput,$strSchema,$strid){

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
    $str_return =[' ',' '];
    //取引先IDを取得
     if($strSeqInput == 'account'){
      $sql .= "select b.id as id,b.sfid as sfid,b.schema as schema from sfdcmiddle.middle_account a ,sfdcmiddle.middle_account b where b.schema != :bschema and a.sfid = :accountid and  a.vctr__vectorno__c = b.vctr__vectorno__c and a.vctr__vectorno__c !=:str_space";
     }
    //取引先責任者IDを取得
     if($strSeqInput == 'contact'){
      $sql .= "select b.id as id,b.sfid as sfid,b.schema as schema  from sfdcmiddle.middle_contact a ,sfdcmiddle.middle_contact b  where b.schema != :bschema and a.sfid = :accountid   and  a.vctr__vectorno__c = b.vctr__vectorno__c  and a.vctr__vectorno__c !=:str_space";
     }

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':bschema',$strSchema,PDO::PARAM_STR);
    $stmt->bindValue(':accountid',$strid,PDO::PARAM_STR);
    $stmt->bindValue(':str_space',$str_space,PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print(' id ==='.$result['id'].' ');
    print(' sfid ==='.$result['sfid'].' ');
    print(' schema ==='.$result['schema'].' ');

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;

//取得結果を返し
return $result;

}

//テスト用

//$strSeqInput='account';
//$strSeqInput='contact';
//$strSchema = 'salesforce001';
//$strid = '0035h000003dEHJAA2';
//$strid = '0015h000005jTEZAA2';
//$getid = getid($strSeqInput,$strSchema,$strid);
//print("getid=".$getid[0]['id']);
//print("getsfid=".$getid[0]['sfid']);
//print("getschema=".$getid[0]['schema']);

?>