<style type="text/css">

#login_box
{
	min-height: 10em;
	background-color: #fff;
	background-image: url('../img/kroon.png');
	background-position: center bottom;
	background-repeat: no-repeat;
	padding: 10px;
}

</style>

<div id='login_box'>
	<?php echo $header; ?>
	<table>
		<form action='<?php echo BASE_URL; ?>guests/login' method='post'>
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