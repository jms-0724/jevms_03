<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location: ../index.php");
    }

    if(isset($_SESSION['userid']) && $_SESSION['userlevel'] === "accountant"){
        header("location: ../Accountant/accountant.php");
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
    <title>Journal Entry Management</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./../assets/css/page.css">
    <link rel="stylesheet" href="./../assets/css/modals.css">
    <link rel="stylesheet" href="./../node_modules/select2/dist/css/select2.min.css">
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
                    <a href="admin.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="usermanagement.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>User Management</span>
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
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-list"></i>
                        <span>Accounts List Management</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="accountmanagement.php" class="sidebar-link">Title Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="typesmanagement.php" class="sidebar-link">Type Management</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="categories.php" class="sidebar-link">Category Management</a>
                        </li>
                    </ul>
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

        <div class="main p-3">
        <h5 style="font-weight:bold; font-size:25px; text-align: center;">Journal Entry Voucher Management System</h5>
                <div class="d-flex bg-tertiary justify-content-end border" style="background-color:white; color:black; border-radius:20px; margin-bottom:10px;">
                    <div class="d-flex p-2">
                    <h5 style="font-size:15px; margin-top:5px;"><i class="lni lni-user"></i> Welcome Back <span><?= $_SESSION['ulvl'] . " " . $_SESSION['fname']?></span> </h5>
                    </div>
                </div>
                
            <div class="card">
                <div class="card-header" style="background-color:#0e2238;">
                    <div class="d-flex mt-1 p-2">
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> Journal Entry Management</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJournals">Add Journal Entries</button> -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createJournals">Add Journal Entry</button> -->
                        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#createJournals1" id="addJEV" style="margin-right:10px;">Add Journal Entry</button>
                        <input type="search" name="search" id="searchJournal" class="d-flex align-items-end rounded" placeholder="Search Entry">
                    </div>
                    <div class="d-flex mt-3">
                        <div class="mx-2">
                        <i class="lni lni-calendar"></i> <label for="fromDate">Date From</label>
                            <input type="date" name="fromDate" id="fromDate">
                        </div>    
                        <div class="mx-2">
                        <i class="lni lni-calendar"></i> <label for="fromDate">Date To</label>
                            <input type="date" name="toDate" id="toDate">
                        </div>
                        <div>
                            <span for="jCategory">Journal Category</span>
                            <select name="" id="jCategory" class=" rounded">
                                
                            </select>
                        </div>
                    
                    </div>
                    <div class="d-flex border p-2 mt-3">
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <th>Date</th>
                                <th>Journal Number</th>
                                <th>Description</th>
                                <th>Encoded By</th>
                                <th>Actions</th>
                                
                            </thead>
                            <tbody id="journalList">

                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <script src="./../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" ></script>
    <script src="./../assets/js/jquery-3.7.1.min.js"></script>
    <script src="system/confirmlogout.js"></script>
    <script src="./../assets/js/journalmanage.js"></script>
    <script src="./../node_modules/select2/dist/js/select2.min.js"></script>
    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/journalmodal.php");
        include("./modals/confirmjournal.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>