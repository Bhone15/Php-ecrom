<?php
session_start();
function checkPermission()
{
  if ($_SESSION['role'] != 1) {
    header('Location: ../index.php');
  }
}
