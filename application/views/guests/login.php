<div id='box'>
	<?php echo $header; ?>
	<table>
		<form action='<?php echo BASE_URL."guests/login/".$model."/".$link."/".$value; ?>' method='post'>
			<tr>
				<td>e-mail: </td>
				<td><input type='text' name='email'></td>
			</tr>
			<tr>
				<td>Wachtwoord: </td>
				<td><input type='password' name='password'></td>
			</tr>
			<tr>
				<td>&nbsp </td>
				<td><input type='submit' name='submit'></td>
			</tr>
		</form>
	</table>
</div>