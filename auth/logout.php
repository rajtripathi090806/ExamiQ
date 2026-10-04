
<?php

    require_once 'config.php';

    // checking if the user is logged in or not
    if (!isset($_SESSION['role'])) { header("location: ../"); die(); } // ❌ user is not logged in

    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>ExamiQ - Logout</title>

    <!-- bootstrap 5 cdn - for dark theme - data-bs-theme="dark" -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" defer></script>

    <!-- poppins font cdn -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" />

    <!-- sweetalert -->
    <script type="text/javascript" src="../src/includes/sweetalert_11.14.4/sweetalert_11.14.4.js" defer></script>
    <script type="text/javascript" src="../src/includes/sweetalert_11.14.4/Swal.mixin.js" defer></script>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: poppins;
            font-size: 14px;
            letter-spacing: 1.2px;
            user-select: none;
        }
    </style>

</head>

<body>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: "success",
            title: "Logout Successful",
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        .then((result) => { if (result.isConfirmed) { window.location.href = "login-form.php"; } });
    });
</script>

</body>
</html>
