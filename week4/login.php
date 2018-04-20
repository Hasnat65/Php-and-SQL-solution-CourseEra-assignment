<?php
session_start();
if ( isset($_POST["email"]) && isset($_POST["pass"]) ) {

 unset($_SESSION["email"]);  // Logout current user
    $_SESSION["email"] = $_POST["email"];
$who = $_POST['email'];
    $salt = 'XyZzy12*_';
    $pass = $_POST['pass'];
    $md5 = hash('md5', $salt . $pass);
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
    if($who == '' || $pass == '')
    {
        echo "<h4>"."Email and password are required"."</h4>";
    }
    else if(strpos($who, '@') === false)
    {
        echo "<h4>"."Email must have an at-sign (@)"."</h4>";
    }
   else{ if($md5 == $stored_hash) {

       $_SESSION["success"] = "Logged in.";
       error_log("Login success ".$_POST['email']);

       header( 'Location: view.php' ) ;
       return;
   } else {
       $_SESSION["error"] = "Incorrect password.";
       header( 'Location: login.php' ) ;
       error_log("Login fail ".$_POST['pass']." $md5");
       return;
   }
}}


?>
<html>
<head><title>Hasnat Kabir</title>
    <style>
        h4{
            color: red;
        }
    </style>
</head>
<body style="font-family: sans-serif;">
<h1>Please Log In</h1>
<?php
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
    unset($_SESSION["error"]);
}
?>
<form method="post">
    <p>Email: <input type="text" name="email" value=""></p>
    <p>Password: <input type="text" name="pass" value=""></p>
    <!-- password is umsi -->
    <p><input type="submit" value="Log In">
        <a href="autoscrud.php">Cancel</a></p>
</form>
</body>
