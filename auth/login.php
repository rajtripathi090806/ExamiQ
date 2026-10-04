
<?php

require_once 'config.php';

$function = $_POST['function'];
$function();



function loginWithPassword() {

    global $conn;
    $emailId = mysqli_real_escape_string($conn, trim($_POST['emailId']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    $query = "SELECT * FROM tbl_users WHERE emailId='$emailId';";
    $result = mysqli_query($conn, $query);
    $record = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);



    // checking if the emailId exists in the database and the entered password is correct or not
    if ($record != 1 || !password_verify($password, $row['password'])) { echo -1; die(); } // ❌ emailId does not exist or password is incorrect



    $_SESSION = [
        'userId' => (int) $row['userId'], // (int) is used because by default, 'mysqli' returns the data in string type
        'username' => $row['username'],
        'role' => $row['role'],
        'accessGranted' => true,
    ];
    echo $row['role'];
}



function loginWithOTP() {

    // otp is already verified by the ajax call to otp-service.php in login-form.php

    global $conn;
    $emailId = mysqli_real_escape_string($conn, trim($_POST['emailId']));

    $query = "SELECT * FROM tbl_users WHERE emailId = '$emailId';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $_SESSION = [
        'userId' => (int) $row['userId'], // (int) is used because by default, 'mysqli' returns the data in string type
        'username' => $row['username'],
        'role' => $row['role'],
        'accessGranted' => true,
    ];
    echo $row['role'];
}

?>
