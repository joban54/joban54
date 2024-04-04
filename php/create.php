<?php
include 'config.php';

// Define variables and initialize with empty values
$name = $address = $price = '';
$name_err = $address_err = $price_err = '';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate price
    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter the price.";
    } elseif (!is_numeric(trim($_POST["price"]))) {
        $price_err = "Price must be a number.";
    } else {
        $price = trim($_POST["price"]);
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($address_err) && empty($price_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO members (name, address, price) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssd", $param_name, $param_address, $param_price);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_price = $price;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to landing page after successful creation
                header("Location: index.php");
                exit();
            } else {
                // Redirect to error page if execution fails
                header("Location: error.php");
                exit();
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Members</title>
    <style>
        .wrapper {
            position: relative;
            width: 500px;
            margin: 100px auto ;
            display:flex;
            flex-direction:column;
            align-items:center;
          box-shadow: 1px 1px 10px grey;
          padding-bottom:20px
     
        }
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
    background-color: rgb(255, 0, 0);
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    width: 100%;
}
a{text-decoration:none;color:white}
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

    </style>
</head>
<body>
    <div class="wrapper">
    <button> <a href="index.php"><img src="arrow.png" alt=""></a></button>
        <h2>Add New Member </h2>
        <p>Please fill this form to add a New Member.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span><?php echo $name_err; ?></span>
            </div>
            <div>
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $address; ?>">
                <span><?php echo $address_err; ?></span>
            </div>
            <div>
                <label>price</label>
                <input type="text" name="price" value="<?php echo $price; ?>">
                <span><?php echo $price_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Add" style="background-color:green">
                <input type="reset" value="Reset">
            </div>
        </form>
        
    </div>
   
</body>
</html>
