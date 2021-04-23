<?php

 //処理対象スキーマ
 //$schema =['salesforce001','salesforce002','salesforce003','salesforce004','salesforce005','salesforce006','salesforce007','salesforce008','salesforce009'];
 //テスト用
  $schema =['salesforce001','salesforce002'];

  //配列一次元
  $array = array('りんご', 'もも', 'なし');
  print_r($array);
  //echo $array;
  print_r($schema);

  foreach($array as $value){
    print_r($value[0]);
    print_r($value[1]);
    print_r($value[2]);
  }

?>