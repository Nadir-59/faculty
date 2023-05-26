
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="add_student.php" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" id="student_id" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" required><br>

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" id="mobile" required><br>

        <label for="section_id">Section:</label>
        <select name="section_id" id="section_id" required>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "employee_management";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch sections from the database
            $sql = "SELECT section_id, section_name FROM section";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['section_id'] . "'>" . $row['section_name'] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="grp_id">Group:</label>
        <select name="grp_id" id="grp_id" required>
            <?php
            // Fetch groups from the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT grp_id, grp_name FROM grp";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['grp_id'] . "'>" . $row['grp_name'] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="level_id">Level:</label>
        <select name="level_id" id="level_id" required>
            <?php
            // Fetch levels from the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT level_id, level_name FROM level";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['level_id'] . "'>" . $row['level_name'] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <input type="submit" value="Add Student">
    </form>

   
</body>
</html>
