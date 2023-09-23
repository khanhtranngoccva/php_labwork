<?php
require_once(__DIR__ . "/../../../vendor/autoload.php");
require_once(__DIR__ . "/model.php");

$conn = \Project\Helpers\Database::get_connection();
$logger = new \Project\Helpers\Logger("reassign_student");

header("Content-Type: application/json; charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(404);
    echo json_encode(array("success" => false, "reason" => "Endpoint not found"));
    die();
}

$result = $conn->query("UPDATE `students` SET `class` = 'Two' WHERE `mark` < 60");
if (!$result) {
    http_response_code(500);
    echo json_encode(array("success" => false, "reason" => "Database query failure"));
    $logger->error(mysqli_error($conn));
}

echo json_encode(array("success" => true));

