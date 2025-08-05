<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $User_ID = $_POST['User_ID'] ?? '';
    $Password = $_POST['Password'] ?? '';

    // Debug logs (view in Render logs)
    error_log("DEBUG User_ID: " . $User_ID);
    error_log("DEBUG Password: " . $Password);

    if (empty($User_ID) || empty($Password)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Missing User ID or Password."]);
        exit();
    }

    // Render DB credentials
    $servername = "sql12.freesqldatabase.com";
    $username = "sql12792959";
    $password = "Gttzi2v86p";
    $dbname = "sql12792959";

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

    error_log("DEBUG Rows found: " . $result->num_rows);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['User_ID'] = $User_ID; // Save in session
        echo json_encode([
            "status" => "success",
            "message" => "Login successful.",
            "Name" => $row['Name']
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "fail", "message" => "Invalid User ID or Password."]);
    }

    $stmt->close();
    $conn->close();
}
?>
