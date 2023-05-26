<?php 
    require_once "include/header.php";
?>

<?php 
    require_once "include/header.php";
?>

<?php
    require_once "include/header.php";
?>


<?php  


         $id = $_GET["id"];
        require_once "../connection.php";

        $sql = "SELECT * FROM student WHERE id = $id ";
        $result = mysqli_query($conn , $sql);

        if(mysqli_num_rows($result) > 0 ){
        
            while($rows = mysqli_fetch_assoc($result) ){
                $name = $rows["name"];
                $email = $rows["email"];
                $dob = $rows["dob"];
                $gender = $rows["gender"];
                $mobile = $rows["mobile"];
                $section = $rows["section"];
                $groupe = $rows["groupe"];
            }
        }

        $nameErr = $emailErr = $mobileErr= $sectionErr= $groupeErr= "";
        
      

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["gender"]) ){
                $gender ="";
            }else {
                $gender = $_REQUEST["gender"];
            }


            if( empty($_REQUEST["dob"]) ){
                $dob = "";
            }else {
                $dob = $_REQUEST["dob"];
            }

            if( empty($_REQUEST["name"]) ){
                $nameErr = "<p style='color:red'> * Name is required</p>";
                $name = "";
            }else {
                $name = $_REQUEST["name"];
            }

            if( empty($_REQUEST["mobile"]) ){
                $mobileErr = "<p style='color:red'> * mobile is required</p>";
                $mobile = "";
            }else {
                $mobile = $_REQUEST["mobile"];
            }

            if (empty($_REQUEST["section"])) {
                $sectionErr = "<p style='color:red'> * Section is required</p> ";
            } else {
                $section = $_REQUEST["section"];
            }
        
            if (empty($_REQUEST["groupe"])) {
                $groupeErr = "<p style='color:red'> * Groupe is required</p> ";
            } else {
                $groupe = $_REQUEST["groupe"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Email is required</p> ";
                $email = "";
            }else{
                $email = $_REQUEST["email"];
            }

            

            if( !empty($name) && !empty($email) && !empty($mobile) ){

                // database connection
                // require_once "../connection.php";

                $sql_select_query = "SELECT email FROM student WHERE email = '$email' ";
                $r = mysqli_query($conn , $sql_select_query);

                
                   

                    $sql = "UPDATE student SET name = '$name' , email = '$email' , dob='$dob', gender='$gender' , mobile='$mobile' , section='$section' , groupe='$groupe' WHERE id = $_GET[id] ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-student.php');
                            $('#linkBtn').text('View students');
                            $('#addMsg').text('Profile Edit Successfully!');
                            $('#closeBtn').text('Edit Again?');
                        })
                     </script>
                     ";
                    }
                    
                

            }
        }

?>



<div style="">
    <div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">
                                <h4 class="text-center">Edit student profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Full Name :</label>
                                        <input type="text" class="form-control" value="<?php echo $name; ?>"
                                            name="name">
                                        <?php echo $nameErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>"
                                            name="email">
                                        <?php echo $emailErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Mobile :</label>
                                        <input type="number" class="form-control" value="<?php echo $mobile; ?>"
                                            name="mobile">
                                        <?php echo $mobileErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="section">Section:</label>
                                        <select class="form-control" name="section">
                                            <option value="">Select a section</option>
                                            <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'employee_management');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $selected_section = "";
        $sectionErr = "";


        // Retrieve sections from the database
        $sql = "SELECT DISTINCT section FROM secgrp";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $section = $row['section'];
                echo "<option value=\"$section\"";
                if ($section == $selected_section) {
                    echo " selected";
                }
                echo ">$section</option>";
            }
        }

        // Close database connection
        mysqli_close($conn);
        ?>
                                        </select>
                                        <?php echo $sectionErr; ?>

                                    </div>

                                    <div class="form-group">
                                        <label for="groupe">Groupe:</label>
                                        <select class="form-control" name="groupe">
                                            <option value="">Select a groupe</option>
                                            <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'employee_management');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $selected_groupe = "";
        $groupeErr = "";


        // Retrieve groupes from the database
        $sql = "SELECT DISTINCT groupe FROM secgrp";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $groupe = $row['groupe'];
                echo "<option value=\"$groupe\"";
                if ($groupe == $selected_groupe) {
                    echo " selected";
                }
                echo ">$groupe</option>";
            }
        }

        // Close database connection
        mysqli_close($conn);
        ?>
                                        </select>
                                        <?php echo $groupeErr; ?>
                                    </div>



                                    <div class="form-group">
                                        <label>Date-of-Birth :</label>
                                        <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob">

                                    </div>

                                    <div class="form-group form-check form-check-inline">
                                        <label class="form-check-label">Gender :</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                            <?php if($gender == "Male" ){ echo "checked"; } ?> value="Male" selected>
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                            <?php if($gender == "Female" ){ echo "checked"; } ?> value="Female">
                                        <label class="form-check-label">Female</label>
                                    </div>


                                    <br>

                                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


<?php 
    require_once "include/footer.php";
?>


<?php 
    require_once "include/footer.php";
?>