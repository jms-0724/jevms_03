document.addEventListener("DOMContentLoaded", ()=> {
    function display(){
       document.getElementById('searchUsers').value = "";
       fetch('search/searchusers.php', {
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
           document.getElementById("usersTable").innerHTML = data;
       })
       .catch(error => {
           console.error("Fetch error:", error);
       });
   }
   display();
   //Display Searched Values
   function displaySearch(search){
       fetch('search/searchusers.php',{
           method: "POST",
           body: new URLSearchParams({
               search:search
           })
       })
       .then(response => {
           if (!response.ok) {
               throw new Error("Network response was not ok");
           }
           return response.text();
       })
       .then(data=>{
           document.getElementById("usersTable").innerHTML = data;
       })
       .catch(error => {
           console.error("Fetch error:", error);
       })
   }
   //Keyup Event Listener
   document.getElementById('searchUsers').addEventListener('keyup',(event)=>{
       let data = event.target.value;
       if(data){
           displaySearch(data);
       } else{
           display();
       }
   })

//    Opens Confirmation window
   document.getElementById("addUserForm").addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmAdd").modal('show');
    $("#addUsers").modal('hide');
   })
   document.getElementById("backAdd").addEventListener("click", ()=> {
        $("#confirmAdd").modal('hide');
        $("#addUsers").modal('show');
   })
   document.getElementById("proceedAdd").addEventListener("click", ()=> {
        let add_username = document.getElementById("add_username").value;
        let add_password = document.getElementById("add_password").value;
        let add_userlevel = document.getElementById("add_userlevel").value;
        let add_userfname = document.getElementById("add_userfname").value;
        let add_usermname = document.getElementById("add_usermname").value;
        let add_userlname = document.getElementById("add_userlname").value;

        fetch('add/addusers.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                add_username:add_username,
                add_password:add_password,
                add_userlevel:add_userlevel,
                add_userfname:add_userfname,
                add_usermname:add_usermname,
                add_userlname:add_userlname
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            if(data = "Success"){
                $("#success").modal('show');
                $("#confirmAdd").modal('hide');
                document.getElementById("addUserForm").reset();
                display();
                dynamicOption();
            } else if (data = "Failed in Inserting User"){
                $("#failed2").modal('show');
                $("#confirmAdd").modal('hide');
            } else if (data = "Failed in Inserting User Info") {
                $("#failed3").modal('show');
                $("#confirmAdd").modal('hide');
            } else if (data = "Username already exists") {
                $("#failed4").modal('show');
                $("#confirmAdd").modal('hide');
            } else {
                $("#failed").modal('show');
                $("#confirmAdd").modal('hide');
            }
        })
   });

    //Open Update Archive
   document.getElementById("archiveForm").addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmArchive").modal('show');
    $("#archiveUser").modal('hide');
   })
   document.getElementById("backArchive").addEventListener("click", ()=> {
        $("#confirmArchive").modal('hide');
        $("#archiveUser").modal('show');
   });

   document.getElementById("proceedArchive").addEventListener("click", ()=> {
    
    let users = document.getElementById("users").value;
    let archived = document.getElementById("archived").value;

    fetch('edit/archiveuser.php', {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({
            "users": users,
            "archived": archived,
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        if(data = "Success"){
            $("#success").modal('show');
            $("#confirmAdd").modal('hide');
            document.getElementById("addUserForm").reset();
            display();
        } else if (data = "Failed"){
            $("#failed6").modal('show');
            $("#confirmAdd").modal('hide');
        } else if (data = "No Statement Prepared") {
            $("#failed5").modal('show');
            $("#confirmAdd").modal('hide');
        }  else {
            $("#failed").modal('show');
            $("#confirmAdd").modal('hide');
        }
    })
});

// Update User
document.getElementById("upd_user").addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmUserUpdate").modal('show');
    $("#updateUser").modal('hide');
   })
   document.getElementById("backUpdate").addEventListener("click", ()=> {
        $("#confirmUserUpdate").modal('hide');
        $("#updateUser").modal('show');
   });
   
