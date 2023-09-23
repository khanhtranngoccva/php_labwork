<?php
require_once(__DIR__ . "/../../../vendor/autoload.php");
require_once(__DIR__ . "/model.php");

$conn = \Project\Helpers\Database::get_connection();
$logger = new \Project\Helpers\Logger("get_students_buckets");

header("Content-Type: application/json; charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(404);
    echo json_encode(array("success" => false, "reason" => "Endpoint not found"));
    die();
}

$result1 = $conn->query("SELECT * FROM `students` WHERE mark < 60")->fetch_all(MYSQLI_ASSOC);
$result2 = $conn->query("SELECT * FROM `students` WHERE 60 <= mark < 75")->fetch_all(MYSQLI_ASSOC);
$result3 = $conn->query("SELECT * FROM `students` WHERE mark >= 75")->fetch_all(MYSQLI_ASSOC);

$transform = function ($item) {
    // Cloning stuff instead of copying ref. neat.
    $transformed = $item;
    $transformed["mark"] = 0 + $item["mark"];
    $transformed["id"] = 0 + $item["id"];
    return $transformed;
};

$result = [
    array_map($transform, $result1),
    array_map($transform, $result2),
    array_map($transform, $result3),
];

echo json_encode(array("success" => true, "data" => $result));