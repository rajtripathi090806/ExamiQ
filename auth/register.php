
<?php

require_once "config.php";

// getting all the raw inputs into data array
$data = [];
foreach ($_POST as $key => $value) { $data[$key] = mysqli_real_escape_string($conn, trim($value)); }






// checking if the email / otp is verified or not
if ($_SESSION['otpVerified'] == false) { echo -1; die(); } // ❌ email / otp is not verified



// checking if the profilePhoto successfully came to the server (this file) or not
if (
    $_FILES['profilePhoto']['error'] != 0 ||
    !is_uploaded_file($_FILES['profilePhoto']['tmp_name']) ||
    empty($_FILES['profilePhoto']['name']) ||
    getimagesize($_FILES['profilePhoto']['tmp_name']) == false
) {
    echo -2; // ❌ profilePhoto does not came to the server (this file) or is corrupted by any chance
    die();
}



// checking if the contactNo already exists in the database or not
$query = "SELECT COUNT(*) as total FROM tbl_students WHERE contactNo = '$data[contactNo]';";
$result = mysqli_query($conn, $query);
if (mysqli_fetch_assoc($result)['total'] > 0) { echo -3; die(); } // ❌ duplicate contact found






// inserting data into the database

try {

    // start the transaction
    mysqli_begin_transaction($conn);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $profilePhoto = $_FILES['profilePhoto'];
        $serverStorage = null;

        // inserting data into tbl_users
        $query = "INSERT INTO tbl_users VALUES ('', '$data[stuName]', '$data[emailId]', '$data[password]', 'Student', NULL);";
        // '' is for stuId (primary key - auto generated), and NULL for profilePhoto
        if (!mysqli_query($conn, $query)) { throw new Exception("Something went wrong. Please try again later."); }

        // getting userId to insert into tbl_students
        $userId = mysqli_insert_id($conn);

        // inserting data into tbl_students
        $query = "INSERT INTO tbl_students VALUES ('', '$userId', '$data[batchId]', '$data[gender]', '$data[contactNo]');";
        if (!mysqli_query($conn, $query)) { throw new Exception("Something went wrong. Please try again later."); }

        // uploading profilePhoto to the server storage
        $tmpPhoto = $profilePhoto['tmp_name'];
        $photoExt = strtolower(pathinfo($profilePhoto['name'], PATHINFO_EXTENSION));
        $serverStorage = "uploads/profile-photos/$userId.$photoExt";
        $photo = $serverStorage;
        if (!move_uploaded_file($tmpPhoto, "../$serverStorage")) { throw new Exception("Something went wrong. Please try again later."); }

        // updating the tbl_users with photo (profile photo) path
        $query = "UPDATE tbl_users SET photo = '$photo' WHERE userId = '$userId';";
        if (!mysqli_query($conn, $query)) { throw new Exception("Something went wrong. Please try again later."); }

    // commit the transaction and echo 1 to show the success
    mysqli_commit($conn);
    echo 1;
}
catch (Exception $e) {
    // rollback the transaction, delete the uploaded profilePhoto (if any), and echo the error message
    mysqli_rollback($conn);
    if ($serverStorage !== null && file_exists("../$serverStorage")) { unlink("../$serverStorage"); }
    echo $e->getMessage();
}

?>
