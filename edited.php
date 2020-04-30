<?php require "partials/header.php"; ?> 
    <?php 
        $id = $_GET['profile_id'];

        $profile_stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $profile_stmt->execute(['id' => $id]);
        $oldProfile = $profile_stmt->fetch();

        // $position_stmt = $pdo->prepare("SELECT * FROM position WHERE profile_id = :id");
        // $position_stmt->execute(['id' => $id]);
        // $oldPositions = $position_stmt->fetchAll();

    ?>

<?php 
    if(isset($_POST['submit'])){
        
        // $profile_id = $_POST['profile_id'];
        // $newProfile = array(
        //     ':user_id' => $_SESSION['user_id'],
        //     ':fname' => $_POST['first_name'],
        //     ':lname' => $_POST['last_name'],
        //     ':email' => $_POST['email'],
        //     ':headline' => $_POST['headline'],
        //     ':summary' => $_POST['summary'],
        //     ':profile_id' => $_POST['profile_id']
        // );
        // $profile_update_sql = "UPDATE profile SET user_id=:user_id, first_name=:fname, last_name=:lname, email=:email, headline=:headline, summary=:summary WHERE profile_id=:profile_id";

        // $profile_update_stmt = $pdo->prepare($profile_update_sql);
        // $profile_update_stmt->execute($newProfile);




        $newData = array(
            ':user_id' => $_SESSION['user_id'],
            ':fname' => $_POST['first_name'],
            ':lname' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':headline' => $_POST['headline'],
            ':summary' => $_POST['summary'],
            ':profile_id' => $_POST['profile_id']
        );
        $sql = "UPDATE profile SET user_id=:user_id, first_name=:fname, last_name=:lname, email=:email, headline=:headline, summary=:summary WHERE profile_id=:profile_id";
        

        $stmt = $pdo->prepare($sql);

        $stmt->execute($newData);

        $profile_id = $_POST['profile_id'];
        addFlash('Updated Successfully');
        header("Location: index.php");
        

        
        // foreach($oldPositions as $position){
        //     $yr = 'year'.$position['position_id'];
        //     $des = 'desc'.$position['position_id'];

        //     $newPosition = array(
        //     ':year' => $_POST[$yr],
        //     ':description' => $_POST[$des],
        //     ':profile_id' => $position['profile_id'],
        //     ':rank' => $position['rank']
        //     );

        //     $position_update_sql = "UPDATE position SET year=:year, description=:description, profile_id=:profile_id, rank=:rank WHERE profile_id=:profile_id";

        //     $position_update_stmt = $pdo->prepare($position_update_sql);
        //     $update_profile_stmt->execute($newProfile);
        // }
        

        // addFlash('Updated Successfully');
        // header("Location: index.php");
    }
?>

    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">EDIT RESUME</h3>  
                    <div class="float-right">
                       <?php 
                            if(authUser()){ echo "<button style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Home</button>" ;}
                            if(authUser()){ echo "<button style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</button>" ;}

                         ?>
                     </div>
                     <p class="text-danger"> <?php showFlash(); removeFlash(); authRedirect(); //authUserProfile($oldData['user_id']) ?></p>
                </div>
                <div class="card-body">
                    <form method="post" class="form col-md-10" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <input type="text" name="profile_id" value="<?php echo $oldData['profile_id']?>" hidden>

                        <label class="label-for-fname" >First Name</label>
                        <input type="text" required name="first_name" id="fname" class="form-control " onmouseleave="return validateAddNew('fname')" value="<?php echo $oldProfile['first_name']?>">
                        <p id="fnameErr" class="text-danger"></p>

                        <label class="label-for-lname">Last Name</label>
                        <input type="text" required name="last_name" id="lname" class="form-control" onmouseleave="return validateAddNew('lname')" value="<?php echo $oldProfile['last_name']?>">
                        <p id="lnameErr" class="text-danger"></p>

                        <label class="label-for-email">Email</label>
                        <input type="email" required name="email" id="email" class="form-control" onmouseleave="return validateAddNew('email')" value="<?php echo $oldProfile['email']?>">
                        <p id="emailErr" class="text-danger"></p>

                        <label class="label-for-headline">Headline</label>
                        <input type="text" required name="headline" id="headline" class="form-control" onmouseleave="return validateAddNew('headline')" value="<?php echo $oldProfile['headline']?>">
                        <p id="headlineErr" class="text-danger"></p>

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"  rows="5" name="summary" id="summary" onmouseleave="return validateAddNew('summary')" class="form-control"><?php echo $oldProfile['summary']?></textarea>
                        <p id="summaryErr" class="text-danger"></p>

                        
                        <button type="submit" class="btn btn-primary" name="submit" onclick="//validateNew()">Save</button>
                    </form>
                    
                </div>
                <div class="card-footer">
                </div>
                
        </section>
        </div>
        <footer></footer>
    <script src="../assets/js/validate.js" type = "text/javascript"></script>
    </body>
</html>

