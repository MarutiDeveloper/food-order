<?php include('../config/constants.php'); ?>

<html>
<head>
	<title> Login - Food Order System</title>
	<link rel="stylesheet" href="../css/admin.css">

</head>
	<body>
		<div class="login">
		<h1 class="text-center">Login</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } 
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            } 
        ?>
        <br><br>
		
        <form action="" method="POST" >
            User Name : <br>
            <input type="text" name="username" placeholder="Enter User Name"><br><br>
	        Password :<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

        </form>
		<p class="text-center">Created By : - <a href="www.Tejaskumar joshi.com">Tejaskumar Joshi</a></p>
	</body>
</html>

<?php 
	//Check whether the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//Process for login
		// 1. Get the Data from login form
		$username = $_POST['username'];
		$password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to chech whether the user exists or not

        $count = mysqli_num_rows($res);
	
	if($count==1)
	{
	        //User Avalable and login Successfully.
	       $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
           $_SESSION['user'] = $username; // To Check whether the user is logged in or not and logout will unset it.
	        // Redirect to Home page.
	        header('location:'.SITEURL.'Admin/');
	}
	else
	{
	    //User not Available and Login Faild.
	   $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
	    //Redirect to home Page/Deshboard
	    header('location:'.SITEURL.'Admin/login.php');
	}

	}

?>
