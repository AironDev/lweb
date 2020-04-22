    
    <!-- Inject single header partials here -->
    <?php require "partials/header.php"; ?> 

    <?php 
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $stmt->execute(['id' => $id]);
        $oldData = $stmt->fetch();

    ?>

    <?php 
    if(isset($_POST['submit'])){

        $newData = array(
            ':user_id' => $_SESSION['user_id'],
            ':fname' => $_POST['fname'],
            ':lname' => $_POST['lname'],
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
        header("Location: view.php?id=$profile_id");
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
                        <input type="text" required name="fname" id="fname" class="form-control " value="<?php echo $oldData['first_name']?>">

                        <label class="label-for-lname">Last Name</label>
                        <input type="text" required name="lname" id="lname" class="form-control" value="<?php echo $oldData['last_name']?>">

                        <label class="label-for-email">Email</label>
                        <input type="email" required name="email" id="email" class="form-control" value="<?php echo $oldData['email']?>">

                        <label class="label-for-headline">Headline</label>
                        <input type="text" required name="headline" id="headline" class="form-control" value="<?php echo $oldData['headline']?>">

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"  rows="5" name="summary" id="summary" class="form-control"><?php echo $oldData['summary']?></textarea>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" onclick="//validateNew()">UPDATE</button>
                </div>
                </form>
        </section>
        </div>
        <footer></footer>
    <script src="" type = "text/javascript"></script>
    </body>
</html>

