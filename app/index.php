<?php 
require 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
        <!-- <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Link</a>
        </li> -->
      </ul>
      <form class="d-flex" action="index.php" method="get">
        <input class="form-control me-2" type="text" placeholder="Search" name="search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <h2>Movie List</h2>
  <div class="row">
  <?php 
try {
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (isset($_GET["search"]))
    {
        echo "<p>Search Result :".$search."</p>";
    }

    //htmlspecialchars
    // if (isset($_GET["search"])) {
    //     // Escape the user input to prevent XSS
    //     $search = htmlspecialchars($_GET["search"], ENT_QUOTES, 'UTF-8');
    //     echo "<p>Search Result: " . $search . "</p>";
    // }

    $sql = "SELECT * FROM movie_schedule WHERE LOWER(movie_name) LIKE LOWER('%$search%')";
    $stmt = $pdo->query($sql);

    //prepared statement
    // $sql = "SELECT * FROM movie_schedule WHERE LOWER(movie_name) LIKE LOWER(:search)";
    // $stmt = $pdo->prepare($sql);


    // Check if any results were returned
    if ($stmt->rowCount() > 0) {
        // Fetch all results
        $results = $stmt->fetchAll();

        // Display the results
        foreach ($results as $row) {
    ?>
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
            <div class="card-body">
            <h4 class="card-title"><?php echo htmlspecialchars($row['movie_name']) ?></h4>
            <p class="card-text"><?php echo htmlspecialchars($row['movie_release']) ?></p>
            <a href="#" class="btn btn-primary">See Details</a>
            </div>
        </div>
  </div>
      <?php
      
    }
    } else {
        echo "No records found.";
    }
} catch (PDOException $e) {
    // Catch any errors and display the error message
    echo "Error running query: " . $e->getMessage();
}
  ?>
    </div>
</div>

</body>
</html>

