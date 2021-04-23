<?php

//企業名（取引先名）の編集

//・株式会社、・、スペース削除
//・半角はすべて全角に変換
//・小文字は大文字に変換
//・株式会社関連の外字・環境依存対応
//  ㈱、㊑、㍿、㈲、㊒
//  ※ひらがな・カタカナの相互変換は不要

function  accountNameEdit($strAccountName){

//①イオン株式会社　⇒「イオン」

$input1 ="イオン株式会社";
$output1 = trim(str_replace("株式会社","",$input1));
//echo "編集後:".$output1;

//②株式会社 明治　 ⇒「明治」

$input2 ='株式会社 明治';
$output2 = trim(str_replace('株式会社','',$input2));


//echo '編集後:'.$output2;


//③株式会社セブン‐イレブン・ジャパン ⇒「セブン‐イレブンジャパン」
//$input3 ='株式会社セブン‐イレブン・ジャパン㈱㊑㍿㈲㊒pHpｱｲｳｴｵセブンアイウエオ';

//$output3 = str_replace('株式会社','',$input3);

//echo '編集後:'.$output3;

//$output4 = trim(str_replace('・','',$input3));

//echo '編集後:'.$output4;

//$search = array("株式会社","・", "㈱","㊑","㍿","㈲","㊒");
//$replace = array("","","","","","","");

//$output11 = trim(str_replace($search,$replace,$input3));

//echo $output11;

//小文字は大文字に変換
//$output12=mb_strtoupper($output11);

//echo $output12;

//半角はすべて全角に変換
//$output13=mb_convert_kana($output12);
//echo $output13;

//・株式会社、・、スペース削除
//・半角はすべて全角に変換
//・小文字は大文字に変換
//・株式会社関連の外字・環境依存対応
//  ㈱、㊑、㍿、㈲、㊒
//  ※ひらがな・カタカナの相互変換は不要

//・小文字は大文字に変換
$tmp_strAccountName=mb_strtoupper($strAccountName);
//・半角はすべて全角に変換
$tmp_strAccountNamekana=mb_convert_kana($tmp_strAccountName);

//・株式会社、・、スペース削除
//・株式会社関連の外字・環境依存対応
//  ㈱、㊑、㍿、㈲、㊒

$search = array("株式会社","・", "㈱","㊑","㍿","㈲","㊒");
$replace = array("","","","","","","");

$editNameAfter = trim(str_replace($search,$replace,$tmp_strAccountNamekana));

 return  $editNameAfter;

}

?>