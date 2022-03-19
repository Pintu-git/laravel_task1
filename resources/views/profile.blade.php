<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profile</title>
	</head>

	<?php 
		if($data['phone']=='')
		$x=1;
		if($data['email']=='')
		$x=2;
	?>


	<body onload="myfun({{$x}})">
		<h1>Profile</h1>


		<span id="sp_phone">Phone Number : {{$data['phone']}}</span><br>
		<span id="sp_email">Email Address : {{$data['email']}}</span><br>
		<br><a href="logout">Logout</a>  |  <a href="update">Update</a>





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