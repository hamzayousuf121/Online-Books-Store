<?php require 'db.php';?>
<?php include "header.php";?>
<?php include "functions.php";?>

<body>
<?php

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		
		require('PHPMailer/src/Exception.php');
		require('PHPMailer/src/PHPMailer.php');
		require('PHPMailer/src/SMTP.php');
	if(isset($_POST['signup']))
	{
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$postcheck = array ($email, $username, $name, $password);
		$postStatus = checkEmpty($postcheck);
		$password = md5($password); 
		
		
		if ($postStatus)
		{
			$ragister_Query = "SELECT email FROM `users` WHERE email = '$email'";
			$ragisterUseReslt = mysqli_query($con, $ragister_Query);
			$ragisterUserows = mysqli_fetch_array($ragisterUseReslt);
			
			if ($ragisterUserows > 0)
			{
				echo "<h1 style = 'style= text-align: centercolor: red;'> !Email already<br>exists Try Again </h1>";
			}
			else
			{
				$rand_num = mt_rand();
				$activation_key  = sha1($rand_num.$username.$rand_num); 
				$subject = 'Verify your Book Store account.';
				$register_sql = "INSERT INTO `users` (`id`, `name`,`username`, `email`, `password`, `activationKey`) VALUES ('', '$name','$username', '$email', '$password', '$activation_key')"; 
				$register_result = mysqli_query($con, $register_sql);
				if ($register_result)
				{
					$message = "Dear ".$name.", </br>Click below to verify your Book Store account.<br><a href='http://localhost/project/login.php?&key=".$activation_key."'>".$subject."</a>";
					
					$mail = new PHPMailer();
					
					$mail->SMTPDebug = 0;                                 //0 for false or 2 to Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'hearthacker.0314@gmail.com';                 // SMTP username
					$mail->Password = 'Superstar8300';                           // SMTP password
					$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					
					$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
					
					$mail->Port = 465;                                    // TCP port to connect to

					//Recipients
					$mail->setFrom($email, 'Book Store');
					$mail->addAddress($email, 'Local Mailer');     // Add a recipient

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body   = $message;
					//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					
					
					if($mailSent = $mail->send())
					{
						echo "<h1 style='color: green;'>Email sent! <br>Check your inbox and verify your email.</h1>";
					}
				}
			}
			
		}
		else
		{
			echo "<h1> Please Fill The form</h1>";
		}
	}
	else { ?>
	<!--signup start -->
<?php include 'header-scripts.php'; ?>
<body>
<br>
<br>
<div class="sign-up-modal">
		
		<div class="logo-container">
				<svg class="logo" width="94.4px" height="56px">
						<g>
								<polygon points="49.3,56 49.3,0 0,28 	" />
								<path d="M53.7,3.6v46.3l40.7-23.2L53.7,3.6z M57.7,10.6l28.4,16.2L57.7,42.9V10.6z" />
						</g>
				</svg>
		</div>

		<form class="details" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<div class="input-container">
						<input class="col-sm-12 myname text-input with-placeholder" name="name" id="name" type="text"maxlength="50" placeholder="Your Name" />
				</div>
				<div class="input-container">
						<input class="col-sm-12 email-input with-placeholder" name="email" id="email" type="email" maxlength="50"placeholder="Email" />
				</div>
				<div class="input-container">
						<input class="col-sm-5 username-input with-placeholder" name="username" id="username" type="text" placeholder="Username" maxlength="20" />
				</div>
				<div class="input-container">
						<input class="col-sm-5 col-sm-push-2 password-input with-placeholder" name="password" id="password" type="password" maxlength="50"placeholder="Password" />
				</div>

				<input id="sign-up-button" name="signup"type="submit" value="Sign Up">

				<p>Already have an account? <a href="login.php?islogin ='false'">Sign in</a></p>

		</form>
</div>
		</div>
<?php } ?>
</body>
</html>
