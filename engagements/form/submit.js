
const form = document.getElementById("signup-form");

form.addEventListener("submit", function(event) {

    event.preventDefault();

    const formData = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    console.log(formData);

    if (formData.email === "" || formData.password === "") {
        alert("Please enter your email and password.");
        return;
    }

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "submit.json", true);

    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function() {

        if (xhr.readyState === 4 && xhr.status === 200) {

            const message = document.getElementById("message");
            const response = JSON.parse(xhr.responseText);

           message.textContent = response.message;
message.style.color = "green";
message.style.fontWeight = "bold";
        } else if (xhr.readyState === 4) {

            alert("Error submitting form.");

        }

    };

    xhr.send(JSON.stringify(formData));

});
