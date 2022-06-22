			<style>
				body h1,
				body h2,
				body h3,
				body h4,
				body h5,
				body h6 {
					color: #060cc1;
					font-weight: bold;
				}
			</style>
			<!--Inner Home Banner Start-->
			<!-- <div class="wt-haslayout wt-innerbannerholder">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
							<div class="wt-innerbannercontent">
								<div class="wt-title">
									<h2><?php echo get_the_title(); ?></h2>
								</div>
								<ol class="wt-breadcrumb">
									<li><a href="<?php echo home_url() ?>">صفحه اصلی</a></li>
									<li><a href="<?php echo home_url('blog') ?>">مقالات</a></li>
									<li class="wt-active">جزئیات مقاله</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!--Inner Home End-->
			<!--Main Start-->
			<div>
				<ol class="wt-breadcrumb">
					<li><a href="<?php echo home_url() ?>">صفحه اصلی</a></li>
					<li><a href="<?php echo home_url('blog') ?>">مقالات</a></li>
					<li class="wt-active">جزئیات مقاله</li>
				</ol>
			</div>
			<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
				<!--Categories Start-->
				<div class="wt-haslayout wt-main-section">
					<div class="container">
						<div class="row justify-content-md-center">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
								<div class="wt-articlesingle-holder wt-bgwhite">
									<div class="wt-articlesingle-content">
										<div class="wt-title">
											<h2> <?php echo get_the_title(); ?></h2>
										</div>
										<figure style="margin-bottom: 8px;" class="wt-singleimg-one">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="img description">
										</figure>
										<ul class="wt-postarticlemeta">
											<li style="float: left;">
												<a href="javascript:void(0);">
													<i class="lnr lnr-calendar-full"></i>
													<span><?php echo custom_get_the_date(get_the_ID()) ?></span>
												</a>
											</li>
											<li style="float: left;">
												<a href="javascript:void(0);">
													<i class="lnr lnr-user"></i>
													<span> <?php get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name') ?></span>
												</a>
											</li>
										</ul>
										<div class="wt-description">
											<?php echo get_the_content(); ?>
										</div>
										<div class="wt-tagsshare">
											<div class="wt-tag wt-widgettag">
												<span>برچسب ها:</span>
												<?php
												$post_tags = get_the_tags();
												if (!empty($post_tags)) {

													foreach ($post_tags as $post_tag) {
														echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
													}
												}
												?>
											</div>
											<ul class="wt-socialiconssimple wt-blogsocialicons">
												<li class="wt-sharejob"><span> این وبلاگ را به اشتراک بگذارید </span></li>
												<li class="wt-facebook"><a class="social-share facebook" href="javascript:void(0);"><i class="fa fa-facebook-f"></i></a></li>
												<li class="wt-twitter"><a class="social-share twitter" href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
												<li class="wt-linkedin"><a class="social-share linkedin" href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
												<li class="wt-google-plus"><a class="social-share instagram" href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
											</ul>
										</div>
										<div style="float: left;
    width: 100%;
    margin-top: 24px;" class="clear" id="comment-list">
											<div class="comments-area" id="comments">
												<div style="padding: 10px;" class="clearfix m-b20">
													<?php
													// If comments are open or we have at least one comment, load up the comment template.
													if (comments_open() || get_comments_number()) {
														comments_template();
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

				<!--Limitless Experience End-->
			</main>
			<!--Main End-->