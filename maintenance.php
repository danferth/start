<?php
require('config.php');

//site root
if($https){
    $protocol = 'https://';
}else{
    $protocol = 'http://';
}

$siteRoot = $protocol . $_SERVER['HTTP_HOST'] . '/';
if($maintenance['status'] === false){
  header('Location: ' . $siteRoot);
  exit(); 
}

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
<meta charset="utf-8">
<title>..:|o|:..</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:900|Mukta+Vaani:200" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<style type="text/css">
h1{
	text-align:center;
	margin-top:10%;
}
h2{
	text-shadow:0 4px 0 #dfdfe1;
	text-align:center;
	font-size:4rem;
	text-transform:uppercase;
	font-family: 'Montserrat', sans-serif;
}
p{
	color:#53535a;
	text-align:center;
	margin:0;
	font-family: 'Mukta Vaani', sans-serif;
}
@media (max-width:550px){
		h2{
			font-size:3rem;
		}
	}
@media (max-width:395px){
		h2{
			font-size:2rem;
		}
	}
</style>
</head>

<body>
	
<div class="row">
	<div class="small-12 column">
		<div class="row">
			<div class="small-12 column">
				<h1 class="animated fadeIn">
					<i class="fa fa-cog fa-5x fa-spin" aria-hidden="true"></i>
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="small-12 medium-11 large-9 medium-centered large-centered column">
				<h2 class="animated zoomInDown">Site Maintenance</h2>
			</div>
			<div class="small-12 medium-8 medium-centered large-6 large-centered column">
				<p class="animated zoomInLeft">Sorry, for the inconvenience we are conducting site maintenance now but will be back up and running better than ever shortly.</p>
				<p class="animated zoomInRight"><b>Check back soon to see our updated and improved website!</b></p>
			</div>
		</div>
	</div>
</div>
	
	
	
	
	
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
	
});
</script>

</body>
</html>