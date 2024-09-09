<?php
include('../conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World</h1>
    <h1><?php echo $_SESSION['admin_name'];?></h1>
    <h1><?php echo $_SESSION['admin_id'];?></h1>
</body>
</html>