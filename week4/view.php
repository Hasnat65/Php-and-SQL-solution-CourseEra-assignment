

<?php


session_start();
if ( !isset($_SESSION["email"]) ) {
    //echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
die("Not logged in");
}   elseif( isset($_SESSION["email"]) ) {

//require_once "autos.php";
    $_SESSION['record']="Record inserted";
    $pdo = new PDO("mysql:host=localhost;dbname=misc", 'root','');
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "<p style='color: #00bf00'>".$_SESSION['record']."</p>"."<br>";
        $stmt=$pdo->query("SELECT make,year,mileage FROM autos where 1");

    echo "<table  border='1'>."."<br>";
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>";
            echo ($row['make']);
            echo ("</td><td>");
            echo ($row['year']);
            echo ("</td><td>");
            echo ($row['mileage']);
            echo ("</td></tr>");


        }echo "</table>";
        unset($_SESSION['record']);}
//unset($_SESSION['record']);}
?>
<html><head><title>hasnat kabir</title></head><body>
<pre><h1>Tracking Autos for csev@umich.edu</h1>
<h1>Automobiles</h1></pre>
<a href="add.php">Add New</a>|<a href="logout.php">Logout</a>


</body></html>
