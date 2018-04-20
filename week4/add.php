<h1>Tracking Autos for csev@umich.edu</h1><?php
session_start();
if ( !isset($_SESSION["email"]) ) {
    //echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
    die("Not logged in");
}
elseif (isset($_SESSION["email"])){
$pdo = new PDO("mysql:host=localhost;dbname=misc", 'root','');
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) )
{$year=$_POST['year'] ;
    $milage=$_POST['mileage'];


    if( is_numeric($year) && is_numeric($milage) && !empty($_POST['make']))   {
        $sql = "INSERT INTO autos (make, year,mileage)
               VALUES (:make, :year, :milage)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(   ':make' =>htmlentities($_POST['make']) ,
            ':year' =>$_POST['year'] ,
            ':milage' =>$_POST['mileage']));
     $_SESSION['record']="Record inserted";
     header("location:view.php");
     return;

    }if(isset($_POST['cancel'])){header("location:view.php");}
    if(!is_numeric($year) || !is_numeric($milage)) {
        echo "<p class='red'>Mileage and year must be numeric</p>".'<br>';
    }
    if(empty($_POST['make']) )  echo "<p class='red'>Make is required</p>";

}}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>hasnat kabir</title>

    <style media="screen">
        .form{
            margin:10px;
        }h4{color:green;}
        input{margin:10px;
            padding:7px;}
        .red{color:red;}
    </style>
</head>
<body>
        <form class="form"   method="post">
            <b >make:</b>
            <input type="text" name="make"><br>
            <b>Year:</b>
            <input type="text" name="year" value=""><br>
            <b>Mileage:</b>
            <input type="text" name="mileage" value=""><br>
            <input type="submit" name="sub" value="Add">
            <input name="cancel" value="Cancel" type="submit">

        </form>
</body>
</html>
