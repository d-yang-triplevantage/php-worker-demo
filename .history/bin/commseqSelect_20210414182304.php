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
    $sql = "";
    $sql .= "SELECT nextval('sfdcmiddle.seq_lead')";

    $stmt  = $dbh->query($sql);
   // foreach ($stmt as $row) {
   //     $nextval=$row['nextval'];
   //   print(' seq_lead nextval==='.$nextval.' ');
   // }
    $nextvalValue = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$nextvalValue[0]['nextval'];
    print(' seq_lead nextval==='.$nextvalValue[0]['nextval'].' ');

}catch(PDOException $e){
  print("接続失敗");
  print($e);
  die();
}

//データベースへの接続を閉じる
$dbh = null;

?>