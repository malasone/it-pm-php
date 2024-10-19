<?php  
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFF4EA;
            font-family: sans-serif;
            margin: 0;
        }
        .sidebar {
            height: 100vh;
            width:250px;
            background-color: #AEDD7F;
            color: white;
            position: fixed;
            overflow-y: auto;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #9cc672;
        }
        .content {
            margin-left: 300px;
            padding: 20px;
            display: flex;
        }
        .product-list {
            margin-right: 20px;
            margin-top: 50px;   
            flex-grow: 1;
        }
        .order-summary {
            margin-top: 50px;   
            margin-left:40px;
            width: 350px;
            border: 1px solid #ced4da;
            padding: 20px;
            background-color: white;
            position: sticky;
            top: 20px;
        }
        .order-total {
            font-weight: bold;
            font-size: 1.2em;
        }
        ul#order-items {
            list-style-type: none;
            padding-left: 0;
        }
        ul#order-items li {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            padding-bottom: 20px;
        }

        .add-to-order {
            background-color: #8FD14F;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 0px;
            margin-left: 225px;
            margin-top: 10px;
        }

        .add-to-order:hover {
            background-color: #3e8e41;
        }

        .order-form .form-group.row {
            margin-bottom: 10px;
        }

        .order-form .form-group.row .col-md-6 {
            padding: 0;
        }

        .order-form .form-group.row label {
            margin-bottom: 5px;
        }

        #clear-list {
            background-color: #dc3545; 
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 0px;
        }

        #clear-list:hover {
            background-color: #c82333;
        }

        #print-receipt {
            background-color: #28a745; 
            color: #ffffff; 
            border: none; 
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 0px;
        }

        #print-receipt:hover {
            background-color: #1f7e25;
        }

        .size-select {
            width: 170px; 
            height: 38px; 
            font-size: 16px; 
        }

    </style>

</head>

<body>

    <div class="d-flex">
        <div class="sidebar p-3">
        <h2>Welcome, <span id="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?>!</span></h2>
        <img src="logo.jpg" style="width:100px" class="center">
            <div class="col-md-6 text-right">

            </div>
            <h3>Dashboard</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function () {
        let orderItems = []; // Array to store the order items

        // Function to update the order summary
        function updateOrderSummary() {
            $('#order-items').empty(); // Clear previous items
            let total = 0; // Reset total price

            const date = new Date();
            $('#order-date').text(date.toLocaleDateString()); // Display current date
            $('#order-time').text(date.toLocaleTimeString()); // Display current time

            orderItems.forEach((item, index) => {
                $('#order-items').append(`
                    <li>
                        ${item.product} (${item.size}) - ₱${item.price.toFixed(2)} x ${item.quantity} 
                        <button class="remove-item btn btn-danger btn-sm" data-index="${index}">Remove</button>
                    </li>
                `);
                total += item.price * item.quantity; // Add price to total
            });

            $('#total-price').text(total.toFixed(2)); // Update total price
        }

        // Add to order event
        $('.add-to-order').click(function () {
            const product = $(this).closest('.order-form').find('.size-select').data('product');
            const size = $(this).closest('.order-form').find('.size-select').val();
            const price = parseFloat($(this).closest('.order-form').find('.size-select option:selected').data('price'));
            const quantity = parseInt($(this).closest('.order-form').find('.quantity-input').val());

            // Create order item object
            const orderItem = {
                product: product,
                size: size,
                price: price,
                quantity: quantity
            };

            // Add to order items array
            orderItems.push(orderItem);

            // Update order summary
            updateOrderSummary();
        });

        // Remove item event
        $(document).on('click', '.remove-item', function () {
            const index = $(this).data('index');
            orderItems.splice(index, 1); // Remove item from array

            // Update order summary
            updateOrderSummary();
        });
        // Clear list event
            $('#clear-list').click(function () {
            orderItems = []; // Clear all items from the array
            updateOrderSummary(); // Update the order summary
        });
        // Print receipt event
        $('#print-receipt').click(function () {
        const orderData = {
        orderItems: orderItems, // The array of order items
        totalPrice: $('#total-price').text() // The total price as a string
        };
        $.ajax({
                type: 'POST',
                url: 'history.php', // Change to the actual path of your PHP script
                data: { orderDetails: JSON.stringify(orderItems) },
                success: function(response) {
                    console.log(response); // You can log the response for debugging
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error); // Handle error
                }
            });

    // Send the data via POST to 'receipt.php'
    $.ajax({
        type: 'POST',
        url: 'receipt.php', // Path to the PHP file
        data: {
            orderItems: JSON.stringify(orderData.orderItems), // Convert the array to a JSON string
            totalPrice: orderData.totalPrice
            },
        success: function (response) {
            // Open the new tab with the response, or redirect after POST
            const newTab = window.open();
            
            newTab.document.write(response);
            newTab.document.close();
            
            },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error); // Handle any error
            }
        });
    });

    });
    </script>
</body>
</html>
