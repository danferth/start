<!-- BEGIN FOOTER -->

<div class="footer">
		
</div>

<!-- END FOOTER -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<?php
	if($GLOBALS['gsap']){
		echo "<!-- GSAP -->";
		echo "<script src='https://cdn.jsdelivr.net/npm/gsap@2.0.2/umd/TweenMax.min.js'></script>";
	}
	if($GLOBALS['sweetalert']){
		echo "<!-- SweetAlert2 -->";
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js' integrity='sha256-qtyU+b249rw/5PQ1KXGRtxjlgg6hfU2EK50YOlc0n50=' crossorigin='anonymous'></script>";
	}
	if($GLOBALS['hammer']){
		echo "<!-- Hammer -->";
		echo "<script src='https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js' integrity='sha256-eVNjHw5UeU0jUqPPpZHAkU1z4U+QFBBY488WvueTm88=' crossorigin='anonymous'></script>";
	}
	if($GLOBALS['moment']){
		echo "<!-- moment -->";
		echo '<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>';
	}
	if($GLOBALS['localforage']){
		echo "<!-- localforage -->";
		echo '<script src="https://cdn.jsdelivr.net/npm/localforage@1.7.2/dist/localforage.min.js" integrity="sha256-vxBB/kklMCqUCIdrghNX+n8Y5rQtVIWSqaiVBSUBI64=" crossorigin="anonymous"></script>';
	}
?>





<!-- site.js-->
<script type="text/javascript" src="assets/build/js/site.js?ver=<?php echo $GLOBALS['v']; ?>"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $GLOBALS['googleAnalytics']; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $GLOBALS["googleAnalytics"]; ?>');
</script>


	</body>
</html>