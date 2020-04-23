<?php require "partials/header.php"; ?> 

    <?php
        $user_id =  $_GET['user_id'];
        $profile_id =  $_GET['profile_id'];

        $fstmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $fstmt->execute(['id' => $profile_id]);
        $data = $fstmt->fetch();

        if(isset($_POST['delete']) && $data['profile_id']){

            $stmt = $pdo->prepare("DELETE  FROM profile WHERE profile_id = :id");
            $stmt->execute(['id' => $profile_id]);

            addFlash('Deleted Successfully');
            header("Location: index.php");

        }elseif (isset($_POST['cancel'])) {
            addFlash('Action Aborted');
            header("Location: index.php");
        }


        

    ?>
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">Delete RESUME <?php echo $profile_id; ?></h3> 
                    
                    <div class="float-right">
                       <?php 
                            if(authUser()){ echo "<a href='index.php' style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Home</a>" ;}
                            if(authUser()){ echo "<a href='logout.php' style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</a>" ;}

                         ?>
                     </div>
                     <p class="text-danger"> <?php authRedirect(); authUserProfile($user_id) ?></p>
                </div>
                <div class="card-body">
                <h5 class="mb-4">Are you sure?</h5> 
                <form method="post" action="">
                    <button type="submit" name="delete" style='border: white solid thin; color:' class='btn btn-warning btn-lg' >Delete</button>
                    <input type="submit" name="cancel" style='border: white solid thin; color: #5ab2f5;' class='btn btn-default btn-lg' value="CANCEL">
                </form>
                </div>
                <div class="card-footer">
                </div>
                </form>
        </section>
        </div>
        <footer></footer>
    <script src="" type = "text/javascript"></script>
    </body>
</html>

