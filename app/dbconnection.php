<?php

$host = 'mysql'; // Replace with your MySQL host (service name or IP address)
$username = 'root';
$password = 'root';
$dbname = 'vapp';

try {
  $conn = new mysqli($host, $username, $password, $dbname);
  echo "Connected to the MySQL database successfully! \n";

  // Optional: Perform a simple query to test further (replace with your query)
  $sql = "SELECT 1 + 1 AS result";
  $result = $conn->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();
    echo "Simple query result: " . $row['result'] . "\n";
  } else {
    echo "Error running query: " . $conn->error . "\n";
  }

  $conn->close();
} catch (mysqli_sql_exception $e) {
  echo "Connection failed: " . $e->getMessage() . "\n";
}

?>
