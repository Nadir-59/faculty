<?php
// database connection
require_once "../connection.php";

if( !empty($_POST["subject"]) ){
    $selected_subjects = explode(',', $_POST["subject"]);
}else {
    $selected_subjects = array();
}

// Retrieve sections from the database
$sql = "SELECT DISTINCT subject FROM subject";
$result = mysqli_query($conn, $sql);

// Loop through the results and add options to the select element
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $subject = $row['subject'];
        echo "<option value=\"$subject\"";
        if (in_array($subject, $selected_subjects)) {
            echo " selected";
        }
        echo ">$subject</option>";
    }
}

?>

<!-- HTML form to select subject -->
<div class="form-group">
    <label for="subject">Subjects:</label>
    <select class="form-control" name="subjects[]" multiple>
        <option value="">Select subjects</option>
        <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '', 'employee_management');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $selected_subjects = "";


        // Retrieve subjects from the database
        $sql = "SELECT DISTINCT subject FROM subject";
        $result = mysqli_query($conn, $sql);

        // Loop through the results and add options to the select element
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $subject = $row['subject'];
                echo "<option value=\"$subject\"";
                if (in_array($subject, $selected_subjects)) {
                    echo " selected";
                }
                echo ">$subject</option>";
            }
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </select>
    <?php echo $subjectErr; ?>
</div>

