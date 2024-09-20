<?php
include('../conn.php');

// Check if 'output' and 'input' are set in the GET request
if (isset($_GET['output']) && isset($_GET['input'])) {
    // Sanitize the inputs to avoid SQL injection
    $output = mysqli_real_escape_string($conn, $_GET['output']);
    $input = mysqli_real_escape_string($conn, $_GET['input']);

    // Prepare the SQL query
    $sql = "INSERT INTO propmt (propmt_input, propmt_output) VALUES ('$input', '$output')";

    // Execute the query and check if successful
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='./home.php'</script>";
    } 
}
?>
