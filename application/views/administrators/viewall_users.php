<style>
.odd
{
	background-color :RGBA(214,214,214,1);
    border :0px solid red;
	font-size:1em;
}
.even
{
	background-color:RGBA(214,214,214,0.5);
	border:0px solid black;
	font-size:1em;
}
.highlight
{
	background-color:grey;
	border:0px solid black;
	font-size:1em;
}
td, th
{
	padding:1em;
	text-align:center;
	
}

</style>

<script type='text/javascript'>
	$('document').ready(function(){
		$("tr:even").addClass("even");
		$("tr:odd").addClass("odd");
		$("tr").hover(
			function(){
				$(this).toggleClass('highlight');
			},
			function(){
				$(this).toggleClass('highlight');
			}
		);
	});
</script>

<h3><?php echo $header;?></h3>
<table>
	<tr>
		<th>ID</th>
		<th>Voornaam</th>
		<th>Tussenvoegsel</th>
		<th>Achternaam</th>
		<th>Wachtwoord</th>
		<th>Gebruikersrol</th>	</tr>
		<?php echo $show_users; ?>
</table>

