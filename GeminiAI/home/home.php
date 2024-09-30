<?php
include('../conn.php');

$user_id = $_SESSION['user_id'];

$user_name = $_SESSION['user_name'];

$title_id = $_SESSION['title_id'];

$sql = "SELECT * FROM propmt WHERE propmt_user_id = '$user_id' and propmt_title_id = '$title_id'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM title WHERE title_user_name = '$user_name'";
$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HatdgoAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style4.css">
    <link rel="icon" href="../img/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/75fe70a6d6.js" crossorigin="anonymous"></script>
    <script type="importmap">
      {
        "imports": {
          "@google/generative-ai": "https://esm.run/@google/generative-ai"
        }
      }
    </script>

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
            <span class="visually-hidden"></span>
        </div>
    </div>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark border-right" id="sidebar-wrapper" style="position:sticky;">
    <div class="sidebar-heading">Sidebar</div>
    <div class="list-group list-group-flush">
      <center><img src="../img/icon.png" alt="" class="list-group-item list-group-item-action bg-dark" style="height: 150px; width: 150px;"></center>
      <a href="#" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;"><?php echo $_SESSION['user_name'];?> <?php echo $_SESSION['user_id'];?></a>
      <a href="./logout.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">Logout</a>
      <a href="#" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">History Propmt Below <i class="fa-solid fa-angle-down"></i></a>
      <?php while($row2 = mysqli_fetch_assoc($result2)) { ?>
      <a href="./switch.php?id=<?php echo $row2['title_id'];?>" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;"><?php echo $row2['title_name'];?></a>
      <?php } ?>
    </div>
  </div>
  
  <!-- Page Content -->
  <div id="page-content-wrapper">
    <button class="btn btn-primary" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
    <div class="container-fluid">
      <br><br><br><br>
      <div class="sandbox go-up">
        <div class="card">
          <div class="face face-top"></div>
          <div class="face face-back"></div>
          <div class="face face-bottom"></div>
          <div class="face face-left"></div>
          <!-- Loading Screen -->
          <div id="loading-screen" class="loading-screen" style="display: none;">
            <div class="loading-spinner"></div>
            <p>Loading, please wait...</p>
          </div>
          <form id="promptForm">
            <div style="display:flex;">
              <img src="../img/icon.png" alt="" class="img_home">
              <input type="text" placeholder="Enter your question" class="input_home" id="userInput" name="userInput" required>
              <button type="submit" class="submit_home2">Enter</button>
            </div>
          </form>
          <!-- Scrollable container -->
          <div id="chatbox-container" class="scrollable-content">
          <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <div style="display: flex; justify-content: flex-end;">
                <div style="width: auto; height: auto; margin-top: 15px; background-color: blue; border-radius: 15px; margin-right: 15px; margin-left: 100px;">
                    <p style="font-size:17px; font-weight:bold; font-family: Arial, Helvetica, sans-serif; text-align:left; padding: 15px 15px; color:white;"><?php echo $row['propmt_input'];?></p>
                </div>
            </div>
            <div style="display: flex; justify-content: flex-start;">
                <div style="width: auto; height: auto; margin-top: 15px; background-color: gray; border-radius: 15px; margin-left: 15px; margin-right: 100px; margin-bottom:30px;">
                    <p style="font-size:17px; font-family: Arial, Helvetica, sans-serif; text-align:left; padding: 15px 15px; color:white;"><?php echo $row['propmt_output'];?></p>
                </div>
            </div>
            <?php } ?>
          </div>
          <!-- End of scrollable container -->
        </div>
      </div>
    </div>
  </div>
</div>

<script type="module">
  // For Gemini AI
  document.getElementById('promptForm').addEventListener('submit', hello);
  import { GoogleGenerativeAI } from "@google/generative-ai";

  const genAI = new GoogleGenerativeAI("AIzaSyAtnhD6P5JY8TOEaj02Sa1Um2Z1_m1_qSM"); // Use your API key here

  async function hello(event) {
    // Show the loading screen
      document.getElementById('loading-screen').style.display = 'flex';

    // Simulate an async operation (e.g., an API request) with a timeout
    setTimeout(function() {
      // Hide the loading screen after a delay (simulate action completion)
      document.getElementById('loading-screen').style.display = 'none';
      
      // Proceed with the form submission or other actions
      // event.preventDefault(); // Uncomment this if you want to stop form submission for some reason
    }, 5000); // Simulating a 2-second delay

    event.preventDefault();
      
    // Get user input
    const prompt = document.getElementById('userInput').value;

    const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

    // Send the prompt to the AI model
    const result = await model.generateContent(prompt);
    const response = await result.response;
    const text = response.text();

    // Display the result in the output paragraph
    window.location.href='./add_propmt.php?output='+text+'&input='+prompt;
  }
  // For Gemini AI
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

<script>
  // var elSandbox = document.querySelector(".sandbox");
  
  // function mouseEnter() {
  //   elSandbox.classList.add('go-up');
  // }

  // function mouseOut() {
  //   elSandbox.classList.remove('go-up');
  // }

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

</body>
</html>
