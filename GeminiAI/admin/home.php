<?php
include('../conn.php');

// Fetch user count
$sql = "SELECT COUNT(user_id) AS user_count FROM user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_count = $row['user_count'];

// Fetch prompt count
$sql2 = "SELECT COUNT(propmt_id) AS prompt_count FROM propmt";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$prompt_count = $row2['prompt_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HatdgoAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="icon" href="../img/icon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/75fe70a6d6.js" crossorigin="anonymous"></script>
    <style>
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
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="d-flex">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper" style="position:sticky;">
            <div class="sidebar-heading text-light"></div>
            <div class="list-group list-group-flush">
                <center><img src="../img/icon.png" alt="" class="list-group-item list-group-item-action bg-dark" style="height: 150px; width: 150px;"></center>
                <a href="./home.php" class="list-group-item list-group-item-action bg-dark text-light"><?php echo $_SESSION['admin_name'];?></a>
                <a href="./list_user.php" class="list-group-item list-group-item-action bg-dark text-light">List of Users</a>
                <a href="./list_propmt.php" class="list-group-item list-group-item-action bg-dark text-light">List of Prompts</a>
                <a href="./logout.php" class="list-group-item list-group-item-action bg-dark text-light">Logout</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button class="btn btn-primary my-3" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="container-fluid">
                <!-- Dashboard Content -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm" style="background-color: red;">
                            <div class="card-body">
                                <h5 class="card-title text-light">Total Users</h5>
                                <p class="card-text display-4 text-light"><?php echo $user_count; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm" style="background-color: #50b848;">
                            <div class="card-body">
                                <h5 class="card-title text-light">Total Prompts</h5>
                                <p class="card-text display-4 text-light"><?php echo $prompt_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar function
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("sidebar-wrapper").classList.toggle("toggled");
            // Toggle text visibility
            const sidebarTextElements = document.querySelectorAll("#sidebar-wrapper .list-group-item, .sidebar-heading");
            sidebarTextElements.forEach(el => {
                if (document.getElementById("sidebar-wrapper").classList.contains("toggled")) {
                    el.style.opacity = "0"; // Hide text
                    el.style.visibility = "hidden";
                } else {
                    el.style.opacity = "1"; // Show text
                    el.style.visibility = "visible";
                }
            });
        });
    </script>
    
    <style>
    /* Style for sidebar */
    #sidebar-wrapper {
        width: 250px;
        height: 100vh; /* Full height */
        overflow-y: auto; /* Enable vertical scroll */
        transition: all 0.5s ease;
    }

    #sidebar-wrapper.toggled {
        width: 0;
    }

    #page-content-wrapper {
        flex-grow: 1;
        padding: 15px;
    }

    /* Hide text smoothly */
    #sidebar-wrapper .list-group-item, .sidebar-heading {
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    </style>

<script>
        // Wait for the entire page (including resources) to load
        window.addEventListener('load', function() {
            // Add a delay of 2 seconds before hiding the loading screen
            setTimeout(function() {
                document.getElementById('loading-screen').remove(); // Remove the loading screen from the DOM
            }, 1000); // 2-second delay
        });
    </script>
</body>
</html>
