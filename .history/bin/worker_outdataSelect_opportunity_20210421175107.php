<?php

//共有先の取引先ID、取引先責任者IDを取得
require('commGetid.php');

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

  $sql = 'select a.id,a.sfid ,b.schema as bschema,a.accountid,a.name,a.contactid,a.vctr__ownercompany__c,a.vctr__shareng__c,a.vctr__vectorno__c
              from sfdcmaster.master_opportunity a, sfdcmiddle.middle_opportunity b
              where a.id = b.id
                and a.sfid = b.sfid
                and a.vctr__vectorno__c = b.vctr__vectorno__c';

  $stmt  = $dbh->query($sql);

  //SQL実行
  foreach ($stmt as $row) {
      //指定Columnを一覧表示

        print($row['id'].' ');
        print($row['sfid'].' ');
        print($row['bschema'].' ');
        print($row['accountid'].' ');
        print($row['name'].' ');
        print($row['contactid'].' ');
        print($row['vctr__ownercompany__c'].' ');
        print('vctr__shareng__c='.$row['vctr__shareng__c'].' ');
        print($row['vctr__vectorno__c']);

        $id = $row['id'];
        $sfid=$row['sfid'];
        $bschema=$row['bschema'];
        $accountid = $row['accountid'];
        $name = $row['name'];
        $contactid = $row['contactid'];
        $vctr__ownercompany__c = $row['vctr__ownercompany__c'];
        $vctr__shareng__c = $row['vctr__shareng__c'];
        $vctr__vectorno__c = $row['vctr__vectorno__c'];


        //マスタテーブル登録
        $prepIns001 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_out_opportunity(id,sfid,schema,accountid,name,contactid,vctr__ownercompany__c,vctr__shareng__c,vctr__vectorno__c) VALUES(:id,:sfid,:bschema,:accountid,:name,:contactid,:vctr__ownercompany__c,:vctr__shareng__c,:vctr__vectorno__c)');
        $prepIns001->bindValue(':id',$id,PDO::PARAM_INT);
        $prepIns001->bindValue(':sfid',$sfid,PDO::PARAM_STR);
        $prepIns001->bindValue(':bschema',$bschema,PDO::PARAM_STR);
        $prepIns001->bindValue(':accountid',$accountid,PDO::PARAM_STR);
        $prepIns001->bindValue(':name',$name,PDO::PARAM_STR);
        $prepIns001->bindValue(':contactid',$contactid,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__ownercompany__c',$vctr__ownercompany__c,PDO::PARAM_STR);
        $prepIns001->bindValue(':vctr__shareng__c',$vctr__shareng__c,PDO::PARAM_BOOL);
        $prepIns001->bindValue(':vctr__vectorno__c',$vctr__vectorno__c,PDO::PARAM_STR);
        $prepIns001->execute();

        if($vctr__shareng__c != ' '){
            //他社共有データ登録
            $strTypeInput = 'contact';
            $strSchema = $bschema;
            $strconid = $contactid;
            $opp_contactid = '';
            //共有先の取引先責任者ID取得
            $getContact = getShareid($strTypeInput,$strSchema,$strconid);
            foreach ($getContact as $value) {
               // print('contact id='.$value['id'].' ');
               // print($value['sfid'].' ');
               // print($value['schema'].' ');

                $opp_contactid = $value['sfid'];
               // $contactschema = $value['schema'];
            }
            //共有先の取引先ID取得
            $strTypeInput = 'account';
            $strSchema = $bschema;
            $straccid = $accountid;
            $opp_accountid = '';
            $accountschema = '';
            $getAccount = getShareid($strTypeInput,$strSchema,$accountid);
            foreach ($getAccount as $value) {
              //  print('account id='.$value['id'].' ');
                print($value['sfid'].' ');
                print($value['schema'].' ');
                $opp_accountid = $value['sfid'];
                $accountschema = $value['schema'];
            }
              if ($accountschema != ''){
                //他社共有データを出力テーブル登録
                $prepIns002 = $dbh->prepare('INSERT INTO sfdcmiddle.middle_out_opportunity(id,sfid,schema,accountid,name,contactid,vctr__ownercompany__c,vctr__shareng__c,vctr__vectorno__c) VALUES(:id,:sfid,:accountschema,:opp_accountid,:name,:opp_contactid,:vctr__ownercompany__c,:vctr__shareng__c,:vctr__vectorno__c)');
                $prepIns002->bindValue(':id',$id,PDO::PARAM_INT);
                $prepIns002->bindValue(':sfid',$sfid,PDO::PARAM_STR);
                $prepIns002->bindValue(':accountschema',$accountschema,PDO::PARAM_STR);
                $prepIns002->bindValue(':opp_accountid',$opp_accountid,PDO::PARAM_STR);
                $prepIns002->bindValue(':name',$name,PDO::PARAM_STR);
                $prepIns002->bindValue(':opp_contactid',$opp_contactid,PDO::PARAM_STR);
                $prepIns002->bindValue(':vctr__ownercompany__c',$vctr__ownercompany__c,PDO::PARAM_STR);
                $prepIns002->bindValue(':vctr__shareng__c',$vctr__shareng__c,PDO::PARAM_BOOL);
                $prepIns002->bindValue(':vctr__vectorno__c',$vctr__vectorno__c,PDO::PARAM_STR);
                $prepIns002->execute();
              }
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