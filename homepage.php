<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Seo1
 * @since 1.0.0
 * Template Name: صفحه اصلی
 */

get_header();

?>
<div class="main_box pages">

	<div class="inner_wrapper  home p-0 pt-md-4">
		<div class="menu-overlay"></div>
		<div class="row top-row mb-0 hide-overflow ">
			<div class="right-wrapper order-0 order-md-1 hide-overflow ">
				<div class="widget-container test desktop-home-slider">
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="catSlider main-home-carousel owl-carousel owl-theme">
								<?php
								$slider = get_field("slider");
								foreach ($slider as $item) {

								?>
									<div class="item">
										<a href="<?php echo $item["link"] ?>">
											<img src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-container resp-home-slider">
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="catSlider main-home-carousel owl-carousel owl-theme">
								<?php
								$slider = get_field("slider");
								foreach ($slider as $item) {

								?>
									<div class="item">
										<a href="<?php echo $item["link"] ?>">
											<img src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-container why-saatchi">
					<div class="widget-content">
						<div class="col-12 p-0 mt-0 mt-md-4 mb-4">
							<div class="col-12 right-wrapper-inner  ">
								<div class="order-0 order-md-1 d-none d-md-none col-12 mobileCats">
									<a href="" class="seeCats has-icon diamond3">مشاهده دسته بندی کالاها </a>
								</div>
								<ul class="home-res-menu">
									<?php
									$slider = get_field("slider-tags");
									foreach ($slider as $item) {

									?>
										<li><a href="<?php echo $item["link"] ?>"><?php echo $item["title"] ?> </a></li>
									<?php } ?>
								</ul>
								<div class="row delivery payment order-1 order-md-0 whiteBox">
									<div class="d-none d-lg-inline-block col-4">
										<p class="Bold"><?php get_field("why-store") ?></p>
										<p class="sub-title"><?php get_field("why-store-desc") ?></p>
									</div>
									<div class="col-6 col-md-3 col-lg-2 p-0">
										<span class="has-icon gdelivery">ارسال رایگان به تمام کشور</span>
									</div>
									<div class="col-6 col-md-3 col-lg-2 p-0">
										<span class="has-icon gchange">ضمانت بازگشت و تعویض </span>
									</div>
									<div class="col-6 col-md-3 col-lg-2 p-0">
										<span class="has-icon ghoures">پشتیبانی 24 ساعته</span>
									</div>
									<div class="col-6 col-md-3 col-lg-2 p-0">
										<span class="has-icon gverified">ضمانت اصالت محصول</span>
									</div>
								</div>
							</div>

						</div>


					</div>
				</div>
			</div>
			<div class="left-wrapper  order-1 order-md-0">
				<div class="widget-container specialOffer">
					<div class="widget-content">
						<?php $banner = get_field('slider-banner') ?>
						<a class=" col-12 p-0 order-1 order-md-0 specialOffer" href="<?php echo $banner["link"] ?>">
							<img src="<?php echo $banner["img"] ?>" alt="<?php echo $banner["title"] ?>">
						</a>

					</div>
				</div>
				<div class="widget-container offerSlider-wrapper">
					<div class="widget-head">
						<span>
							<?php $refer = get_field('refer') ?>
							<?php echo $refer["title"] ?>
						</span>

					</div>
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="slider offerSlider col-12 single-dynamic-carousel owl-carousel owl-theme">


								<?php
								foreach ($refer["items"] as $item) {
									$product = wc_get_product($item->ID);
								?>

									<div class="item">
										<a href="<?php echo get_permalink($item->ID); ?>" title="<?php echo $item->post_title ?>">
											<img width="300" src="<?php the_post_thumbnail_url($item->ID); ?>" alt="<?php echo $item->post_title ?>">
											<h3 class="pb-2"><?php echo $item->post_title ?></h3>
											<p class="clrfx delivery">
												<span class="d-inline-block d-lg-inline weight">
													<i class="fa fa-weight"></i>
													<?php //echo $item["weight"] 
													?>
												</span>
												<span class="deliver d-inline-block d-lg-inline has-icon red-fast"><?php //echo $item["desc"] 
																													?></span>
											</p>
											<p class="price"><?php echo $product->get_price() ?></p>
										</a>
									</div>
								<?php
								}
								?>

							</div>
						</div>
					</div>
				</div>
				<div class="widget-container specialOffer-mobile">
					<div class="widget-content">
						<a class=" col-12 p-0 order-1 order-md-0 specialOffer" href="<?php echo $banner["link"] ?>">
							<img src="<?php echo $banner["img"] ?>" alt="<?php echo $banner["title"] ?>">
						</a>

					</div>
				</div>
			</div>

		</div>
		<div class="row mb-4 p-0 mt-0 newest-products">
			<?php $new = get_field('new') ?>
			<div class="widget-container ">
				<div class="widget-content">
					<a class=" col-12 p-0 order-1 order-md-0 specialOffer" href="<?php echo $new["banner"]["link"] ?>">
						<img src="<?php echo $new["banner"]["img"] ?>" alt="<?php echo $new["banner"]["title"] ?>">
					</a>

				</div>
			</div>
			<div class="widget-container mb-0 new-products whiteBox  p-4">
				<div class="widget-head">
					<span>
						<?php echo $new["title"] ?>
					</span>
					<a class="link" href="<?php echo $new["link"] ?>">بیشتر</a>

				</div>
				<div class="widget-content">
					<div class="slider-wrapper">
						<div class="slider homeSlider new col-12 owl-carousel owl-theme">
							<?php
							foreach ($new["items"] as $item) {
								$product = wc_get_product($item->ID);
							?>
								<div class="item">

									<a href="<?php echo get_permalink($item->ID); ?>" title="<?php echo $item->post_title ?>">
										<img width="300" src="<?php the_post_thumbnail_url($item->ID); ?>" alt="<?php echo $item->post_title ?>">
										<h3 class="is-ellipsis"><?php echo $item->post_title ?></h3>
										<p class="price"><?php echo $product->get_price() ?></p>
									</a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4 p-0 mt-0">
			<div class="widget-container mb-2 new-products whiteBox  p-4">
				<div class="widget-head">
					<?php
					$brand = get_field('brand');

					?>
					<span><?php echo $brand["title"] ?></span>
				</div>
				<div class="widget-content">
					<div class="slider-wrapper">
						<div class="slider homeSlider cat_slide new col-12 owl-carousel owl-theme">
							<?php
							foreach ($brand["items"] as $brand) {
							?>
								<div class="item p-4">
									<a href="<?php echo $item["link"] ?>" title="">
										<img src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
										<h3 class="cat-title"><?php echo $item["title"] ?></h3>
										<p class="cat-quantity is-ellipsis newPrice"><?php echo $item["desc"] ?>
										</p>
									</a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4 collections-video">
			<div class="whiteBox col-12 order-0 col-md-8  p-4 mb-4 mb-md-0 collections">
				<div class="widget-container collection">
					<div class="widget-head">
						<span>
							<?php $best = get_field("best");
							?>
							<?php echo $best["title"] ?>
						</span>

					</div>
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="slider homeSlider new col-12 owl-carousel owl-theme">
								<?php
								foreach ($best["items"] as $item) {
									$product = wc_get_product($item->ID);
								?>
									<div class="item">

										<a href="<?php echo get_permalink($item->ID); ?>" title="<?php echo $item->post_title ?>">
											<img width="300" src="<?php the_post_thumbnail_url($item->ID); ?>" alt="<?php echo $item->post_title ?>">
											<h3 class="is-ellipsis"><?php echo $item->post_title ?></h3>
											<p class="price"><?php echo $product->get_price() ?></p>
										</a>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class=" col-12 col-md-4 pl-0 pr-0 pr-md-4 order-1 topProducts">
				<div class="widget-container ">
					<div class="widget-content">
						<div class="">
							<div class="row m-0 p-0">
								<div class="col-12 p-0">
									<div class="show-video-loop" data-src="<?php echo get_field("film") ?>"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-12 col-md-6 pr-md-0 pl-md-75 order-1 order-md-0">
				<div class="widget-container ">
					<?php
					$banner = get_field("banner-mid-1");
					?>
					<div class="widget-content">
						<a href="<?php echo $banner["link"]; ?>">
							<img class="d-block my-4 my-md-0" src="<?php echo $banner["img"]; ?>" />
						</a>

					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 pl-md-0 pr-md-75 order-0 order-md-1 ">
				<div class="widget-container ">
					<div class="widget-content">
						<div class="row">
							<?php
							$banner = get_field("banner-mid-2");
							?>
							<div class="col-12 mb-4 p-0 pr-md-4 pl-md-4">
								<a href="<?php echo $banner["link"]; ?>">
									<img class="d-block" src="<?php echo $banner["img"]; ?>" />
								</a>
							</div>
							<div class="col-12 p-0 pr-md-4 pl-md-4 mb-4 mb-md-0">
								<?php
								$banner = get_field("banner-mid-2");
								?>
								<a href="<?php echo $banner["link"]; ?>">
									<img class="d-block" src="<?php echo $banner["img"]; ?>" />
								</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="inner_wrapper magBox home p-0 pt-md-4 new-width1">
		<div class="row mag-wrapper mb-4 mb-md-0">
			<div class="col-12 mx-auto text-center p-4 mb-4">
				<div class="widget-container row mag-bar">
					<div class="widget-content">
						<div class="col-12 col-lg-7 mx-auto slider-header">
							<?php $art = get_field("art"); ?>
							<span class="title has-icon social-rss3"><?php echo $atr["title"] ?> </span>
							<span class="d-none d-md-inline sub-title ml-auto"><?php echo $atr["desc"] ?></span>
							<a class="link" href="<?php echo $atr["link"] ?>">ورود به مجله</a>
						</div>
					</div>

				</div>
			</div>
			<div class="row m-0">
				<div class="col-12 col-md-6">
					<div class="row m-0">
						<div class="widget-container mag-banner col-5 pr-0">
							<div class="widget-content">
								<a href="<?php echo $atr["link"] ?>" title="<?php echo $atr["title"] ?>">
									<img src="<?php echo $atr["img"] ?>" alt="مجله طلا ساعتچی">
								</a>

							</div>
						</div>
						<div class="widget-container content col-7 pr-0">
							<div class="widget-head">
								<span>
									<?php echo $atr["title-sub"] ?>
								</span>

							</div>
							<div class="widget-content">
								<div class="row p-0 m-0">

									<div class="col-12">
										<?php
										foreach ($art["icon-items"] as $item) {
										?>
											<div class="row mb-4">
												<div class="col-3 img-wrapper">
													<img src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
												</div>
												<div class="col-9 text-right">
													<p class="title-header p-0 m-0 no-border"><?php echo $item["title"] ?></p>
													<p class="d-none d-md-inline-block desc">
														<?php echo $item["desc"] ?>
													</p>
													<a class="links d-none d-md-inline-block" href="<?php echo $item["link"] ?>">مشاهده
														ی مطالب</a>
												</div>
											</div>
										<?php
										}
										?>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="d-none d-md-inline-block col-md-6 pl-0">
					<div class="widget-container content mag-img">
						<div class="widget-head">
							<span>
								<?php echo $atr["title-sub-1"] ?>
							</span>

						</div>
						<div class="widget-content">
							<div class="row row p-0 m-0">
								<?php
								foreach ($art["icon-items"] as $item) {
								?>
									<div class="col-6 help">
										<a href="<?php echo get_permalink($item->ID); ?>">
											<img src="<?php echo $item["img"] ?>" alt="<?php echo $item->post_title ?>" class="blogItem-img lazy" />
											<div class="overlay"></div>
										</a>
										<div class="info">
											<p><?php echo $item->post_title ?></p>
											<span><?php echo get_the_date($item->ID); ?></span>

										</div>
									</div>
								<?php
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
<div class="inner_wrapper home p-0 pt-md-4">
	<div class="inner_wrapper">
		<div class=" row whiteBox widget-wrapper mb-4">
		</div>
		<div class="row mb-4  branches-wrapper row mb-4 pr-4 pl-0 ">
			<div class="slider-gallery col-12 col-lg-3 p-0 pr-0 pr-lg-2  mt-4 m-lg-0  ">
				<div class="widget-container ">
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="catSlider main-home-carousel owl-carousel owl-theme">
								<?php
								$contact = get_field("contact");
								foreach ($contact["slider"] as $item) {
								?>
									<img src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">

								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="map-container col-12 col-lg-9 p-0 pl-sm-2 pl-xs-0 m-0">
				<div class="widget-container branches">
					<div class="widget-content">
						<div class="row whiteBox m-0 ml-0 p-5">
							<div class="col-12 slider-header">
								<span class="title">ارتباط با ما</span>
							</div>
							<div class="col-12">
								<div class="row">
									<div class="col-12 col-md-7">
										<ul>
											<?php
											$index = 0;
											foreach ($contact["tels"] as $item) {
												$index++;
											?>
												<li class="branch row mb-2 pt-3 pt-3" data-id="0">
													<div class="col-xs-12 col-sm-9 p-0">
														<span class="num">1</span>
														<p class="branch-name">
															<span class="d-inline-block w-100 title"><?php echo $item["title"] ?></span>
															<span class="d-inline-block w-100"><?php echo $item["desc"] ?></span>
														</p>

													</div>
													<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
														<p class="branch-phone">
															<span style="direction: ltr;display: inline-block;"><?php echo $item["tel"] ?></span>
														</p>
													</div>
												</li>
											<?php
											}
											?>

										</ul>
									</div>
									<div class="d-none d-md-inline-block col-5 map-images">
										<a data-id="1" class="map" href="<?php echo $contact["map"]["link"] ?>">
											<img src="<?php echo $contact["map"]["img"] ?>" alt="map">
										</a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="push"></div>
<?php

get_footer();
