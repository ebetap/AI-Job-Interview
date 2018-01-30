<div class="container header">
<h2 class="text-center">Form Registrasi</h2>

	<form method="POST">
		<div class="form-group" >
			<label>No.KTP:</label>
			<input type="text" class="form-control" id="noktp" name="noktp" required>
		</div>
		<div class="form-group" >
			<label>Nama Lengkap:</label>
			<input type="name" class="form-control" id="name" name="fullname" required>
		</div>
		<div class="form-group" >
			<label>Username:</label>
			<input type="username" class="form-control" id="username" name="username" required>
		</div>
		<div class="form-group" >
			<label>E-mail:</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
		<div class="form-group" name="gender"  >
			<label>Gender</label><br>
		  	<input type="radio" name="gender" value="Male"><label>Male</label></input>
		  	<input type="radio" name="gender" value="Female"><label>Female</label><br></input>
		</div>
		<div class="form-group" >
			<label>Password:</label>
			<input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Sign up</button><br>
		<blockquote class="blockquote-reverse">
		Already have an account? <a href="<?php echo base_url(); ?>/user/login">Login here</a>	
		</blockquote>
	</form>