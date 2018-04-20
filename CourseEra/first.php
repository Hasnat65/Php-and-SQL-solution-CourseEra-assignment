
 <html>
<head><style>
    table{
        border-collapse: collapse;
        color: greenyellow;
        background-color: black;
        margin: auto;
    }
    body{
        text-align: center;
    }
    </style></head>
     
     <body>
         
     </body>

 </html> <?php


   $pdo = new PDO("mysql:host=localhost;dbname=merc", 'root','');
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to database";
    echo "<hr>";
    $stmt=$pdo->query("SELECT Name,Email,PW FROM mytbale where 1");
     echo "<table  border='1'>."."<br>";
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr><td>";
    echo ($row['Name']);
    echo ("</td><td>");
      echo ($row['Email']);
     echo ("</td><td>");
    echo ($row['PW']);
    echo ("</td></tr>");
    
   
}echo "</table>";
    
?> 