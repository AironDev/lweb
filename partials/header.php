<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]. 'database/connection.php');  
    session_start(); 

    function addFlash($msg){
         $_SESSION['flashMsg'] = $msg;

    }

    function showFlash(){
        if(isset($_SESSION['flashMsg'])){
            echo $_SESSION['flashMsg'];
        }
    }

    function removeFlash(){
        unset($_SESSION['flashMsg']);
    }

    function authRedirect(){
        if(!isset($_SESSION['user_id'])){
             header("Location: login.php");
            addFlash("You must login first");

             exit();
        }
    }

    function authUser(){
        if(isset($_SESSION['user_id'])){
                return true;
        }
    }

    function authUserProfile($userId){
        if($_SESSION['user_id'] == $userId){
                return true;
        }else{
            echo "Sorry, you do not have permission to edit this profile" ;
            exit();
        }
    }

   

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf">
        <title>Aaron Aniebiet</title>  

        <!-- CSS Framework/Misc -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate/animate.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
    
        <!-- Font Icons -->
        <link rel="stylesheet" href="assets/font-icons/font-awesome/css/font-awesome.css">
    
        <!-- Head Scripts -->
        <script type="text/javascript" src='assets/jquery/jquery.min.js'></script>
        <script src='assets/bootstrap/js/bootstrap.min.js'></script>
    </head>
