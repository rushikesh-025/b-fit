<?php
session_start(); // Start the session

// ✅ Show errors during testing (remove/comment in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ✅ Ensure we can read POST body for `application/x-www-form-urlencoded`
    if (empty($_POST)) {
        parse_str(file_get_contents("php://input"), $_POST);
    }

    $User_ID = trim($_POST['User_ID'] ?? '');
    $Password = $_POST['Password'] ?? '';

    if (empty($User_ID) || empty($Password)) {
        echo json_encode(["status" => "error", "message" => "User ID and Password are required."]);
        exit();
    }

    // 🔄 Database details
    $servername = "sql12.freesqldatabase.com";
    $port = 3306;
    $username = "sql12792959";
    $password = "Gttzi2v86p";
    $dbname = "sql12792959";

    // ✅ Connect to DB
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
        exit();
    }

    // ✅ Check user by User_ID
    $sql = "SELECT Name, Password FROM registration WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "SQL Error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $User_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // ✅ Verify password hash
        if (password_verify($Password, $row['Password'])) {
            echo json_encode([
                "status" => "success",
                "message" => "Login successful.",
                "Name" => $row['Name']
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["status" => "fail", "message" => "Invalid credentials."]);
        }
    } else {
        http_response_code(401);
        echo json_encode(["status" => "fail", "message" => "Invalid credentials."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
