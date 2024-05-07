<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli('localhost', 'serverwe_patholo', 'Wmps@2019', 'serverwe_pathology');
    $conn->set_charset('utf8mb4');
} catch (Exception $e) {
    error_log($e->getMessage());
}
?>