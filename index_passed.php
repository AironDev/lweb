<?php ob_start(); session_start();  ?>
    <?php require "partials/header.php"; ?> 
    <?php 

        $stmt = $pdo->prepare("SELECT * FROM profile");
        $stmt->execute();
        $data = $stmt->fetchAll();

    ?>
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">RESUMES</h3>  
                    <p class="text-success"> <?php showFlash(); removeFlash();      //authRedirect(); ?></p> 
                    <div class="float-right">
                        <table border="1">
                       <?php 
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/add.php' >Add New Entry</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</a>" ;}
                            if(!authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/login.php'>Please log in</a>" ;}

                         ?>
                     </div>
                </div>
                <div class="card-body">

                        <table class="table table-striped"> 
                                <tr>  
                                    <th>Name</th>
                                    <th>Headline</th>
                                    <th>Action</th>
                                </tr>
                                
                                
                                    <?php 

                                        foreach ($data as $key => $value) {

                                                if(authUser()){ 
                                                    $profileId = $value['profile_id'];
                                                     $userId = $value['user_id'];


                                                    $btn = "<a href='view.php?profile_id=$profileId' class='btn btn-sm btn-default'>View</a>
                                                            <a href='edit.php?profile_id=$profileId' class='btn btn-sm'>Edit</a>
                                                            <a href='delete.php?profile_id=$profileId' name='delete' class='btn btn-sm'>Delete</a>";

                                                }else{
                                                    $btn = "<a href='view.php?profile_id=$profileId' class='btn btn-sm btn-default'><i class='fa fa-book'></i></a>";
                                                };

                                            echo "<tr>" .  "<td>" . $value['first_name']. ' '. $value['last_name']. "</td>".  "<td>" . substr($value['headline'], 0, 50).' ...'. "</td>". "<td class='' style='width: 20% !important;'>". $btn . "</td>" .  "</tr>";
                                        }
                                    ?>

                        </table>
                </div>
                <div class="card-footer">
                    <?php echo $_SESSION['user_id']; ?>
                </div>
        </section>
        </div>
        <footer></footer>
    <script src="" type = "text/javascript"></script>
    </body>
</html>

