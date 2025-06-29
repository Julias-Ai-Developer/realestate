<?php
include __DIR__ . '/../database/conn.php';
session_start();
session_unset();
session_destroy();
header('Location:/homepage');
?>

