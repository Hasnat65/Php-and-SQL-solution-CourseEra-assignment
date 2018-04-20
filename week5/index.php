<?php
require_once "pdo.php";
session_start();
?>
<html>
<head><title>Hasnat Kabir</title></head><body>
<?php
if (isset($_SESSION['error']))  {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){echo "Record Added";
unset($_SESSION['success']);}
if  (isset($_SESSION['delete']))  {
    echo '<p style="color:green">'.$_SESSION['delete']."</p>\n";
    unset($_SESSION['delete']);
}//if($_SESSION['edit']){echo $_SESSION['edit'];
//unset($_SESSION['edit']);}
if  (isset($_SESSION['edit']))  {
    echo '<p style="color:green">'.$_SESSION['edit']."</p>\n";
    unset($_SESSION['edit']);
}
echo('<table border="1">'."\n");
echo "<thead><tr>";
echo "<th>Make</th>";
echo "<th>Model</th><th>Year</th><th>Mileage</th><th>Action</th></tr></thead>";
$stmt = $pdo->query("SELECT make, model, year, mileage,autos_id FROM autos");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['model']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
    echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New Entry</a><br>
<a href="logout.php">Logout</a>
</body>
</html>