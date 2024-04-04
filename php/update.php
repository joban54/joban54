<?php
include 'config.php';

// Check if ID parameter is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve record from database based on provided ID
    $sql = "SELECT * FROM members WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $address = $row['address'];
        $price = $row['price'];
    } else {
        // Redirect to error page if record not found
        header("Location: error.php");
        exit();
    }
} else {
    // Redirect to error page if ID parameter is missing
    header("Location: error.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $price = $_POST['price'];

    // Update record in the database
    $sql = "UPDATE members SET name = '$name', address = '$address', price = $price WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to landing page after successful update
        header("Location: index.php");
        exit();
    } else {
        // Redirect to error page if update fails
        header("Location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Member</title>
</head>
<style>
       div {
            position: relative;
            width: 500px;
            margin: 100px auto ;
            display:flex;
            flex-direction:column;
            align-items:center;
          box-shadow: 1px 1px 10px grey;
          padding-bottom:20px
     
        }
    body{display:flex;flex-direction:column; align-items:center;}
     input[type=text]
 {
    width: 100%;
    padding: 12px 20px;
    border: 0px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid rgba(128, 128, 128, 0.603);
    box-sizing: border-box;
    background-color: white;
    border-radius: 10px;
}
input[type=submit],input[type=reset]{
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    width: 100%;
}
button img{width:30px;}
button{
    background-color:transparent;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    width: 100px;
    position:absolute;
    left:10px;
}

div{width:500px;}
    </style>
<body>
    <div>
    <button> <a href="index.php"><img src="arrow.png" alt=""></a></button>
    <h2>Update Member</h2>
    <form method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>"><br><br>
        <label for="price">price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
    </div>
</body>
</html>