document.getElementById("proceedUpdate").addEventListener("click", ()=> {
    
    let uid = document.getElementById("uId").textContent;
    let upd_username = document.getElementById("upd_username").value;
    let upd_password = document.getElementById("upd_password").value;
    let upd_userlevel = document.getElementById("upd_userlevel").value;

    fetch('edit/edituser.php', {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({
            "uid": uid,
            "upd_username": upd_username,
            "upd_password": upd_password,
            "upd_userlevel": upd_userlevel,
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        if(data = "Success"){
            $("#success").modal('show');
            $("#confirmUserUpdate").modal('hide');
            document.getElementById("addUserForm").reset();
            display();
        } else if (data = "Failed"){
            $("#failed6").modal('show');
            $("#confirmUserUpdate").modal('hide');
        } else if (data = "No Statement Prepared") {
            $("#failed5").modal('show');
            $("#confirmUserUpdate").modal('hide');
        }  else {
            $("#failed").modal('show');
            $("#confirmUserUpdate").modal('hide');
            console.log();
        }
    })
})
    
// Update user info
document.getElementById("upd_user_info").addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmInfoUpdate").modal('show');
    $("#updateUserInfo").modal('hide');
   })
   document.getElementById("backUpdate2").addEventListener("click", ()=> {
        $("#confirmInfoUpdate").modal('hide');
        $("#updateUserInfo").modal('show');
   });
   
document.getElementById("proceedUpdate2").addEventListener("click", ()=> {
    
    let uID = document.getElementById("uID").textContent;
    let upd_userfname = document.getElementById("upd_userfname").value;
    let upd_usermname = document.getElementById("upd_usermname").value;
    let upd_userlname = document.getElementById("upd_userlname").value;

    fetch('edit/edituserinfo.php', {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({
            uID: uID,
            upd_userfname: upd_userfname,
            upd_usermname: upd_usermname,
            upd_userlname: upd_userlname,
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        if(data === "Success"){
            $("#success").modal('show');
            $("#confirmInfoUpdate").modal('hide');
            console.log(data);
            display();
        } else if (data === "Failed"){
            $("#failed6").modal('show');
            $("#confirmInfoUpdate").modal('hide');
            console.log(data);
        } else if (data === "No Statement Prepared") {
            $("#failed5").modal('show');
            $("#confirmInfoUpdate").modal('hide');
            console.log(data);
        }  else {
            $("#failed").modal('show');
            $("#confirmInfoUpdate").modal('hide');
            console.log(data);
        }
    })
})

   function dynamicOption(){
    fetch('fetch/users.php', {
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
        document.getElementById("users").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
}
dynamicOption();
})
   //Dynamically Fill Fields
   function editUser(uid){
    fetch('fetch/fetchusers.php',{
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
        let tbl_user = JSON.parse(data);
        document.getElementById("uId").textContent = tbl_user.uid;
        document.getElementById("upd_username").value = tbl_user.username;
        // document.getElementById("up_pword").value = tbl_user.password;
        document.getElementById("upd_userlevel").value = tbl_user.userlevel;
        $("#updateUser").modal('show');
    })
    .catch(error => {
        console.error('Error:', error);
    });  
   
}
  //Dynamically Fill Fields
  function editUserInfo(uid){
    fetch('fetch/fetchuserinfo.php',{
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
        let tbl_user_info = JSON.parse(data);
        document.getElementById("uID").textContent = tbl_user_info.user_info_id;
        document.getElementById("upd_userfname").value = tbl_user_info.user_fname;
        // document.getElementById("up_pword").value = tbl_user.password;
        document.getElementById("upd_usermname").value = tbl_user_info.user_mname;
        document.getElementById("upd_userlname").value = tbl_user_info.user_lname;
        const editModal = new bootstrap.Modal(document.getElementById("updateUserInfo"));
        editModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }