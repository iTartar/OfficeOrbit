<!DOCTYPE html>
<html lang ="en">

<body></body>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/logincss.css" >

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#">
			<h1>Create Account</h1>
			<div class="social-container">
			</div>
			<input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
			<button>Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Sign in</h1>
			<div class="social-container">
			</div>
			<span>or use your account</span>
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button href="/">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>Silahkan login disini</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello</h1>
				<p>Tolong mengisi data diri</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
	<form method="post" action="connect.php">
		Username : <input type="text" name="Username"> <br></br>
		Password : <input type="text" name="Password"> <br></br>
		<input type="submit"input type="submit">
	</form>
</div>
<script src="js/loginjs.js">
	        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
</script>
<footer>
</footer>
</html>