<?php   
session_start();

// Debugging line to check the username stored in session
//echo "Logged in as: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not logged in');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

date_default_timezone_set('Asia/Manila');
include 'database.php'; // Ensure your database connection is established here

// Check if order details were sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderDetails'])) {
    $orderDetails = json_decode($_POST['orderDetails'], true);
    $username = $conn->real_escape_string($_SESSION['username']);

    // Insert each order item into the database
    foreach ($orderDetails as $item) {
        $product = $conn->real_escape_string($item['product']);
        $size = $conn->real_escape_string($item['size']);
        $quantity = intval($item['quantity']);
        $price_per_item = floatval($item['price']);
        $total_price = $price_per_item * $quantity;
        $date = date('Y-m-d H:i:s');

        // Prepare SQL insert statement
        $sql = "INSERT INTO orders (username, product, size, quantity, total_price, date) VALUES ('$username', '$product', '$size', $quantity, $total_price, '$date')";
        
        if (!$conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit();
        }
    }
    echo "Receipt saved successfully!";
    $conn->close();
    exit();
}

// Fetch user's order history
$username = $conn->real_escape_string($_SESSION['username']);
$sql = "SELECT * FROM orders WHERE username = '$username'";
$result = $conn->query($sql);

if (!$result) {
    echo "Query failed: " . $conn->error;
    exit();
}

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/history.css"></link>
</head>
<body>

</div>

<div class="container">
    <h2>Order History</h2>
    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No orders found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['product']); ?></td>
                            <td><?php echo htmlspecialchars($order['size']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
