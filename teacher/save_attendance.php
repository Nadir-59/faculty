<?php
// Establish the database connection



$connection = mysqli_connect("localhost", "root", "", "faculty");

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());

}
// Check if the form has been submitted
if (isset($_POST['save_attendance'])) {
    // Retrieve the attendance data from the form
    $attendanceData = $_POST['att'];

    // Retrieve the subject_id from the form
    $subjectName = $_POST['attendance'];
   
    // Prepare the SQL statement to insert the attendance data into the report table
    $sql = "INSERT INTO report (student_id, subject_name, attendance) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($connection, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, 'iss', $studentId, $subjectName, $attendance);

    // Loop through the attendance data and insert it into the report table
    foreach ($attendanceData as $studentId => $attendance) {
        // Retrieve the student name associated with the student ID
       
        $query = "SELECT name FROM students WHERE id = $studentId";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];

        // Execute the statement
        mysqli_stmt_execute($stmt);
    }
    header("Location: attendance.php");
    
}
   

    ?>