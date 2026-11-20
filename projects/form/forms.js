
document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const name = document.getElementById("name").value;
    const course = document.getElementById("course").value;
    const birthday = document.getElementById("birthday").value;
    const phone = document.getElementById("phone").value;
    const level = document.querySelector('input[name="level"]:checked');
    const interests = document.querySelectorAll('input[name="interests"]:checked');
    const message = document.getElementById("message").value;
    const color = document.getElementById("color").value;

    if (email.trim() === "" || password === "" || name.trim() === "") {
        alert("Email, Password, and Name cannot be blank.");
        return;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return;
    }

    const selectedInterests = [];

    interests.forEach(function(interest) {
        selectedInterests.push(interest.value);
    });

    const formData = {
        email: email,
        password: password,
        name: name,
        course: course,
        birthday: birthday,
        phone: phone,
        level: level ? level.value : "",
        interests: selectedInterests,
        message: message,
        color: color
    };

    console.log(formData);

    const xhr = new XMLHttpRequest();

    xhr.open("GET", "forms.json", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            alert(response.message);

            document.getElementById("myForm").reset();

        } else if (xhr.readyState === 4) {
            alert("Error submitting form.");
        }
    };

    xhr.send();
});
