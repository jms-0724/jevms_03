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
    <title>Admin Main Page</title>
    <link href="./assets/web-font-files/lineicons.css" rel="stylesheet" />
    <link href="./../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/bwdlogo.ico" type="image/x-icon">
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
                            <a href="#" class="sidebar-link">Category Management</a>
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
                        <h3 style="font-weight:bold; color:white;"><i class="lni lni-book"></i> Journal Types Management Utility</h3>
                    </div>
                </div>

                <div class="card card-outline card-primary">
                <div class="card-body">
                <div class="d-flex">
                    <button type="button" class="btn btn-primary rounded-pill" data-bs-target="#addCategory" data-bs-toggle="modal" style="margin-right:10px;">Add Journal Types</button>
                    <div class="d-flex">
                        <input type="search" name="searchTypes" id="searchCategories" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <div class="d-flex mx-3">
                    <table class="table table-striped table-bordered mt-3">
                        <thead>
                            <th>Account Type</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </thead>
                        <tbody id="cTables">
                            
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
    <script>
        document.addEventListener("DOMContentLoaded", ()=> {
            document.getElementById("updCategoryForm").addEventListener("submit",(e)=> {
                e.preventDefault();
                $("#categoryConfirm2").modal('show');
                $("#updCategory").modal('hide');
            })

            document.getElementById("backCategory2").addEventListener("click",()=> {
                $("#categoryConfirm2").modal('hide');
                $("#updCategory").modal('show');
            })

            document.getElementById("proceedCategory2").addEventListener("click",()=> {
                let upd_code = document.getElementById("cCode").textContent;
                let upd_category = document.getElementById("upd_category").value;
                let upd_description = document.getElementById("upd_description2").value;

                fetch("edit/editcategories.php", {
                    method: "POST",
                    headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                     "cCode": upd_code,
                     "upd_category": upd_category,
                     "upd_description2": upd_description
                })
                
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
               if (data === "Success"){
                 $("#categoryConfirm2").modal('hide');
                 $("#updsuccess2").modal('show');

               } else {
                $("#categoryConfirm2").modal('hide');
                $("#updfailed2").modal('show');
                document.getElementById("err2").textContent = data;
               } 
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
                

                
            })
            // Javascript for Displaying Account Types
    function display(){
        document.getElementById('searchCategories').value = "";
        fetch('search/searchcategory.php', {
            method: 'POST',
        })
        //Ensure response is ok
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("cTables").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();

    document.getElementById("addCategoryForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#categoryConfirm").modal('show');
        $("#addCategory").modal('hide');
       })

       document.getElementById("backCategory").addEventListener("click", ()=> {
            $("#categoryConfirm").modal('hide');
            $("#addCategory").modal('show');
       })
       document.getElementById("proceedCategory").addEventListener("click", ()=> {
           
            let add_category = document.getElementById("add_category").value;
            let add_description = document.getElementById("add_description").value;
            

            fetch('add/addcategory.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    add_category: add_category,
                    add_category_description: add_description,
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                console.log(data);
                if(data === "Success"){
                    console.log(data);
                    $("#success1").modal('show');
                    $("#categoryConfirm").modal('hide');
                    document.getElementById("addCategoryForm").reset();
                    display();
                } else if (data === "Failed in Inserting Accounts"){
                    $("#failed1").modal('show');
                    $("#categoryConfirm").modal('hide');
                } else if (data === "Account Category Already Existing") {
                    $("#failed2").modal('show');
                    $("#categoryConfirm").modal('hide');
                } else if (data === "Statement Not Prepared") {
                    $("#failed3").modal('show');
                    $("#categoryConfirm").modal('hide');
                } else {
                    $("#failed4").modal('show');
                    $("#categoryConfirm").modal('hide');
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
       });
    })

    function editAccountCategory(uid){
    fetch('fetch/fetchcategory.php',{
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            uid: uid
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response.text();
    })
    .then(data => {
        let tbl_account_category = JSON.parse(data);
        document.getElementById("cCode").textContent = tbl_account_category.category_id;
        document.getElementById("upd_category").value = tbl_account_category.category_name;
        // document.getElementById("upd_description") = tbl_account_category.category_description;

        const editModal = new bootstrap.Modal(document.getElementById("updCategory"));
        editModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }
    
    </script>
    <?php 
         include("./modals/logoutmodal.php");
         include("./modals/accountsmodal.php");
         include("./modals/comfirmaccounts.php");
    ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>