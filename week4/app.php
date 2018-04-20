<?php
session_start();
if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}
if ( isset($_POST["email"]) && isset($_POST["pass"]) ) {
    unset($_SESSION["email"]);  // Logout current user
    if ( strlen($_POST['email'])< 1 || strlen($_POST['pass']) < 1 ){
        $_SESSION["error"] = "Email and password are required";
        header ('Location:login.php');
        return;
    }
    else if ( strpos($_POST['email'],'@') !== false) {
        if ( $_POST['pass'] == 'tors' ) {
            // Redirect the browser to auto.php
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['success'] = "Logged in.";
            //header('location:view.php');
            header("Location: view.php?name=".urlencode($_SESSION['email']));
            error_log("Login success ".$_SESSION['email']);
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_SESSION['email']);
            header('Location: login.php');
            return;
        }
    } else {
        $_SESSION["error"] = "Email should contain '@'";
        header ('Location:login.php');
        return;
    }
}

?>
<html>
<head>
    <title>Hasnat Kabir</title>
</head>
<body style="font-family: sans-serif;">
<h1>Please Log In</h1>
<?php
if ( isset($_SESSION["error"]) ) {
    echo('<p style="color:red">'.htmlentities($_SESSION["error"])."</p>\n");
    unset($_SESSION["error"]);
}
?>
<form method="post">
    <p>Account: <input type="text" name="email" value=""></p>
    <p>Password: <input type="text" name="pass" value=""></p>
    <p><input type="submit" value="Log In">
        <a href="login.php">Cancel</a>
        <a class="btn" href="logout.php">Log out!</a></p>
</form>

</body>
</html>