<?php require 'pdo.php';
if ( ! isset($_GET['name']) ) {
    die('Name parameter missing');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasnat Kabir</title>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for
        <?php
        if ( isset($_REQUEST['name']) ) {
            echo htmlentities($_REQUEST['name']);
        }
        ?>
    </h1>
    <p style="color:red">
        <?php
        if (isset($_POST['Add'])) {
            if (empty($_POST['make'])) {
                echo "Make is required";
            } elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
                echo "Mileage and year must be numeric";
            } else {
                $sql ="INSERT INTO autos(make,year,mileage) VALUES(:make,:year,:mileage)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':make'=> $_POST['make'],
                    ':year'=> $_POST['year'],
                    ':mileage'=>$_POST['mileage']
                ));
                echo "<p style='color:green'>Record inserted</p>";
            }



        }
        if (isset($_POST['logout'])) {
            header("Location: index.php ");
        }




        ?></p>
    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>
        <input type="submit" name="Add" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>

    <h2>Automobiles</h2>
    <ul><p>
        <?php
        $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
        while ($row=$stmt-> fetch (PDO::FETCH_ASSOC)){
            echo "<li>{$row['year']} {$row['make']} / {$row['mileage']}";
        }
        ?></ul>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script></body>
</html>
