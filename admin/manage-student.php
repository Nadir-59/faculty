<?php 
    require_once "include/header.php";
?>


<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT st.id, st.name AS student_name, st.dob, st.email, st.mobile, st.gender,
               sec.name AS section_name, g.name AS group_name, lvl.name AS level_name
        FROM students st
        INNER JOIN section sec ON st.section_id = sec.id
        INNER JOIN grp g ON st.grp_id = g.id
        INNER JOIN level lvl ON st.level_id = lvl.id";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Manage students</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Name</th>
        <th>Email</th> 
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Section</th>
        <th>Groupe</th>
        <th>level</th>
        <th>Mobile</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $name= $rows["name"];
            $email= $rows["email"];
            $dob = $rows["dob"];
            $gender = $rows["gender"];
            $id = $rows["id"];
            $section = $rows["section_name"];
            $groupe = $rows["group_name"];
            $level = $rows["level_name"];
            $mobile = $rows["mobile"];
            if($gender == "" ){
                $gender = "Not Defined";
            } 

            
            if($mobile== "" ){
                $mobile= "Not Defined";
            }   
            
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td> <?php echo $name ; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $dob; ?></td>
        <td><?php echo $section; ?></td>
        <td><?php echo $groupe; ?></td>
        <td><?php echo $level; ?></td>
        <td><?php echo $mobile; ?></td>

        <td>  <?php 
                $edit_icon = "<a href='edit-student.php?id={$id}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-student.php?id={$id}' id='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
             ?> 
        </td>

      
        

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-student.php');
                $('#linkBtn').text('Add student');
                $('#addMsg').text('No students Found!');
                $('#closeBtn').text('Remind Me Later!');
            })
         </script>
         ";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>

<?php 
    require_once "include/footer.php";
?>