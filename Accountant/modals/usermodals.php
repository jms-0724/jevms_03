<!-- Modal Add Users -->
<div class="modal fade" id="addUsers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Users</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <form method="post" id="addUserForm">
                <div class="form-group mb-2">
                    <label for="add_username" class="form-label">Username</label>
                    <input type="text" name="add_username" id="add_username" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_password" class="form-label">Password</label>
                    <input type="password" name="add_password" id="add_password" class="form-control" required>
                </div>
                <!-- <div>
                    <label for="password">Re-enter Password</label>
                    <input type="password" name="password2" id="password2">
                    </div> -->
                <div class="form-group mb-2">
                    <label for="userlevel" class="form-label">Userlevel</label>
                    <select name="add_userlevel" id="add_userlevel" class="form-select" required>
                        <option style="display: none;"></option>
                        <option value="Administrator">Administrator</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Bookkeeper">Bookkeeper</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="add_userfname" class="form-label">Firstname</label>
                    <input type="text" name="add_userfname" id="add_userfname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_usermname" class="form-label">Middlename</label>
                    <input type="text" name="add_usermname" id="add_usermname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="add_userlname" class="form-label">Lastname</label>
                    <input type="text" name="add_userlname" id="add_userlname" class="form-control" required>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal Archive -->
   <div class="modal fade" id="archiveUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Update User Status</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="archiveForm">
                <div class="form-group mb-3">
                    <select id="users" class="form-select">
                        <option style="display:none" disabled selected value></option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <select name="" id="archived" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- Modal Update User -->
    <div class="modal fade" id="updateUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Update User <i id="uId"></i></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="upd_user">
                <div class="form-group mb-3">
                    <label for="upd_username" class="form-label">Username</label>
                    <input type="text" name="upd_username" id="upd_username" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="upd_password" class="form-label">Password</label>
                    <input type="password" name="upd_password" id="upd_password" class="form-control" required>
                </div>
                <div>
                    <label for="upd_userlevel" class="form-label">Userlevel</label>
                    <select name="upd_userlevel" id="upd_userlevel" class="form-select" required>
                        <option style="display: none;"></option>
                        <option value="Administrator">Administrator</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Bookkeeper">Bookkeeper</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- Modal Update User Info -->
<div class="modal fade" id="updateUserInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update User <i id="uID"></i></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="upd_user_info">
            <div class="form-group mb-3">
                <label for="upd_userfname" class="form-label">Firstname</label>
                <input type="text" name="upd_userfname" id="upd_userfname" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="upd_usermname" class="form-label">Middlename</label>
                <input type="text" name="upd_usermname" id="upd_usermname" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="upd_userlname" class="form-label">Lastname</label>
                <input type="text" name="upd_userlname" id="upd_userlname" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Status</button>
                <button type="reset" class="btn btn-danger">Clear</button>
             </div>
          </form>
        </div>
      </div>
    </div>
  </div>


