<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM student WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-student.php?delete-success-where-id=" .$id );


?>
