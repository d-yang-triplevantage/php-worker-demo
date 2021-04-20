<?php

//定数ファイルを読み込み
//require('config.php');
//スキームの環境変数取得
$schema=getenv('SCHEMA');

//DB接続情報を取得
$dbopts = parse_url(getenv('DATABASE_URL'));

$DBHOST = $dbopts["host"];
$DBPORT = $dbopts["port"];
$DBNAME = ltrim($dbopts["path"],'/');
$DBUSER = $dbopts["user"];
$DBPASS = $dbopts["pass"];
        print('DBHOST: '.$DBHOST.' ');
        print('DBPORT: '.$DBPORT.' ');
        print('DBNAME: '.$DBNAME.' ');
        print('DBUSER: '.$DBUSER.' ');
        print('DBPASS: '.$DBPASS.' ');
try{
  //DB接続
  $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
  
     foreach ($schema as $value) {
   
       //検索対象スキーマ
       $schemaid = $value.'.lead';
       print('schema value='.$schemaid);

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
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];    
        print('======salesforce.lead========='.$schemaid);
        //中間テーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_lead(id,sfid, schema,firstname,lastname,email) VALUES(:id,:sfid, :schema,:firstname,:lastname,:email)');
        $prepIns001->execute(array($id,$sfid,$schema,$firstname,$lastname,$email));
      
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