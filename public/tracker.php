<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "b_fit";
$conn = new mysqli($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userID = $_SESSION['user_id'] ?? 'B-FIT123'; // sample fallback for testing

// Fetch profile
$profileSQL = "SELECT Name, Email FROM registration WHERE User_ID = '$userID'";
$profileResult = mysqli_query($conn, $profileSQL);
$profile = mysqli_fetch_assoc($profileResult);

// Fetch last activity
$lastActivitySQL = "SELECT activity_type, activity_time FROM user_activity WHERE User_ID = '$userID' ORDER BY activity_time DESC LIMIT 1";
$lastActivityResult = mysqli_query($conn, $lastActivitySQL);
$lastActivity = mysqli_fetch_assoc($lastActivityResult);

// Calculate active time (based on login_time to now)
$activeTimeSQL = "SELECT login_time FROM user_activity WHERE User_ID = '$userID' ORDER BY login_time DESC LIMIT 1";
$loginResult = mysqli_query($conn, $activeTimeSQL);
$loginRow = mysqli_fetch_assoc($loginResult);
$loginTime = strtotime($loginRow['login_time']);
$activeDuration = round((time() - $loginTime) / 60); // in minutes

// Workout & Nutrition logs
$workoutLogs = mysqli_query($conn, "SELECT * FROM workout_logs WHERE User_ID = '$userID' ORDER BY Date DESC");
$nutritionLogs = mysqli_query($conn, "SELECT * FROM nutrition_logs WHERE User_ID = '$userID' ORDER BY Date DESC");
?>