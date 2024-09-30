<?php
include('./conn.php');

$user_name = $_SESSION['user_name'];

$sql = "SELECT * FROM title WHERE title_user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HatdogAI</title>
    <!-- For Table -->
      <!-- Bootstrap 5 CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <!-- Data Table CSS -->
        <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
      <!-- For Table -->
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
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
    <br><br>
    <div style="display:flex; justify-content:center;">
        <div>
            <div style="width:1200px;">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="choose.php" class="btn btn-secondary">Back</a>
            </div>
            <!-- Table -->
            <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>User_Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['title_name'];?></td>
                    <td><?php echo $row['title_user_name'];?></td>
                    <td><a href="./view_propmt_success.php?id=<?php echo $row['title_id'];?>"><button style="background:blue; color:white;">See</button></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<!-- Data Table JS -->
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
      <!-- Script JS -->
      <script>
        $(document).ready(function() {
            $('#example').DataTable({
            //disable sorting on last column
            "columnDefs": [
                { "orderable": false, "targets": 1 }
            ],
            language: {
                //customize pagination prev and next buttons: use arrows instead of words
                'paginate': {
                'previous': '<span class="fa fa-chevron-left"></span>',
                'next': '<span class="fa fa-chevron-right"></span>'
                },
                //customize number of elements to be displayed
                "lengthMenu": 'Display <select class="form-control input-sm">'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">All</option>'+
                '</select> results'
            }
            })  
        } );
      </script>
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
