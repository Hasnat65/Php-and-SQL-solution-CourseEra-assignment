<?php
require_once "pdo.php";
session_start();

if ( ! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']) ) {

    $sql = "UPDATE autos SET make = :mk,
    model = :mo, year = :yr, mileage = :mi
    WHERE autos_id = :autos_id";

    if ( strlen($_POST['make']) < 1  || strlen($_POST['model']) < 1  || strlen($_POST['year']) < 1  || strlen($_POST['mileage']) < 1 )  {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
    } else if ((!is_numeric($_POST['year'])) || (!is_numeric($_POST['mileage']))) {
        $_SESSION['error'] = "Mileage and Year must be numeric";
        header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
    } else {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':mo' => $_POST['model'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'],
            ':autos_id' => $_POST['autos_id']));

        $_SESSION['edit'] = "Record edited";
        header( 'Location: index.php' );
        return;
    }

}
if ( ! isset($_GET['autos_id']) ) {
    $_SESSION['error'] = "Missing autos_id";
    header('Location: index.php');
    return;
}

$stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}

$k = htmlentities($row['make']);
$l = htmlentities($row['model']);
$y = htmlentities($row['year']);
$m = htmlentities($row['mileage']);
$autos_id = htmlentities($row['autos_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasnat Kabir</title>
</head>
<body>
<div class="">
    <h1>Editing Automobile</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make:
            <input type="text" name="make" value="<?= $k ?>"></p>
        <p>Model:
            <input type="text" name="model" value="<?= $l ?>"></p>
        <p>Year:
            <input type="text" name="year" value="<?= $y ?>"></p>
        <p>Mileage:
            <input type="text" name="mileage" value="<?= $m ?>"></p>
        <input type="hidden" name="autos_id" value="<?= $autos_id ?>">
        <input type="submit" name='save' value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
