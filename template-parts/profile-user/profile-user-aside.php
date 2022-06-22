<?php
$user_info = get_query_var('user_info');
$user_meta = get_query_var('user_meta');
$page_action = get_query_var('page_action');
?>
<div id="" class="wt-sidebarwrapper">
	<!-- <div id="wt-btnmenutoggle" class="wt-btnmenutoggle">
		<span class="menu-icon">
			<em></em>
			<em></em>
			<em></em>
		</span>
	</div> -->
	<div id="wt-verticalscrollbar" class="wt-verticalscrollbar">
		<div class="wt-companysdetails wt-usersidebar">
			<figure class="wt-companysimg">
				<?php
				$avatar = get_template_directory_uri() . "/assets/images/sidebar/img-01.jpg";
				if (isset($user_meta['avatar_bg'])) {
					$avatar = $user_meta['avatar_bg'][0];
				}
				?>
				<img src="<?php echo $avatar; ?>">
			</figure>
			<div class="wt-companysinfo">
				<figure>
					<?php
					$avatar = get_template_directory_uri() . "/assets/img/male.jpg";
					if (isset($user_meta['user_sex']) && $user_meta['user_sex'][0] == "female") {
						$avatar = get_template_directory_uri() . "/assets/img/female.jpg";
					}
					if (isset($user_meta['avatar'])) {
						$avatar = $user_meta['avatar'][0];
					}
					?>
					<img src="<?php echo $avatar; ?>">
				</figure>
				<div class="wt-title">
					<h2><a href="javascript:void(0);"><?php isset($user_meta['user_name']) ? $user_meta['user_name'][0] : '' ?></a></h2>
					<span><?php isset($user_meta['user_name']) ? $user_meta['user_name'][0] : '' ?></span>
				</div>
				<!-- <div class="wt-btnarea"><a href="dashboard-postjob.html" class="wt-btn">ارسال کار </a></div> -->
			</div>
		</div>
		<nav id="wt-navdashboard" class="wt-navdashboard">
			<ul>
				<?php
				get_template_part('template-parts/menu/menu', 'top');
				?>
			</ul>
		</nav>
		<div class="wt-navdashboard-footer">
			<span>ورکترن. © 1398کلیه حقوق محفوظ است.</span>
		</div>
	</div>
</div>