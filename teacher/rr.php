<?php
require_once "include/header.php";
?>

<?php




// Establish the database connection
$connection = mysqli_connect("localhost", "root", "", "faculty");

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}



// Retrieve filter values
$specialty_id = $_GET['specialty_id'] ?? '';
$level_id = $_GET['level_id'] ?? '';
$section_id = $_GET['section_id'] ?? '';
$grp_id = $_GET['grp_id'] ?? '';
$subject = $_GET['subject'] ?? '';
$type = $_GET['type'] ?? '';

// Prepare the SQL query with filters
$sql = "SELECT name, specialty_id, level_id, section_id, grp_id
        FROM students
        LEFT JOIN attendance ON students.id = attendance.student_id AND attendance.subject = '$subject' AND attendance.type = '$type'
        WHERE 1=1";

if (!empty($specialty_id)) {
    $sql .= " AND students.specialty_id = $specialty_id";
}

if (!empty($level_id)) {
    $sql .= " AND students.level_id = $level_id";
}

if (!empty($section_id)) {
    $sql .= " AND students.section_id = $section_id";
}

if (!empty($grp_id)) {
    $sql .= " AND students.grp_id = $grp_id";
}

// Execute the query and fetch the results
$result = mysqli_query($connection, $sql);

// Check if the query was successful
if ($result) {
    // Display the form and table
    ?>
   <!-- HTML FORM STARTS HERE -->
    <form method="POST" action="attendance_save.php">
        <input type="hidden" name="subject" value="<?php echo $subject; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <label for="specialty_id">Specialty:</label>
        <select name="specialty_id" id="specialty_id">
            <option value="">All Specialties</option>
            <?php
            // Retrieve specialties from the "specialty" table and populate the options
            $query = "SELECT * FROM specialty";
            $specialties = mysqli_query($connection, $query);
            while ($specialtyRow = mysqli_fetch_assoc($specialties)) {
                $specialtyId = $specialtyRow['id'];
                $specialtyName = $specialtyRow['name'];
                $selected = ($specialty_id == $specialtyId) ? 'selected' : '';
                echo "<option value='$specialtyId' $selected>$specialtyName</option>";
            }
            ?>
        </select>

        <label for="level_id">Level:</label>
        <select name="level_id" id="level_id">
            <option value="">All Levels</option>
            <?php
            // Retrieve levels from the "level" table and populate the options
            $query = "SELECT * FROM level";
            $levels = mysqli_query($connection, $query);
            while ($levelRow = mysqli_fetch_assoc($levels)) {
                $levelId = $levelRow['id'];
                $levelName = $levelRow['name'];
                $selected = ($level_id == $levelId) ? 'selected' : '';
                echo "<option value='$levelId' $selected>$levelName</option>";
            }
            ?>
        </select>

        <label for="section_id">Section:</label>
        <select name="section_id" id="section_id">
            <option value="">All Sections</option>
            <?php
            // Retrieve sections from the "section" table and populate the options
            $query = "SELECT * FROM section";
            $sections = mysqli_query($connection, $query);
            while ($sectionRow = mysqli_fetch_assoc($sections)) {
                $sectionId = $sectionRow['id'];
                $sectionName = $sectionRow['name'];
                $selected = ($section_id == $sectionId) ? 'selected' : '';
                echo "<option value='$sectionId' $selected>$sectionName</option>";
            }
            ?>
        </select>

        <label for="grp_id">Group:</label>
        <select name="grp_id" id="grp_id">
            <option value="">All Groups</option>
            <?php
            // Retrieve groups from the "grp" table and populate the options
            $query = "SELECT * FROM grp";
            $grps = mysqli_query($connection, $query);
            while ($grpRow = mysqli_fetch_assoc($grps)) {
                $grpId = $grpRow['id'];
                $grpName = $grpRow['name'];
                $selected = ($grp_id == $grpId) ? 'selected' : '';
                echo "<option value='$grpId' $selected>$grpName</option>";
            }
            ?>
        </select>

        <button type="submit">Save Attendance</button>

        <!-- ATTENDANCE TABLE STARTS HERE -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Specialty</th>
                    <th>Level</th>
                    <th>Section</th>
                    <th>Group</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop over the results and display the attendance form for each student
                while ($row = mysqli_fetch_assoc($result)) {
                    $student_id = $row['id'];
                    $name = $row['name'];
                    $specialty = $row['specialty_id'];
                    $level = $row['level_id'];
                    $section = $row['section_id'];
                    $grp = $row['grp_id'];
                    $attendance = $row['attendance'];

                    echo "<tr>
                            <td>$name</td>
                            <td>$specialty</td>
                            <td>$level</td>
                            <td>$section</td>
                            <td>$grp</td>
                            <td>
                                <input type='radio' name='attendance[$student_id]' value='present' " . ($attendance == 'present' ? 'checked' : '') . "> Present
                                <input type='radio' name='attendance[$student_id]' value='absent' " . ($attendance == 'absent' ? 'checked' : '') . "> Absent
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <!-- HTML FORM ENDS HERE -->

    <?php
} else {
    // Display an error message if the query failed
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?><?php 
    require_once "include/footer.php";
?>
