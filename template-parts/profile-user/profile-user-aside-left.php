<?php
$user_info = get_query_var('user_info');
$user_meta = get_query_var('user_meta');
$page_action = get_query_var('page_action');
?>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
	<div class="wt-haslayout wt-dbsectionspace wt-codescansidebar">
		<div class="tg-authorcodescan wt-codescanholder">
			<div class="wt-codescanicons">
				<span> پروفایل خود را به اشتراک بگذارید</span>
				<ul class="wt-socialiconssimple">
					<li class="wt-facebook"><a class="social-share facebook" href="javascript:void(0);"><i class="fa fa-facebook-f"></i></a></li>
					<li class="wt-twitter"><a  class="social-share twitter"  href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
					<li class="wt-linkedin"><a  class="social-share linkedin"  href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
					<li class="wt-google-plus"><a  class="social-share instagram"  href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="wt-companyad">
			<figure class="wt-companyadimg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/add-img.jpg" alt="img description"></figure>
			<span>تبلیغات 255px X 255px</span>
		</div>
	</div>
</div>