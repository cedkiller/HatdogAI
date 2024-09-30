<?php
// Include the database connection file
include('./conn.php');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer library files
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
    <!-- Include SweetAlert for alert messages -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Include Google reCAPTCHA -->
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
            <!-- Front Face: Welcome Screen with Login and Sign Up buttons -->
            <div class="cube-face front">
                <center><img src="./img/icon.png" alt="Icon" style="height: 150px; width: 150px;"></center>
                <p>Choose an option</p>
                <button id="login-btn">Login</button>
                <button id="signup-btn">Sign Up</button>
            </div>
            
            <!-- Back Face: Login Form -->
            <div class="cube-face back" id="login-form">
                <h2>Login</h2>
                <form action="" method="POST">
                    <!-- Email Input -->
                    <input type="email" placeholder="Email" name="email" required> 
                    <div class="password-container">
                        <!-- Password Input -->
                        <input type="password" id="login-password" name="pass" placeholder="Password" required>
                        <!-- Toggle Password Visibility -->
                        <span class="toggle-password" data-target="#login-password">👁️</span>
                    </div>
                    <!-- Google reCAPTCHA -->
                    <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                    <!-- Submit Button -->
                    <button type="submit" name="login">Login</button>
                    <!-- Forgot Password Link -->
                    <p><a href="#" id="forgot-password-link">Forgot Password?</a></p>
                </form>

                <?php
                // Handle Login Form Submission
                if (isset($_POST['login'])) {
                    // Retrieve and sanitize user input
                    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

                    // Retrieve reCAPTCHA response
                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    // Check if reCAPTCHA is completed
                    if (strlen($recaptchaResponse) >= 10) {
                        // Query to check if the email exists in the admin table
                        $sql = "SELECT admin_email FROM admin WHERE admin_email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);

                        if (isset($row['admin_email']) && $row['admin_email'] === $email) {
                            // Retrieve admin password
                            $sql5 = "SELECT admin_password FROM admin WHERE admin_email = '$email'";
                            $result5 = mysqli_query($conn, $sql5);
                            $row5 = mysqli_fetch_assoc($result5);

                            // Check if the password matches
                            if ($row5['admin_password'] === $pass) {
                                // Retrieve full admin details
                                $sql6 = "SELECT * FROM admin WHERE admin_email = '$email'";
                                $result6 = mysqli_query($conn, $sql6);
                                $row6 = mysqli_fetch_assoc($result6);

                                // Start session and set admin details
                                $_SESSION['admin_name'] = "Admin";
                                $_SESSION['admin_id'] = $row6['admin_id'];

                                // Redirect to admin home page
                                echo "<script>window.location.href='./admin/home.php'</script>";
                            } else {
                                // Display invalid password error
                                echo "<script>swal('Invalid Password!', 'Your password is invalid please try again!', 'error');</script>"; 
                            }
                        } else {
                            // Query to check if the email exists in the user table
                            $sql2 = "SELECT user_email FROM user WHERE user_email = '$email'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);

                            if (isset($row2['user_email']) && $row2['user_email'] === $email) {
                                // Retrieve user password
                                $sql3 = "SELECT user_password FROM user WHERE user_email = '$email'";
                                $result3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($result3);

                                // Verify the password using password hashing
                                if (password_verify($pass, $row3['user_password'])) {
                                    // Retrieve full user details
                                    $sql4 = "SELECT * FROM user WHERE user_email = '$email'";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($result4);

                                    // Start session and set user details
                                    $_SESSION['user_name'] = htmlspecialchars($row4['user_name'], ENT_QUOTES, 'UTF-8');
                                    $_SESSION['user_id'] = $row4['user_id'];

                                    // Redirect to user choose page
                                    echo "<script>window.location.href='./choose.php'</script>";
                                } else {
                                    // Display invalid password error
                                    echo "<script>swal('Invalid Password!', 'Your password is invalid please try again!', 'error');</script>";    
                                }
                            } else {
                                // Display invalid email error
                                echo "<script>swal('Invalid Email!', 'Your email is invalid please try again!', 'error');</script>";
                            }
                        }
                    } else {
                        // Display captcha failure error
                        echo "<script>swal('Captcha Failed!', 'Please complete the captcha!', 'error');</script>";
                    }
                }
                ?>

                <!-- Back Button to Welcome Screen -->
                <button id="back-to-welcome-login" class="back-btn">Back</button>
            </div>

            <!-- Right Face: Sign Up Form -->
            <div class="cube-face right" id="signup-form">
                <h2>Sign Up</h2>
                <!-- Sign Up Form -->
                <form action="" method="POST">
                    <!-- Name Input -->
                    <input type="text" placeholder="Enter your name" name="name" required>
                    <!-- Email Input -->
                    <input type="email" placeholder="Enter your email" name="email" required>
                    <div class="password-container">
                        <!-- Password Input -->
                        <input type="password" id="signup-password" name="pass" placeholder="Enter your password" required>
                        <!-- Toggle Password Visibility -->
                        <span class="toggle-password" data-target="#signup-password">👁️</span>
                    </div>
                    <div class="password-container">
                        <!-- Confirm Password Input -->
                        <input type="password" id="signup-confirm-password" name="con_pass" placeholder="Confirm password" required>
                        <!-- Toggle Password Visibility -->
                        <span class="toggle-password" data-target="#signup-confirm-password">👁️</span>
                    </div>
                    <!-- Google reCAPTCHA -->
                    <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                    <!-- Submit Button -->
                    <button type="submit" name="sign">Sign Up</button>
                </form>

                <?php
                // Handle Sign Up Form Submission
                if (isset($_POST['sign'])) {
                    // Retrieve and sanitize user input
                    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
                    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
                    $con_pass = htmlspecialchars($_POST['con_pass'], ENT_QUOTES, 'UTF-8');

                    // Retrieve reCAPTCHA response
                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    // Check if reCAPTCHA is completed
                    if (strlen($recaptchaResponse) >= 10) {
                        // Validate password length
                        if (strlen($pass) < 8) {
                            echo "<script>swal('Password too short!', 'Password must be at least 8 characters long.', 'error');</script>";
                        } 
                        // Validate presence of uppercase letter
                        elseif (!preg_match('/[A-Z]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one uppercase letter.', 'error');</script>";
                        }
                        // Validate presence of lowercase letter
                        elseif (!preg_match('/[a-z]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one lowercase letter.', 'error');</script>";
                        }
                        // Validate presence of number
                        elseif (!preg_match('/[0-9]/', $pass)) {
                            echo "<script>swal('Password requirement not met!', 'Password must contain at least one number.', 'error');</script>";
                        }
                        // Check if passwords match
                        elseif ($pass === $con_pass) {
                            // Hash the password before storing
                            $hash_password = password_hash($pass, PASSWORD_DEFAULT);

                            // Insert new user into the database
                            $sql = "INSERT INTO user(user_name, user_email, user_password) VALUES('$name','$email','$hash_password')";

                            if (mysqli_query($conn, $sql)) {
                                echo "<script>swal('You have been registered!', 'Please go to login to enter your account!', 'success');</script>";
                            }
                        } 
                        else {
                            // Display password mismatch error
                            echo "<script>swal('Password not match!', 'Your confirm password does not match the entered password!', 'error');</script>";
                        }
                    } else {
                        // Display captcha failure error
                        echo "<script>swal('Captcha Failed!', 'Please complete the captcha!', 'error');</script>";
                    }
                }
                ?>

                <!-- Back Button to Welcome Screen -->
                <button id="back-to-welcome-signup" class="back-btn">Back</button>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal">
        <div class="modal-content">
            <!-- Close Button for Modal -->
            <span class="close" id="close-modal">&times;</span>
            <h2>Forgot Password</h2>
            <p>Please enter your email to reset your password.</p>
            <form action="" method="POST">
                <!-- Email Input for Password Reset -->
                <input type="email" name="forgot_email" placeholder="Enter your email" required>
                <!-- Google reCAPTCHA -->
                <center><div class="g-recaptcha" data-sitekey="6Lc3yEcqAAAAAL1ujFFVAixn4dNfGXHh9AmiedP6"></div></center>
                <!-- Submit Button -->
                <button type="submit" name="reset_password">Submit</button>
            </form>

            <?php
            // Handle Password Reset Form Submission
            if (isset($_POST['reset_password'])) {
                // Retrieve and sanitize user input
                $forgot_email = htmlspecialchars($_POST['forgot_email'], ENT_QUOTES, 'UTF-8');

                // Query to check if the email exists in the user table
                $sql7 = "SELECT user_email FROM user WHERE user_email = '$forgot_email'";
                $result7 = mysqli_query($conn, $sql7);
                $row7 = mysqli_fetch_assoc($result7);

                // Retrieve reCAPTCHA response
                $recaptchaResponse = $_POST['g-recaptcha-response'];

                // Check if reCAPTCHA is completed
                if (strlen($recaptchaResponse) >= 10) {
                    if ($row7 && $row7['user_email'] === $forgot_email) {
                        // Initialize PHPMailer
                        $mail = new PHPMailer(true);

                        try {
                            // Server settings
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'aniamaesantos0@gmail.com'; // Replace with your email
                            $mail->Password = 'eskmnqzpoblrpruw'; // Replace with your email password or app password
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 465;

                            // Sender and recipient settings
                            $mail->setFrom('aniamaesantos0@gmail.com', 'HotdhogAI'); // Replace with your email and name
                            $mail->addAddress($forgot_email);

                            // Email content settings
                            $mail->isHTML(true);
                            $mail->Subject = 'Reset Password';
                            $mail->Body = '<div style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
                                <p><b>Hello!</b></p>
                                <p>You are receiving this email because we received a password reset request for your account.</p>
                                <br>
                                <div style="text-align: center;">
                                    <a href="localhost/geminiai/reset_password.php" style="
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

                            // Send the email
                            $mail->send();

                            // Display success message
                            echo "<script>swal('Success!', 'Please check your email to see the link for resetting your password!', 'success');</script>";
                        } catch (Exception $e) {
                            // Display error message if email fails to send
                            echo "<script>swal('Error!', 'There was an error sending the email. Please try again later.', 'error');</script>";
                        }
                    } else {
                        // Display email not found error
                        echo "<script>swal('Email not found!', 'Your email is not in the system!', 'error');</script>";
                    }
                } else {
                    // Display captcha failure error
                    echo "<script>swal('Captcha Failed!', 'Please complete the captcha!', 'error');</script>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        // Select necessary DOM elements
        const cube = document.querySelector('.cube');
        const loginBtn = document.getElementById('login-btn');
        const signupBtn = document.getElementById('signup-btn');
        const backToWelcomeLogin = document.getElementById('back-to-welcome-login');
        const backToWelcomeSignup = document.getElementById('back-to-welcome-signup');
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const modal = document.getElementById('forgot-password-modal');
        const closeModal = document.getElementById('close-modal');

        // Event listener to show login form
        loginBtn.addEventListener('click', () => {
            cube.classList.add('show-login');
            cube.classList.remove('show-signup');
        });

        // Event listener to show signup form
        signupBtn.addEventListener('click', () => {
            cube.classList.add('show-signup');
            cube.classList.remove('show-login');
        });

        // Event listener to go back to welcome screen from login form
        backToWelcomeLogin.addEventListener('click', () => {
            cube.classList.remove('show-login');
        });

        // Event listener to go back to welcome screen from signup form
        backToWelcomeSignup.addEventListener('click', () => {
            cube.classList.remove('show-signup');
        });

        // Event listener to show Forgot Password modal
        forgotPasswordLink.addEventListener('click', (event) => {
            event.preventDefault();
            modal.style.display = "block";
        });

        // Event listener to close the modal when 'x' is clicked
        closeModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        // Event listener to close the modal when clicking outside of it
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Event listeners to toggle password visibility
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
