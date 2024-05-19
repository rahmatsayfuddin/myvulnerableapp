<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ping</title>
</head>
<body>
    <h2>Ping a Host</h2>
    <form action="check.php" method="post">
        <label for="host">Enter IP address or hostname:</label>
        <input type="text" name="host" id="host" required>
        <br><br>
        <input type="submit" value="Ping">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $host = $_POST['host'];
        
        // Vulnerable to command injection
        $cmd = "ping -c 4 " . $host;
        echo "<pre>$cmd</pre>";
        $output = shell_exec($cmd);
        
        echo "<pre>" . htmlspecialchars($output) . "</pre>";
    }
    ?>

<?php
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $host = $_POST['host'];

    //     // Validate the host to allow only IP addresses and hostnames
    //     if (filter_var($host, FILTER_VALIDATE_IP) || preg_match('/^[a-zA-Z0-9.-]+$/', $host)) {
    //         $cmd = escapeshellcmd("ping -c 4 " . $host);
    //         echo "<pre>$cmd</pre>";
    //         $output = shell_exec($cmd);
            
    //         echo "<pre>" . htmlspecialchars($output) . "</pre>";
    //     } else {
    //         echo "Invalid IP address or hostname.";
    //     }
    // }
    ?>
</body>
</html>
