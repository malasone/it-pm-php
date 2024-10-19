<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'user_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Perform the query and check for errors
    $register = '';
    $checkUser = $conn->query("SELECT * FROM user WHERE username='$username'");
    if (!$checkUser) {
        // Handle query failure
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    } else {
        if ($checkUser->num_rows > 0) {
            $message = "<div class='error'>Username already exists!</div>";
        } else {
            if ($conn->query("INSERT INTO user (username, password) VALUES ('$username', '$password')") === TRUE) {
                $message = "<div class='success'>Registration successful!</div>";
            } else {
                $message = "<div class='error'>Error: " . $conn->error . "</div>";
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register.css"></link>
</head>
<body>
    <div class="registration-container">
        <img src="assets/images/logo.png" alt="Logo"> <!-- Logo image -->
        <h2>Register</h2>
        <?php if (!empty($message)): ?>
            <?php echo $message; ?> <!-- Display error or success message -->
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
