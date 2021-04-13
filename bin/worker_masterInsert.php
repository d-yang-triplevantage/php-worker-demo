<?php

print('===データ統合  開始=== ');

//リードデータ統合
require('worker_masterInsert_lead.php');

//取引先データ統合
require('worker_masterInsert_account.php');

//取引先責任者データ統合
require('worker_masterInsert_contact.php');

//商談データ統合
require('worker_masterInsert_opportunity.php');

//利用データ統合
require('worker_masterInsert_using.php');

print('===データ統合  終了=== ');

?>






