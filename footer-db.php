</div>
<!--Content Wrapper End-->
</div>
<!--Wrapper End-->

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-library.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.sortable.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tilt.jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/scrollbar.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/prettyPhoto.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/readmore.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/countTo.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/appear.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tipso.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/gmap3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jRate.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/share.js"></script>
<script>
	const menu_icon = document.querySelector('.menu-icon');

	function addClassFunThree() {
		this.classList.toggle("click-menu-icon");
	}
	menu_icon.addEventListener('click', addClassFunThree);
</script>
<?php  
  get_template_part('template-parts/custom-js/custom-js', 'create-job');
?>
</body>

</html>