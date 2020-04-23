<?php require "partials/header.php"; ?> 
    <?php 
        $id = $_GET['profile_id'];

        $stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $stmt->execute(['id' => $id]);
        $oldData = $stmt->fetch();

    ?>

    <?php 
    if(isset($_POST['submit'])){

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
                        <input type="text" required name="first_name" id="fname" class="form-control " onmouseleave="return validateAddNew('fname')" value="<?php echo $oldData['first_name']?>">
                        <p id="fnameErr" class="text-danger"></p>

                        <label class="label-for-lname">Last Name</label>
                        <input type="text" required name="last_name" id="lname" class="form-control" onmouseleave="return validateAddNew('lname')" value="<?php echo $oldData['last_name']?>">
                        <p id="lnameErr" class="text-danger"></p>

                        <label class="label-for-email">Email</label>
                        <input type="email" required name="email" id="email" class="form-control" onmouseleave="return validateAddNew('email')" value="<?php echo $oldData['email']?>">
                        <p id="emailErr" class="text-danger"></p>

                        <label class="label-for-headline">Headline</label>
                        <input type="text" required name="headline" id="headline" class="form-control" onmouseleave="return validateAddNew('headline')" value="<?php echo $oldData['headline']?>">
                        <p id="headlineErr" class="text-danger"></p>

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"  rows="5" name="summary" id="summary" onmouseleave="return validateAddNew('summary')" class="form-control"><?php echo $oldData['summary']?></textarea>
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

