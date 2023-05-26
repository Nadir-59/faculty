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
    $date = $_GET['date'] ?? '';

    // Prepare the SQL query with filters
    $sql = "SELECT report.*, students.name FROM report 
            INNER JOIN students ON report.student_id = students.id
            WHERE 1=1";

    if (!empty($level)) {
        $sql .= " AND students.level_id = $level";
    }

    if (!empty($date)) {
        $sql .= " AND DATE(report.timestamp) = '$date'";
    }

    // Execute the query and fetch the results
    $result = mysqli_query($connection, $sql);

    // Check if the query was successful
    if ($result) {
        // Display the form and table
    ?>
        <form method="GET" action="">
            <div class="d-flex align-items-center">
                <label for="level" class="ml-2">Level:</label>
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

                <label for="date" class="ml-2">Date:</label>
                <input type="date" name="date" id="date" class="form-control ml-2" style="width:11%" value="<?php echo $date; ?>">

                <input type="submit" value="Filter" class="btn btn-primary ml-2" style="width:10%">
            </div>
        </form>

        <div class="container bg-white shadow">
            <div class="py-4 mt-5">
                <div class='text-center pb-2'>
                    <h4>Attendance Report</h4>
                </div>

                <table class="table-hover text-center">
                    <tr class="bg-dark">
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Attendance</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['name'];
                            $attendance = $row['attendance'];
                            $timestamp = $row['timestamp'];
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $attendance; ?></td>
                                <td><?php echo $timestamp; ?></td>
                            </tr>
                    <?php
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found.</td></tr>";
                    }
                    ?>
                </table>
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
