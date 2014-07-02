<div id='box'>
	<?php
		 echo $header;
		 echo $text;
	?>
	<table>
		<form action='<?php echo BASE_URL."users/mailinglist"; ?>' method='post'>
			<tr>
				<td><input type='submit' name='submit'></td>
			</tr>
		</form>
	</table>
</div>