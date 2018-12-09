<!DOCTYPE html>
<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);


	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>


<html>
<head>
	<title>Welcome to Learnify!</title>
	
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	
	
	<!--<a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@stevenhoustonfitness?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Steven Houston"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Steven Houston</span></a>-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>

</head>
<body>
	<?php
		if(isset($_POST['registerButton'])){
			echo '<script>
					$(document).ready(function(){

						$("#loginForm").hide();
						$("#registerForm").show();
					});
				</script>';
		}
		else{
			echo '<script>
					$(document).ready(function(){

						$("#loginForm").show();
						$("#registerForm").hide();
					});
				</script>';
		}
	?>
	
	

	<div id="background"> 

		<div id="loginContainer">



			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" type="text" name="loginUsername" placeholder="Username" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" type="password" name="loginPassword" placeholder="Your password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account? Sign up here.</span>
					</div>
					<br>
					<div class="requestReset">
						<a href="requestReset.php">Forgot Password?</a>
					</div>
				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Sign up to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="Username">Username</label>
						<input id="Username" type="text" name="Username" placeholder="Username" value="<?php getInputValue('Username') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">First name</label>
						<input id="firstName" type="text" name="firstName" placeholder="Your name" value="<?php getInputValue('firstName') ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" type="text" name="lastName" placeholder="Your surname" value="<?php getInputValue('lastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailsInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" type="Email" name="email" placeholder="e.g. email@gmail.com" value="<?php getInputValue('Email') ?>" required>
					</p>
					<p>
						<label for="email2">Confirm Email</label>
						<input id="email2" type="Email" name="email2" placeholder="e.g. email@gmail.com" value="<?php getInputValue('Email') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$passwordsNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordsCharacters); ?>
						<label for="password">Password</label>
						<input id="password" type="password" name="password" placeholder="Your password" required>
					</p>

					<p>
						<label for="password2">Confirm Password</label>
						<input id="password2" type="password" name="password2" placeholder="Your password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Login here.</span>
					</div>

				</form>
			</div>

			<div id="loginText">
				<h1>Get great video classes, right now.</h1>
				<h2>Listen to classes and video classes for free</h2>
				<ul>
					<li>Review classes you missed</li>
					<li>Get help for your homework</li>
					<li>Study for exams</li>
				</ul>
			</div>
		</div>
	</div>

</body>
</html>