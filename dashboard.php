<?php
// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION["member_id"])){
    header("location: login.php");
    exit;
}

// Welcome message
$welcome_msg = "Welcome back, " . $_SESSION["first_name"] . " " . $_SESSION["last_name"] . "!";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }
        p {
            font-size: 24px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to FitWorks</h1>
        <p><?php echo $welcome_msg; ?></p>
        <p>You can now access our workout tracking page <a href="#">here</a>.</p>
        <p><a href="logout.php">Log out</a></p>
    </div>
</body>
</html>
