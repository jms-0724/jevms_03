<?php
session_start();

if(isset($_SESSION['userid'])){
  if($_SESSION['userlevel'] == 'admin' ){
      header("location: Admin/admin.php");
      exit();
  } else if ($_SESSION['userlevel'] == 'accountant') {
      header("location: Accountant/accountant.php");
      exit();
  } else {
      header("location: Bookkeeper/bookkeeper.php");
      exit();
  }
}  
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="./assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/login.css">
        <link rel="shortcut icon" href="assets/img/bwdlogo.ico" type="image/x-icon">
        <link rel="stylesheet" href="./assets/css/modals.css">
    </head>
    <body>
        <div class="bg-image">
          <h3 class="header">Journal Entry Voucher Management System</h3>
          <main class="container d-flex align-items-center justify-content-center vh-50">
              <div class="card border-card">
                  <center><img src="./assets/img/bwd_logo.jpg" alt="" class="img-fluid" width="150" height="150"></center>
                  <h2 class="text-center fw-bold">Login</h2>
                    <form action="#" id="loginform">
                      <div class="form-group">
                          <label for="username">&nbsp;&nbsp;&nbsp;Username</label>
                          <input type="text" class="form-control" id="username" placeholder="" required>
                      </div>
                      <div class="form-group">
                        <label for="password">&nbsp;&nbsp;&nbsp;Password</label>
                        <input type="password" class="form-control" id="password" placeholder="" required>
                      </div>
                      <div class="form-group">
                        &nbsp;&nbsp;
                        <input type="checkbox" name="" id="checkboxShow" class="form-check-input"> 
                        <label for="showPass" class="form-check-label"> Show Password</label>
                      </div>
                      <div class="form-group text-center" >
                        <br><button type="submit" class="btn btn-primary">Login</button>
                      </div>
                    </form>
                
              </div>
            
          </main>
        </div>
  <!-- Modal: Invalid Request -->
  <div class="modal fade" id="invalidRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Invalid Request</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The System encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    <!-- Modal: No User Found -->
    <div class="modal fade" id="noUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>No User is Found</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system cannot find an exisiting user</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

      <!-- Modal: Incorrect Password -->
      <div class="modal fade" id="incorrectPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Incorrect Password</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>Password seems to be mismatched from the one you use to log in</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

      <!-- Modal: Statement Not Prepared -->
      <div class="modal fade" id="unprepared" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>Statement Unprepared</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

        <!-- Modal: General Error -->
        <div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header danger-header">
          <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
          <img src="./assets/svg/x-circle.svg" alt="check" width="50" height="50">
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center">
            <h3>System Error</h3>
          </div>
          <div class="d-flex justify-content-center">
            <p>The system encountered an error</p>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

        <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/password.js"></script>
        <script src="./login.js"></script>
        <script src="./assets/js/jquery-3.7.1.min.js"></script>
    </body>
    </html>