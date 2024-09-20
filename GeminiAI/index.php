<?php
include('./conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotdhogAI</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./css/style3.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cube">
            <div class="cube-face front">
                <center><img src="./img/icon.png" alt="" style="height: 150px; width: 150px;"></center>
                <p>Choose an option</p>
                <button id="login-btn">Login</button>
                <button id="signup-btn">Sign Up</button>
            </div>
            <div class="cube-face back" id="login-form">
                <h2>Login</h2>
                <form action="" method="POST">
                    <input type="text" placeholder="Email" name="email" required>
                    <div class="password-container">
                        <input type="password" id="login-password" name="pass" placeholder="Password" required>
                        <span class="toggle-password" data-target="#login-password">👁️</span>
                    </div>
                    <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                    <button type="submit" name="login">Login</button>
                    <p><a href="#" id="forgot-password-link">Forgot Password?</a></p> <!-- Forgot Password Link -->
                </form>

                <?php
                if (isset($_POST['login']))
                {
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];

                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    if (strlen($recaptchaResponse) >= 10)
                    {
                        $sql = "SELECT admin_email FROM admin WHERE admin_email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);

                        if (isset($row['admin_email']) && $row['admin_email'] === $email)
                        {
                            $sql5 = "SELECT admin_password FROM admin WHERE admin_email = '$email'";
                            $result5 = mysqli_query($conn, $sql5);
                            $row5 = mysqli_fetch_assoc($result5);

                            if ($row5['admin_password'] === $pass)
                            {
                                $sql6 = "SELECT * FROM admin WHERE admin_email = '$email'";
                                $result6 = mysqli_query($conn, $sql6);
                                $row6 = mysqli_fetch_assoc($result6);

                                $_SESSION['admin_name'] = "Admin";
                                $_SESSION['admin_id'] = $row6['admin_id'];

                                echo "<script>window.location.href='./admin/home.php'</script>";
                            }

                            else {
                                echo "<script>swal('Invalid Password!', 'Your password is invalid please try again!', 'error');</script>"; 
                            }
                        }

                        else {
                            $sql2 = "SELECT user_email FROM user WHERE user_email = '$email'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);

                            if (isset($row2['user_email']) && $row2['user_email'] === $email)
                            {
                                $sql3 = "SELECT user_password FROM user WHERE user_email = '$email'";
                                $result3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($result3);

                                if (password_verify($pass, $row3['user_password']))
                                {
                                    $sql4 = "SELECT * FROM user WHERE user_email = '$email'";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($result4);

                                    $_SESSION['user_name'] = $row4['user_name'];
                                    $_SESSION['user_id'] = $row4['user_id'];

                                    echo "<script>window.location.href='./home/home.php'</script>";
                                }

                                else {
                                    echo "<script>swal('Invalid Password!', 'Your password is invalid please try again!', 'error');</script>";    
                                }
                            }

                            else {
                                echo "<script>swal('Invalid Email!', 'Your email is invalid please try again!', 'error');</script>";
                            }
                        }
                    }

                    else {
                        echo "<script>swal('Captcha Failed!', 'Please complete the captcha!', 'error');</script>";
                    }
                }
                ?>

                <button id="back-to-welcome-login" class="back-btn">Back</button>
            </div>

            <div class="cube-face right" id="signup-form">
                <h2>Sign Up</h2>
                <!-- Sign Up Form -->
                <form action="" method="POST">
                    <input type="text" placeholder="Enter your name" name="name" required>
                    <input type="email" placeholder="Enter your email" name="email" required>
                    <div class="password-container">
                        <input type="password" id="signup-password" name="pass" placeholder="Enter your password" required>
                        <span class="toggle-password" data-target="#signup-password">👁️</span>
                    </div>
                    <div class="password-container">
                        <input type="password" id="signup-confirm-password" name="con_pass" placeholder="Confirm password" required>
                        <span class="toggle-password" data-target="#signup-confirm-password">👁️</span>
                    </div>
                    <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                    <button type="submit" name="sign">Sign Up</button>
                </form>

                <?php
                if (isset($_POST['sign'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];
                    $con_pass = $_POST['con_pass'];

                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    if (strlen($recaptchaResponse) >= 10)
                    {
                        // Check if the password meets all criteria
                        if (strlen($pass) < 8) {
                            echo "<script>swal('Password too short!', 'Password must be at least 8 characters long.', 'error');</script>";
                        } 
                        elseif (!preg_match('/[A-Z]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one uppercase letter.', 'error');</script>";
                        }
                        elseif (!preg_match('/[a-z]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one lowercase letter.', 'error');</script>";
                        }
                        elseif (!preg_match('/[0-9]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one number.', 'error');</script>";
                        }
                        elseif ($pass === $con_pass) {
                            $hash_password = password_hash($pass, PASSWORD_DEFAULT);

                            $sql = "INSERT INTO user(user_name, user_email, user_password) VALUES('$name','$email','$hash_password')";

                            if (mysqli_query($conn, $sql)) {
                                echo "<script>swal('You have been registered!', 'Please go to login to enter your account!', 'success');</script>";
                            }
                        } 
                        else {
                            echo "<script>swal('Password not match!', 'Your confirm password does not match the entered password!', 'error');</script>";
                        }
                    }

                    else {
                        echo "<script>swal('Captcha Failed!', 'Please complete the captcha!', 'error');</script>";
                    }
                }
                ?>

                <button id="back-to-welcome-signup" class="back-btn">Back</button>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <h2>Forgot Password</h2>
            <p>Please enter your email to reset your password.</p>
            <form action="" method="POST">
                <input type="email" name="forgot_email" placeholder="Enter your email" required>
                <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                <button type="submit" name="reset_password">Submit</button>
            </form>

            <?php
            if (isset($_POST['reset_password']))
            {
                $forgot_email = $_POST['forgot_email'];
                $sql7 = "SELECT user_email FROM user WHERE user_email = '$forgot_email'";
                $result7 = mysqli_query($conn, $sql7);
                $row7 = mysqli_fetch_assoc($result7);

                $recaptchaResponse = $_POST['g-recaptcha-response'];

                if (strlen($recaptchaResponse) >= 10)
                {
                    if ($row7 && $row7['user_email'] === $forgot_email)
                    {
                        $mail = new PHPMailer(true);

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'aniamaesantos0@gmail.com';
                        $mail->Password = 'eskmnqzpoblrpruw';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;

                        $mail->setFrom('aniamaesantos0@gmail.com');

                        $mail->addAddress($_POST["forgot_email"]);

                        $mail->isHTML(true);

                        $mail->Subject = 'Reset Password';
                        $mail->Body = '<div style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
                            <p><b>Hello!</b></p>
                            <p>You are receiving this email because we received a password reset request for your account.</p>
                            <br>
                            <div style="text-align: center;">
                                <a href="http://localhost/geminiai/reset_password.php" style="
                                    background-color: #512da8;
                                    color: #fff;
                                    padding: 12px 40px;
                                    font-size: 14px;
                                    border-radius: 8px;
                                    text-decoration: none;
                                    font-weight: bold;
                                    letter-spacing: 1px;
                                    display: inline-block;
                                    margin: 15px 0;">
                                    Reset Password
                                </a>
                            </div>
                            <br>
                            <p>If you did not request a password reset, no further action is required.</p>
                            <hr style="border: none; border-top: 1px solid #ddd;">
                            <footer style="text-align: center; margin-top: 20px;">
                                <p style="font-size: 12px; color: #999;">&copy; 2024 HotdhogAI. All rights reserved.</p>
                            </footer>
                        </div>';


                        $mail->send();


                        echo "<script>swal('Success!', 'Please see your gmail account to see the link for reset password!', 'success');</script>";
                    }
                    else {
                        echo "<script>swal('Email not found!', 'Your email is not in the system!', 'error');</script>";
                    }
                }

                else {
                    echo "<script>swal('Captcha Failed!','Please complete the captcha','error')</script>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        const cube = document.querySelector('.cube');
        const loginBtn = document.getElementById('login-btn');
        const signupBtn = document.getElementById('signup-btn');
        const backToWelcomeLogin = document.getElementById('back-to-welcome-login');
        const backToWelcomeSignup = document.getElementById('back-to-welcome-signup');
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const modal = document.getElementById('forgot-password-modal');
        const closeModal = document.getElementById('close-modal');

        loginBtn.addEventListener('click', () => {
            cube.classList.add('show-login');
            cube.classList.remove('show-signup');
        });

        signupBtn.addEventListener('click', () => {
            cube.classList.add('show-signup');
            cube.classList.remove('show-login');
        });

        backToWelcomeLogin.addEventListener('click', () => {
            cube.classList.remove('show-login');
        });

        backToWelcomeSignup.addEventListener('click', () => {
            cube.classList.remove('show-signup');
        });

        // Show Forgot Password Modal
        forgotPasswordLink.addEventListener('click', (event) => {
            event.preventDefault();
            modal.style.display = "block";
        });

        // Close Modal
        closeModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Show/Hide Password Toggle
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.getAttribute('data-target'));
                if (target.type === "password") {
                    target.type = "text";
                    button.textContent = "🙈"; // Hide eyes icon
                } else {
                    target.type = "password";
                    button.textContent = "👁️"; // Show eyes icon
                }
            });
        });
    </script>
</body>
</html>
