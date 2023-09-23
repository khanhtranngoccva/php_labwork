<?php
require_once(__DIR__ . "/../../../vendor/autoload.php");
require_once(__DIR__ . "/model.php");

$conn = \Project\Helpers\Database::get_connection();
$logger = new \Project\Helpers\Logger("create_student");

header("Content-Type: application/json; charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(404);
    echo json_encode(array("success" => false, "reason" => "Endpoint not found"));
    die();
}

try {
    $body = json_decode(file_get_contents("php://input"), true);
    $logger->info($body);
} catch (\Throwable $e) {
    $logger->error($e);
    die();
}

$result = $conn->execute_query("INSERT INTO `students` (name, class, mark, sex) VALUES (?, ?, ?, ?)", [
    $body["name"],
    $body["class"],
    $body["mark"],
    $body["sex"],
]);

if (!$result) {
    http_response_code(500);
    echo json_encode(array("success" => false, "reason" => "Database query failure"));
    die();
}

echo json_encode(array("success" => true, "data" => $result));
