<?php  
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
date_default_timezone_set('Asia/Manila');
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to external CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="assets/js/script.js"></script> <!-- Link to external JavaScript -->
</head>

<body>
    <div class="d-flex">
        <div class="content">
            <div class="product-list">

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
                        $conn = new mysqli("localhost", "root", "", "user_db"); // Adjust connection details if needed
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
                                        <td>₱{$row['price_small']}</td>
                                        <td>₱{$row['price_medium']}</td>
                                        <td>₱{$row['price_large']}</td>
                                        <td>
                                            <form class='order-form'>
                                                <div class='form-group row'>
                                                    <div class='col-md-6'>
                                                        <label for='size{$row['id']}'>Select Size</label>
                                                        <select class='form-control size-select' data-product='{$row['name']}'>
                                                            <option value='Small' data-price='{$row['price_small']}'>Small</option>
                                                            <option value='Medium' data-price='{$row['price_medium']}'>Medium</option>
                                                            <option value='Large' data-price='{$row['price_large']}'>Large</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class='col-md-6'>
                                                        <label for='quantity{$row['id']}'>Quantity</label>
                                                        <input type='number' class='form-control quantity-input' value='1' min='1'>
                                                    </div>
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
                <center>
                <h2>Order Summary</h2>
                <h4>Starbox Coffee Gusa</h4>

                <div id="order-date" class="printable"></div>
                <div id="order-time" class="printable"></div>
                </center>
                <ul id="order-items">
                    <!-- Order items will be added here-->
                </ul>
                <div class="order-total">Total: ₱<span id="total-price">0.00</span></div>
                <button id="clear-list" class="btn btn-warning">Clear List</button>        
                <button id="print-receipt" class="btn btn-success">Confirm</button>
                
            </div>
        </div>
    </div>
</body>
</html>
