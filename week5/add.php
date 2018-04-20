<?php
session_start();
if ( !isset($_SESSION["email"]) ) {
    //echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
    die("ACCESS DENIED");
}
$pdo = new PDO("mysql:host=localhost;dbname=misc", 'root','');
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ( isset($_POST['make'])  && isset($_POST['model']) && isset($_POST['year'])
    && isset($_POST['mileage']) ) {

    // Data validation
    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 ||strlen($_POST['year']) < 1||strlen($_POST['mileage']) < 1) {
        $_SESSION['error'] = 'All fields are required';
        header("Location: add.php");
        if (isset($_POST['cancel'])){header("location:index.php");
            unset( $_SESSION['error']);
            return;}
        return;
    }

   if(!is_numeric($_POST['year'])){echo "Year must be an integer";
    header("location:add.php");
    return;}

    $sql = "INSERT INTO autos (make,model,year,mileage)
              VALUES (:make, :model, :year,:mileage)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':model' => $_POST['model'],
        ':year' => $_POST['year'],
     ':mileage' => $_POST['mileage']));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}
elseif (isset($_POST['cancel'])){header("location:index.php"); return;}
// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
</head>
<body>
<div class="container">
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