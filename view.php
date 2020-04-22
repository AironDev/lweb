    
    <!-- Inject single header partials here -->
    <?php require "partials/header.php"; ?> 

    <?php 
        $id = $_GET['profile_id'];
        $stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

    ?>
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title"> <?php echo $data['first_name'] . "'s " .'Profile'?></h3>  
                    <p class="text-success"> <?php showFlash(); removeFlash();  authRedirect(); ?></p>
                    <div class="float-right">
                       <?php 
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/login.php' >Add New</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Edit</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default' href='/index.php'>Home</a>" ;}

                         ?>
                     </div>
                </div>
                <div class="card-body">
                        <table class="table table-bordered"> 
                                <tbody> 
                                    <tr>

                                        <td>
                                            <label>ID</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                               <?php echo $data['profile_id']; ?>
                                             </data>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Name</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                                <?php echo $data['first_name'] . " " . $data['last_name']?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Email</label>
                                             <data class="ml-3" style="display: inline-flex;">
                                                 <?php echo $data['email']; ?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Headline</label>
                                             <data class="ml-5 flex" style="display: block;">
                                                <?php echo $data['headline']; ?>
                                             </data>
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>
                                            <label>Summary</label>
                                             <data class="ml-5" style="display: block;">
                                                <?php echo $data['summary']; ?>
                                             </data>
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

