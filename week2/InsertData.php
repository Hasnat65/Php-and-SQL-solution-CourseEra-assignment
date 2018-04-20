<?php

require_once "pdo.php";
if ( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password'])) {
  $sql = "INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)";
  echo("<pre>\n".$sql."\n</pre>\n");
$stmt=$pdo->prepare($sql);
$stmt->execute(array(   ':name' =>$_POST['name'] ,
                        ':email' =>$_POST['email'] ,
                        ':password' =>$_POST['password']  ));


}?>
<?php
if ( isset($_POST['user_id']) ) {
    $delete = "DELETE FROM users WHERE user_id = :user_id";
    echo "<pre>$delete</pre>\n";
    $stmt2 = $pdo->prepare($delete);
    $stmt2->execute(array(':user_id' => $_POST['user_id']));

}
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Add new</title>
   </head>
   <body style="text-align:center;font-family:sans-sarif">
     <form class=""  method="post">
       <h4>Add New Data</h4>
       Name:<input type="text"  size="40" required name="name" value=""><br>
       Email:<input type="text" size="40" required name="email" value=""><br>
       PassWord:<input type="password" size="40"name="password"required  value=""><br>
       <input type="submit" name="" value="Add new">
     </form>
     <p>Delete A User</p>
<form method="post">
<p>ID to Delete:
<input type="text" name="user_id"></p>
<p><input type="submit" value="Delete"/></p>
</form>

   </body>
 </html>
