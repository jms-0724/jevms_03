document.addEventListener("DOMContentLoaded", function(){
    function showPassword(){
        var passField = document.getElementById("password");
        if (passField.type === "password"){
            passField.type = "text";
        } else {
            passField.type = "password";
        }
    }
    document.getElementById("checkboxShow").addEventListener("click",showPassword);
    
})

