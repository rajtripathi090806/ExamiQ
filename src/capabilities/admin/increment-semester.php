
<?php

require_once "../../../auth/config.php";



function incrementSemester() {
    $query = "update tbl_students set semester = semester + 1";
    incrementYear();
}



function incrementYear() {
    // year will be incremented only in odd semesters
    $query = "update tbl_students set year = year + 1 where semester mod 2 <> 0";
    incrementSection();
}



function incrementSection() {
    // check the onPromotion column in tbl_sections
    mailPassoutStudents();
}



function mailPassoutStudents() {
    $passoutStudents = getPassoutStudents();
    generateExcel($passoutStudents);
    sendEmail();
}

function getPassoutStudents() {
    $query = "select * from tbl_students where semester > 8";
    return $passoutStudents;
}

function generateExcel($arrayData) {
    // use PHP Spreadsheet library
}

function sendEmail() {
    // this is already created in notes-nest software
}

?>
