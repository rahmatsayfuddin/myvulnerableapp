<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSRF Example</title>
</head>
<body>
    <h2>Fetch URL Content</h2>
    <form action="import.php" method="post">
        <label for="url">Enter URL:</label>
        <input type="text" name="url" id="url" required>
        <br><br>
        <input type="submit" value="Fetch">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $url = $_POST['url'];
        // Fetch the content from the URL
        $content = file_get_contents($url);

        if ($content !== false) {
            echo "<h3>Content fetched from URL:</h3>";
            echo "<pre>" . htmlspecialchars($content) . "</pre>";
        } else {
            echo "Unable to fetch content from the URL.";
        }
    }
    ?>


<?php
//fix
// function is_private_ip($ip) {
//     if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
//         return true;
//     }
//     return false;
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $url = $_POST['url'];

//     // Basic URL validation
//     if (filter_var($url, FILTER_VALIDATE_URL) && parse_url($url, PHP_URL_SCHEME) === 'http') {
//         $host = parse_url($url, PHP_URL_HOST);

//         // Resolve the IP address of the host
//         $ip = gethostbyname($host);

//         // Check if the resolved IP is a private IP or localhost
//         if (!is_private_ip($ip) && $ip !== '127.0.0.1' && $ip !== '::1') {
//             // Fetch the content from the URL
//             $content = file_get_contents($url);

//             if ($content !== false) {
//                 echo "<h3>Content fetched from URL:</h3>";
//                 echo "<pre>" . htmlspecialchars($content) . "</pre>";
//             } else {
//                 echo "Unable to fetch content from the URL.";
//             }
//         } else {
//             echo "Access to private IP addresses and localhost is not allowed.";
//         }
//     } else {
//         echo "Invalid URL.";
//     }
// }
    ?>
</body>
</html>
