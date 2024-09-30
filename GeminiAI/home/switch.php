<?php
session_start();

if (isset($_GET['id']))
{
    $id = $_GET['id'];

    $_SESSION['title_id'] = $id;

    echo "<script>window.location.href='home.php'</script>";
}
?>