<?php

 //処理対象スキーマ
 //$schema =['salesforce001','salesforce002','salesforce003','salesforce004','salesforce005','salesforce006','salesforce007','salesforce008','salesforce009'];
 //テスト用
  $schema =['salesforce001','salesforce002'];
 
  //配列一次元
 // $array = array();
 // $array = array('りんご', 'もも', 'なし');
  //print_r($array);
  //echo $array;
  //print_r($schema);

 // foreach($array as $value){
 //   print_r($value);
 // }


 // $array1 = array('apple'=>'りんご', 'peach'=>'もも', 'pear'=>'なし');
  //print_r($array1);
 // foreach($array1 as $value){
 //   print_r($value);
 // }


  //$array2 = array('バナナ', 'apple'=>'りんご', 'peach'=>'もも', 'pear'=>'なし', 'みかん');
  //$array2 = ['バナナ', 'apple'=>'りんご', 'peach'=>'もも', 'pear'=>'なし', 'みかん'];
 // print_r($array2);

 // print_r($array2[0]);
 // print_r($array2[1]);
 // print_r($array2['apple']);

//配列二次元
 // $array3 = array('fruits'=>array('a'=>'orange', 'b'=>'banana'), 'numbers'=>array(1, 3, 5));
  //print_r($array3);
 // print_r($array3['fruits']);
 // print_r($array3['numbers']);

 //配列結合
 //$array1 = array('color'=>'red', 10=>1, 0=>3);

$array1[] = 100;
$array1[] = 200;
$array1[] = 300;
$array1[] = 400;
$array1[] = 500;
//$array2 = array('a', 'b', 'color'=>'green', 5);
//$array = array_merge($array1, $array2);

print_r($array1);
//print_r($array2);
//print_r($array);

print_r(count($array1));

 foreach($array1 as $value){
    print_r($value);
  }

?>