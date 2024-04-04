<?php
include 'config.php';

// Check if ID parameter is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Prepare a delete statement
    $sql = "DELETE FROM members WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = $_GET['id'];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to landing page after successful deletion
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
} else {
    // Redirect to error page if ID parameter is missing
    header("Location: error.php");
    exit();
}
?>
