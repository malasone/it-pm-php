<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
date_default_timezone_set('Asia/Manila');
// Check if the POST data is received
if (isset($_POST['orderItems']) && isset($_POST['totalPrice'])) {
    $orderItems = json_decode($_POST['orderItems'], true); // Decode the JSON string to an array
    $totalPrice = $_POST['totalPrice'];
} else {
    echo "No order data received.";
    exit(); // Stop further execution if no data is received
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Page Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .receipt-page {
            margin: 30px auto;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .receipt-border {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 10px 0;
            margin: 20px 0;
        }

        .receipt-header {
            text-align: center;
            padding-bottom: 10px;
        }

        .receipt-header h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .receipt-header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .receipt-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .receipt-summary {
            width: 100%;
            margin-bottom: 20px;
        }

        .receipt-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .receipt-items th, .receipt-items td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .receipt-items th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .receipt-total {
            text-align: right;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .receipt-total p {
            margin: 5px 0;
        }

        .receipt-buttons {
            text-align: center;
        }

        .receipt-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px 5px;
        }

        .calculator-section {
            text-align: center;
            margin: 30px 0;
        }

        .calculator-section input {
            width: 150px;
            padding: 8px;
            font-size: 16px;
        }

        /* Print Styles */
        @media print {
            body {
                background-color: #fff;
            }

            .receipt-buttons, .calculator-section {
                display: none;
            }

            .receipt-page {
                box-shadow: none;
                border: none;
                margin: 0;
            }

            .receipt-items th {
                background-color: #343a40;
                color: white;
            }

            .receipt-border {
                border-color: #000;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-page">
        <div class="receipt-header">
            <h1>Starbox Store</h1>
            <p>Villa Ernesto 2 Gate, Cagayan de Oro, Misamis Oriental</p>
            <p>Tel: (02) 1234-5678</p>
        </div>

        <div class="receipt-title">Cash Receipt</div>

        <div class="receipt-border"></div>

        <div class="receipt-summary">
            <table class="receipt-items">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product']); ?></td>
                            <td><?php echo htmlspecialchars($item['size']); ?></td>
                            <td>₱<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="receipt-border"></div>

        <div class="receipt-total">
            <p>Total: <strong>₱<?php echo number_format($totalPrice, 2); ?></strong></p>
            <p id="cashGivenText"></p>
            <p id="changeText"></p>
        </div>

        <div class="calculator-section">
            <h4>Cash Payment</h4>
            <input type="number" id="cashGiven" class="form-control" placeholder="Enter cash given">
            <button onclick="calculateChange()" class="btn btn-primary">Calculate</button>
        </div>

        <div class="receipt-buttons">
            <button class="btn btn-info" onclick="customPrint()">Print</button>
            <button class="btn btn-success" onclick="window.close()">Close</button>
        </div>
    </div>

    <script>
        let cashGiven = 0;
        let change = 0;

        function calculateChange() {
            cashGiven = parseFloat(document.getElementById('cashGiven').value);
            const totalPrice = <?php echo $totalPrice; ?>;

            if (isNaN(cashGiven) || cashGiven < totalPrice) {
                document.getElementById('changeText').innerHTML = '<span style="color:red;">Insufficient cash!</span>';
                document.getElementById('cashGivenText').innerHTML = '';
            } else {
                change = (cashGiven - totalPrice).toFixed(2);
                document.getElementById('cashGivenText').innerHTML = 'Cash Given: ₱' + cashGiven.toFixed(2);
                document.getElementById('changeText').innerHTML = 'Change: ₱' + change;
            }
        }

        function customPrint() {
            const originalContents = document.body.innerHTML;
            const printContents = document.querySelector('.receipt-page').innerHTML;
            document.body.innerHTML = printContents;

            const cashGivenText = 'Cash Given: ₱' + cashGiven.toFixed(2);
            const changeText = 'Change: ₱' + change;

            document.getElementById('cashGivenText').innerHTML = cashGivenText;
            document.getElementById('changeText').innerHTML = changeText;

            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>
