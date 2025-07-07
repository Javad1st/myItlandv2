<?php
session_start();

if (!isset($_SESSION['logged_in']) && !isset($_COOKIE['logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
