<style>
.odd
{
	background-color :RGBA(230,230,230,0.5);
}

.even
{
	background-color:RGBA(230,230,230,0.5);
}

.highlight
{
	background-color:RGBA(200,200,200,1.0);
}


</style>
<script type='text/javascript'>
	$('document').ready(function(){
		$("#link li:even").addClass("even");
		$("#link li:odd").addClass("odd");
		$("#link li").hover(
			function(){
				$(this).toggleClass('highlight');
			},
			function(){
				$(this).toggleClass('highlight');
			}
		);
	});
</script>
<div id='link'>
</div>