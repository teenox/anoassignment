<?php
// Start session
session_start();

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "login");

// Check for form submission
if(isset($_POST["submit"])) {
  // Get form data
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  // Query database for user with matching email
  $sql = "SELECT * FROM members WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if(password_verify($password, $row["password"])) {
      // Password is correct, start session and redirect to dashboard
      $_SESSION["member_id"] = $row["member_id"];
      $_SESSION["email"] = $row["email"];
      $_SESSION["first_name"] = $row["first_name"];
      $_SESSION["last_name"] = $row["last_name"];
      header("Location: dashboard.php");
      exit;
    } else {
      // Password is incorrect, display error message
      $login_error = "Incorrect email or password.";
    }
  } else {
    // No user with matching email found, display error message
    $login_error = "Incorrect email or password.";
  }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>FitWorks - Sign In</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
    }
    form {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 20px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    .error {
      color: #ff0000;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h1>Sign In</h1>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <?php if(isset($signin_error)) { echo "<div class='error'>" . $signin_error . "</div>"; } ?>

    <input type="submit" name="submit" value="Sign In">
  </form>
</body>
</html>

     
