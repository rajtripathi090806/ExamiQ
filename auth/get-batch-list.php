
<?php

require_once "config.php";

$query = "SELECT * FROM tbl_batches ORDER BY batchName;";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['batchId'] . "'>" . $row['batchName'] . "</option>";
}

?>