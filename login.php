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
    <style>
        body {
            background-image: url('BG2.webp'); /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #fff;
        }
        .login-container img {
            width: 100px; /* Adjust logo size */
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #fff;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            box-sizing: border-box; /* Ensure padding is included in total width */
        }
        input::placeholder {
            color: #aaa; /* Placeholder color */
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838; /* Darker green on hover */
        }
        .error {
            background-color: #e74c3c; /* Red background for errors */
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        p {
            color: #fff; /* Text color for paragraph */
        }
        a {
            color: #f1c40f; /* Link color */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="L.jpg" alt="Logo"> <!-- Logo image -->
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
