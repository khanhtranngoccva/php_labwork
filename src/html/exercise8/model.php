<?php
$conn = \Project\Helpers\Database::get_connection();
$result = $conn->query("CREATE TABLE IF NOT EXISTS `students` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(512),
    class TINYTEXT,
    mark INT,
    sex TINYTEXT,
    check(mark >= 0)
)");
if (!$result) {
    http_response_code(500);
    echo json_encode(array("success" => false, "reason" => "Database query failure"));
    die();
}