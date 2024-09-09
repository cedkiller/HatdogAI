<?php
include('../conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/75fe70a6d6.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Sidebar</div>
    <div class="list-group list-group-flush">
      <center><img src="../img/icon.png" alt="" class="list-group-item list-group-item-action bg-dark" style="height: 150px; width: 150px;"></center>
      <a href="#" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;"><?php echo $_SESSION['user_name'];?> <?php echo $_SESSION['user_id'];?></a>
      <a href="./logout.php" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">Logout</a>
      <a href="#" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">History Propmt Below <i class="fa-solid fa-angle-down"></i></a>
      <a href="#" class="list-group-item list-group-item-action bg-dark" style="color: lightgray;">Example Propmt</a>
    </div>
  </div>
  
  <!-- Page Content -->
  <div id="page-content-wrapper">
    <button class="btn btn-primary" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
    <div class="container-fluid">
      <br><br><br><br>
      <div class="sandbox">
        <div class="shadow"></div>
        <div class="card" onmouseenter="mouseEnter()" onmouseleave="mouseOut()">
          <div class="face face-top"></div>
          <div class="face face-back"></div>
          <div class="face face-bottom"></div>
          <div class="face face-left"></div>
          <form action="">
            <label for="">Your Prompt</label>
            <input type="text" placeholder="Enter your prompt" name="name">
          </form>
          <div style="display: flex; justify-content: flex-start;">
            <div style="width: 200px; height: 100px; margin-top: 15px; background-color: blue; border-radius: 15px; margin-left: 15px;"></div>
          </div>
          <div style="display: flex; justify-content: flex-end;">
            <div style="width: 200px; height: 100px; margin-top: 15px; background-color: gray; border-radius: 15px; margin-right: 15px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var elSandbox = document.querySelector(".sandbox");
  
  function mouseEnter() {
    elSandbox.classList.add('go-up');
  }

  function mouseOut() {
    elSandbox.classList.remove('go-up');
  }

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
