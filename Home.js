const singInForm = document.querySelector(".cover")
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.display = 'block';
});

//email
let email = document.getElementById("email");
email.addEventListener("input", () => {
    if (email.validity.valueMissing) {
        email.setCustomValidity("خطأ أدخل البريد الإلكتروني الخاص بك ");
    } else if (email.validity.typeMismatch) {
        email.setCustomValidity("خطأ أدخل البريد الإلكتروني الخاص بك بشكل غير صحيح");
    } else {
        email.setCustomValidity("");
    }
});
email.addEventListener("invalid", () => {
    if (email.validity.valueMissing) {
        email.setCustomValidity("خطأ أدخل البريد الإلكتروني الخاص بك ");
    } else if (email.validity.typeMismatch) {
        email.setCustomValidity("خطأ أدخل البريد الإلكتروني الخاص بك بشكل غير صحيح");
    } else {
        email.setCustomValidity("");
    }
});



//pass

let pass = document.getElementById("password");
pass.addEventListener("input", () => {
    if (pass.validity.valueMissing) {
        pass.setCustomValidity("خطأ أدخل كلمة المرور");
    } else if (email.validity.typeMismatch) {
        pass.setCustomValidity("خطأ أدخل كلمة المرور بشكل غير صحيح ");
    } else {
        pass.setCustomValidity("");
    }
});
pass.addEventListener("invalid", () => {
    if (pass.validity.valueMissing) {
        pass.setCustomValidity("خطأ أدخل كلمة المرور");
    } else if (email.validity.typeMismatch) {
        pass.setCustomValidity("خطأ أدخل كلمة المرور بشكل غير صحيح");
    } else {
        pass.setCustomValidity("");
    }
});

//send data
let from = document.getElementById("from");
from.addEventListener("submit", (e) => {
    e.preventDefault();
    let con_email = /\w+@gmail.com/;
    let con_pass = /\w+/ig;
    if (con_email.test(email.value) == false) {
        document.getElementById("email_div").innerHTML = "خطأ أدخل البريد الإلكتروني الخاص بك بشكل غير صحيح";
    } else {
        document.getElementById("email_div").innerHTML = "";
        localStorage.setItem("email_user", 1);
    }
    if (con_pass.test(pass.value) == false) {
        document.getElementById("pass_div").innerHTML = "خطأ أدخل كلمة المرور بشكل غير صحيح";
    } else {
        document.getElementById("pass_div").innerHTML = "";
        localStorage.setItem("pass_user", 1);
    }
    if (localStorage.getItem("email_user") == 1 && localStorage.getItem("pass_user") == 1) {
        let Data = {
            'user': email.value,
            'pass': pass.value
        };
        let requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer your-token'
            },
            body: JSON.stringify(Data)
        };

        fetch('./api.php', requestOptions)
            .then(response => response.text())
            .then(data => {
                const dataMatch = data.match(/data: (.+)\n\n/);
                if (dataMatch) {
                    const jsonData = JSON.parse(dataMatch[1]);
                    if (jsonData.Con.email == true) {
                        if (jsonData.Con.pass == true) {
                            singInForm.classList.add("hidden");
                            document.getElementById("email_div").innerHTML = "";
                            document.getElementById("pass_div").innerHTML = "";
                            localStorage.removeItem("email_user");
                            localStorage.removeItem("pass_user");
                            let send_email = btoa(email.value);
                            let send_id = btoa(jsonData.Con.id);
                            localStorage.setItem("UserInformation", send_email);
                            localStorage.setItem("send_id", send_id);
                            email.innerHTML = '';
                            pass.innerHTML = '';
                        } else {
                            document.getElementById("email_div").innerHTML = "";
                            document.getElementById("pass_div").innerHTML = "خطأ أدخل كلمة المرور بشكل غير صحيح";
                        }
                    } else {
                        document.getElementById("email_div").innerHTML = "خطأ أدخل البريد الإلكتروني الخاص بك بشكل غير صحيح";
                    }
                }
            });
        //singInForm.classList.add("hidden");
    }
});

if (localStorage.getItem("UserInformation") !== null) {
    singInForm.classList.add("hidden")
}
document.getElementById("time").addEventListener("click", () => {
    localStorage.setItem("time", btoa("time"));
    localStorage.removeItem("ac");
    window.location.href = "../../../Request/vacation/index.html";
});
document.getElementById("ac").addEventListener("click", () => {
    location.assign("../../../Request/vacation/index.html");
    localStorage.setItem("ac", btoa("ac"));
    localStorage.removeItem("time");
});
