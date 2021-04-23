<?php

 //処理対象スキーマ
 //$schema =['salesforce001','salesforce002','salesforce003','salesforce004','salesforce005','salesforce006','salesforce007','salesforce008','salesforce009'];
 //テスト用
  $schema =['salesforce001','salesforce002'];
 
  //配列一次元
  $array = array();
  $array = array('りんご', 'もも', 'なし');
  //print_r($array);
  //echo $array;
  //print_r($schema);

  foreach($array as $value){
    print_r($value);
  }


  $array1 = array('apple'=>'りんご', 'peach'=>'もも', 'pear'=>'なし');
  print_r($array1);


?>