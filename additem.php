<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root"; // Adjust if different
$password = ""; // Adjust if different
$dbname = "user_db"; // Use your existing database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price_small = $_POST['price_small'];
    $price_medium = $_POST['price_medium'];
    $price_large = $_POST['price_large'];

    $sql = "INSERT INTO products (name, price_small, price_medium, price_large)
            VALUES ('$name', '$price_small', '$price_medium', '$price_large')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price_small = $_POST['price_small'];
    $price_medium = $_POST['price_medium'];
    $price_large = $_POST['price_large'];

    $sql = "UPDATE products SET name='$name', price_small='$price_small', price_medium='$price_medium', price_large='$price_large' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Product
if (isset($_POST['delete_product'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch products for display
$products = $conn->query("SELECT * FROM products");

$conn->close();
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/additem.css"></link>
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>

        <!-- Add New Product Form -->
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="price_small">Price (Small)</label>
                    <input type="number" class="form-control" id="price_small" name="price_small" step="0.01" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="price_medium">Price (Medium)</label>
                    <input type="number" class="form-control" id="price_medium" name="price_medium" step="0.01" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="price_large">Price (Large)</label>
                    <input type="number" class="form-control" id="price_large" name="price_large" step="0.01" required>
                </div>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
        </form>

        <h2 class="mt-5">Product List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (Small)</th>
                    <th>Price (Medium)</th>
                    <th>Price (Large)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price_small']; ?></td>
                        <td><?php echo $row['price_medium']; ?></td>
                        <td><?php echo $row['price_large']; ?></td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $row['id']; ?>">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price_small">Price (Small)</label>
                                            <input type="number" class="form-control" id="price_small" name="price_small" value="<?php echo $row['price_small']; ?>" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price_medium">Price (Medium)</label>
                                            <input type="number" class="form-control" id="price_medium" name="price_medium" value="<?php echo $row['price_medium']; ?>" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price_large">Price (Large)</label>
                                            <input type="number" class="form-control" id="price_large" name="price_large" value="<?php echo $row['price_large']; ?>" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_product" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
