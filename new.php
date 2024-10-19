<?php  
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h3>Dashboard</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="additem.php">Add Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dailysalereport.php">Daily Sale Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="product-list">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                <p>This is your dashboard.</p>

                <h2>Product List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Small</th>
                            <th>Medium</th>
                            <th>Large</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to database
                        $conn = new mysqli("localhost", "root", "", "user_db");
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch products from the products table
                        $sql = "SELECT id, name, price_small, price_medium, price_large FROM products";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data for each product
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['name']}</td>
                                        <td>\${$row['price_small']}</td>
                                        <td>\${$row['price_medium']}</td>
                                        <td>\${$row['price_large']}</td>
                                        <td>
                                            <form class='order-form'>
                                                <div class='form-group'>
                                                    <label for='size{$row['id']}'>Select Size</label>
                                                    <select class='form-control size-select' data-product='{$row['name']}'>
                                                        <option value='Small' data-price='{$row['price_small']}'>Small</option>
                                                        <option value='Medium' data-price='{$row['price_medium']}'>Medium</option>
                                                        <option value='Large' data-price='{$row['price_large']}'>Large</option>
                                                    </select>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='quantity{$row['id']}'>Quantity</label>
                                                    <input type='number' class='form-control quantity-input' value='1' min='1'>
                                                </div>
                                                <button type='button' class='btn btn-primary add-to-order'>Add to Order</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No products available</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                <h4>Store: Starbox</h4>
                <div id="order-date"></div>
                <div id="order-time"></div>
                <ul id="order-items">
                    <!-- Order items will be added here dynamically -->
                </ul>
                <div class="order-total">Total: $<span id="total-price">0.00</span></div>
                <button id="clear-list" class="btn btn-warning">Clear List</button>
                <button id="confirm-print" class="btn btn-success">Confirm & Print</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="scripts.js"></script> <!-- Link to external JavaScript -->
</body>
</html>
