<html>
<head>
  <title>Login Page</title>
  <style>
   body{
 background-image: linear-gradient(to bottom, rgba(255,0,0,0), rgba(105,105,105));
   }
  .content
  {
   text-align: center;
   }
</style>
</head>

<body>

<div class="content">
	<h2> Please fill all the fields </h2>
<form action="database.php" method="POST">
<b> UserName: </b> <input type="email" name="username" placeholder="Enter username"value="" maxlength="30" required="">
<br> <br>
<b> Password: </b><input type="password" name="password" placeholder="Enter password"value="" maxlength="10" required=""><br> <br>

<input type="submit"  value="Login" name="submit"> <br><br>
</div>
 </form>
 </body>
 </html>