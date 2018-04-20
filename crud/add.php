<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password'])) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }

    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: add.php");
        return;
    }

    $sql = "INSERT INTO users (name, email, password)
              VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
</head>
<body><title>Hasnat Kabir</title>
<div >
    <h1>Tracking Automobiles for umsi@umich.edu</h1>
    <form method="post">
        <p>Make:

            <input name="make" size="40" type="text"></p>
        <p>Model:

            <input name="model" size="40" type="text"></p>
        <p>Year:

            <input name="year" size="10" type="text"></p>
        <p>Mileage:

            <input name="mileage" size="10" type="text"></p>
        <input name="add" value="Add" type="submit">
        <input name="cancel" value="Cancel" type="submit">
    </form>
    <p>
    </p></div>

</body></html>