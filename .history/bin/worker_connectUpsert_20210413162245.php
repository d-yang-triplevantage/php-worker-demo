<?php

print('===データ連携  開始=== ');

//リードデータ連携
require('worker_connectUpsert_lead.php');

//取引先データ連携
require('worker_connectUpsert_account.php');

//取引先責任者データ連携
require('worker_connectUpsert_contact.php');

//商談データ連携
require('worker_connectUpsert_opportunity.php');

//利用データ連携
require('worker_connectUpsert_using.php');

print('===データ連携  終了=== ');

?>