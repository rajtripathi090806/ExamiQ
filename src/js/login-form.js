
// function to login with password

function loginWithPassword(e) {

    e.preventDefault();
    const form = e.target;

    if (!form.checkValidity()) {
        errorSwal.fire({ title: "Please fill out the form correctly." });
        return;
    }

    const emailId = $("#emailId_password");
    const password = $("#password");

    $.ajax({
        url: "login.php",
        method: "post",
        data: { function: "loginWithPassword", emailId: emailId.val(), password: password.val() },

        success: function(response) {
            if (response.trim() == "Student") { window.location.href = "../student/"; }
            else if (response.trim() == "Exam Coordinator") { window.location.href = "../exam-coordinator/students.php"; }
            else if (response.trim() == "Admin" || response.trim() == "Super Admin") { window.location.href = "../admin/students.php"; }
            else if (response.trim() == -1) { errorSwal.fire({ title: "Invalid Email Id or Password." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Error in login. Please try again later." });
        }
    });
}



// function to send otp

function sendLoginOTP() {

    const emailId = $("#emailId_otp");
    if (!emailId.val()) { errorSwal.fire({ title: "Please enter your email id." }); return; }

    $.ajax({
        url: "otp-service.php",
        method: "post",
        data: { function: "sendLoginOTP", emailId: emailId.val() },

        success: function(response) {

            if (response.trim() == 1) {
                successSwal.fire({ title: "OTP has been sent to the email id." });
                $("#otp").focus();
                emailId.prop("readonly", true);
                $("#btn-sendLoginOTP").html("Resend OTP");
            }
            else if (response.trim() == -1) { errorSwal.fire({ title: "The entered email id does not exist in our database." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Error in sending OTP. Please try again later." });
        }
    });
}



// function to login with otp

function loginWithOTP(e) {
    
    e.preventDefault();
    const form = e.target;

    if (!form.checkValidity()) {
        errorSwal.fire({ title: "Please fill out the form correctly." });
        return;
    }
    
    const otp = $("#otp");
    const emailId = $("#emailId_otp");

    $.ajax({
        url: "otp-service.php",
        method: "post",
        data: { function: "verifyOTP", otp: otp.val() },
        
        success: function(response) {

            if (response.trim() == 1) {
                
                $.ajax({
                    url: "login.php",
                    method: "post",
                    data: { function: "loginWithOTP", emailId: emailId.val() },

                    success: function(response) {
                        if (response.trim() == "Student") { window.location.href = "../student/exams.php"; }
                        else if (response.trim() == "Exam Coordinator") { window.location.href = "../exam-coordinator/students.php"; }
                        else if (response.trim() == "Admin" || response.trim() == "Super Admin") { window.location.href = "../admin/students.php"; }
                        else if (response.trim() == -1) { errorSwal.fire({ title: 'Invalid Email Id or Password.' }); }
                        else { errorSwal.fire({ title: response.trim() }); }
                    },

                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        errorSwal.fire({ title: "Error in login. Please try again later." });
                    }
                });
            }
            else if (response.trim() == -1) { errorSwal.fire({ title: "The entered OTP is invalid or expired." }); }
            else { errorSwal.fire({ title: response.trim() }); }
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            errorSwal.fire({ title: "Error in OTP verification. Please try again later." });
        }
    });
}
