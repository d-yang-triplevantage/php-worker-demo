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

    //中間テーブルのデータを削除処理
     //SQL作成

   // $sql = 'select * from  sfdcmiddle.middle_out_opportunity';

    //$stmt  = $dbh->query($sql);

    $content = file_get_contents('./sql/deletemiddle.sql');
    print('======$content= '.$content);
    $rows = explode("\n",$content);
    foreach($rows as $sql){
        print('======$sql= '.$sql);
        $stmt  = $dbh->query($sql);

    }

}catch(PDOException $e){
    print("接続失敗");
    print($e);
    die();
  }

  //データベースへの接続を閉じる
  $dbh = null;

?>