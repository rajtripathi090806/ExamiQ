
<?php

    $query = "
        SELECT
            a.ansId,
            u.username,
            u.emailId,
            u.profilePhoto,
            s.gender,
            s.contactNo,
            b.batchName,

            e.examName,
            e.startTimestamp,
            e.endTimestamp,
            e.examDuration,

            r.startedAt,
            r.endedAt,
            TIMEDIFF(r.endedAt, r.startedAt) AS attemptDuration,
            r.submissionType,

            q.question,
            q.quesType,
            q.maxMarks,
            a.stuAnswer,
            a.obtMarks,
            a.aiRemarks,
            a.authorityRemarks

        FROM tbl_answers a
        JOIN tbl_students s ON s.stuId = a.stuId
        JOIN tbl_users u ON u.userId = s.userId
        JOIN tbl_batches b ON b.batchId = s.batchId
        JOIN tbl_questions q ON q.quesId = a.quesId
        JOIN tbl_exams e ON e.examId = q.examId
        JOIN tbl_results r
            ON r.stuId = a.stuId
            AND r.examId = e.examId
            
        WHERE r.resId = ?
    ";

?>
