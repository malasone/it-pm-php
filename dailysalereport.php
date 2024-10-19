<?php
// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get today's date
$today = date('Y-m-d');

// 1. Daily total: Calculate the total sales based on quantity and price for today.
$result = $conn->query("SELECT SUM(total_price) AS daily_total, COUNT(*) AS order_count FROM orders WHERE DATE(date) = '$today'");
$row = $result->fetch_assoc();
$daily_total = $row['daily_total'] ? $row['daily_total'] : 0;
$order_count = $row['order_count'] ? $row['order_count'] : 0;

// 2. Insert or update today's sales report in the daily_sales table
// Check if an entry already exists for today's date
$checkResult = $conn->query("SELECT * FROM daily_sales WHERE date = '$today'");
if ($checkResult->num_rows > 0) {
    // If today's report exists, update the total sales and number of orders
    $stmt = $conn->prepare("UPDATE daily_sales SET total_sales = ?, number_of_orders = ? WHERE date = ?");
    $stmt->bind_param("dis", $daily_total, $order_count, $today);
} else {
    // If not, insert a new row for today
    $stmt = $conn->prepare("INSERT INTO daily_sales (date, total_sales, number_of_orders) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $today, $daily_total, $order_count);
}

if ($stmt->execute()) {
   // echo "Daily sales report updated successfully.";
} else {
    echo "Error saving report: " . $stmt->error;
}

$stmt->close();

// Get the first order date
$result = $conn->query("SELECT MIN(date) AS first_order_date FROM orders");
$row = $result->fetch_assoc();
$first_order_date = $row['first_order_date'];

// 3. Weekly total: Only calculate if at least 7 days have passed since the first order
$weekly_total = '';
if ($first_order_date && (strtotime($today) - strtotime($first_order_date)) >= 7 * 24 * 60 * 60) {
    $result = $conn->query("SELECT SUM(total_price) AS weekly_total FROM orders WHERE DATE(date) >= DATE_SUB('$today', INTERVAL 7 DAY)");
    $row = $result->fetch_assoc();
    $weekly_total = $row['weekly_total'] ? $row['weekly_total'] : 0;
}

// 4. Monthly total: Only calculate if at least 30 days have passed since the first order
$monthly_total = '';
if ($first_order_date && (strtotime($today) - strtotime($first_order_date)) >= 30 * 24 * 60 * 60) {
    $result = $conn->query("SELECT SUM(total_price) AS monthly_total FROM orders WHERE MONTH(date) = MONTH('$today') AND YEAR(date) = YEAR('$today')");
    $row = $result->fetch_assoc();
    $monthly_total = $row['monthly_total'] ? $row['monthly_total'] : 0;
}

// 5. Yearly total: Only calculate if at least 365 days have passed since the first order
$yearly_total = '';
if ($first_order_date && (strtotime($today) - strtotime($first_order_date)) >= 365 * 24 * 60 * 60) {
    $result = $conn->query("SELECT SUM(total_price) AS yearly_total FROM orders WHERE YEAR(date) = YEAR('$today')");
    $row = $result->fetch_assoc();
    $yearly_total = $row['yearly_total'] ? $row['yearly_total'] : 0;
}

$conn->close();
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sales Report</title>
    <link rel="stylesheet" href="assets/css/dailysalesreport.css"></link>
</head>
<body>
<div class="d-flex">
    <div class="container">
    <h2>Sales Report</h2>
    <table>
        <tr>
            <th>Period</th>
            <th>Total Sales</th>
        </tr>
        <tr>
            <td>Daily</td>
            <td>₱<?= number_format($daily_total, 2) ?></td>
        </tr>
        <tr>
            <td>Weekly</td>
            <td>
                <?php if ($weekly_total !== ''): ?>
                    ₱<?= number_format($weekly_total, 2) ?>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Monthly</td>
            <td>
                <?php if ($monthly_total !== ''): ?>
                    ₱<?= number_format($monthly_total, 2) ?>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Yearly</td>
            <td>
                <?php if ($yearly_total !== ''): ?>
                    ₱<?= number_format($yearly_total, 2) ?>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
    </table>
                </div>
    </div>
</body>
</html>
