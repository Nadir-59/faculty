<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM teacher WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-teacher.php?delete-success-where-id=" .$id );


?>
