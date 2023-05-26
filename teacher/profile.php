<?php 

require_once "include/header.php";
?>
 <?php  
    


    // databaseconnection
    require_once "../connection.php";

    $sql_command = "SELECT * FROM teacher WHERE email = '$_SESSION[email_emp]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
           $name = ucwords($rows["name"]);
            $id = $rows["id"];
       }

       

       
}
 ?>


<div class=container>
    <div class="row ">
        <div class="col-4 ">
        </div>
        <div class="col-12 col-lg-6 col-md-6" >
            <div class="card shadow" style="width: 22rem;">
                <img src="upload/<?php if(!empty($dp)){ echo $dp; }else{ echo "1.jpg"; } ?>" class="rounded img-fluid  card-img-top"  style="height: 300px "  alt="...">
                <div class="card-body">
                <h2 class="text-center mb-4"><?php echo $name; ?> </h2>
                    <p class="card-text">Email: <?php echo $_SESSION["email_emp"] ?> </p>
                    <p class="card-text">teacher Id: <?php echo $id ?> </p>
                    </p>
                    
                    <p class="text-center">
                    <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    <a href="change-password.php" class="btn btn-outline-primary">Change Password</a>
                    <a href="profile-photo.php" class="mt-2 btn btn-outline-primary">Change profile photo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once "include/footer.php";
?>