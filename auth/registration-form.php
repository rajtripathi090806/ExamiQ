
<?php
    require_once 'config.php';

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

<?php injectBoilerplate($title = "ExamiQ - Registration Form", $cssFile = "auth.css"); ?>

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
                $activeTabIndex = 1
            );
        ?>
    </header>



    <main class="d-flex justify-content-center">

        <div class="registration-card">

            <div style="width: 100%;"> <!-- this extra div is used for 'align-items: center' for its parent 'registration-card' -->

                <!-- header -->
                <div class="text-center mb-4 mb-md-5">
                    <h3>Registration Form</h3>
                </div>

                <form onsubmit="register(event)" enctype="multipart/form-data" autocomplete="off" id="regnForm" novalidate>

                    <!-- profile photo -->
                    <div class="d-flex justify-content-center mb-4 mb-md-5">
                        <label class="photo-box d-flex align-items-center justify-content-center" for="profilePhoto">
                            <i class="bi bi-person photo-icon"></i>
                        </label>
                        <input type="file" class="d-none" id="profilePhoto" name="profilePhoto" onchange="changeProfilePhoto(this);"
                            accept=".jpg, .jpeg, .png, .webp, image/jpeg, image/png, image/webp" />
                    </div>
                    
                    <div class="row gx-5 gy-3">

                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="stuName">Student's Name</label>
                            <input type="text" class="form-control" id="stuName" name="stuName" required />
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="batch">Batch</label>
                            <select class="form-select" id="batch" name="batchId[]" required multiple>
                                <!-- batch list (options) is fetched using ajax -->
                                <?php require_once 'get-batch-list.php'; ?>
                            </select>
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" selected>-- Select --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="contactNo">Contact No.</label>
                            <input type="number" min="0" class="form-control" id="contactNo" name="contactNo" required />
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="emailId-regn">Email Id</label>
                            <div class="input-group">
                                <input type="email" class="form-control disable-cut-copy-paste" id="emailId-regn" name="emailId-regn" required />
                                <span class="bg-success input-group-text d-none lbl-verified" tabindex="-1"><i class="bi bi-check-circle-fill"></i>&nbsp;Verified</span>
                                <button type="button" class="btn btn-primary input-group-text" id="btn-sendRegnOTP" onclick="sendRegnOTP();">Send OTP</button>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="otp">OTP</label>
                            <div class="input-group">
                                <input type="password" class="form-control disable-cut-copy-paste" id="otp" name="otp" required />
                                <span class="bg-success input-group-text d-none lbl-verified" tabindex="-1"><i class="bi bi-check-circle-fill"></i>&nbsp;Verified</span>
                                <button type="button" class="btn btn-secondary input-group-text" onclick="passwordToggle(this)" tabindex="-1"><i class="bi bi-eye"></i></button>
                                <button type="button" class="btn btn-primary input-group-text" onclick="verifyOTP(this);">Verify OTP</button>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control disable-cut-copy-paste" id="password" name="password" required />
                                <button type="button" class="btn btn-secondary input-group-text" onclick="passwordToggle(this)" tabindex="-1"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-sm-6 mb-1">
                            <label class="form-label mb-3" for="conPassword">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control disable-cut-copy-paste" id="conPassword" required />
                                <button type="button" class="btn btn-secondary input-group-text" onclick="passwordToggle(this)" tabindex="-1"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-success py-3 my-3 w-100 fs-5">Register</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </main>
    
</div>

<?php injectFooter($jsFile = "registration-form.js"); ?>

</body>
</html>
