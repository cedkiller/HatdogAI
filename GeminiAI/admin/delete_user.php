<?php
include('../conn.php');

if (isset($_GET['id']))
{
    $id = $_GET['id'];

    // Fetch the user name before deleting the user
    $sql3 = "SELECT user_name FROM user WHERE user_id = '$id'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);

    if ($row3) // Check if the user exists
    {
        $name = $row3['user_name'];

        // Delete from the prompt table
        $sql = "DELETE FROM propmt WHERE propmt_user_id = '$id'";
        if (mysqli_query($conn, $sql))
        {
            // Delete from the user table
            $sql2 = "DELETE FROM user WHERE user_id = '$id'";
            if (mysqli_query($conn, $sql2))
            {
                // Delete from the title table
                $sql4 = "DELETE FROM title WHERE title_user_name = '$name'";
                if (mysqli_query($conn, $sql4))
                {
                    echo "<script>window.location.href='./list_user.php'</script>";
                }
            }
        }
    }
}
?>
