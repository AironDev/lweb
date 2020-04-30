<?php require "partials/header.php"; ?> 
    <body>
        <header></header>
        <div class="container">
            <section class="card white">
                <div class="card-header">
                    <h3 class="card-title">ADD RESUME</h3>  
                    <p class="text-danger"> <?php showFlash(); removeFlash(); authRedirect(); ?></p>
                    <!-- <p class="text-danger">All values are required</p>
 -->
                    <div class="float-right">
                       <?php 
                            if(authUser()){ echo "<a href='index.php' style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Home</a>" ;}
                            if(authUser()){ echo "<a style='border: white solid thin; color: #5ab2f5;' class='btn btn-default'>Logout</a>" ;}
                         ?>
                     </div>
                </div>
                <div class="card-body">
                    <form method="post" class="form col-md-10" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                        <p id="allErr" class="text-danger"></p>
                        <label class="label-for-fname" >First Name</label>
                        <input type="text"  name="first_name" id="fname" class="form-control" onmouseleave="return validateAddNew('fname')">
                        <p id="fnameErr" class="text-danger"></p>

                        <label class="label-for-lname">Last Name</label>
                        <input type="text"   name="last_name" id="lname" class="form-control" onmouseleave="return validateAddNew('lname')">
                        <p id="lnameErr" class="text-danger"></p>

                        <label class="label-for-email">Email</label>
                        <input type="email"  name="email" id="email" class="form-control" onmouseleave="return validateAddNew('email')">
                        <p id="emailErr" class="text-danger"></p>

                        <label class="label-for-headline">Headline</label>
                        <input type="text"  name="headline" id="headline" class="form-control" onmouseleave="return validateAddNew('headline')">
                        <p id="headlineErr" class="text-danger"></p>

                        <label class="label-for-summary">Summary</label>
                        <textarea cols="10"   rows="5" name="summary" id="summary" class="form-control" onmouseleave="return validateAddNew('summary')" ></textarea>
                        <p id="summaryErr" class="text-danger"></p>
                        <label class="label-for-position">Position</label>
                        <button id="addPos" onclick="return false">+</button>
                        <div id="position_fields">
                            <!-- position fiels are injected here from jquery -->
                        </div>
                        <hr/>
                        <button type="submit" value="Add" class="btn btn-primary mt-2" name="submit" onmouseover="validateAddNew('submit')">Add</button>
                        
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

       if($_POST['headline'] != null || $_POST['first_name'] != "" ||  $_POST['email'] != ""){
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

            $profile_id = $pdo->lastInsertId();

            
            $rank = 1;
            for($i=1; $i<=9; $i++) {
                if ( ! isset($_POST['year'.$i]) ) continue;
                if ( ! isset($_POST['desc'.$i]) ) continue;
                $year = $_POST['year'.$i];
                $desc = $_POST['desc'.$i];

                if (strlen($year) == 0 || strlen($desc) == 0) {
                    addFlash("All fields are required");
                    header("Location: add.php");
                }

                 if (!is_numeric($year)) {
                    addFlash("Position year must be numeric ");
                    header("Location: add.php");
                }

                $stmt = $pdo->prepare('INSERT INTO position
                (profile_id, rank, year, description) 
                VALUES ( :pid, :rank, :year, :desc)');
                $stmt->execute(array(
                ':pid' => $profile_id,
                ':rank' => $rank,
                ':year' => $year,
                ':desc' => $desc));
                $rank++;
            }

            addFlash('Added Successfully');
            header("Location: index.php");
            return;
       }else{
           addFlash('All values are required');
       }
    }
?>

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