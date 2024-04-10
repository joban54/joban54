<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "username", "password", "restaurant_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create a new menu item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $category = $_POST["category"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    $sql = "INSERT INTO menu_items (category, name, price) VALUES ('$category', '$name', $price)";

    if (mysqli_query($conn, $sql)) {
        echo "New menu item added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Update a menu item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $category = $_POST["category"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    $sql = "UPDATE menu_items SET category='$category', name='$name', price=$price WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Menu item updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Delete a menu item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM menu_items WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Menu item deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Read all menu items
$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Category: " . $row["category"] . " - Name: " . $row["name"] . " - Price: $" . $row["price"] . "<br>";
    }
} else {
    echo "No menu items found.";
}

mysqli_close($conn);
?>
