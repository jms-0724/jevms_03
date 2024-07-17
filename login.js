document.addEventListener("DOMContentLoaded", ()=> {

    const form = document.getElementById("loginform");

    form.addEventListener("submit", (e)=> {
        e.preventDefault();
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;

        fetch('login.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                username:username,
                password:password,
            })
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            if(result === "admin"){
                window.location.href = "Admin/admin.php";
            } else if (result === "accountant"){
                window.location.href = "Accountant/accountant.php";
            } else if(result = "bookkeeper"){
                window.location.href = "Bookkeeper/bookkeeper.php";
            } else if (result === "Invalid Request"){
                $("#invalidRequest").modal('show');
                form.reset();
            } else if (result === "No User is Found"){
                $("#noUser").modal('show');
                form.reset();
            } else if (result === "Incorrect Password"){
                $("#incorrectPassword").modal('show');
                form.reset();
            } else if (result === "Statement not Prepared"){
                $("#unprepared").modal('show');
                form.reset();
            } else {
                $("#failed").modal('show');
                form.reset();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
    })
    
    // $("#loginform").submit(function (e){
    //     e.preventDefault();

    //     let username = $("#username").val();
    //     let password = $("#password").val();

    //     $.post("./../../login.php")

    // })
})