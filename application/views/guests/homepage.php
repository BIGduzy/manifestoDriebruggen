<div id='BIG_picture'>
	<?php echo $picture; ?>
	<div class='transparent_box'>
		<?php echo $title; ?>
		<button type='button' class='button'>Bestel</button>
	</div>

</div>
<div id='optredens'>
	<ul>
		<?php echo $show_optredens; ?>
	</ul>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		$('.button').click(function(){
			location.href = '<?php echo $link; ?>';
		});
	});	

</script>