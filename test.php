
<?php require "partials/header.php"; ?> 
    <?php 
        $id = 4;

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
        <form method="post" class="form col-md-10" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label class="label-for-summary">Summary</label>
            <textarea cols="10"  rows="5" name="summary" id="summary" onmouseleave="return validateAddNew('summary')" class="form-control"><?php echo $oldProfileData['summary']?></textarea>
            <p id="summaryErr" class="text-danger"></p>
            
            <?php foreach ($oldPositions as  $position): ?>
            <div id="<?php echo "position".$position['position_id']; ?>" >                              
                <input type="text" name="<?php echo "year".$position['position_id']; ?>" value="<?php echo $position['year'] ?>" class="form-control col-sm-8 float-left" placeholder="Year">
                <button id="" onclick=" return false" class="form-control col-sm-2 float-right">-</button>
                <textarea name="<?php echo "desc".$position['position_id']; ?>" cols="80" rows="5" class="form-control" placeholder="Description"><?php echo $position['description'] ?></textarea>
            </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary" name="submit" onclick="//validateNew()">Save</button>
        </form>
        </div>
    </body>

<?php 
    if(isset($_POST['submit'])){

        // $newProfileData = array(
        //     ':user_id' => $_SESSION['user_id'],
        //     ':fname' => $_POST['first_name'],
        //     ':lname' => $_POST['last_name'],
        //     ':email' => $_POST['email'],
        //     ':headline' => $_POST['headline'],
        //     ':summary' => $_POST['summary'],
        //     ':profile_id' => $_POST['profile_id']
        // );
        // $updateProfileSql = "UPDATE profile SET user_id=:user_id, first_name=:fname, last_name=:lname, email=:email, headline=:headline, summary=:summary WHERE profile_id=:profile_id";
        

        // $updateProfileStmt = $pdo->prepare($updateProfileSql);
        // $updateProfileStmt->execute($newProfileData);
        //  $id = $_GET['profile_id'];
        // $getPositionStmt = $pdo->prepare("SELECT * FROM position WHERE profile_id = :id");
        // $getPositionStmt->execute(['id' => $id]);
        // $oldPositions = $getPositionStmt->fetch();
      foreach($oldPositions as $position){
            $num = $position['year'];
            echo $num;
           


            // $newPositionData = array(
            // ':year' => $_POST[$yr],
            // ':description' => $_POST[$des],
            // ':profile_id' => $position['profile_id'],
            // ':rank' => $position['rank']
            // );

            // $updatePositionSql = "UPDATE position SET year=:year, description=:description, profile_id=:profile_id, rank=:rank WHERE profile_id=:profile_id";

            // $updatePositionStmt = $pdo->prepare($updatePositionSql);
            // $updatePositionStmt->execute($newPositionData);
        }
        


        // $profile_id = $_POST['profile_id'];
        // addFlash('Updated Successfully');
        // header("Location: index.php");
    }
?>