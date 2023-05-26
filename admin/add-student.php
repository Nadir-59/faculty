<?php 
    require_once "include/header.php";
?>

<?php
    require_once "include/header.php";
?>

<?php
    $nameErr = $emailErr = $dobErr = $genderErr =$mobileErr = $sectionErr = $grpErr = $levelErr =  "";
    $name = $email = $dob = $gender = $mobile = $section = $grp = $level =  "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    
        // Validate and retrieve form data
        if (empty($_POST["name"])) {
            $nameErr = "<p style='color:red'> * Name is required</p> ";
        } else {
            $name = $_POST["name"];
        }

        if (empty($_POST["dob"])) {
            $dobErr = "<p style='color:red'> * dob is required</p> ";
        } else {
            $dob = $_POST["dob"];
        }

        if (empty($_POST["gender"])) {
            $genderErr = "<p style='color:red'> * gender is required</p> ";
        } else {
            $gender = $_POST["gender"];
        }
    
        if (empty($_POST["email"])) {
            $emailErr = "<p style='color:red'> * Email is required</p> ";
        } else {
            $email = $_POST["email"];
        }
    
        if (empty($_POST["mobile"])) {
            $mobileErr = "<p style='color:red'> * Mobile is required</p> ";
        } else {
            $mobile = $_POST["mobile"];
        }
    
        if (empty($_POST["level"])) {
            $levelErr = "<p style='color:red'> * level is required</p> ";
        } else {
            $level = $_POST["level"];
        }
    
        if (empty($_POST["section"])) {
            $sectionErr = "<p style='color:red'> * Section is required</p> ";
        } else {
            $section = $_POST["section"];
        }
    
        if (empty($_POST["grp"])) {
            $grpErr = "<p style='color:red'> * Group is required</p> ";
        } else {
            $grp = $_POST["grp"];
        }
    
        
    
        if (!empty($name) && !empty($email) && !empty($mobile)) {
            // Database connection
            require_once "../connection.php";
    
            $sql_select_query = "SELECT email FROM students WHERE email = '$email' ";
            $result = mysqli_query($conn, $sql_select_query);
    
            if (mysqli_num_rows($result) > 0) {
                $emailErr = "<p style='color:red'> * Email Already Registered</p>";
            } else {
                $sql = "INSERT INTO students (name, email, dob, gender, mobile, level_id, section_id, grp_id) 
                        VALUES('$name', '$email', '$dob', '$gender', '$mobile', '$level', '$section', '$grp')";
                $insert_result = mysqli_query($conn, $sql);
    
                if ($insert_result) {
                    $name = $email = $dob = $gender = $mobile = $section = $grp = $mix =  "";
                    echo "<script>
                            $(document).ready(function() {
                                $('#showModal').modal('show');
                                $('#modalHead').hide();
                                $('#linkBtn').attr('href', 'manage-student.php');
                                $('#linkBtn').text('View students');
                                $('#addMsg').text('Student added successfully!');
                                $('#closeBtn').text('Add More?');
                            });
                         </script>";
                } else {
                    echo "<script>alert('Error: Unable to add student.');</script>";
                }
            }
        }
    }
    
    ?>

<!-- CSS styles -->
<style>
    /* Add your CSS styles here */
</style>

<!-- Rest of the HTML code remains the same -->

<div style="">
    <div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">
                                <h4 class="text-center">Add New Student</h4>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <!-- Form fields -->

                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" value="<?php echo $name; ?>"
                                            name="name">
                                        <?php echo $nameErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob">
                                        <?php echo $dobErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                value="Male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                value="Female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <?php echo $genderErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>"
                                            name="email">
                                        <?php echo $emailErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile:</label>
                                        <input type="text" class="form-control" value="<?php echo $mobile; ?>"
                                            name="mobile">
                                        <?php echo $mobileErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="level">level:</label>
                                        <select class="form-control" name="level">
                                            <option value="">Select a level</option>
                                            <?php
                                                                                        require_once "../connection.php";

                                                // Retrieve level from the database
                                                $sql = "SELECT id, name FROM level";
                                                $result = mysqli_query($conn, $sql);

                                                // Loop through the results and add options to the select element
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $level_id = $row['id'];
                                                        $level_name = $row['name'];
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
                                            require_once "../connection.php";
                                                // Retrieve sections from the database
                                                $sql = "SELECT id, name FROM section";
                                                $result = mysqli_query($conn, $sql);

                                                // Loop through the results and add options to the select element
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $section_id = $row['id'];
                                                        $sct_name = $row['name'];
                                                        echo "<option value=\"$section_id\">$sct_name</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php echo $sectionErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="grp">Groupe:</label>
                                        <select class="form-control" name="grp">
                                            <option value="">Select a group</option>
                                            <?php
                                            require_once "../connection.php";
                                                // Retrieve groups from the database
                                                $sql = "SELECT id, name FROM grp";
                                                $result = mysqli_query($conn, $sql);

                                                // Loop through the results and add options to the select element
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $grp_id = $row['id'];
                                                        $grp_name = $row['name'];
                                                        echo "<option value=\"$grp_id\">$grp_name</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php echo $grpErr; ?>
                                    </div>

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