<?php
include('../conn.php');

// Check if 'output' and 'input' are set in the GET request
if (isset($_GET['output']) && isset($_GET['input'])) {
    // Sanitize the inputs to avoid SQL injection
    $output = mysqli_real_escape_string($conn, $_GET['output']);
    $input = mysqli_real_escape_string($conn, $_GET['input']);
    $user_id = $_SESSION['user_id'];
    $title_id = $_SESSION['title_id'];

    // Prepare the SQL query
    $sql = "INSERT INTO propmt (propmt_input, propmt_output, propmt_user_id, propmt_title_id) VALUES ('$input', '$output', '$user_id', '$title_id')";

    // Execute the query and check if successful
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='./home.php'</script>";
    } 
}
?>
