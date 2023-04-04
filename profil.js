var profile = document.getElementById("profile")
var editLogin = document.getElementById("change-login");
var editPassword = document.getElementById("change-password");
var editConfirmedPassword = document.getElementById("change-confirmed-password");

function init(){                
    editLogin.style.display = "none"
    editPassword.style.display = "none"
}

window.onload = init;

document.getElementById("change-login-btn").addEventListener("click", function(){ 
    profile.style.display = 'none';
    editLogin.style.display = 'block';

});

document.getElementById("login-comeback").addEventListener("click", function(){ 
    editLogin.style.display = 'none';
    profile.style.display = 'block';
});

document.getElementById("change-password-btn").addEventListener("click", function(){ 
    profile.style.display = 'none';
    editPassword.style.display = 'block';

});

document.getElementById("password-comeback").addEventListener("click", function(){ 
    editPassword.style.display = 'none';
    profile.style.display = 'block';
});

document.getElementById("form-login").addEventListener("submit", function(e) {
    e.preventDefault();

    var data = new FormData(this); // FormData est une classe JS qui sert  récupérer automatiquement les données du formulaire

    var xhr = new XMLHttpRequest();

    var editMessage = document.getElementById("edit-message");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            var res = this.response;
            if (res == null) {
                editMessage.innerHTML = "<p style='color:green'> Modification prise en compte :) ! </p>";
                editLogin.appendChild(editMessage);
            } else {
                editMessage.innerHTML = res.msg;
                editLogin.appendChild(editMessage);
            }
        } else if (this.readyState == 4) {
            alert("Une erreur est survenue")
        }
    };

    xhr.open("POST", "profilScriptLogin.php", true);
    xhr.responseType = "json";
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);

    return false;
})

document.getElementById("form-password").addEventListener("submit", function(e) {
    e.preventDefault();

    var data = new FormData(this); // FormData est une classe JS qui sert  récupérer automatiquement les données du formulaire

    var xhr = new XMLHttpRequest();

    var editMessage = document.getElementById("edit-message");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            var res = this.response;
            if (res.success) {
                editMessage.innerHTML = res.msg;
                editPassword.appendChild(editMessage);
            } else {
                editMessage.innerHTML = res.msg;
                editPassword.appendChild(editMessage);
            }
        } else if (this.readyState == 4) {
            alert("Une erreur est survenue")
        }
    };

    xhr.open("POST", "profilScriptPassword.php", true);
    xhr.responseType = "json";
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);

    return false;
})

