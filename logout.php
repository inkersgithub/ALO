<?php
session_start();
if(isset($_POST['logout']))
{
 unset($_SESSION['email']);
  unset($_SESSION['usr_id']);
}
?>

<html>
<body>
 <h2>Hi, Demo</h2>
 <form method='post'>
  <input type='submit' name='logout' value='Logout'>
 </form>
</body>
</html>
