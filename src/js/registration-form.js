
new TomSelect("#batch", {
    create: false,
    plugins: ["remove_button", "clear_button"],
    sortField: { field: "text", direction: "asc" }
});

new TomSelect("#gender", { create: false, });






// funtion to change profile photo

function changeProfilePhoto(input) {

    const photo = input.files[0];
    if (!photo) { return; }
    const allowedImages = ["image/jpg", "image/jpeg", "image/png", "image/webp"];
    const maxSize = 1 * 1024 * 1024; // maxSize = 1 mb

    if (!allowedImages.includes(photo.type)) {
        errorSwal.fire({ title: "Only JPG, JPEG, PNG and WEBP images are allowed." });
        input.value = "";
        return;
    }

    if (photo.size > maxSize) {
        errorSwal.fire({ title: "File size must be under 1 MB." });
        input.value = "";
        return;
    }

    const photoURL = URL.createObjectURL(photo);

    $(".photo-box")
        .css("background-image", `url(${photoURL})`)
        .css("border", "2px solid #3CB371")
        .find(".photo-icon").hide();
};



// function to send otp

function sendRegnOTP() {

    const emailId = $("#emailId");
    const stuName = $("#stuName");
    if (!emailId.val()) { errorSwal.fire({ title: "Please enter your email id." }); return; }
    else if (!stuName.val()) { errorSwal.fire({ title: "Please enter your name." }); return; }

    $.ajax({
        url: "otp-service.php",
        method: "post",
        data: { function: "sendRegnOTP", emailId: emailId.val(), stuName: stuName.val() },

        success: function(response) {

            if (response.trim() == 1) {
                successSwal.fire({ title: "OTP has been sent to the email id." });
                $("#otp").focus();
                emailId.prop("readonly", true);
                $("#btn-sendRegnOTP").html("Resend OTP");
            }
            else if (response.trim() == -1) { errorSwal.fire({ title: "The entered email id already exists in our database." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Error in sending the OTP. Please try again later." });
        }
    });
}



// function to verify otp

function verifyOTP(btn) {
    
    const otp = $("#otp");
    if (!otp.val()) { errorSwal.fire({ title: "Please enter the OTP." }); return; }

    $.ajax({
        url: "otp-service.php",
        method: "post",
        data: { function: "verifyOTP", otp: otp.val() },
        
        success: function(response) {

            if (response.trim() == 1) {
                $(btn)
                .siblings("input").attr("type", "password").prop("readonly", true) // converting the otp textbox into password format and locking it
                .siblings("button").remove() // removing the show / hide password button
                .remove(); // removing the btn itself
                $("#btn-sendRegnOTP").remove(); // removing the send otp button
                $(".lbl-verified").removeClass("d-none"); // adding the verified label
            }
            else if (response.trim() == -1) { errorSwal.fire({ title: "The entered OTP is invalid or expired." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Error in verifying the OTP. Please try again later." });
        }
    });
}



// function to register the student

function register(e) {
    
    e.preventDefault();

    // checking if the profilePhoto is uploaded or not
    if ($("#profilePhoto")[0].files.length == 0) {
        errorSwal.fire({ title: "Please choose your profile photo." });
        return;
    }

    // checking the contactNo and fatherContact length
    if ($("#contactNo").val().length != 10) {
        errorSwal.fire({ title: "Contact no. should contain 10 digits." });
        return;
    }

    // checking if the password and conPassword fields are same
    if ($("#password").val() != $("#conPassword").val()) {
        errorSwal.fire({ title: "Error in confirming the password. Please re-check." });
        return;
    }

    const formData = new FormData(document.getElementById("regnForm"));

    $.ajax({
        url: "register.php",
        method: "post",
        data: formData,
        processData: false,
        contentType: false,

        success: function(response) {

            if (response.trim() == 1) {
                Swal.fire({
                    icon: "success",
                    title: "Registration Successful",
                    text: "Please login to your account.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                })
                .then((result) => { if (result.isConfirmed) { window.location.href = "login-form.php"; } });
            }
            else if (response.trim() == -1) { errorSwal.fire({ title: "Email Id is not verified. Please verify it." }); }
            else if (response.trim() == -2) { errorSwal.fire({ title: "Error uploading profile photo. Please try again or upload another image." }); }
            else if (response.trim() == -3) { errorSwal.fire({ title: "The entered Contact No. already exists in our database. Please contact your admin." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Something went wrong. Please try again later." });
        }
    });
}
