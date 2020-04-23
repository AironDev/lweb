<?php ob_start(); session_start(); ?>
<?php require "partials/header.php"; ?>
<?php session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    addFlash('logged out');
    header("Location: index.php")

?>