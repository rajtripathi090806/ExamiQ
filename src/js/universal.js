
const loader = $(".loader");
function showLoader() { loader.css("visibility", "visible"); }
function hideLoader() { loader.css("visibility", "hidden"); }

$(document).ajaxStart(showLoader);
$(document).ajaxStop(hideLoader);



// disabling the cut-copy-paste on otp, password, and conPassword
$(".disable-cut-copy-paste").on("cut copy paste", function(e) { e.preventDefault(); });



// function to show / hide password

function passwordToggle(button) {
    
    button = $(button);
    const input = button.siblings("input");
    const icon = button.find("i");

    if (input.attr("type") == "password") {
        input.attr("type", "text");
        icon.removeClass("bi-eye").addClass("bi-eye-slash");
    }
    else {
        input.attr("type", "password");
        icon.removeClass("bi-eye-slash").addClass("bi-eye");
    }
}
