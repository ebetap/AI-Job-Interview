<div class="container header">
	<h2 class="text-center">Form Login</h2>
		
	<?php 
	if ($pesan = $this->session->flashdata('item')) {
		echo $pesan;
	}
	 ?>

	<form class="formregis" method="POST">
		<div class="form-group">
			<label>Username:</label>
			<input type="username" placeholder="Username" class="form-control" id="username" name="username" required>
		</div>
		<div class="form-group" >
			<label>Password:</label>
			<input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
		</div>

		<button type="submit" class="btn btn-primary" name="submit">Login</button><br><br>
		<blockquote class="blockquote-reverse">
		Don't have an account? <a href="<?php echo base_url(); ?>register">Sign Up Here</a>	
		</blockquote>
		 
	</form>	

</div>
