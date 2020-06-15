<?php include 'inc/header.php'; ?>


<h2>Show password button</h2>
<div class="content">
	<style>
		
	</style>
	
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" placeholder="Enter username....">
				</td>
			</tr>
		
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password" id="password" placeholder="Enter username....">
				</td>
			</tr>
			
			<tr>
				<td></td>
				<td></td>
				<td>
					<button type="button" name="showpassword" id="showpassword" value="Show Password">Show Password</button>
				</td>
			</tr>


		</table>
		<div id="passwordstatus">
			
		</div>
	</form>


</div>
<?php include 'inc/footer.php'; ?>