<div id='box'>
	<div class='title'>
		<?php 
			echo $header;
			
			if ($uitverkocht == "true"){
				echo "<img class= 'img1' src='".BASE_URL."public/img/uitverkocht.jpg'>";
			}
			else{
				echo "<button type='button' class='button'> bestel kaarten </button>";
			}
			echo $datum;
		?>
		<div class='kaarten_beschikbaar'>
			<?php echo "<h2>Nog ".$kaarten_beschikbaar." kaarten beschikbaar</h2>"; ?>
		</div>
	</div>
	<div class='picture'>
		<?php echo $foto ?> 
	</div>
	<div class='omschrijving'></div>
	<?php
		
		echo $omschrijving;
		
		echo "<br><br> Artiesten: ".$artiest."<br>";
		if( isset ($video) ) {
			echo $video;
		}
		echo "<br>";
		if( isset ($sound) ) {
			echo $sound;
		}
	 ?>
</div>

<script type="text/javascript">

	$('document').ready(function(){
		$('.button').click(function(){
			location.href = '<?php echo $link; ?>';
		});
	});	

</script>