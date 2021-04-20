<?php

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
    if($strSeqInput == 'lead'){
      $sql .= "SELECT nextval('sfdcmiddle.seq_lead')";
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

return $strSeq;

}

$strSeqInput='lead';

$seqget = seqget($strSeqInput);
print("seqget=".$seqget);

?>