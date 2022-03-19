<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<style type="text/css">
		#email_btn{ color: red; margin-left: 20px;}
		#phone_btn{ color: red; margin-left: 20px;}
		.field_error{color: red;}
		</style>
	</head>
	<body>
		<h1>Login Here</h1>
		<form method="POST" action="loginCheck">
			{{@csrf_field() }}
			<span id="sp_phone">Phone : <input id="phone" type="text" name="phone" placeholder="Phone Number">
			<span class="field_error">
				@error('phone')
				{{$message}}
				@enderror
			</span><br><br></span>
			<span id="sp_email">Email : <input id="email" type="text" name="email" placeholder="Email Address">
			<span class="field_error">
				@error('email')
				{{$message}}
				@enderror
			</span><br><br></span>
			<span>Password : <input type="text" name="pass" placeholder="Password">
			<span class="field_error">
				@error('pass')
				{{$message}}
				@enderror
			</span></span><br><br>
			
			<input id="type" type="hidden" name="type" value="email">
			<input type="submit" name="submit" value="Submit">
			<a href="signup">Or Create a new Account</a><br>
			<span class="field_error">
				<h2>{{session('error')}}</h2>
				<h2>{{session('status')}}</h2>
			</span><br>
		</form>
		<br>
		<button id="email_btn" onclick="email_fun()">Login with Email</button>
		<button id="phone_btn" onclick="phone_fun()">Login with Phone</button>
		<script type="text/javascript">
				document.getElementById('sp_phone').style.display='none';
			
			function email_fun(){
				document.getElementById('phone').value='';
				document.getElementById('type').value='email';
				document.getElementById('sp_phone').style.display='none';
				document.getElementById('sp_email').style.display='block';
			}
			function phone_fun(){
				document.getElementById('email').value='';
				document.getElementById('type').value='phone';
				document.getElementById('sp_email').style.display='none';
				document.getElementById('sp_phone').style.display='block';
			}
		</script>
	</body>
</html>