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
   
   
  $sql = 'select a.sfid as asfid,a.schema as aschema,b.sfid as bsfid,b.schema as bschema,b.lastname as blastname,b.firstname as bfirstname,b.email as bemail from sfdcmiddle.middle_lead a ,sfdcmiddle.middle_lead b
               where a.lastname = b.lastname
                   and a.firstname = b.firstname
                   and a.email = b.email
                  and  a.schema != b.schema';
  
  $stmt  = $dbh->query($sql);

  $keynew = ['','',''];
  $keyold = ['','',''];
  
  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

    //  print($row['asfid'].'\n');      
    //  print($row['aschema'].'\n');
    //  print($row['bsfid'].'\n');      
    //  print($row['bschema'].'\n');
    //  print($row['bemail'].'\n');
    //  print($row['blastname'].'\n');
    //  print($row['bfirstname'].'\n');
     $asfid=$row['asfid'];
     $aschema=$row['aschema'];
     $bsfid=$row['bsfid'];
     $bschema=$row['bschema'];
     $firstname = $row['blastname'];
     $lastname = $row['bfirstname'];
     $email = $row['bemail'];
     

     if ($row === reset($stmt)){
         $keynew = [$firstname,$lastname,$email];
         print($keynew[0].'\n');
         print($keynew[1].'\n');
         print($keynew[2].'\n');
     }
     if ($keynew === $keyold){
        //$keynewに新レコードを設定
        $keynew = [$firstname,$lastname,$email];
     }else{
          if($row === end($stmt)){
             //keyoldデータ登録
             print('=======keyoldのデータ登録=最後====');
           //中間テーブル登録
           $company = '日精自動車';
           $vectorno__c = '9999001';
            $firstname=$keynew[0];
            $lastname=$keynew[1];
            $email=$keynew[2];
           $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_lead(firstname,lastname,email,company,vectorno__c) VALUES(:firstname,:lastname,:email,:company,:vectorno__c)');
           $prepIns->execute(array($firstname,$lastname,$email,$company,$vectorno__c));
           
           //中間テーブルに統合IDを反映
           updatemiddletable($firstname,$lastname,$email,$company,$vectorno__c,$dbh);
           
         }else{
             //keyoldのデータ登録
             print('=======keyoldのデータ登録=====');
           //中間テーブル登録
           $company = '日精自動車';
           $vectorno__c = '9999001';
            $firstname=$keynew[0];
            $lastname=$keynew[1];
            $email=$keynew[2];
           $prepIns = $dbh->prepare('INSERT INTO sfdcmaster.master_lead(firstname,lastname,email,company,vectorno__c) VALUES(:firstname,:lastname,:email,:company,:vectorno__c)');
           $prepIns->execute(array($firstname,$lastname,$email,$company,$vectorno__c));
           
           //中間テーブルに統合IDを反映
           updatemiddletable($firstname,$lastname,$email,$company,$vectorno__c,$dbh);
           
           
             //keyoldにkeynewを設定
             $keyold = $keynew;
       }
     }
      
      //中間テーブルに統合IDを反映
      function updatemiddletable($firstname,$lastname,$email,$company,$vectorno__c,$dbh){
      
          $sql = 'update sfdcmiddle.middle_lead set company = :company,vectorno__c=:vectorno__c WHERE firstname = :firstname and lastname=:lastname and email=:email';
          $stmt = $dbh->prepare($sql);
          $stmt->execute(array($company,$vectorno__c,$firstname,$lastname,$email));

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