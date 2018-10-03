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
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<?php echo $account->getError(Constants::$loginFailed); ?>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. HarryKane" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" type="password" name="loginPassword" placeholder="Your password" required>
			</p>

			<button type="submit" name="loginButton">LOG IN</button>

		</form>

		<form id="registerForm" action="register.php" method="POST">
			<h2>Sign up to your account</h2>
			<p>
				<?php echo $account->getError(Constants::$usernameCharacters); ?>
				<?php echo $account->getError(Constants::$usernameTaken); ?>
				<label for="Username">Username</label>
				<input id="Username" type="text" name="Username" placeholder="e.g. HarryKane" value="<?php getInputValue('Username') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$firstNameCharacters); ?>
				<label for="firstName">First name</label>
				<input id="firstName" type="text" name="firstName" placeholder="e.g. Harry" value="<?php getInputValue('firstName') ?>" required>
			</p>
			<p>
				<?php echo $account->getError(Constants::$lastNameCharacters); ?>
				<label for="lastName">Last name</label>
				<input id="lastName" type="text" name="lastName" placeholder="e.g. Kane" value="<?php getInputValue('lastName') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
				<?php echo $account->getError(Constants::$emailsInvalid); ?>
				<?php echo $account->getError(Constants::$emailTaken); ?>
				<label for="email">Email</label>
				<input id="email" type="Email" name="email" placeholder="e.g. Harry@gmail.com" value="<?php getInputValue('Email') ?>" required>
			</p>
			<p>
				<label for="email2">Confirm Email</label>
				<input id="email2" type="Email" name="email2" placeholder="e.g. Harry@gmail.com" value="<?php getInputValue('Email') ?>" required>
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

		</form>
	</div>

</body>
</html>