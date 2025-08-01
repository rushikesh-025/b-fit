<?php
session_start(); // Start the session

// Check if the user is logged in (if session variables are set)
if (!isset($_SESSION['Name']) || !isset($_SESSION['Email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$Name = $_SESSION['Name'];
$Email = $_SESSION['Email'];
header("Location: home.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($Name); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($Email); ?></p>

    <a href="logout.php">Logout</a>
</body>
</html>
