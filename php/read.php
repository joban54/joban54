<?php
include 'config.php';

// Check if ID parameter is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve record from database based on provided ID
    $sql = "SELECT * FROM members WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = $id;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $result = $stmt->get_result();

            // Check if the record exists
            if ($result->num_rows == 1) {
                // Fetch result row as an associative array
                $row = $result->fetch_assoc();

                // Retrieve individual field values
                $name = $row['id'];
                $name = $row['name'];
                $address = $row['address'];
                $price = $row['price'];
                $time = $row['time'];
            } else {
                // Redirect to error page if record not found
                header("Location: error.php");
                exit();
            }
        } else {
            // Redirect to error page if execution fails
            header("Location: error.php");
            exit();
        }

        // Close statement
        $stmt->close();
    }
} else {
    // Redirect to error page if ID parameter is missing
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Detail</title>
    <style>
        .wrapper {
            display: flex;flex-direction:column;align-items:center;gap: 50px;
            font-size:20px;text-align:left;
            width: 500px;
            margin: 0 auto;
        }
table,tr,td{border:2px solid black;border-collapse:collapse}
td{padding:10px}
a{text-decoration:none;color:white;
padding:15px;
border-radius:10px;
background-color:red}
  
    </style>
        
</head>
<body>
<center><h2>Member Detail</h2></center>
    <div class="wrapper">


    <table>
<tr>
    <td>Id:</td>
    <td><?php echo $id; ?></td>
</tr>
<tr>
    <td>Name:</td>
    <td><?php echo $name; ?></td>
</tr>
<tr>
    <td>Address:</td>
    <td><?php echo $address; ?></td>
</tr>
<tr>
    <td>Price:</td>
    <td><?php echo $price; ?></td>
</tr>
<tr>
    <td>Date/Time:</td>
    <td><?php echo $time; ?></td>
</tr>

    </table>
      
   
        
        <p><a href="index.php">Back to Members List</a></p>
    </div>
</body>
</html>
