
<?php

require_once 'config.php';
require_once '../src/includes/PHPMailer_6.9.2/email-sender.php';

$function = $_POST['function'];
$function();



function generateOTP() {

    // generating the otp
    $otp = random_int(100000, 999999);

    // saving the otp in session variable
    $_SESSION['otpVerified'] = false;
    $_SESSION['otp'] = $otp;
    $_SESSION['otpExpiry'] = time() + (5 * 60); // otp validity = 5 minutes

    // return the otp
    return $otp;
}



function sendLoginOTP() {

    global $conn;
    $emailId = mysqli_real_escape_string($conn, trim($_POST['emailId']));

    // checking if the entered emailId exists in the database or not
    $query = "SELECT username FROM tbl_users WHERE emailId = '$emailId';";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) { echo -1; die(); } // ❌ no such emailId exist

    $username = mysqli_fetch_assoc($result)['username'];
    $otp = generateOTP();

    // sending otp to the email id

    $to = [[$emailId, $username]];
    $subject = "OTP For Login - ExamiQ";

    $body = "
        <body style='margin:0; padding:0; letter-spacing: 1.1px; font-family: verdana, sans-serif;'>
            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background: #f4f6f9;'>
                <tr>
                    <td align='center'>
                        <table width='600' cellpadding='0' cellspacing='0' border='0' style='background: #fff;'>

                            <!-- header -->
                            <tr>
                                <td align='center' style='background: #0d6efd; color: #fff; padding: 25px;'>
                                    <h3 style='margin: 0;'>ExamiQ</h3>
                                </td>
                            </tr>

                            <!-- content -->

                            <tr>
                                <td style='padding: 30px; color: #222;'>
                                    <p style='font-size: 13px;'>Dear $username,</p>
                                    <p style='font-size: 13px;'>We've received a request to login to your ExamiQ account.</p>
                                    <p style='font-size: 13px;'>Please use the following OTP to login.</p>

                                    <table align='center' cellpadding='0' cellspacing='0' border='0' style='margin: 30px auto;'>
                                        <tr>
                                            <td align='center' style='background: #f8f9fa; border: 2px dashed #0d6efd; padding: 15px 25px; font-size: 30px; letter-spacing: 5px; color: #0d6efd;'>
                                                <strong>$otp</strong>
                                            </td>
                                        </tr>
                                    </table>

                                    <p style='font-size: 13px;'>This OTP is valid for 5 minutes.</p>
                                    <p style='font-size: 13px;'>For your security, never share this OTP with anyone.</p>
                                </td>
                            </tr>

                            <!-- footer -->
                            <tr>
                                <td align='center' style='background: #eee; color: #888; padding: 20px'>
                                    <p style='font-size: 13px;'><strong>ExamiQ</strong><br /></p>
                                    <p style='font-size: 13px;'>(This is an auto generated email. Please do not reply.)<br /></p>
                                    <p style='font-size: 13px;'>&copy; " . date('Y') . " ExamiQ. All Rights Reserved.</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </body>
    ";

    $altBody = "
        ExamiQ

        Dear $username,
        We've received a request to login to your ExamiQ account.
        Please use the following OTP to login.

        $otp

        This OTP is valid for 5 minutes only.
        For your security, never share this OTP with anyone.

        ExamiQ
        (This is an auto generated email. Please do not reply.)
        &copy; " . date('Y') . " ExamiQ. All Rights Reserved.
    ";

    echo sendEmail($to, $subject, $body, $altBody);
}



function sendRegnOTP() {

    global $conn;
    $emailId = mysqli_real_escape_string($conn, trim($_POST['emailId']));
    $stuName = mysqli_real_escape_string($conn, trim($_POST['stuName']));

    // checking if the entered emailId already exists in the database
    $query = "SELECT COUNT(*) as total FROM tbl_users WHERE emailId = '$emailId';";
    $result = mysqli_query($conn, $query);
    if (mysqli_fetch_assoc($result)['total'] > 0) { echo -1; die(); } // ❌ emailId already exist

    $otp = generateOTP();

    // sending otp to the email id

    $to = [[$emailId, $stuName]];
    $subject = "OTP For Registration - ExamiQ";

    $body = "
        <body style='margin:0; padding:0; letter-spacing: 1.1px; font-family: verdana, sans-serif;'>
            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background: #f4f6f9;'>
                <tr>
                    <td align='center'>
                        <table width='600' cellpadding='0' cellspacing='0' border='0' style='background: #fff;'>

                            <!-- header -->
                            <tr>
                                <td align='center' style='background: #0d6efd; color: #fff; padding: 25px;'>
                                    <h3 style='margin: 0;'>ExamiQ</h3>
                                </td>
                            </tr>

                            <!-- content -->

                            <tr>
                                <td style='padding: 30px; color: #222;'>
                                    <p style='font-size: 13px;'>Hello $stuName,</p>
                                    <p style='font-size: 13px;'>We've received a request to verify your email.</p>
                                    <p style='font-size: 13px;'>Please use the following OTP to continue the verification.</p>

                                    <table align='center' cellpadding='0' cellspacing='0' border='0' style='margin: 30px auto;'>
                                        <tr>
                                            <td align='center' style='background: #f8f9fa; border: 2px dashed #0d6efd; padding: 15px 25px; font-size: 30px; letter-spacing: 5px; color: #0d6efd;'>
                                                <strong>$otp</strong>
                                            </td>
                                        </tr>
                                    </table>

                                    <p style='font-size: 13px;'>This OTP is valid for 5 minutes.</p>
                                    <p style='font-size: 13px;'>For your security, never share this OTP with anyone.</p>
                                </td>
                            </tr>

                            <!-- footer -->
                            <tr>
                                <td align='center' style='background: #eee; color: #888; padding: 20px'>
                                    <p style='font-size: 13px;'><strong>ExamiQ</strong><br /></p>
                                    <p style='font-size: 13px;'>(This is an auto generated email. Please do not reply.)<br /></p>
                                    <p style='font-size: 13px;'>&copy; " . date('Y') . " ExamiQ. All Rights Reserved.</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </body>
    ";

    $altBody = "
        ExamiQ

        Hello $stuName,
        We've received a request to verify your email.
        Please use the following OTP to continue the verification process.

        $otp

        This OTP is valid for 5 minutes only.
        For your security, never share this OTP with anyone.

        ExamiQ
        (This is an auto generated email. Please do not reply.)
        &copy; " . date('Y') . " ExamiQ. All Rights Reserved.
    ";

    echo sendEmail($to, $subject, $body, $altBody);
}



function verifyOTP() {
    
    global $conn;
    $otp = mysqli_real_escape_string($conn , trim($_POST['otp']));
    $currTime = time();

    // checking if the entered otp is incorrect or expired
    if ($otp != $_SESSION['otp'] || $currTime > $_SESSION['otpExpiry']) { echo -1; die(); } // ❌ otp is incorrect or expired

    // else - otp verified
    $_SESSION['otpVerified'] = true;
    unset($_SESSION['otp']);
    unset($_SESSION['otpExpiry']);
    echo 1;
}

?>
