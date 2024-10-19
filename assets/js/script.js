// scripts.js
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
                    ${item.product} (${item.size}) - $${item.price.toFixed(2)} x ${item.quantity} 
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

    // Confirm & Print event (opens a new tab with order details and print option)
    $('#confirm-print').click(function () {
        // Logic for confirming and printing
    });
});
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