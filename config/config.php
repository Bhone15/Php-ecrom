<?php

define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'ecorm');

$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

try {
  $pdo = new PDO(
    'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DATABASE,
    MYSQL_USER,
    MYSQL_PASSWORD,
    $options
  );
} catch (PDOException $e) {
  echo $e;
}
