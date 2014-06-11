<div id='BIG_picture'>
	<?php echo $picture; ?>
	<div id='transparent_box'>
		<?php echo $title; ?>
		<button type='button' class='button'>Bestel</button>
	</div>

</div>
<div id='optredens'>
	<table>
		<?php echo $show_optredens; ?>
	</table>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		$('.button').click(function(){
			location.href = '<?php echo $link; ?>';
		});
	});	

</script>