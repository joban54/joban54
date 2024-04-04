<!DOCTYPE html>
<html>
<head>
    <title>Gym Members Records</title>
</head>
<body>
    <style>
        div,body{display: flex;justify-content: center;flex-direction:column;align-items:center}
h2{text-align:center;}
table{width:80%; border-collapse:collapse;}
th{background-color:red;text-align:left;font-size:20px;}
th{padding:10px}
td{padding:30px 0px;border-bottom:1px solid grey;}
a{text-decoration:none;color:white;
padding:15px;
margin-top:30px;
border-radius:10px;
background-color:red}

        </style>
<div style="width:100%;">
<h2>Gym Members Records</h2>
<div style="width:100%;">
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Price</th>
        <th>Date/Time</th>
        <th style="text-align:center">Action</th>
    </tr>
    <?php
    // Fetch and display records from the database
    include 'config.php';
    $sql = "SELECT * FROM members";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td style='text-align:center;'><a href='read.php?id=".$row['id']."' style='background-color:blue;'>View</a> | <a href='update.php?id=".$row['id']."'style='background-color:grey;'>Update</a> | <a href='delete.php?id=".$row['id']."'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    $conn->close();
    ?>
</table>

<a href="create.php" style="background-color:green;">Add New Member</a>
<div>

</body>
</html>
