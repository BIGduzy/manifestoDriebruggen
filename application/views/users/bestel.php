<div id='box'>
	<div class='title'>
		<?php 
			echo $header;
			echo $title;
		?>
		<p>Kies het gewenste aantal tickets. Druk vervolgens op GA VERDER.</p>
	</div>


	<div class='prijs_table'>
		<form name='buy_form' action='<?php echo BASE_URL; ?>users/bestel/<?php echo $id ?>' method='post'>
			<table>
				<th>Ticked</th>
				<th>Prijs</th>
				<th>Aantal</th>
				<tr>
					<td>Rang 2 - Normaal</td>
					<td><?php echo $prijs; ?></td>
					<td>
						<select name='amount'>
							<option value="1" >1</option>
							<option value="2" >2</option>
							<option value="3" >3</option>
							<option value="4" >4</option>
						</select>
					</td>
				</tr>
			</table>
			<div class='submitbutton'>
				<span alt="Ga verder  &#187;" title="Ga verder  &#187;" onclick="document.forms.buy_form.submit();">Ga verder  &#187;</span>
			</div>
		</form>
	</div>
	<p>LET OP elke reservering kost 1 euro extra (per kaartje).</p>
	
</div>