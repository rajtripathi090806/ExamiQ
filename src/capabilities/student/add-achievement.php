
<?php

require_once '../../../auth/config.php';

$stuId              = $_POST['stuId'];
$category           = $_POST['category'];
$name               = $_POST['name'];
$description        = $_POST['description'];
$document           = $_FILES['document'];
// $docPath            = $_FILES['docPath'];
$semester           = $_POST['semester'];
$capableForWorkshop = $_POST['capableForWorkshop'];

// $query = "insert into tbl_students values ($stuId, $category, $name, $description, $docPath, $semester, $capableForWorkshop)";

?>
