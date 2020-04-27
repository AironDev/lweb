<?php ob_start(); session_start();  ?>
<?php 
    require_once('database/connection.php'); 
     

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


//     function validatePos() {
//   for($i=1; $i<=9; $i++) {
//     if ( ! isset($_POST['year'.$i]) ) continue;
//     if ( ! isset($_POST['desc'.$i]) ) continue;

//     $year = $_POST['year'.$i];
//     $desc = $_POST['desc'.$i];

//     if ( strlen($year) == 0 || strlen($desc) == 0 ) {
//       return "All fields are required";
//     }

//     if ( ! is_numeric($year) ) {
//       return "Position year must be numeric";
//     }
//   }
//   return true;
// }


    function insertPos() {
        $rank = 1;
        for($i=1; $i<=9; $i++) {
            // if ( ! isset($_POST['year'.$i]) ) continue;
            // if ( ! isset($_POST['desc'.$i]) ) continue;
            $year = $_POST['year'.$i];
            $desc = $_POST['desc'.$i];
            $stmt = $pdo->prepare('INSERT INTO position
            (profile_id, rank, year, description) 
            VALUES ( :pid, :rank, :year, :desc)');
            $stmt->execute(array(
            ':pid' => $profile_id,
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc));
            $rank++;
        }
    
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf">
        <title>Aaron, Aniebiet B.</title>  

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
