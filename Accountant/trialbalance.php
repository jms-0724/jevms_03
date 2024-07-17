<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "admin"){
        header("location: ../Admin/admin.php");
    } else if (isset($_SESSION['userid']) && $_SESSION['userlevel'] === "bookkeeper"){
        header("location: ../Bookkeeper/bookkeeper.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Balance Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.5/css/all.min.css" integrity="sha512-some-long-hash" crossorigin="anonymous" />
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">JEVMS</a>
                </div>
                
            </div>

            <!-- logo and title -->
            <div class="justify-content-center" style="text-align:center; ">
                    <img src="./../assets/img/bwd_logo2.png" alt="" class="img-fluid" width="75" height="75">
                    <h2 style="color:white; text-align:center; font-size: 25px; margin-bottom:20px; font-weight:bold;">Balaoan Water District</h2>
                </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="journal.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Journal Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="generalledger.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>General Ledger</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="trialbalance.php" class="sidebar-link">
                        <i class="lni lni-book"></i>
                        <span>Trial Balance</span>
                    </a>
                </li>

                
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">
                <a  data-bs-toggle="modal" data-bs-target="#Logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- title part -->
        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: center;">Journal Entry Voucher Management System</h5>
                <div class="d-flex bg-tertiary justify-content-end border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                    <div class="d-flex p-2">
                    <h5 style="font-size:15px; margin-top:5px;"><i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span> </h5>
                    </div>
                </div>

            <!-- card header -->
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> View Trial Balance</h3>
                    </div>
                </div>

            <div class="card card-outline card-primary">
        
            <!-- <h3>Home </h3> -->
            <main class="card-body">
                <div class="container-fluid">
                    <div class="d-flex">
                    <input type="search" name="search" id="searchTrial" class="d-flex align-items-end rounded" placeholder="Search" style="margin-bottom:10px;">
                    </div>
                    <div class="mt-3">
                    <table class="table table-striped table-bordered mt-3">
                            <thead class="table table-bordered">
                                <th>Account Code</th>
                                <th>Account Name</th>
                                <th>Debit Balance</th>
                                <th>Credit Balance</th>
                            </thead>
                            <tbody id ="displayTrial" class="table table-bordered">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            </div>
        </div>
        
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>
    <script src="./../assets/js/trialbalance.js"></script>

    <?php 
         include("./modals/logoutmodal.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>