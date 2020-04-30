
<?php require "partials/header.php"; ?> 
    <?php 
        $id = $_GET['profile_id'];

        $getProfileStmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $getProfileStmt->execute(['id' => $id]);
        $oldProfileData = $getProfileStmt->fetch();

        $getPositionStmt = $pdo->prepare("SELECT * FROM position WHERE profile_id = :id");
        $getPositionStmt->execute(['id' => $id]);
        $oldPositions = $getPositionStmt->fetchAll();

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
                     <p class="text-danger"> <?php showFlash(); removeFlash(); authRedirect(); //authUserProfile($oldProfileData['user_id']) ?></p>
                </div>
                <div class="card-body">
                    <form method="post" class="form col-md-10" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <input type="text" name="profile_id" value="<?php echo $oldProfileData['profile_id']?>" hidden>

                        <label class="label-for-fname" >First Name</label>
                        <input type="text" required name="first_name" id="fname" class="form-control " onmouseleave="return validateAddNew('fname')" value="<?php echo $oldProfileData['first_name']?>">
                        <p id="fnameErr" class="text-danger"></p>

                        <label class="label-for-lname">Last Name</label>
                        <input type="text" required name="last_name" id="lname" class="form-control" onmouseleave="return validateAddNew('lname')" value="<?php echo $oldProfileData['last_name']?>">
                        <p id="lnameErr" class="text-danger"></p>

                        <label class="label-for-email">Email</label>
                        <input type="email" required name="email" id="email" class="form-control" onmouseleave="return validateAddNew('email')" value="<?php echo $oldProfileData['email']?>">
                        <p id="emailErr" class="text-danger"></p>

                        <label class="label-for-headline">Headline</label>
                        <input type="text" required name="headline" id="headline" class="form-control" onmouseleave="return validateAddNew('headline')" value="<?php echo $oldProfileData['headline']?>">
                        <p id="headlineErr" class="text-danger"></p>

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"  rows="5" name="summary" id="summary" onmouseleave="return validateAddNew('summary')" class="form-control"><?php echo $oldProfileData['summary']?></textarea>
                        <p id="summaryErr" class="text-danger"></p>
                        <?php if($oldPositions == null): ?>
                            <label class="label-for-position">Position</label>
                            <button id="addPos" onclick="return false">+</button>
                            <div id="position_fields">
                            <!-- position fiels are injected here from jquery -->
                            </div>
                             <hr/>
                        <?php endif ?>
                        
                        <?php $num = 1; foreach ($oldPositions as  $position): ?>
                        <div id="<?php echo "position".$position['position_id']; ?>" >                              
                            <input type="text" name="<?php echo "year".$num; ?>" value="<?php echo $position['year'] ?>" class="form-control col-sm-8 float-left" placeholder="Year">
                            <button id="" onclick=" return false" class="form-control col-sm-2 float-right">-</button>
                            <textarea name="<?php echo "desc".$num; ?>" cols="80" rows="5" class="form-control" placeholder="Description"><?php echo $position['description'] ?></textarea>
                        </div>
                        <?php  $num++; endforeach; ?>

                        <?php if($num < 9): ?>
                            <label class="label-for-position">Position</label>
                            <button id="addPos" onclick="return false">+</button>
                            <div id="position_fields">
                            <!-- position fiels are injected here from jquery -->
                            </div>
                             <hr/>
                        <?php endif ?>
                        <button type="submit" class="btn btn-primary" name="submit" onclick="//validateNew()">Save</button>
                    </form>
                    
                </div>
                <div class="card-footer">
                </div>
                
        </section>
        </div>
        <footer></footer>
            <script type="text/javascript">
                countPos = 0;

                function removePos(param){
                        $('#position'+countPos).remove();
                        console.log('Removing Position' +countPos);
                    }
                $(document).ready(function(){
                    $('#addPos').click(function(e){
                        e.preventDefault();
                        if(countPos >= 9){
                            alert('Maximum of nine postion entries exceeded');
                            return;
                        }
                        countPos++;
                        console.log('Adding Position' +countPos);
                        var position_fields = '<div id="position' +countPos+'">\
                                            <input type="text" name="year' +countPos+'" value="" class="form-control col-sm-8 float-left" placeholder="Year">\
                                            <button id="" onclick="removePos(countPos); return false" class="form-control col-sm-2 float-right">-</button>\
                                            <textarea name="desc' +countPos+'" cols="80" rows="5" class="form-control" placeholder="Description"></textarea>\
                                        </div> <hr/>';
                        $('#position_fields').append(position_fields);
                    });

                });


            </script>
             <script src="../assets/js/validate.js" type = "text/javascript"></script>
    </body>
</html>
<?php 
    if(isset($_POST['submit'])){
        $newProfileData = array(
            ':user_id' => $_SESSION['user_id'],
            ':fname' => $_POST['first_name'],
            ':lname' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':headline' => $_POST['headline'],
            ':summary' => $_POST['summary'],
            ':profile_id' => $_POST['profile_id']
        );
        $updateProfileSql = "UPDATE profile SET user_id=:user_id, first_name=:fname, last_name=:lname, email=:email, headline=:headline, summary=:summary WHERE profile_id=:profile_id";
        

        $updateProfileStmt = $pdo->prepare($updateProfileSql);
        $updateProfileStmt->execute($newProfileData);

        // Position

        // Clear out the old position entries
        $deletePositionStmt = $pdo->prepare('DELETE FROM Position WHERE profile_id=:pid');
        $deletePositionStmt->execute(array( ':pid' => $_REQUEST['profile_id']));

        // Insert the position entries
        $rank = 1;
        for($i=1; $i<=9; $i++) {

            if ( ! isset($_POST['year'.$i]) ) continue;
            if ( ! isset($_POST['desc'.$i]) ) continue;
            $year = $_POST['year'.$i];
            $desc = $_POST['desc'.$i];
            $stmt = $pdo->prepare('INSERT INTO position
            (profile_id, rank, year, description)
            VALUES ( :pid, :rank, :year, :desc)');
            $stmt->execute(array(
            ':pid' => $_REQUEST['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc)
            );
            $rank++;
        }


        addFlash('Updated Successfully');
        header("Location: index.php");
    }
?>

