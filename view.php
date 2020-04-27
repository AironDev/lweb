<?php require "partials/header.php"; ?> <!-- Inject single header partials here -->

    <?php 
        $id = $_GET['profile_id'];
        $profile_stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id ") ;
        $profile_stmt->execute(['id' => $id]);
        $profile = $profile_stmt->fetch();

        $position_stmt = $pdo->prepare("SELECT * FROM position WHERE profile_id = :id ") ;
        $position_stmt->execute(['id' => $id]);
        $positions = $position_stmt->fetchAll();


    ?>
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title"> <?php echo $profile['first_name'] . "'s " .'Profile'?></h3>  
                    <p class="text-success"> <?php showFlash(); removeFlash();  authRedirect(); ?></p>
                    <div class="float-right">
                       <?php if(authUser()):?>
                            <a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='add.php' >Add New</a>
                            <a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href="edit.php?profile_id=<?php echo $_GET['profile_id']; ?>" >Edit</a>
                            <a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='index.php'>Home</a>
                        <?php endif; ?>
                     </div>
                </div>
                <div class="card-body">
                        <table class="table table-bordered"> 
                                <tbody> 
                                    <tr>

                                        <td>
                                            <label>ID</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                               <?php echo $profile['profile_id']; ?>
                                             </data>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Name</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                                <?php echo $profile['first_name'] . " " . $profile['last_name']?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Email</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                                 <?php echo $profile['email']; ?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Headline</label>
                                             <data class="ml-5 flex" style="display: block;">
                                                <?php echo $profile['headline']; ?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>
                                            <label>Summary</label>
                                             <data class="ml-5" style="display: block;">
                                                <?php echo $profile['summary']; ?>
                                             </data>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Positions</label>
                                            <?php foreach ($positions as $position): ?>
                                            <data class="ml-5" style="display: block;">
                                                <div>Year: <span style="margin-left:60px"><?php echo $position['year']; ?></span> </div>
                                                <div>Descritption: <span class="ml-2"><?php echo $position['description']; ?></span></div>
                                                <hr>
                                            </data>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
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

