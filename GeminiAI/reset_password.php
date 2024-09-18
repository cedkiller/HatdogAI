<?php
include('./conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Arial&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(145deg, #f0f0f0, #dcdcdc);
        }

        .reset-container {
            perspective: 1000px;
        }

        .form-box {
            width: 350px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.15), -10px -10px 30px rgba(255, 255, 255, 0.5);
            transform-style: preserve-3d;
            transition: transform 0.4s ease-in-out;
            position: relative;
            z-index: 1; /* Ensure the form remains on top */
            pointer-events: none; /* Add this line */
        }

        /* Reduced the hover effect to ensure usability */
        .form-box:hover {
            transform: rotateY(3deg) translateZ(20px);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
            z-index: 2; /* Ensure input fields are clickable */
            pointer-events: auto; /* Add this line */
        }

        .input-group label {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f0f0f0;
            outline: none;
            font-size: 16px;
            box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.1), inset -4px -4px 8px rgba(255, 255, 255, 0.7);
            transition: background 0.3s, box-shadow 0.3s;
        }

        .input-group input:focus {
            background: #e0e0e0;
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.15), inset -2px -2px 4px rgba(255, 255, 255, 0.6);
        }

        .reset-btn {
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.4s ease-in-out, transform 0.3s;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.6);
            z-index: 2; /* Ensure button is clickable */
            position: relative;
            pointer-events: auto; /* Add this line */
        }

        .reset-btn:hover {
            background-color: #555;
            transform: translateY(-3px);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3), -5px -5px 15px rgba(255, 255, 255, 0.6);
        }

    </style>
</head>
<body>

<div class="reset-container">
    <div class="form-box">
        <h2>Reset Password</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="pass" placeholder="Enter new password" required>
            </div>

            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="con_pass" placeholder="Confirm new password" required>
            </div>

            <button type="submit" name="submit" class="reset-btn">Reset Password</button>
        </form>
        
        <?php
        if (isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $con_pass = $_POST['con_pass'];

            if ($pass = $con_pass)
            {
                $sql = "SELECT user_email FROM user WHERE user_email = '$email'";

                if (mysqli_query($conn, $sql))
                {
                    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                    $sql2 = "UPDATE user SET user_password = '$hash_pass' WHERE user_email = '$email'";
                    
                    if (mysqli_query($conn, $sql2)) 
                    {
                        echo "<script>alert('Your Password Has Been Change!');
                        window.location.href='./index.php';
                        </script>";
                    }
                }

                else {
                    echo "<script>swal('Invalid Email!', 'Your email is invalid please try again!', 'error');</script>";
                }
            }

            else {
                echo "<script>swal('Password not match!', 'Your confirm password does not match the entered password!', 'error');</script>";
            }
        }
        ?>

    </div>
</div>

</body>
</html>
