<?php
include('../conn.php');

$sql = "SELECT * FROM propmt";
$result = mysqli_query($conn, $sql);
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
    <!-- For Table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
    <!-- For Table -->
     <!-- For Captcha -->
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <!-- For Captcha -->
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
            <div class="sidebar-heading">Sidebar</div>
            <div class="list-group list-group-flush">
                <center><img src="../img/icon.png" alt="" class="list-group-item list-group-item-action bg-dark" style="height: 150px; width: 150px;"></center>
                <a href="./home.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;"><?php echo $_SESSION['admin_name'];?></a>
                <a href="./list_user.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">List of user's</a>
                <a href="./list_propmt.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">List of propmt's</a>
                <a href="./logout.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">Logout</a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="container-fluid">
                <div style="display:flex; justify-content:center;">
                    <div>
                        <div style="width:1700px;">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Propmt Input</th>
                                        <th>Propmt Output</th>
                                        <th>Propmt Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php 
                                        $id = $row['propmt_user_id'];

                                        $sql2 = "SELECT * FROM user WHERE user_id = '$id'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($result2);

                                        echo $row2['user_name'];
                                        ?></td>
                                        <td><?php echo $row['propmt_input'];?></td>
                                        <td><?php echo $row['propmt_output'];?></td>
                                        <td><?php echo $row['propmt_created'];?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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

    <!-- For Table -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

    <!-- Script JS -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": 1 }
                ],
                language: {
                    'paginate': {
                        'previous': '<span class="fa fa-chevron-left"></span>',
                        'next': '<span class="fa fa-chevron-right"></span>'
                    },
                    "lengthMenu": 'Display <select class="form-control input-sm">'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="30">30</option>'+
                    '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">All</option>'+
                    '</select> results'
                }
            });

            // Populate modal with user data when Edit button is clicked
            $('.edit').on('click', function() {
                const userId = $(this).data('id');
                const userName = $(this).data('name');
                const userEmail = $(this).data('email');

                $('#editUserId').val(userId);
                $('#editUserName').val(userName);
                $('#editUserEmail').val(userEmail);
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
