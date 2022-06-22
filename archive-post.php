<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Kaktos
 *  * Template Name: آخرین مطالب
 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 8,
	'paged' => $paged
);
$the_query = new WP_Query($args);
get_header();
?>
<!--Inner Home Banner Start-->
<!-- <div class="wt-haslayout wt-innerbannerholder">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
				<div class="wt-innerbannercontent">
					<div class="wt-title">
						<h2>مقالات جدید</h2>
					</div>
					<ol class="wt-breadcrumb">
						<li><a href="<?php echo home_url() ?>">صفحه اصلی</a></li>
						<li class="wt-active">مقالات</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!--Inner Home End-->
<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
	<!--Two Columns Start-->
	<div class="wt-haslayout wt-main-section">
		<div class="container">
			<div class="row">
				<div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-right">
						<aside id="wt-sidebar" class="wt-sidebar">
							<?php
							get_template_part('template-parts/widget/widget', 'search-form');
							get_template_part('template-parts/widget/widget', 'category');
							?>
						</aside>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-right">
						<div class="wt-classicaricle-holder">
							<div class="wt-classicaricle-header">
								<div class="wt-title">
									<h2> جدیدترین مقالات ما</h2>
								</div>
							</div>
							<div class="wt-article-holder">
								<?php if ($the_query->have_posts()) { ?>
									<?php
									// Start the Loop.
									while ($the_query->have_posts()) :
										$the_query->the_post();
									?>
										<div class="wt-article">
											<figure>
												<img src="<?php the_post_thumbnail_url(); ?>" alt="img description">
											</figure>
											<div class="wt-articlecontent">
												<div class="wt-title">
													<h2> <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
												</div>
												<ul class="wt-postarticlemeta">
													<li>
														<a href="javascript:void(0);">
															<i class="lnr lnr-clock"></i>
															<span><?php echo custom_get_the_date(get_the_ID()); ?> </span>
														</a>
													</li>
													<li>
														<a href="javascript:void(0);">
															<i class="lnr lnr-user"></i>
															<span> <?php  get_the_author_meta('first_name').' '.get_the_author_meta('last_name') ?> </span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									<?php
									// End the loop.
									endwhile;
									?>
							</div>
							<div class="pagination wt-pagination">
								<?php
									echo paginate_links(array(
										'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
										'total'        => $the_query->max_num_pages,
										'current'      => max(1, get_query_var('paged')),
										'format'       => '?paged=%#%',
										'show_all'     => false,
										'type'         => 'plain',
										'end_size'     => 2,
										'mid_size'     => 1,
										'prev_next'    => true,
										'prev_text'    => sprintf('<i></i> %1$s', __('بعدی', 'text-domain')),
										'next_text'    => sprintf('%1$s <i></i>', __('قبلی', 'text-domain')),
										'add_args'     => false,
										'add_fragment' => '',
									));
								?>
							</div>
							<?php wp_reset_query(); ?>
						<?php
								} else {
									get_template_part('template-parts/content/content', 'none');
								}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Two Columns End-->
</main>
<!--Main End-->
<?php
get_footer();