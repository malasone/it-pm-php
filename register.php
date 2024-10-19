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
    <style>
        body {
            background-image: url('path/to/your/background.jpg'); /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .registration-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #fff;
        }
        .registration-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
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
            background-color: #007bff; /* Blue button color */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .error {
            background-color: #e74c3c; /* Red background for errors */
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #28a745; /* Green background for success */
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
    <div class="registration-container">
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
