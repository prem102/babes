
</body>

<?php 
if(!empty($js))
{
	foreach($js as $jval){
	echo "<script type='text/javascript' src='".base_url()."assets/front/js/$jval.js'></script>";
	
		}
}
?>			

</html> 
