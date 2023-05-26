<?php 
    require_once "include/header.php";
?>

<div>
  <?php
    // Establish the database connection
    $connection = mysqli_connect("localhost", "root", "", "faculty");

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }




  


    

    // Retrieve filter values
    $level = $_GET['level'] ?? '';
    $section = $_GET['section'] ?? '';
    $grp = $_GET['grp'] ?? '';

    // Prepare the SQL query with filters
    $sql = "SELECT * FROM students WHERE 1=1";

    if (!empty($level)) {
      $sql .= " AND level_id = $level";
    }

    if (!empty($section)) {
      $sql .= " AND section_id = $section";
    }

    if (!empty($grp)) {
      $sql .= " AND grp_id = $grp";
    }

    // Execute the query and fetch the results
    $result = mysqli_query($connection, $sql);

    // Check if the query was successful
    if ($result) {
        // Display the form and table

        $subjectCheckboxes = ''; // Initialize the variable
        $studentId = 0;

        // Fetch the teacher's information and subjects taught
        $teacherName = "bahlouli boualem"; // Replace with the actual teacher's name
        $query = "SELECT t.id, t.name, ts.subject_id, s.name AS subject_name
                  FROM teacher t
                  INNER JOIN teacher_subject ts ON t.id = ts.teacher_id
                  INNER JOIN subject s ON ts.subject_id = s.id
                  WHERE t.name = '$teacherName'";
        $teacherResult = mysqli_query($connection, $query);
        
        if (mysqli_num_rows($teacherResult) > 0) {
            $teacherRow = mysqli_fetch_assoc($teacherResult);
            $teacherId = $teacherRow['id'];
            $teacherName = $teacherRow['name'];
        
            // Generate checkboxes for subjects taught by the teacher
            do {
                $subjectId = $teacherRow['subject_id'];
                $subjectName = $teacherRow['subject_name'];
                $subjectCheckboxes .= "<div class='form-check'>
                                            <input type='checkbox' name='subject' value='{$subjectName}' class='form-check-input'>
                                            <label class='form-check-label'>{$subjectName}</label>
                                        </div>";
            } while ($teacherRow = mysqli_fetch_assoc($teacherResult));
        
            // ...
        
        } else {
            echo "Teacher not found.";
        }


        ?>
  <form method="GET" action="">
    <div class="d-flex align-items-center">


    <label for="level" class="ml-2">level:</label>
        <select name="level" id="level" class="form-control ml-2" style="width:11%">
            <option value="">All levels</option>
            <?php
            // Retrieve levels from the "level" table and populate the options
            $query = "SELECT * FROM level";
            $levels = mysqli_query($connection, $query);
            while ($levelRow = mysqli_fetch_assoc($levels)) {
                $levelId = $levelRow['id'];
                $levelName = $levelRow['name'];
                $selected = ($level == $levelId) ? 'selected' : '';
                echo "<option value='$levelId' $selected>$levelName</option>";
            }
            ?>
        </select>


        

        <label for="section" class="ml-2">Section:</label>
        <select name="section" id="section" class="form-control ml-2" style="width:11%">
            <option value="">All Sections</option>
            <?php
            // Retrieve sections from the "section" table and populate the options
            $query = "SELECT * FROM section";
            $sections = mysqli_query($connection, $query);
            while ($sectionRow = mysqli_fetch_assoc($sections)) {
                $sectionId = $sectionRow['id'];
                $sectionName = $sectionRow['name'];
                $selected = ($section == $sectionId) ? 'selected' : '';
                echo "<option value='$sectionId' $selected>$sectionName</option>";
            }
            ?>
        </select>

        <label for="grp" class="ml-2">grp:</label>
        <select name="grp" id="grp" class="form-control ml-2" style="width:11%">
            <option value="">All grps</option>
            <?php
            // Retrieve grp from the "grp" table and populate the options
            // Replace with the actual teacher's name
            $query = "SELECT * FROM grp";
            $grps = mysqli_query($connection, $query);
            while ($grpRow = mysqli_fetch_assoc($grps)) {
                $grpId = $grpRow['id'];
                $grpName = $grpRow['name'];
                $selected = ($grp == $grpId) ? 'selected' : '';
                echo "<option value='$grpId' $selected>$grpName</option>";
            }
            ?>
        </select>

        <input type="submit" value="Filter" class="btn btn-primary ml-2" style="width:10%">
    </div>
    <br><br>
    <div>

    <?php echo $subjectCheckboxes; ?>


    </div>



</form>

</div>

<style>
  table,
  th,
  td {
    border: 1px solid black;
    padding: 15px;
  }

  table {
    border-spacing: 10px;
  }
</style>

<div class="container bg-white shadow">
  <div class="py-4 mt-5">
    <div class='text-center pb-2'>
      <h4>Attendance</h4>
    </div>

    <form method="POST" action="save_attendance.php" id="attendanceForm">
        <select name="attendance" id="level" class="form-control ml-2" style="width:11%">
           
        <?php 
            // Retrieve levels from the "level" table and populate the options
            $teacherName = $_SESSION["teacher_name"];
            $query = "SELECT t.id, t.name, ts.subject_id, s.name AS subject_name
                  FROM teacher t
                  INNER JOIN teacher_subject ts ON t.id = ts.teacher_id
                  INNER JOIN subject s ON ts.subject_id = s.id
                  WHERE t.name = '$teacherName'";
            $levels = mysqli_query($connection, $query);
            while ($levelRow = mysqli_fetch_assoc($levels)) {
                $levelId = $levelRow['id'];
                $levelName = $levelRow['subject_name'];
                $selected = ($level == $levelId) ? 'selected' : '';
                echo "<option value='$levelName' $selected>$levelName</option>";
            }
            ?>
        </select>
        <div>
       <h4>
       
      
    



      <table style="width:100%" class="table-hover text-center">
        <tr class="bg-dark">
          <th>S.No.</th>
          <th>Name</th>

          <th>Attendance</th>
        </tr>
        <?php 
                    if (mysqli_num_rows($result) > 0) {
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $studentId = $row['id'];
                            $name = $row['name'];
                            $levelId = $row['id'];
                            $sectionId = $row['section_id'];
                            $grpId = $row['grp_id'];
                            ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $name; ?></td>

          <td>
            <div class="form-check">
              <input type="radio" name="att[<?php echo $studentId; ?>]" value="present"
                id="present-<?php echo $studentId; ?>" class="form-check-input">
              <label class="form-check-label" for="present-<?php echo $studentId; ?>">Present</label>
            </div>
            <div class="form-check mt-2">
              <input type="radio" name="att[<?php echo $studentId; ?>]" value="absent"
                id="absent-<?php echo $studentId; ?>" class="form-check-input">
              <label class="form-check-label" for="absent-<?php echo $studentId; ?>">Absent</label>
            </div>
          </td>

        </tr>
        <?php
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No students found.</td></tr>";
                    }
                    ?>
      </table>
      
      <button type="submit" name="save_attendance" class="btn btn-primary mt-3">Save Attendance</button>

     
    </form>
  </div>
</div>

<?php
    } else {
        // Display an error message if the query fails
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
?>






<?php 
    require_once "include/footer.php";
?>