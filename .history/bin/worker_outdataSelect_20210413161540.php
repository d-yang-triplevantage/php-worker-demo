<?php

print('===データ抽出  開始=== ');

//リードデータ統合
require('worker_outdataSelect_lead.php');

//取引先データ抽出
require('worker_outdataSelect_account.php');

//取引先責任者データ抽出
require('worker_outdataSelect_contact.php');

//商談データ抽出
require('worker_outdataSelect_opportunity.php');

//利用データ抽出
require('worker_outdataSelect_using.php');

print('===データ抽出  終了=== ');

?>








