<?php

$app = new Silex\Application();
$app['debug'] = true;

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);

//   $sql = "insert into test_table(id,name) values(2,'hello world')";
//   $stmt = $app['pdo']->prepare($sql);
//   $stmt->execute();

  $st = $app['pdo']->prepare('SELECT LastName FROM salesforce001.Lead');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['LastName']);
    $LastName[] = $row;
    echo $LastName[]
  }
  
$app->run();

