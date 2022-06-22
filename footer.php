	<!--Footer Start-->
	<footer id="wt-footer" class="wt-footer wt-haslayout">
		<div class="wt-footerholder wt-haslayout">
			<div class="container">
				<div class="row">
					<?php
					$data = get_field("footer-col-1", 'option');
					?>
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<div class="wt-footerlogohold">
							<strong class="wt-logo"><a href="index-2.html"><img src="<?php echo $data["icon"]; ?>" alt="company logo here"></a></strong>
							<div class="wt-description">
								<p><?php echo $data["text"]; ?></p>
							</div>
							<ul class="wt-socialiconssimple wt-socialiconfooter">
								<?php
								if (isset($data["sosial"]) && is_array($data["sosial"])) {
									foreach ($data["sosial"] as $item) {
								?>
										<li class="wt-facebook"><a title="<?php echo $item["text"]; ?>" href="<?php echo $item["link"]; ?>"><i class="fa fa-<?php echo $item["icon"]; ?>"></i></a></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
					</div>
					<?php
					$data = get_field("footer-col-2", 'option');
					?>
					<div class="col-12 col-sm-6 col-md-3 col-lg-3">
						<div class="wt-footercol wt-widgetcompany">
							<div class="wt-fwidgettitle">
								<h3><?php echo $data["title"]; ?></h3>
							</div>
							<ul class="wt-fwidgetcontent">
								<?php
								if (isset($data["links"]) && is_array($data["links"])) {
									foreach ($data["links"] as $item) {
								?>
										<li><a title="<?php echo $item["link"]["text"]; ?>" href="<?php if (isset($item["link"]["link"]->ID))  echo  get_permalink($item["link"]["link"]->ID);  ?>"><?php echo $item["link"]["text"]; ?></a></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
					</div>
					<?php
					$data = get_field("footer-col-3", 'option');
					?>
					<div class="col-12 col-sm-6 col-md-3 col-lg-3">
						<div class="wt-footercol wt-widgetexplore">
							<div class="wt-fwidgettitle">
								<h3><?php echo $data["title"]; ?></h3>
							</div>
							<ul class="wt-fwidgetcontent">
								<?php
								if (isset($data["links"]) && is_array($data["links"])) {
									foreach ($data["links"] as $item) {
								?>
										<li><a title="<?php echo $item["link"]["text"]; ?>" href="<?php if (isset($item["link"]["link"]->ID))  echo  get_permalink($item["link"]["link"]->ID);  ?>"><?php echo $item["link"]["text"]; ?></a></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wt-haslayout wt-joininfo">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 push-lg-1">
						<div class="wt-companyinfo">
							<span><?php echo get_field("footer-reg", 'option') ?></span>
						</div>
						<div class="wt-fbtnarea">
							<a href="<?php echo home_url('register') ?>" class="wt-btn">اکنون بپیوندید</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wt-haslayout wt-footerbottom">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p class="wt-copyrights"><span></span> کلیه حقوق محفوظ است.</p>
						<nav class="wt-addnav">
							<?php
							$data = get_field("footer-col-4", 'option');
							?>
							<ul>
								<?php
								if (isset($data["links"]) && is_array($data["links"])) {
									foreach ($data["links"] as $item) {
								?>
										<li><a title="<?php echo $item["link"]["text"]; ?>" href="<?php if (isset($item["link"]["link"]->ID))  echo  get_permalink($item["link"]["link"]->ID);  ?>"><?php echo $item["link"]["text"]; ?></a></li>
								<?php
									}
								}
								?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--Footer End-->
	</div>
	<!--Content Wrapper End-->
	</div>
	<!--Wrapper End-->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-3.3.1.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-library.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/scrollbar.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tilt.jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/prettyPhoto.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-ui.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/readmore.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/countTo.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/appear.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tipso.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jRate.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/share.js"></script>
	<?php  
  get_template_part('template-parts/custom-js/custom-js', 'create-job');
?>
	</body>

	</html>