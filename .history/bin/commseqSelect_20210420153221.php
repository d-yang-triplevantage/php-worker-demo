<?php

//SEQを取得関数
function  seqget($strSeqInput){

$dbopts = parse_url(getenv('DATABASE_URL'));

$DBHOST = $dbopts["host"];
$DBPORT = $dbopts["port"];
$DBNAME = ltrim($dbopts["path"],'/');
$DBUSER = $dbopts["user"];
$DBPASS = $dbopts["pass"];

try{
    //DB接続
    $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
    $sql = "";
    //リードのSEQを取得
    if($strSeqInput == 'lead'){
      $sql .= "SELECT nextval('sfdcmiddle.seq_lead')";
     }
    //取引先のSEQを取得
     if($strSeqInput == 'account'){
      $sql .= "SELECT nextval('sfdcmiddle.seq_account')";
     }
    //取引先責任者のSEQを取得
     if($strSeqInput == 'contact'){
      $sql .= "SELECT nextval('sfdcmiddle.seq_contact')";
     }
   //商談のSEQを取得
     if($strSeqInput == 'opportunity'){
      $sql .= "SELECT nextval('sfdcmiddle.seq_opportunity')";
     }
    $stmt  = $dbh->query($sql);

    $nextvalValue = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print(' seq nextval==='.$nextvalValue[0]['nextval'].' ');
    $strSeq=$nextvalValue[0]['nextval'];

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;

//取得結果を返し
return $strSeq;

}

//テスト用
//$strSeqInput='lead';
//$strSeqInput='account';
//$strSeqInput='contact';
//$strSeqInput='opportunity';
//$seqget = seqget($strSeqInput);
//print("seqget=".$seqget);

?>