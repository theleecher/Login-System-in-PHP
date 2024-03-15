<?php
require("db.php");

if(isset($_POST['reg-submit'])) 
{
  $reg_user=$_POST['reg-username'];
  $reg_pass=$_POST['reg-passwd'];
  $reg_email=$_POST['reg-email'];

  if(!empty($reg_user) && !empty($reg_pass) && !empty($reg_email))

  {
      $md5_pass = md5($reg_pass);
      $user_exist_check_query="select * from users where user='$reg_user'";
      $user_exist_check_query_results = $conn->query($user_exist_check_query);

      $email_exist_check_query="select * from users where email='$reg_email'";
      $email_exist_check_query_results = $conn->query($email_exist_check_query);

      if($user_exist_check_query_results->num_rows>0) 
      {
        echo "<script>alert('"."Sorry Username Already Exist')</script>";
      }

      elseif($email_exist_check_query_results->num_rows>0) 
      {
        echo "<script>alert('"."Sorry Email Already Exist')</script>";
      }

        else
              {
              $reg_query = "INSERT INTO users(user,email,password) VALUES ('$reg_user','$reg_email','$md5_pass')";
              $reg_query_result = $conn->query($reg_query);

              if ($reg_query_result === TRUE)
              {
               echo "<script>alert('New record created successfully')</script>";
              }
              else {
                echo "Error: " . $reg_query . "<br>" . $conn->error;
              }
      }

  
}
  else {
        echo "<script>alert('"."Please Fill All Signup Fields')</script>";
      }

}

if(isset($_POST['login-submit'])) 
{
  $login_email=mysqli_real_escape_string($conn,$_POST['login_email']);
  $login_pass=mysqli_real_escape_string($conn,$_POST['login_passwd']);

  if(!empty('$login_email') && !empty($login_pass))
  {
      $login_md5_pass = md5($login_pass);
      $login_query = "SELECT * FROM users where email='$login_email' AND  password='$login_md5_pass'";
      $login_query_result = $conn->query($login_query);


      if ($login_query_result->num_rows>0)
      {
        $session_id =  md5(rand(100000,999999999));
       
        $session_insert="UPDATE users SET session_id='$session_id' WHERE email='$login_email'";
        $session_insert_results=$conn->query($session_insert);
        setcookie("session_id", $session_id);
       echo "<script>alert('"." Login Successfully')</script>";
      }
      else {
        echo "<script>alert('Wrong Password')</script>";
        }

  }
  
else {
        echo "<script>alert('"."Please Fill All Login Fields')</script>";
      }
 
}

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="index.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="reg-username" placeholder="User name">
					<input type="email" name="reg-email" placeholder="Email">
					<input type="password" name="reg-passwd" placeholder="Password" >
          <input type="submit" name="reg-submit" >
		
				</form>
			</div>

			<div class="login">
				<form action="index.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="login_email" placeholder="Email" >
					<input type="password" name="login_passwd" placeholder="Password" >
					 <input type="submit" name="login-submit" >

				</form>
			</div>
	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>
