<!DOCTYPE html>

<?php
$error_msg = '';
if(isset($_POST['who']) && isset($_POST['pass']) && !isset($_POST['cancel']))
{
    $who = $_POST['who'];
    $pass = $_POST['pass'];
    if($who == '' || $pass == '')
    {
        $error_msg = "Email and password are required";
    }
    else if(strpos($who, '@') === false)
    {
        $error_msg = "Email must have an at-sign (@)";
    }
    else
    {
        $salt = 'XyZzy12*_';
        $md5 = hash('md5', $salt . $pass);
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        if($md5 == $stored_hash)
        {
            error_log("Login success ".$_POST['who']);
            header("Location: autos.php?name=".urlencode($_POST['who']));
        }
        else
        {
            $error_msg = "Incorrect password";
            error_log("Login fail ".$_POST['who']." $md5");
        }
    }
}
?>

<html>
<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <title>Hasnat Kabir</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    echo "<p style=\"color:red;\">$error_msg</p>";
    ?>
    <form method="POST">
        <label for="nam">User Name</label>
        <input type="text" name="who" id="nam"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is the three character name of the
        programming language used in this class (all lower case)
        followed by 123. -->
    </p>
</div>
</body>
