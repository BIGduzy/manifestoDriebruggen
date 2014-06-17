<div id='box'>
	<div class="title">
		<?php echo $header; ?>
	</div>

	<div id="agenda">
		<ul>
			<?php echo $show_optredens; ?>
		</ul>
	</div>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		$('.button').click(function(){
			location.href = '<?php echo $link; ?>';
		});
	});	

</script>