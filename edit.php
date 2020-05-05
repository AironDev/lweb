
<?php require "partials/header.php"; ?> 
    <?php 
        $id = $_GET['profile_id'];

        $getProfileStmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $getProfileStmt->execute(['id' => $id]);
        $oldProfileData = $getProfileStmt->fetch();

        $getPositionStmt = $pdo->prepare("SELECT * FROM position WHERE profile_id = :id");
        $getPositionStmt->execute(['id' => $id]);
        $oldPositions = $getPositionStmt->fetchAll();

        $getEducationStmt = $pdo->prepare("SELECT * FROM education INNER JOIN institution on education.institution_id = institution.institution_id  WHERE profile_id = :id ");
        $getEducationStmt->execute(['id' => $id]);
        $oldEducation = $getEducationStmt->fetchAll();

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



                         <!--  Displays existing Education records   -->
                        <label class="label-for-position">Education</label>
                        <div id="education_fields" class="pd-3">
                            <?php $eduNum = 1; foreach ($oldEducation as  $education): ?>
                            <div id="<?php echo "education".$eduNum; ?>" class="mb-2">                              
                                <input type="text" name="<?php echo "edu_year".$eduNum; ?>" value="<?php echo $education['year'] ?>" class="form-control col-sm-11 float-left" placeholder="Year">
                                <button id="" class="removePos" onclick=" return false" class="form-control col-sm-1 float-right"><i class="fa fa-times-circle-o"></i></button>
                                <textarea name="<?php echo "edu_school".$eduNum; ?>" cols="80" rows="2" class="form-control" placeholder="Description"><?php echo $education['name'] ?></textarea>
                            </div>
                            <?php  $eduNum++; endforeach; ?>
                        </div>

                        <!-- Displays a button to add new education record if the exisitng ones is less than 9 -->
                        <?php if($eduNum < 9): ?>
                        <button id="addEdu" class="" onclick="return false">Add New</button>
                        <div id="education_fields"></div> <hr><!-- Education fiels are injected here from jquery -->
                         <?php endif ?>


                         <!--  Displays existing Positions   -->
                        <label class="label-for-position">Positions</label>
                        <div id="position_fields">
                            <?php $posNum = 1; foreach ($oldPositions as  $position): ?>
                            <div id="<?php echo "position".$posNum; ?>" class="mb-2">                              
                                <input type="text" name="<?php echo "year".$posNum; ?>" value="<?php echo $position['year'] ?>" class="form-control col-sm-11 float-left" placeholder="Year">
                                <button id="" class="removePos" onclick=" return false" class="form-control col-sm-1 float-right"><i class="fa fa-times-circle-o"></i></button>
                                <textarea name="<?php echo "desc".$posNum; ?>" cols="80" rows="2" class="form-control" placeholder="Description"><?php echo $position['description'] ?></textarea>
                            </div>
                            <?php  $posNum++; endforeach; ?>
                        </div>

                        <!-- Displays a button to add new position record if the exisitng ones is less than 9 -->
                        <?php if($posNum < 9): ?>
                            <button id="addPos" onclick="return false">Add New</button>
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
             <script src="../assets/js/validate.js" type = "text/javascript"></script>
             <script src="../assets/js/resume_fields.js" type = "text/javascript"></script>
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

         $profile_id = $_POST['profile_id'];

        // Position

        
 
             //Clear out the old position entries
            $deletePositionStmt = $pdo->prepare('DELETE FROM position WHERE profile_id=:pid');
            $deletePositionStmt->execute(array( ':pid' => $profile_id));
            // Insert new position
            $rank = 1;
            for($i=1; $i<=9; $i++) {
                if ( ! isset($_POST['year'.$i]) ) continue;
                if ( ! isset($_POST['desc'.$i]) ) continue;
                $year = $_POST['year'.$i];
                $desc = $_POST['desc'.$i];
                $updatePositionStmt = $pdo->prepare('INSERT INTO position
                (profile_id, rank, year, description)
                VALUES ( :pid, :rank, :year, :desc)');
                $updatePositionStmt->execute(array(
                ':pid' => $_REQUEST['profile_id'],
                ':rank' => $rank,
                ':year' => $year,
                ':desc' => $desc)
                );
                $rank++;
            }


            //Clear out the old education entries
            $deleteEducationStmt = $pdo->prepare('DELETE FROM education WHERE profile_id=:pid');
            $deleteEducationStmt->execute(array( ':pid' => $profile_id));
         // Insert Education Data
            $ranked = 1;
            for($k=1; $k<=9; $k++) {
                if ( ! isset($_POST['edu_year'.$k]) ) continue;
                if ( ! isset($_POST['edu_school'.$k]) ) continue;
                $year = $_POST['edu_year'.$k];
                $school = $_POST['edu_school'.$k];

                // lookup the school is its there
                $institution_id = false;
                $stmt = $pdo->prepare('SELECT institution_id FROM institution WHERE name = :name');
                $stmt->execute(array(':name'=> $school));

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row !== false) $institution_id = $row['institution_id'];

                // if there was no institution insert it
                if($institution_id === false){
                    $stmt = $pdo->prepare('INSERT INTO institution (name) VALUES (:name)');
                    $stmt->execute(array(':name' => $school));
                    $institution_id = $pdo->lastInsertId();
                }

               
                $stmt = $pdo->prepare('INSERT INTO education
                (profile_id, rank, year, institution_id) 
                VALUES ( :pid, :rank, :year, :institution_id)');
                $stmt->execute(array(
                ':pid' => $profile_id,
                ':rank' => $ranked,
                ':year' => $year,
                ':institution_id' => $institution_id));

                $ranked++;
            }


        addFlash('Updated Successfully');
        header("Location: index.php");
    }
?>

