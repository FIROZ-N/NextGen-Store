<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

// Handle the addition of a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $main_image_url = $_POST['main_image_url'];
    $sub_image1_url = $_POST['sub_image1_url'];
    $sub_image2_url = $_POST['sub_image2_url'];
    $sub_image3_url = $_POST['sub_image3_url'];
    $sub_image4_url = $_POST['sub_image4_url'];
    $key_features = $_POST['key_features'];

    $stmt = $db->prepare("INSERT INTO products (name, description, price, category, image_url, main_image_url, sub_image1_url, sub_image2_url, sub_image3_url, sub_image4_url, key_features) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $name,
        $description,
        $price,
        $category,
        $image_url,
        $main_image_url,
        $sub_image1_url,
        $sub_image2_url,
        $sub_image3_url,
        $sub_image4_url,
        $key_features
    ]);

    //$stmt = $db->prepare("INSERT INTO products (name, description, price, category, main_image_url, sub_image1_url, sub_image2_url, sub_image3_url, sub_image4_url, key_features) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //$stmt->execute([$name, $description, $price, $category, $main_image_url, $sub_image1_url, $sub_image2_url, $sub_image3_url, $sub_image4_url, $key_features]);

    header("Location: store.php");
    exit;
}

// Handle the editing of a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $main_image_url = $_POST['main_image_url'];
    $sub_image1_url = $_POST['sub_image1_url'];
    $sub_image2_url = $_POST['sub_image2_url'];
    $sub_image3_url = $_POST['sub_image3_url'];
    $sub_image4_url = $_POST['sub_image4_url'];
    $key_features = $_POST['key_features'];

    $stmt = $db->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, /* image_url = ?, page_url = ?, */ main_image_url = ?, sub_image1_url = ?, sub_image2_url = ?, sub_image3_url = ?, sub_image4_url = ?, key_features = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $category, /* $image_url, $page_url, */ $main_image_url, $sub_image1_url, $sub_image2_url, $sub_image3_url, $sub_image4_url, $key_features, $id]);

    header("Location: store.php");
    exit;
}

// Handle the deletion of a product
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: store.php");
    exit;
}

// Handle the deletion of all products
if (isset($_POST['delete_all'])) {
    $stmt = $db->prepare("DELETE FROM products");
    $stmt->execute();

    header("Location: store.php");
    exit;
}

// Get the selected category from the query parameter
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare the query based on the selected category
if ($category === 'all') {
    $query = "SELECT * FROM products";
} else {
    $query = "SELECT * FROM products WHERE category = ?";
}

// Prepare and execute the query
$stmt = $db->prepare($query);
if ($category !== 'all') {
    $stmt->execute([$category]);
} else {
    $stmt->execute();
}

// Fetch all products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch slider data from the database
$slidesQuery = "SELECT * FROM slider ORDER BY slide_order ASC";
$slides = $db->query($slidesQuery)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Store</title>
    <link rel="stylesheet" href="./storeM.css">
</head>

<body>
    <h2>Manage Products - NextGen Store !</h2>
    <div class="product-link">
        <div class="product-links">
            <a href="?category=all">All Products</a>
            <a href="?category=iphone">iPhone</a>
            <a href="?category=samsung">Samsung</a>
            <a href="?category=redmi">Redmi</a>
            <a href="?category=wired_headphone">Wired Headphone</a>
            <a href="?category=wireless_headphone">Wireless Headphone</a>
            <a href="?category=airpods">AirPods</a>
        </div>
    </div>

    <div class="products">
        <!-- Form to Add/Edit Product -->
        <form action="store.php" method="post">
            <h4>Add or Edit Product</h4><br>
            <input type="hidden" name="add_product" value="1"> <!-- For adding new product -->
            <div class="case"><label>Name: <input type="text" name="name" required></label></div>
            <div class="case"><label>Description: <textarea name="description" required></textarea></label></div>
            <div class="case"><label>Price: <input type="number" name="price" step="0.01" required></label></div>
            <div class="case"><label>Category:
                    <select name="category" required>
                        <option value="iphone">iPhone</option>
                        <option value="samsung">Samsung</option>
                        <option value="redmi">Redmi</option>
                        <option value="wired_headphone">Wired Headphone</option>
                        <option value="wireless_headphone">Wireless Headphone</option>
                        <option value="airpods">AirPods</option>
                    </select>
                </label></div>
            <!-- New fields for product details -->
            <div class="case"> <label>Main Image URL: <input type="text" name="main_image_url" required></label></div>
            <div class="case"><label>Sub Image 1 URL: <input type="text" name="sub_image1_url"></label></div>
            <div class="case"><label>Sub Image 2 URL: <input type="text" name="sub_image2_url"></label></div>
            <div class="case"><label>Sub Image 3 URL: <input type="text" name="sub_image3_url"></label></div>
            <div class="case"><label>Sub Image 4 URL: <input type="text" name="sub_image4_url"></label></div>
            <div class="case"><label>Key Features: <textarea name="key_features" rows="8" placeholder="Enter each feature on a new line"></textarea></label></div>

            <button type="submit">Add Or Edit Product</button>
        </form>

        <!-- Form to Delete All Products -->
        <form action="store.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="delete_all" value="1">
            <button type="submit" onclick="return confirm('Are you sure you want to delete all products?');">Delete All Products</button>
        </form>

        <!-- Display Products -->
        <?php if (empty($products)): ?>
            <p>No products available in this category.</p>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Main Image</th>
                            <th>Page URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td><?= htmlspecialchars($product['description']) ?></td>
                                <td>$<?= htmlspecialchars($product['price']) ?></td>
                                <td><?= htmlspecialchars($product['category']) ?></td>
                                <td><img src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="Main Image" width="100"></td>
                                <td><a href="../../Frontend/store/product-details.php ?id=<?= htmlspecialchars($product['id']) ?>" target="_blank">View Page</a></td>
                                <td>
                                    <!-- Edit and Delete Links -->
                                    <a href="edit-product.php?id=<?= htmlspecialchars($product['id']) ?>">Edit</a>
                                    <a href="?delete_id=<?= htmlspecialchars($product['id']) ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>