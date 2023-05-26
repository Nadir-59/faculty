

<?php  
    $nameErr = $emailErr = $mobileErr = $sectionErr = $grpErr = $levelErr = "";
    $name = $email = $dob = $gender = $mobile = $section = $grp = $level = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... existing code ...

        if (empty($_POST["level"])) {
            $levelErr = "<p style='color:red'> * Level is required</p> ";
        } else {
            $level = $_POST["level"];
        }

        if (empty($_POST["section"])) {
            $sectionErr = "<p style='color:red'> * Section is required</p> ";
        } else {
            $section = $_POST["section"];
        }

        if (empty($_POST["grp"])) {
            $grpErr = "<p style='color:red'> * grp is required</p> ";
        } else {
            $grp = $_POST["grp"];
        }

        if (!empty($name) && !empty($email) && !empty($mobile)) {
            // database connection
            require_once "../connection.php";

            $sql_select_query = "SELECT email FROM student WHERE email = '$email' ";
            $r = mysqli_query($conn, $sql_select_query);

            if (mysqli_num_rows($r) > 0) {
                $emailErr = "<p style='color:red'> * Email Already Register</p>";
            
                        } else {
                            $sql = "INSERT INTO students (name, email, dob, gender, mobile, section_id, grp_id, level_id) 
                                    VALUES('$name', '$email', '$dob', '$gender', '$mobile', '$section', '$grp', '$level')";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $name = $email = $dob = $gender = $mobile = $section = $grp = $level = "";
                                echo "<script>
                                        $(document).ready( function(){
                                            $('#showModal').modal('show');
                                            $('#modalHead').hide();
                                            $('#linkBtn').attr('href', 'manage-student.php');
                                            $('#linkBtn').text('View students');
                                            $('#addMsg').text('Student added successfully!');
                                            $('#closeBtn').text('Add More?');
                                        })
                                     </script>";
                            }
                        }
                    }
                }
            
        
    
?>

<!-- Rest of the HTML code remains the same -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Attendance Students</title>
    
    <link href="../resorce/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <style> 
     .hidden {
         display: none;
     }
    </style>

<div style="">
    <div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">
                                <h4 class="text-center">Add New Student</h4>
                                <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


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

                                    <?php
require_once "../connection.php";
?>


                                    <div class="form-group">
                                        <label for="level">Level:</label>
                                        <select class="form-control" name="level">
                                            <option value="">Select a level</option>
                                            <?php
        // Retrieve levels from the database
        $sql = "SELECT level_id, level_name FROM level";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $level_id = $row['level_id'];
                $level_name = $row['level_name'];
                echo "<option value=\"$level_id\">$level_name</option>";
            }
        }
        ?>
                                        </select>
                                        <?php echo $levelErr; ?>
                                    </div>







                                    <div class="form-group">
                                        <label for="section">Section:</label>
                                        <select class="form-control" name="section">
                                            <option value="">Select a section</option>
                                            <?php
        // Retrieve sections from the database
        $sql = "SELECT section_id, section_name FROM section";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $section_id = $row['section_id'];
                $section_name = $row['section_name'];
                echo "<option value=\"$section_id\">$section_name</option>";
            }
        }
        ?>
                                        </select>
                                        <?php echo $sectionErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="grp">groupe:</label>
                                        <select class="form-control" name="grp">
                                            <option value="">Select a groupe</option>
                                            <?php
        // Retrieve grps from the database
        $sql = "SELECT grp_id, grp_name FROM grp";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $grp_id = $row['grp_id'];
                $grp_name = $row['grp_name'];
                echo "<option value=\"$grp_id\">$grp_name</option>";
            }
        }
        ?>
                                        </select>
                                        <?php echo $grpErr; ?>
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

                                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>

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