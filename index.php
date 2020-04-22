    
    <!-- Inject single header partials here -->
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
                       <?php 
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/add.php' >Add New</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</a>" ;}
                            if(!authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/login.php'>Login</a>" ;}

                         ?>
                     </div>
                </div>
                <div class="card-body">
                        <table class="table table-striped"> 
                                <thead>  
                                    
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Email</th>
                                    <th>Headline</th>
                                    <th></th>
                                </thead>
                                <tbody> 
                                    <?php 

                                        foreach ($data as $key => $value) {

                                                if(authUser()){ 
                                                    $profileId = $value['profile_id'];
                                                     $userId = $value['user_id'];


                                                    $btn = "<a href='view.php?profile_id=$profileId' class='btn btn-sm btn-default'><i class='fa fa-book'></i></a>
                                                            <a href='edit.php?profile_id=$profileId class='btn btn-sm'><i class='fa fa-edit'></i></a>
                                                            <a href='delete.php?user_id=$userId&profile_id=$profileId' name='delete' class='btn btn-sm'><i class='fa fa-eraser'></i></a>";

                                                }else{
                                                    $btn = "<a href='view.php?id=3' class='btn btn-sm btn-default'><i class='fa fa-book'></i></a>";
                                                };

                                            echo "<tr>" . "<td>" . $value['profile_id']. "</td>".  "<td>" . $value['first_name']. "</td>". "<td>" . $value['email']. "</td>". "<td>" . substr($value['headline'], 0, 50).' ...'. "</td>". "<td class='' style='width: 20% !important;'>". $btn . "</td>" .  "</tr>";
                                        }
                                    ?>
                                    
                                </tbody>
                        </table>
                </div>
                <div class="card-footer">
                    
                </div>
        </section>
        </div>
        <footer></footer>
    <script src="" type = "text/javascript"></script>
    </body>
</html>