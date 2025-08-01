<?php
header("Content-Type: application/json");

// Database credentials
$host = 'localhost';
$dbname = 'b_fit';
$username = 'root';
$password = 'root123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "DB connection failed: " . $e->getMessage()]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Name     = htmlspecialchars(trim($_POST["Name"]));
    $Email    = htmlspecialchars(trim($_POST["Email"]));
    $DOB      = $_POST["DOB"];
    $Contact  = htmlspecialchars(trim($_POST["Contact"]));
    $Address  = htmlspecialchars(trim($_POST["Address"]));
    $User_ID  = htmlspecialchars(trim($_POST["User_ID"]));
    $Password = $_POST["Password"]; // Consider hashing in real deployment

    try {
        $stmt = $pdo->prepare("INSERT INTO registration (Name, Email, DOB, Contact, Address, User_ID, Password)
                               VALUES (:Name, :Email, :DOB, :Contact, :Address, :User_ID, :Password)");
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':DOB', $DOB);
        $stmt->bindParam(':Contact', $Contact);
        $stmt->bindParam(':Address', $Address);
        $stmt->bindParam(':User_ID', $User_ID);
        $stmt->bindParam(':Password', $Password);

        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Registration failed: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
