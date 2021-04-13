<?php

print('===データ収集  開始=== ');

//リードデータ収集
require('worker_middleInsert_lead.php');

//取引先データ収集
require('worker_middleInsert_account.php');

//取引先責任者データ収集
require('worker_middleInsert_contact.php');

//商談データ収集
require('worker_middleInsert_opportunity.php');

//利用データ収集
require('worker_middleInsert_using.php');

print('===データ収集  終了=== ');

?>