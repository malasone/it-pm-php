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
    <link rel="stylesheet" href="assets/css/receipt.css"></link>
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
