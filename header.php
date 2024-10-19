<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to external CSS -->
</head>

<div class="sidebar p-3">
    <h2>Welcome, <span id="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?>!</span></h2>
    <img src="assets/images/logo.png" style="width:100px" class="center">
    <div class="col-md-6 text-right"></div>
    <h3>Dashboard</h3>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="additem.php">Item List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="history.php">Transactions History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dailysalereport.php">Sales Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>
</div>