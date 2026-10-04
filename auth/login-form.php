
<?php
    require_once 'config.php';

    // checking if the user is already logged in or not

    if (isset($_SESSION['role'])) {
        // ✅ user is already logged in
        if ($_SESSION['role'] === "Student") { header("location: ../student/exams.php"); die(); }
        else if ($_SESSION['role'] === "Exam Coordinator") { header("location: ../exam-coordinator/students.php"); die(); }
        else { header("location: ../admin/students.php"); die(); }
    }

    $_SESSION['otpVerified'] = false;
    $_SESSION['otp'] = "";
    $_SESSION['otpExpiry'] = "";
?>

<?php
    require_once '../src/php/html-boilerplate.php';
    require_once '../src/php/loader.php';
    require_once '../src/php/header.php';
    require_once '../src/php/footer.php';
?>

<?php injectBoilerplate($title = "ExamiQ - Login Form", $cssFile = "auth.css"); ?>

<body>

<?php injectLoader(); ?>



<div class="wrapper"> <!-- to prevent any (chrome) extensions from injecting its own source into the body -->

    <header>
        <?php
            injectHeader(
                $tabs = [
                    "<i class='me-2 bi bi-box-arrow-right'></i>Login" => "login-form.php",
                    "<i class='me-2 bi bi-person-plus-fill'></i>Register" => "registration-form.php"
                ],
                $activeTabIndex = 0
            );
        ?>
    </header>



    <main class="d-flex justify-content-center align-items-sm-center">

        <div class="login-card">

            <div style="width: 100%;"> <!-- this extra div is used for 'align-items: center' for its parent 'registration-card' -->

                <!-- header -->
                <div class="text-center mb-5">
                    <h3>Login Form</h3>
                </div>

                <!-- tabs - login with password and login with otp -->
                <ul class="nav nav-pills nav-justified my-4">
                    <li class="nav-item"><button type="button" class="nav-link active" data-bs-toggle="pill" data-bs-target="#passwordLoginForm">Password</button></li>
                    <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="pill" data-bs-target="#otpLoginForm">OTP</button></li>
                </ul>

                <div class="tab-content">

                    <!-- form - login with password -->

                    <div class="tab-pane fade show active" id="passwordLoginForm">

                        <form onsubmit="loginWithPassword(event)" method="post" autocomplete="off" id="loginWithPassword" novalidate>

                            <div class="mb-4">
                                <label class="form-label mb-3" for="emailId_password">Email Id</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="emailId_password"><i class="bi bi-envelope"></i></label>
                                    <input type="email" class="form-control disable-cut-copy-paste" id="emailId_password" name="emailId" required />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label mb-3" for="password">Password</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="password"><i class="bi bi-lock"></i></label>
                                    <input type="password" class="form-control disable-cut-copy-paste" id="password" name="password" required />
                                    <button type="button" class="btn btn-secondary input-group-text" onclick="passwordToggle(this)" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success py-2 my-3 w-100">Login</button>

                        </form>

                        <div class="text-center mt-1">
                            <span class="text-secondary">Didn't have an account?</span><br />
                            <a href="registration-form.php" class="text-decoration-none d-block mt-1">Register Here</a>
                        </div>

                    </div>

                    <!-- form - login with otp -->

                    <div class="tab-pane fade" id="otpLoginForm">

                        <form onsubmit="loginWithOTP(event)" method="post" autocomplete="off" id="loginWithOTP" novalidate>

                            <div class="mb-4">
                                <label class="form-label mb-3" for="emailId_otp">Email Id</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="emailId_otp"><i class="bi bi-envelope"></i></label>
                                    <input type="email" class="form-control disable-cut-copy-paste" id="emailId_otp" name="emailId" required />
                                    <button type="button" class="btn btn-primary input-group-text" id="btn-sendLoginOTP" onclick="sendLoginOTP();">Send OTP</button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label mb-3" for="otp">OTP</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="otp"><i class="bi bi-lock"></i></label>
                                    <input type="password" class="form-control disable-cut-copy-paste" id="otp" name="otp" required />
                                    <button type="button" class="btn btn-secondary input-group-text" onclick="passwordToggle(this)" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success py-2 my-3 w-100">Verify OTP & Login</button>

                        </form>

                        <div class="text-center mt-1">
                            <span class="text-secondary">Didn't have an account?</span><br />
                            <a href="registration-form.php" class="text-decoration-none d-block mt-1">Register Here</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<?php injectFooter($jsFile = "login-form.js"); ?>

</body>
</html>
