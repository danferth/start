<!-- BEGIN FOOTER -->

<div class="footer">
    
</div>

<!-- END FOOTER -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<?php
if($gsap){
    echo "<!-- GSAP -->";
    echo "<script src='https://cdn.jsdelivr.net/npm/gsap@2.0.2/umd/TweenMax.min.js'></script>";
}
if($sweetalert){
    echo "<!-- SweetAlert2 -->";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js' integrity='sha256-qtyU+b249rw/5PQ1KXGRtxjlgg6hfU2EK50YOlc0n50=' crossorigin='anonymous'></script>";
}?>

<!-- site.js-->
<script type="text/javascript" src="assets/build/js/site.js?ver=<?php echo $v; ?>"></script>

    </body>
</html>