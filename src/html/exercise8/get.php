<?php
require_once(__DIR__ . "/../../../vendor/autoload.php");
require_once(__DIR__ . "/model.php");

$conn = \Project\Helpers\Database::get_connection();
$logger = new \Project\Helpers\Logger("get_students");

header("Content-Type: application/json; charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(404);
    echo json_encode(array("success" => false, "reason" => "Endpoint not found"));
    die();
}

$result = $conn->query("SELECT * FROM `students`")->fetch_all(MYSQLI_ASSOC);
$transformed_result = array_map(function ($item) {
    // Cloning stuff instead of copying ref. neat.
    $transformed = $item;
    $transformed["mark"] = 0 + $item["mark"];
    $transformed["id"] = 0 + $item["id"];
    return $transformed;
}, $result);

echo json_encode(array("success" => true, "data" => $transformed_result));