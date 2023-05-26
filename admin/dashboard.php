<?php 
require_once "include/header.php";
?>
<?php

        // database connection
        require_once "../connection.php";

         $currentDay = date( 'Y-m-d', strtotime("today") );
         $tomarrow = date( 'Y-m-d', strtotime("+1 day") );

         
        // total admin
        $select_admins = "SELECT * FROM admin";
        $total_admins = mysqli_query($conn , $select_admins);

        // total student
        $select_students = "SELECT * FROM students";
        $total_students = mysqli_query($conn , $select_students);

        


        



        // total teacher
        $select_emp = "SELECT * FROM teacher";
        $total_emp = mysqli_query($conn , $select_emp);

        


       



?>

<div class="container">

    <div class="row mt-5">
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Admins</li>
                    <li class="list-group-item">Total Admin : <?php echo mysqli_num_rows($total_admins); ?> </li>
                    <li class="list-group-item text-center"><a href="manage-admin.php"><b>View All Admins</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">students</li>
                    <li class="list-group-item">Total students : <?php echo mysqli_num_rows($total_students); ?></li>
                    <li class="list-group-item text-center"><a href="manage-student.php"> <b>View All students</b></a></li>
                </ul>
            </div>
        </div>
        
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">teachers</li>
                    <li class="list-group-item">Total teachers : <?php echo mysqli_num_rows($total_emp); ?></li>
                    <li class="list-group-item text-center"><a href="manage-teacher.php"> <b>View All teachers</b></a></li>
                </ul>
            </div>
        </div>
        
    </div>
    

        
    
</div>

<?php 
require_once "include/footer.php";
?>