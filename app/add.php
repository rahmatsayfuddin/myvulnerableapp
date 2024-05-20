<?php 
require 'dbconnection.php';
session_start();
// var_dump($_SESSION);
// echo isset($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Add Movies</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <?php if (!isset($_SESSION["username"])) {?>
        <li class="nav-item">
          <a class="nav-link" href="loginui.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="registerui.php">Register</a>
        </li>
        <?php }
        else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
            <?php } ?>
        <?php
        if (isset($_SESSION['role']) and ($_SESSION['role'] == "admin")) {
        ?>
                <li class="nav-item">
                <a class="nav-link" href="import.php">Import</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="add.php">Add movie</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="check.php">Check Connection</a>
                </li>
        <?php
        }
        ?>
      </ul>
      <form class="d-flex" action="index.php" method="get">
        <input class="form-control me-2" type="text" placeholder="Search" name="search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <div class="row">
  <h2>Add Movie</h2>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="movie_name">Movie Name:</label>
        <input type="text" name="movie_name" id="movie_name" required>
        <br><br>
        <label for="movie_synopsis">Movie Synopsis:</label>
        <textarea name="movie_synopsis" id="movie_synopsis" required></textarea>
        <br><br>
        <label for="movie_image">Movie Image:</label>
        <input type="file" name="movie_image" id="movie_image" required>
        <br><br>
        <label for="movie_duration">Movie Duration (in minutes):</label>
        <input type="number" name="movie_duration" id="movie_duration" required>
        <br><br>
        <label for="movie_release">Movie Release Year:</label>
        <input type="number" name="movie_release" id="movie_release" required>
        <br><br>
        <input type="submit" value="Add Movie">
    </form>

    <?php
    require 'dbconnection.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $movie_name = htmlspecialchars($_POST['movie_name']);
        $movie_synopsis = htmlspecialchars($_POST['movie_synopsis']);
        $movie_duration = $_POST['movie_duration'];
        $movie_release = $_POST['movie_release'];

        // Vulnerable file upload
        $target_dir = "assets/";
        $target_file = $target_dir . basename($_FILES["movie_image"]["name"]);
        move_uploaded_file($_FILES["movie_image"]["tmp_name"], $target_file);

        $movie_image = $_FILES["movie_image"]["name"];

        // Use prepared statements for SQL query
        $sql = "INSERT INTO movie_schedule (movie_name, movie_synopsis, movie_image, movie_duration, movie_release) VALUES (:movie_name, :movie_synopsis, :movie_image, :movie_duration, :movie_release)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':movie_name', $movie_name);
        $stmt->bindParam(':movie_synopsis', $movie_synopsis);
        $stmt->bindParam(':movie_image', $movie_image);
        $stmt->bindParam(':movie_duration', $movie_duration, PDO::PARAM_INT);
        $stmt->bindParam(':movie_release', $movie_release, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "New movie added successfully";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
    ?>
    </div>
</div>

</body>
</html>
