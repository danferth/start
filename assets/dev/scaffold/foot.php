<!-- closing container for page -->
</div>

<!-- BEGIN FOOTER -->

<div class="container footer mt-5 py-3 border-top border-primary">
	<div class="row justify-content-center">
		<div class="col text-center">
			<small class='d-block mb-md-1 text-muted'><i class="fa fa-copyright"></i> <?php echo date('Y'); ?> START | danferth.com</small>
		</div>
	</div>
</div>

<!-- END FOOTER -->

</div> <!-- END site-container-->


<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<?php
$activePage = $_SERVER['PHP_SELF'];
echo "<script type='text/javascript'>";
echo "var activePage ='" . $activePage . "';";

if($hasForm){
  echo "document.body.className += ' '+'hasForm'; ";
}
echo "</script>";


	if($useVuejs){
		if($production){
			echo "<script src='https://cdn.jsdelivr.net/npm/vue'></script>";
		}else{
			echo "<script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>";
		}
	}
	if($gsap){
		echo "<!-- GSAP -->";
		echo "<script src='https://cdn.jsdelivr.net/npm/gsap@2.0.2/umd/TweenMax.min.js'></script>";
	}
	if($sweetalert){
		echo "<!-- SweetAlert2 -->";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@8.14.0/dist/sweetalert2.min.js' integrity='sha256-KV2uV5Pn+Hwf/HUf1rwNmrLyCGuPjZwXYkE/QQj9/9o=' crossorigin='anonymous'></script>";
	}
	if($hammer){
		echo "<!-- Hammer -->";
		echo "<script src='https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js' integrity='sha256-eVNjHw5UeU0jUqPPpZHAkU1z4U+QFBBY488WvueTm88=' crossorigin='anonymous'></script>";
	}
	if($moment){
		echo "<!-- moment -->";
		echo '<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>';
	}
	if($localforage){
		echo "<!-- localforage -->";
		echo '<script src="https://cdn.jsdelivr.net/npm/localforage@1.7.2/dist/localforage.min.js" integrity="sha256-vxBB/kklMCqUCIdrghNX+n8Y5rQtVIWSqaiVBSUBI64=" crossorigin="anonymous"></script>';
	}

?>


<!-- intro.js -->
<script src="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/intro.min.js"></script>

<!-- site.js-->
<script type="text/javascript" src="assets/build/js/site.js?ver=<?php echo $GLOBALS['v']; ?>"></script>

<!-- errors & messages -->
<?php
  //error & message callouts
  if(isset($_SESSION['m'])){
    echo '<script type="text/javascript">';
    echo 'Swal.fire({';
    echo "title: 'FYI',";
    echo "text: '".$siteMessage."',";
    echo "type: 'info',";
    echo "confirmButtonText: 'OK',";
    echo "onClose: closeMessage,";
    echo '});';
    echo '</script>';
  }
  if(isset($_SESSION['e'])){
    echo '<script type="text/javascript">';
    echo 'Swal.fire({';
    echo "title: 'Whoops!',";
    echo "text: '".$siteError."',";
    echo "type: 'error',";
    echo "confirmButtonText: 'OK',";
    echo "onClose: closeError,";
    echo '});';
    echo '</script>';
  }
 ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<?php
if($googleAnalytics != ""){
	echo "<script async src='https://www.googletagmanager.com/gtag/js?id=" . $googleAnalytics . "'></script>";
	echo "<script>";
	echo "  window.dataLayer = window.dataLayer || [];\n";
	echo "  function gtag(){dataLayer.push(arguments);}\n";
	echo "  gtag('js', new Date());\n";

	echo "  gtag('config', '" . $googleAnalytics . "');\n";
	echo "</script>";
}else{
	echo "<!-- no Google Analytics set up -->";
}
 ?>


	</body>
</html>
