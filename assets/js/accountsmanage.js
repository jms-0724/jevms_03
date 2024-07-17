document.addEventListener("DOMContentLoaded", ()=> {
    function display(){
        document.getElementById('searchAccounts').value = "";
        fetch('search/searchaccounts.php', {
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
            document.getElementById("accountsTable").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchaccounts.php',{
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
            document.getElementById("accountsTable").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchAccounts').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })
    document.getElementById("addAccountForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#AccountConfirm").modal('show');
        $("#addAccounts").modal('hide');
       })
       document.getElementById("backAdd").addEventListener("click", ()=> {
            $("#AccountConfirm").modal('hide');
            $("#addAccounts").modal('show');
       })
       document.getElementById('add_code').addEventListener('input', (event) => {
        let value = event.target.value;
        event.target.value = value.replace(/[^0-9]/g, '');
        });
       document.getElementById("proceedAdd").addEventListener("click", ()=> {
            let add_code = document.getElementById("add_code").value;
            let add_title = document.getElementById("add_title").value;
            let add_account_type = document.getElementById("add_account_type").value;
            
            let account_type = document.getElementById("add_account_type");
            let selectedOption = account_type.options[account_type.selectedIndex];
            let accountGroup = selectedOption.getAttribute("data-account-code");

            

            fetch('add/addaccounts.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    account_code:add_code,
                    account_name: add_title,
                    account_type: add_account_type,  
                    accountGroup:accountGroup
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
                    console.log(data);
                    $("#success1").modal('show');
                    $("#AccountConfirm").modal('hide');
                    document.getElementById("addAccountForm").reset();
                    display();
                } else if (data === "Failed in Inserting Accounts"){
                    $("#failed1").modal('show');
                    $("#AccountConfirm").modal('hide');
                } else if (data === "Account Already Exists") {
                    $("#failed2").modal('show');
                    $("#AccountConfirm").modal('hide');
                } else if (data === "Statement Not Prepared") {
                    $("#failed3").modal('show');
                    $("#confirmAdd").modal('hide');
                } else {
                    console.log(data);
                    $("#failed4").modal('show');
                    $("#confirmAdd").modal('hide');
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
       });

       document.getElementById("updAccountForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#accountUpdate").modal('show');
        $("#updAccounts").modal('hide');
       })
       document.getElementById("backUpd").addEventListener("click", ()=> {
            $("#accountUpdate").modal('hide');
            $("#updAccounts").modal('show');
       });
       
    document.getElementById("proceedUpdate").addEventListener("click", ()=> {
        
            let upd_code = document.getElementById("accnt").textContent;
            let upd_name = document.getElementById("upd_title").value;
            let upd_account_type = document.getElementById("upd_account_type").value;
            
            
            let account_type = document.getElementById("upd_account_type");
            let selectedOption = account_type.options[account_type.selectedIndex];
            let accountGroup = selectedOption.getAttribute("data-account-code");
    
            console.log(accountGroup);
        fetch('edit/editaccounts.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                "upd_code": upd_code,
                "upd_name": upd_name,
                "upd_account_type": upd_account_type,
                "account_group": accountGroup,
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
                console.log(data);
                $("#success2").modal('show');
                $("#accountUpdate").modal('hide');
                document.getElementById("updAccountForm").reset();
                display();
            } else if (data = "No Rows Fetched"){
                $("#failed5").modal('show');
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

    // Dynamic Account Type
    function dynamicOption(){
        fetch('fetch/types.php', {
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
            document.getElementById("add_account_type").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption();

        // Dynamic Account Type
        function dynamicOption2(){
            fetch('fetch/types.php', {
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
                document.getElementById("upd_account_type").innerHTML = data;
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
        }
        dynamicOption2();

    // function dynamicOption2(){
    //     fetch('fetch/category.php', {
    //         method: 'POST',
    //     })
    //     //Ensure response is ok
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error("Network response was not ok");
    //         }
    //         return response.text();
    //     })
    //     .then(data => {
    //         document.getElementById("add_account_category").innerHTML = data;
    //     })
    //     .catch(error => {
    //         console.error("Fetch error:", error);
    //     });
    // }
    // dynamicOption2();


})
function editAccount(uid){
    fetch('fetch/fetchaccounts.php',{
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
        let tbl_account_title = JSON.parse(data);
        document.getElementById("accnt").textContent = tbl_account_title.account_code;
        document.getElementById("upd_title").value = tbl_account_title.account_name;
        document.getElementById("upd_account_type").value = tbl_account_title.account_type;

        const editModal = new bootstrap.Modal(document.getElementById("updAccounts"));
        editModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }