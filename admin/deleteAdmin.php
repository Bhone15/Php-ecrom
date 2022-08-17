<?php
session_start();
require('../config/config.php');

if ($_SESSION['id'] == $_GET['id']) {
  echo "<script>
          alert('You cannot delete yourself!');
          window.location.href='adminUsers.php';
        </script>
       ";
} else {
  $stmt = $pdo->prepare('DELETE FROM users WHERE id=' . $_GET['id']);
  $stmt->execute();
  header('Location: adminUsers.php');
}
