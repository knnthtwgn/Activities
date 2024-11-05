<?php
$products = [
    "Coke" => 15,
    "Sprite" => 20,
    "Royal" => 20,
    "Pepsi" => 15,
    "Mountain Dew" => 20
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Vendo Machine</h1>

        <form action="Vendo Machine.php" method="POST">
            <!-- Products Panel -->
            <div class="border p-3 mb-3">
                <h4>Products:</h4>
                <?php foreach ($products as $product => $price): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="selected_products[]" value="<?php echo $product; ?>" id="<?php echo $product; ?>">
                        <label class="form-check-label" for="<?php echo $product; ?>">
                            <?php echo $product . " - ₱ " . $price; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Options Panel -->
            <div class="border p-3 mb-3">
                <h4>Options:</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for="size" class="form-label">Size:</label>
                        <select class="form-select" name="size" id="size">
                            <option value="regular">Regular</option>
                            <option value="up-size">Up-Size (+₱ 5)</option>
                            <option value="jumbo">Jumbo (+₱ 10)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-secondary w-100">Check Out</button>
                    </div>
                </div>
            </div>
        </form>

        <hr class="bold-line"> 

        <!-- PHP to handle the form submission and display the purchase summary -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['selected_products']) && isset($_POST['quantity']) && $_POST['quantity'] > 0) {
                $selectedProducts = $_POST['selected_products'];
                $quantity = (int) $_POST['quantity'];
                $size = $_POST['size'];

                $total = 0;
                echo "<div class='mt-4'><h4>Purchase Summary:</h4><ul>";
                foreach ($selectedProducts as $product) {
                    $productPrice = $products[$product];
                    
                    // Adjust price based on size
                    if ($size === 'up-size') {
                        $productPrice += 5;
                    } elseif ($size === 'jumbo') {
                        $productPrice += 10;
                    }

                    $itemTotal = $productPrice * $quantity;
                    $total += $itemTotal;

                    // Determine singular or plural form based on quantity
                    $pieceText = $quantity === 1 ? "piece" : "pieces";

                    // Display each item in the purchase summary
                    echo "<li>{$quantity} {$pieceText} of " . ucfirst($size) . " $product amounting to ₱ $itemTotal</li>";
                }
                echo "</ul>";
                echo "<p><strong>Total Number of Items: $quantity</strong></p>";
                echo "<p><strong>Total Amount: ₱ $total</strong></p>";
                echo "</div>";
            } else {
                echo "<div class='mt-4 text-danger'>No Selected Product, Try Again</div>";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
