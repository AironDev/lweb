<?php require "partials/header.php"; ?> 
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">ADD RESUME</h3>  
                    <p class="text-success"> <?php showFlash(); removeFlash(); authRedirect(); ?></p>
                    <div class="float-right">
                       <?php 
                            if(authUser()){ echo "<a href='index.php' style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Home</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</a>" ;}
                         ?>
                     </div>
                </div>
                <div class="card-body">
                    <form method="post" class="form col-md-10" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <p id="allErr" class="text-danger">All values are required</p>
                        <label class="label-for-fname" >First Name</label>
                        <input type="text" required = 'required' name="first_name" id="fname" class="form-control" onmouseleave="return validateAddNew('fname')">
                        <p id="fnameErr" class="text-danger"></p>

                        <label class="label-for-lname">Last Name</label>
                        <input type="text"  required = 'required' name="last_name" id="lname" class="form-control" onmouseleave="return validateAddNew('lname')">
                        <p id="lnameErr" class="text-danger"></p>

                        <label class="label-for-email">Email</label>
                        <input type="email"  name="email" id="email" class="form-control" onmouseleave="return validateAddNew('email')">
                        <p id="emailErr" class="text-danger"></p>

                        <label class="label-for-headline">Headline</label>
                        <input type="text"  required = 'required' name="headline" id="headline" class="form-control" onmouseleave="return validateAddNew('headline')">
                        <p id="headlineErr" class="text-danger"></p>

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"  required = 'required'  rows="5" name="summary" id="summary" class="form-control" onmouseleave="return validateAddNew('summary')" ></textarea>
                        <p id="summaryErr" class="text-danger"></p>
                        <button type="submit" value="Add" class="btn btn-primary" name="submit" onmouseover="validateAddNew('submit')">Add</button>
                        
                    </form>
                </div>
                <div class="card-footer">
                    <?php echo $_SESSION['me']; echo $_SESSION['name']; echo $_SESSION['user_id']; ?>
                </div>
        </section>
        </div>
        <footer></footer>
    <script src="../assets/js/validate.js" type = "text/javascript"></script>
    </body>
</html>

<?php 
    if(isset($_POST['submit'])){
        //echo $_SESSION['user_id'];

       if($_POST['headline'] != ""){
            $stmt = $pdo->prepare('INSERT INTO profile
            (user_id, first_name, last_name, email, headline, summary)
            VALUES ( :user_id, :fname, :lname, :email, :headline, :summary)');
    
            $stmt->execute(array(
            ':user_id' => $_SESSION['user_id'],
            ':fname' => $_POST['first_name'],
            ':lname' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':headline' => $_POST['headline'],
            ':summary' => $_POST['summary'])
            );
    
            addFlash('Added Successfully');
            header("Location: index.php");
            return;
       }else{
           addFlash('All values are required');
       }
    }
?>
