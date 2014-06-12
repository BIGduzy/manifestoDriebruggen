<div id='box'>
	<div class='title'>
		<?php 
			echo $header;
			echo "<button type='button' class='button'> bestel kaarten </button>";
			echo $datum;
		?>
	</div>
	<div class='picture'>
		<?php echo $foto ?> 
	</div>
	<div class='omschrijving'></div>
	<?php
		
		echo $omschrijving;
		
		/*echo "artiest: ".$artiest."<br>";
		echo "zaal: ".$zaal."<br>";
		echo "uitverkocht: ".$uitverkocht."<br>";
		echo "kaarten_beschikbaar: ".$kaarten_beschikbaar."<br>";
		echo "afgelast: ".$afgelast."<br>";
		echo "datum_uitverkocht: ".$datum_uitverkocht."<br>";*/
		
	 ?>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		$('.button').click(function(){
			location.href = '<?php echo $link; ?>';
		});
	});	

</script>