<?php
include('./conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the title input in the session
    $_SESSION['title'] = $_POST['promptTitle'];
    $user_name = $_SESSION['user_name'];
    $title = mysqli_real_escape_string($conn, $_POST['promptTitle']); // Sanitize input

    // Insert the title into the database
    $sql = "INSERT INTO title(title_name, title_user_name) VALUES('$title', '$user_name')";

    if (mysqli_query($conn, $sql)) {
        // Get the ID of the inserted title
        $title_id = mysqli_insert_id($conn);
        $_SESSION['title_id'] = $title_id;

        echo "<script>window.location.href='./home/home.php'</script>";
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add a hover effect and make the card clickable */
        .card {
            cursor: pointer;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }

        /* Animation keyframes for fade-in */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Apply a smooth hover effect */
        .card:hover {
            transform: scale(1.07);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Text color change on hover for more interaction feedback */
        .card:hover .card-title, 
        .card:hover .card-text {
            color: #007bff;
        }

        /* Stagger the animation for each card */
        .col-md-6:nth-child(1) .card {
            animation-delay: 0.3s;
        }
        .col-md-6:nth-child(2) .card {
            animation-delay: 0.6s;
        }

        /* Style for the loading screen */
        #loading-screen {
            display: flex; /* Show the loading screen initially */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: gray; /* Semi-transparent background */
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it stays above all other elements */
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
    <title>Choose Prompt</title>
</head>
<body>
    <!-- Loading Screen -->
  <div id="loading-screen" class="d-flex">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Choose Your Option</h2>
        <div class="row">
            <!-- New Prompt Container -->
            <div class="col-md-6 mb-4">
                <a href="#" class="card shadow-sm text-decoration-none text-dark" data-toggle="modal" data-target="#newPromptModal">
                    <div class="card-body text-center">
                        <h5 class="card-title">New Prompt</h5>
                        <p class="card-text">Start with a new prompt for your task.</p>
                    </div>
                </a>
            </div>
            <!-- Use Past Prompt Container -->
            <div class="col-md-6 mb-4">
                <a href="./view_propmt.php" class="card shadow-sm text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title">Use Past Prompt</h5>
                        <p class="card-text">Continue with a prompt you used</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal for New Prompt -->
    <div class="modal fade" id="newPromptModal" tabindex="-1" role="dialog" aria-labelledby="newPromptModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPromptModalLabel">Enter Title of New Prompt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="promptTitle">Title of Prompt</label>
                            <input type="text" class="form-control" id="promptTitle" name="promptTitle" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Wait for the entire page (including resources) to load
        window.addEventListener('load', function() {
            // Add a delay of 2 seconds before hiding the loading screen
            setTimeout(function() {
                document.getElementById('loading-screen').remove(); // Remove the loading screen from the DOM
            }, 1000); // 2-second delay
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
