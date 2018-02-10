<?php 
 ?>
<div class="account">
	<div class="isimenu">
		<!-- Head isi -->
		<div class="head">
		</div>
		<!-- Body isi -->
		<div class="body_account">
			<div class="tampil">
				<h3>Detail Account</h3>
				<table class=".table-striped">
					<tr>
					    <td>ID </td>
					    <td><p>  <?php echo $fetch['userID']; ?></p></td>
					</tr>
					<tr>
						<td>No.KTP </td>
						<td><p>  <?php echo $fetch['noktp']; ?></p></td>
					</tr>
					<tr>
						<td>Fullname </td>
						<td><p>  <?php echo $fetch['fullname']; ?></p></td>
					</tr>
					<tr>
						<td>Username </td>
						<td><p>  <?php echo $fetch['username']; ?></p></td>
					</tr>
					<tr>
						<td>E-mail </td>
						<td><p>  <?php echo $fetch['email']; ?></p></td>
					</tr>
					<tr>
						<td>Gender </td>
						<td><p>  <?php echo $fetch['gender']; ?></p></td>
					</tr>
				</table>
			</div>
			<div class="edit">
				<a href="controller/account_edit.php"><button type="button" class="btn btn-primary">Edit Profile</button></a>
			</div>	
		</div>
	</div>
</div>	