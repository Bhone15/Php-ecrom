<?php
session_start();
require('../config/config.php');

$stmt = $pdo->prepare('DELETE FROM orders WHERE id=' . $_GET['id']);
$stmt->execute();
header('Location: adminUsers.php');
