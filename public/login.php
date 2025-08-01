<?php

session_start(); // Start the session

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $User_ID = $_POST['User_ID'] ?? '';
    $Password = $_POST['Password'] ?? '';

    $servername = "localhost";
    $username = "root";
    $password = "root123";
    $dbname = "b_fit";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database connection failed."]);
        exit();
    }

    $sql = "SELECT Name FROM registration WHERE User_ID = ? AND Password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "SQL Error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("ss", $User_ID, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc(); // Fetch Name

        echo json_encode([
            "status" => "success",
            "message" => "Login successful.",
            "Name" => $row['Name'] // 🔥 Send name back to frontend
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "fail", "message" => "Invalid credentials."]);
    }

    $stmt->close();
    $conn->close();
}
?>
