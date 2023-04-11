<?php
// Start session
session_start();

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "login");

// Check for form submission
if(isset($_POST["submit"])) {
  // Get form data
  $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
  $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
  $phone_number = mysqli_real_escape_string($conn, $_POST["phone_number"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $fitness_goals = mysqli_real_escape_string($conn, $_POST["fitness_goals"]);
  $workout_schedule = mysqli_real_escape_string($conn, $_POST["workout_schedule"]);
  $fitness_level = mysqli_real_escape_string($conn, $_POST["fitness_level"]);

  // Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert data into database
  $sql = "INSERT INTO members (first_name, last_name, phone_number, email, password, fitness_goals, workout_schedule, fitness_level) VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$hashed_password', '$fitness_goals', '$workout_schedule', '$fitness_level')";
  if(mysqli_query($conn, $sql)) {
    // Redirect to login page
    header("Location: login.php");
    exit;
  } else {
    // Display error message
    echo "Error: " . mysqli_error($conn);
  }
}

// Close database connection
mysqli_close($conn);
?>

<html>
<head>
  <title>FitWorks - Sign Up</title>
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
    input[type="text"],
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
  <h1>Sign Up</h1>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>

    <label for="phone_number">Phone Number:</label>
    <input type="text" name="phone_number" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <label for="fitness_goals">Fitness Goals:</label>
    <textarea name="fitness_goals" rows="3"></textarea>

    <label for="workout_schedule">Workout Schedule:</label>
    <textarea name="workout_schedule" rows="3"></textarea>

    <label for="fitness_level">Fitness Level:</label>
    <select name="fitness_level">
      <option value="beginner">Beginner</option>
      <option value="intermediate">Intermediate</option>
      <option value="advanced">Advanced</option>
    </select>

    <?php if(isset($signup_error)) { echo "<div class='error'>" . $signup_error . "</div>"; } ?>

    <input type="submit" name="submit" value="Sign Up">
  </form>
</body>
</html>
