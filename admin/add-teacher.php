<?php 
    require_once "include/header.php";
?>

<?php
    $nameErr = $emailErr = $passErr = "";
    $name = $email = $pass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "<p style='color:red'> * Name is required</p>";
        } else {
            $name = $_POST["name"];
        }

        if (empty($_POST["email"])) {
            $emailErr = "<p style='color:red'> * Email is required</p> ";
        } else {
            $email = $_POST["email"];
        }

        if (empty($_POST["pass"])) {
            $passErr = "<p style='color:red'> * Password is required</p> ";
        } else {
            $pass = $_POST["pass"];
        }

        if (!empty($name) && !empty($email) && !empty($pass)) {
            // Database connection
            require_once "../connection.php";

            $sql_select_query = "SELECT email FROM teacher WHERE email = '$email'";
            $result = mysqli_query($conn, $sql_select_query);

            if (mysqli_num_rows($result) > 0) {
                $emailErr = "<p style='color:red'> * Email Already Registered</p>";
            } else {
                // Insert teacher into the teacher table
                $sql = "INSERT INTO teacher (name, email, password) VALUES ('$name', '$email', '$pass')";
                $insert_result = mysqli_query($conn, $sql);

                if ($insert_result) {
                    $teacher_id = mysqli_insert_id($conn); // Get the ID of the inserted teacher

                    // Get the selected subjects from the form
                    $selected_subjects = $_POST["subjects"];

                    // Insert teacher-subject relationship into the teacher_subject table
                    foreach ($selected_subjects as $subject_id) {
                        $sql = "INSERT INTO teacher_subject (teacher_id, subject_id) VALUES ($teacher_id, $subject_id)";
                        mysqli_query($conn, $sql);
                    }

                    $name = $email = $pass = "";
                    echo "<script>
                        $(document).ready(function() {
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-teacher.php');
                            $('#linkBtn').text('View teachers');
                            $('#addMsg').text('Teacher added successfully!');
                            $('#closeBtn').text('Add More?');
                        });
                    </script>";
                } else {
                    echo "<script>alert('Error: Unable to add teacher.');</script>";
                }
            }
        }
    }
?>

<div style="">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">
                                <h4 class="text-center">Add New Teacher</h4>
                                <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" value="<?php echo $name; ?>" name="name">
                                        <?php echo $nameErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                        <?php echo $emailErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass">
                                        <?php echo $passErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Subjects:</label>
                                        <?php
                                            // Database connection
                                            require_once "../connection.php";

                                            // Retrieve subjects from the subject table
                                            $sql = "SELECT id, name FROM subject";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $subject_id = $row['id'];
                                                    $subject_name = $row['name'];
                                                    echo "<div class='form-check'>";
                                                    echo "<input class='form-check-input' type='checkbox' name='subjects[]' value='$subject_id'>";
                                                    echo "<label class='form-check-label'>$subject_name</label>";
                                                    echo "</div>";
                                                }
                                            }
                                        ?>
                                    </div>

                                    <br>

                                    <button type="submit" class="btn btn-primary btn-block">Add</button>
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
