<?php ob_start(); ?>
<?php session_start();?>
<?php require "partials/header.php"; ?> 
<?php 

    if(isset($_POST['submit'])){

        $password = $_POST['pass']; //php123
        $email = $_POST['email']; //  umsi@umich.edu
        $salt = 'XyZzy12*_';

        $hashedPassword = hash('md5', $salt.$password);
        $stmt = $pdo->prepare('SELECT user_id, name FROM users
        WHERE email = :em AND password = :pw');

        $stmt->execute([':em' => $email, ':pw' => $hashedPassword]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ( $row !== false ) {
           
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];
            addFlash("Welcome back " . $_SESSION['name']);  //Add a welcome message to flash
            header("Location: index.php"); // Redirect the browser to index.php
            return;
            
        }else{
            addFlash('Email or Password does not exists"');
            header("Location: ");
           
            
        }
    }

    $data = $pdo->query("SELECT * FROM users")->fetchAll();

?>
    <body>
        <!-- require the main nav -->
        <?php require "partials/nav.php"; ?>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group-group">
                            <input type="email" name="email" class="" placeholder="email" id="email">
                            <input type="password" name="pass" id="password">
                            <input type="submit" name="submit" onclick=" validateLogin();" value="Log In">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="text-danger"> <?php showFlash(); removeFlash();  ?></p> 
                    <button class='btn btn-primary' onclick="<?php  login()?>">Logined</button>
                    
                    <button class='btn btn-primary' onclick="<?php  logout()?>">Logouted</button>
                </div>
        </section>
        </div>
        <footer></footer>
    <script src="../assets/js/validate.js" type = "text/javascript"></script>
    </body>
</html>
