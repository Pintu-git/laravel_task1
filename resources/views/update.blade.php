<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Update</title>
		<style type="text/css">
		.field_error{color: green;}
		</style>
	</head>

	<?php 
		if($data['phone']=='')
		$x=1;
		if($data['email']=='')
		$x=2;
	?>


	<body onload="myfun({{$x}})">
	<h1>Update Profile</h1>
	<form method="POST" action="updateFor">
			{{@csrf_field() }}
			<span id="sp_phone">Phone : <input id="phone" type="text" name="phone" value="{{$data['phone']}}">
				<span class="field_error">
					@error('phone')
					{{$message}}
					@enderror
				</span><br><br>
			</span>
			<span id="sp_email">Email : <input id="email" type="text" name="email" value="{{$data['email']}}">
				<span class="field_error">
					@error('email')
					{{$message}}
					@enderror
				</span><br><br>
			</span>
			<span>Old Password : <input type="text" name="opass" >
				<span class="field_error">
					@error('opass')
					{{$message}}
					@enderror
				</span><br><br>
			</span>
			<span>New Password : <input type="text" name="npass" >
				<span class="field_error">
					@error('npass')
					{{$message}}
					@enderror
				</span><br><br>
			</span>
			<input type="submit" name="submit" value="Update"><br>
			<span class="field_error">
				<h2>{{session('status')}}</h2>
			</span><br>
	</form>
<br><a href="logout">Logout</a> | <a href="profile">Profile</a>



<script type="text/javascript">
	function myfun(x){
		if(x==1){
			document.getElementById('sp_phone').style.display='none';
		}else{
			document.getElementById('sp_email').style.display='none';
		}
	}
</script>




</body>
</html>