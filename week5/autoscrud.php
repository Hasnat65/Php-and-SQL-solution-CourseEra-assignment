<?php
session_start();
?>
<html>
<head><title>Hasnat Kabir</title>
</head>
<body style="font-family: sans-serif;">
<h1>Welcome to Autos Database</h1>

<?php


if ( isset($_SESSION["success"]) ) {
    echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
    unset($_SESSION["success"]);
}

// Check if we are logged in!
if ( ! isset($_SESSION["email"]) ) { ?>
    <p> <a href="login.php">Please log in</a> </p>
<?php } else { ?>

<?php } ?>
<p>Attempt to  <a href="add.php">add data</a> without logging in - it should fail with an error message.</p>
</body>
</html>
