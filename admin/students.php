
<?php
    require_once '../auth/config.php';

    // checking if the user is already logged in or not

    // if (!isset($_SESSION['role'])) {
    //     // ❌ user is not logged in
    //     header("location: ../auth/login-form.php");
    //     die();
    // }
?>

<?php
    require_once '../src/php/html-boilerplate.php';
    require_once '../src/php/loader.php';
    require_once '../src/php/header.php';
    require_once '../src/php/footer.php';
?>

<?php injectBoilerplate($title = "ExamiQ - Admin - Students", $cssFile = "admin.css"); ?>

<body>

<?php injectLoader(); ?>



<div class="wrapper"> <!-- to prevent any (chrome) extensions from injecting its own source into the body -->

    <header>
        <?php
            injectHeader(
                $tabs = [
                    "<i class='me-2 bi bi-people-fill'></i>Students" => "students.php",
                    "<i class='me-2 bi bi-file-earmark-text'></i>Exams</a>" => "exams.php",
                    "<i class='me-2 bi bi-bar-chart'></i>Results</a>" => "results.php",
                    "<i class='me-2 bi bi-exclamation-circle'></i>Grievances</a>" => "grievances.php",
                    "<i class='me-2 bi bi-person-lines-fill'></i>Users</a>" => "users.php",
                    "<i class='me-2 bi bi-mortarboard'></i>Batches</a>" => "batches.php",
                    "<i class='me-2 bi bi-person-circle'></i>Profile</a>" => "profile.php",
                    "<i class='me-2 bi bi-box-arrow-left'></i>Logout</a>" => "logout.php",
                ],
                $activeTabIndex = 0
            );
        ?>
    </header>



    <main class="p-lg-4">

        <div class="content-header p-3 p-lg-0">
            <h5 class="m-0">Admin <i class="bi bi-chevron-compact-right"></i> Students</h5>
            <button class="btn btn-success px-3 py-2"><i class="bi bi-person-fill-add"></i> Add New Student</button>
            <button class="btn btn-danger px-3 py-2"><i class="bi bi-person-fill-dash"></i> Delete Selected</button>
            <button class="btn btn-primary px-3 py-2"><i class="bi bi-arrow-bar-up"></i> Export</button>
            <input type="text" class="form-control w-auto" id="searchStudents" placeholder="Search ..." />
        </div>

        <div class="table-responsive">

            <table id="studentsTable" class="table table-striped table-hover align-middle nowrap w-100">

                <thead style="font-weight: 100;"> 
                    <tr>
                        <th><!-- select checkbox --></th>
                        <th><!-- profile photo --></th>
                        <th style="text-align: center;">Stu Id</th>
                        <th style="text-align: left;">Student's Name</th>
                        <th style="text-align: center;">Batch</th>
                        <th style="text-align: center;">Gender</th>
                        <th style="text-align: left;">Email Id</th>
                        <th style="text-align: center;">Contact No.</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                
                <tbody style="font-weight: 100;">

                    <tr>
                        <td><!-- select checkbox --></td>
                        <td style="text-align: center;"><img src="../profile-photos/1.jpg" alt="" class="profile-photo" /></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: left;">Raj Tripathi</td>
                        <td style="text-align: center;">1st Year</td>
                        <td style="text-align: center;">Male</td>
                        <td style="text-align: left;">raj.tripathi.090806@gmail.com</td>
                        <td style="text-align: center;">9519595245</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>

                    <tr>
                        <td><!-- select checkbox --></td>
                        <td style="text-align: center;"><img src="../profile-photos/1.jpg" alt="" class="profile-photo" /></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: left;">Raj Tripathi</td>
                        <td style="text-align: center;">1st Year</td>
                        <td style="text-align: center;">Male</td>
                        <td style="text-align: left;">raj.tripathi.090806@gmail.com</td>
                        <td style="text-align: center;">9519595245</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>

                    <tr>
                        <td><!-- select checkbox --></td>
                        <td style="text-align: center;"><img src="../profile-photos/1.jpg" alt="" class="profile-photo" /></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: left;">Raj Tripathi</td>
                        <td style="text-align: center;">1st Year</td>
                        <td style="text-align: center;">Male</td>
                        <td style="text-align: left;">raj.tripathi.090806@gmail.com</td>
                        <td style="text-align: center;">9519595245</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>

                    <tr>
                        <td><!-- select checkbox --></td>
                        <td style="text-align: center;"><img src="../profile-photos/1.jpg" alt="" class="profile-photo" /></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: left;">Raj Tripathi</td>
                        <td style="text-align: center;">1st Year</td>
                        <td style="text-align: center;">Male</td>
                        <td style="text-align: left;">raj.tripathi.090806@gmail.com</td>
                        <td style="text-align: center;">9519595245</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>
                    
                    <?php

                        $query = "
                            SELECT
                                u.profilePhoto,
                                s.stuId,
                                u.username,
                                b.batchName,
                                s.gender,
                                u.emailId,
                                s.contactNo
                            FROM tbl_users u
                            JOIN tbl_students s ON s.userId = u.userId
                            JOIN tbl_batches b ON b.batchId = s.batchId
                            ORDER BY s.stuId DESC;
                        ";
                        
                        $result = mysqli_query($conn, $query);

                        while ($student = mysqli_fetch_assoc($result)) {
                            echo "
                                <tr>
                                    <td><!-- select checkbox --></td>
                                    <td><img src='' alt='' class='profile-photo' /></td>
                                    <td>" . htmlspecialchars($student['profilePhoto']) . "</td>
                                    <td>" . htmlspecialchars($student['stuId']) . "</td>
                                    <td>" . htmlspecialchars($student['username']) . "</td>
                                    <td>" . htmlspecialchars($student['batchName']) . "</td>
                                    <td>" . htmlspecialchars($student['gender']) . "</td>
                                    <td>" . htmlspecialchars($student['emailId']) . "</td>
                                    <td>" . htmlspecialchars($student['contactNo']) . "</td>
                                    <td>
                                        <button class='btn btn-sm btn-outline-primary'>Edit</button>
                                        <button class='btn btn-sm btn-outline-danger'>Delete</button>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
                
                </tbody>

            </table>

        </div>

    </main>

</div>

<?php injectFooter($jsFile = "admin.js"); ?>

</body>
</html>
