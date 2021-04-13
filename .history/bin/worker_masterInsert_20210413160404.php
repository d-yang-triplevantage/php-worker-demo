<?php

print('===データ統合  開始=== ');

//リードデータ収集
require('worker_masterInsert_lead.php');

//取引先データ収集
require('worker_masterInsert_account.php');

//取引先責任者データ収集
require('worker_masterInsert_contact.php');

//商談データ収集
require('worker_masterInsert_opportunity.php');

//利用データ収集
require('worker_masterInsert_using.php');

print('===データ統合  終了=== ');

?>






