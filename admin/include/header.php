<?php 
    session_start();
    if( empty($_SESSION["email"]) ){
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Attendance Students</title>
    
    <link href="../resorce/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <style> 
     .hidden {
         display: none;
     }
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    
    <!--*******************
        Preloader end
    ********************-->

     





    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="">

        <!--**********************************
            Nav header start
        <!-- ***********************************-->
        <div class="nav-header">

             <div class="brand-logo">
                <a >
                    <span class="brand-title">
                   
                    </span>
                </a>
            </div> 
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
               <div class="text-center">
                <h2 class="pt-3"> Attendance Students </h2>
                 </div>
                
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                   <br> <br>       
                    <li>
                        <a href="./dashboard.php"  >
                            <i class="icon-home menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>


                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-address-card-o menu-icon"></i><span class="nav-text">Students</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./add-student.php"> <i class="icon-plus menu-icon"></i><span class="nav-text">Add Student</span></a></li>
                            <li><a href="./manage-student.php"> <i class="fa fa-tasks menu-icon"></i><span class="nav-text">Manage Student</span></a></li>
                            <!-- <li><a href="./"> <i class="fa fa-bar-chart menu-icon"></i><span class="nav-text">mobile Table</span></a></li> -->

                        </ul>
                    </li>

                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-address-card-o menu-icon"></i><span class="nav-text">teacher</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./add-teacher.php"> <i class="icon-plus menu-icon"></i><span class="nav-text">Add teacher</span></a></li>
                            <li><a href="./manage-teacher.php"> <i class="fa fa-tasks menu-icon"></i><span class="nav-text">Manage teacher</span></a></li>
                            <!-- <li><a href="./"> <i class="fa fa-bar-chart menu-icon"></i><span class="nav-text">Salary Table</span></a></li> -->

                        </ul>
                    </li>

                    <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-address-card-o menu-icon"></i><span class="nav-text">Admin</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./add-admin.php"> <i class="icon-plus menu-icon"></i><span class="nav-text">Add Admin</span></a></li>
                            <li><a href="./manage-admin.php"> <i class="fa fa-tasks menu-icon"></i><span class="nav-text">Manage Admins</span></a></li>
                        </ul>
                    </li>
                    
                    
                    <li>
                        <a href="./logout.php" >
                            <i class="icon-logout menu-icon"></i><span class="nav-text">Logout</span>
                        </a>
                    </li>
                    <li>
                        <a href="./profile.php"  >
                            <!-- <img src="https://icon-library.net//images/icon-profile/icon-profile-20.jpg" width="14"> -->
                            <i class="fa fa-user menu-icon"></i><span class="nav-text"> Profile</span>
                        </a>
                    </li>                 
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">



        <div class="modal fade" id="showModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalHead" class="modal-header">
                    <button id="modal_cross_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p id="addMsg" class="text-center font-weight-bold"></p>
                </div>
                <div class="modal-footer ">
                    <div class="mx-auto">
                        <a type="button" id="linkBtn" href="#" class="btn btn-primary" >Add Expense For the Day</a>
                        <a type="button" id="closeBtn" href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
            <!-- row -->

            <div class="container-fluid">

            