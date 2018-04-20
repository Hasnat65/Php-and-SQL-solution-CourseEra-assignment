

<?php
require_once "pdo.php";
if(isset($_POST['email']) && isset($_POST['password']))
{
  $email =$_POST['email'];
  $password=$_POST["password"];
  $sql='SELECT name FROM users WHERE email=:em AND password=:pw';
  //ECHO "<p>$sql</p>\n";
  $stmt=$pdo->prepare($sql);
  $stmt->execute(array(':em' =>$email,':pw' => $password));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  if($row==FALSE)
  ECHO "OOOOOOOPS!!!!!     LOGIN FAILED";
  else ECHO " YOU ARE SUCCESFULLY LOGGED IN ";

}


 ?>

<p>Please Login</p>
<form method="post">
<p>Email:
<input type="text" size="40" name="email"></p>
<p>Password:
<input type="text" size="40" name="password"></p>
<p><input type="submit" value="Login"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
Check out this
<a href="http://xkcd.com/327/" target="_blank">XKCD comic that is relevant</a>.
