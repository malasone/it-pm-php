<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session only if it hasn't been started yet
}

$error = ''; // Initialize an error variable
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'user_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use real_escape_string to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check if the user exists
    $result = $conn->query("SELECT * FROM user WHERE username='$username'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; // Store session data
            header('Location: dashboard.php'); // Redirect to dashboard
            exit(); // Prevent further script execution
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Username not found!";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css"></link>
</head>
<body>
    <div class="login-container">
        <img src="assets/images/logo.png" alt="Logo"> <!-- Logo image -->
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div> <!-- Display error message -->
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
