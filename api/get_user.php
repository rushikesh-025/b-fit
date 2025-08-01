<?php
include("db.php");

$userId = $_GET['id'];
$sql = "SELECT * FROM registration WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["message" => "User not found"]);
}
?>
