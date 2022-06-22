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
					<span>انواع برند های طلا</span>
				</div>
				<div class="widget-content">
					<div class="slider-wrapper">
						<div class="slider homeSlider cat_slide new col-12 owl-carousel owl-theme">
							<div class="item p-4">
								<a href="https://saatchico.com/brand/vancleef" title="">
									<img src="https://saatchico.com/uploads/brands/18/300x-067d018c6bd1045ac75515bd9aeccba4b440e14a.png" alt="ونکلیف - Van Cleef &amp; Arpels">
									<h3 class="cat-title">ونکلیف</h3>
									<p class="cat-quantity is-ellipsis newPrice">120
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/cartier" title="">
									<img src="https://saatchico.com/uploads/brands/19/300x-03fe3683275750180508b540f95193c5e44b1fde.jpg" alt="کارتیر - Cartier">
									<h3 class="cat-title">کارتیر</h3>
									<p class="cat-quantity is-ellipsis newPrice">67
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/fred" title="">
									<img src="https://saatchico.com/uploads/brands/20/300x-28813a16d50b1e6f67993a95de9a98510a323bfb.jpg" alt="فرد - Fred">
									<h3 class="cat-title">فرد</h3>
									<p class="cat-quantity is-ellipsis newPrice">56
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/david-yurman" title="">
									<img src="https://saatchico.com/uploads/brands/21/300x-2d5803bb19faabf1af327bfdd527770086b2f03c.jpg" alt="دیوید یورمن - David Yurman">
									<h3 class="cat-title">دیوید یورمن</h3>
									<p class="cat-quantity is-ellipsis newPrice">42
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/tiffani" title="">
									<img src="https://saatchico.com/uploads/brands/22/300x-803c5bf7c25369343424b7d303fe13a25b8439f4.jpg" alt="تیفانی - Tiffany &amp; Co">
									<h3 class="cat-title">تیفانی</h3>
									<p class="cat-quantity is-ellipsis newPrice">39
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/louis-vuitton" title="">
									<img src="https://saatchico.com/uploads/brands/23/300x-e8c939321cf63cabc8c27ad9490cfaa3b5eeb35e.jpg" alt="لویی ویتون - Louis Vuitton">
									<h3 class="cat-title">لویی ویتون</h3>
									<p class="cat-quantity is-ellipsis newPrice">37
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/chobard" title="">
									<img src="https://saatchico.com/uploads/brands/28/300x-11d8e27a5ec81618c7327fa2404bad64dd644125.jpg" alt="شوپارد - Chopard">
									<h3 class="cat-title">شوپارد</h3>
									<p class="cat-quantity is-ellipsis newPrice">21
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/hermes" title="">
									<img src="https://saatchico.com/uploads/brands/24/300x-531c3348aba5b85eada1047218a8fc97d73ada41.jpg" alt="هرمس - Hermes">
									<h3 class="cat-title">هرمس</h3>
									<p class="cat-quantity is-ellipsis newPrice">17
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/nimany" title="">
									<img src="https://saatchico.com/uploads/brands/25/300x-c2c1e2ae175cedf5d8023af2a419f06b3e0103d0.jpg" alt="نیمانی - Nimany">
									<h3 class="cat-title">نیمانی</h3>
									<p class="cat-quantity is-ellipsis newPrice">12
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/chaumet" title="">
									<img src="https://saatchico.com/uploads/brands/29/300x-9ac6c0448783291336bf81daf71701cad71cee6f.jpg" alt="شومه - Chaumet">
									<h3 class="cat-title">شومه</h3>
									<p class="cat-quantity is-ellipsis newPrice">8
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/omega" title="">
									<img src="https://saatchico.com/uploads/brands/26/300x-b54fd140259e66040f6bcbe187f92694f5bfef10.jpg" alt="امگا - Omega">
									<h3 class="cat-title">امگا</h3>
									<p class="cat-quantity is-ellipsis newPrice">7
										مدل</p>
								</a>
							</div>
							<div class="item p-4">
								<a href="https://saatchico.com/brand/marla-aaron" title="">
									<img src="https://saatchico.com/uploads/brands/27/300x-c6e54563ad2ad2d75ddf479be06465c8f44c759a.jpg" alt="مارلا آرون - Marla Aaron">
									<h3 class="cat-title">مارلا آرون</h3>
									<p class="cat-quantity is-ellipsis newPrice">5
										مدل</p>
								</a>
							</div>
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
							پرفروش های ساعتچی
						</span>

					</div>
					<div class="widget-content">
						<div class="slider-wrapper">
							<div class="slider homeSlider new col-12 owl-carousel owl-theme">
								<div class="item">
									<a href="https://saatchico.com/bracelet/LB122" title="دستبند طلا طرح پر کد LB122">
										<img width="300" src="https://saatchico.com/uploads/products/4138/300x51b0672f1abd1da5db1cabd9e2d265e6004882bb.jpg" alt="دستبند طلا طرح پر کد LB122">
										<h3 class="is-ellipsis">دستبند طلا طرح پر کد LB122</h3>
										<p class="price">2,554,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/necklace/CN480" title="گردنبند طلا طرح LOVE کارتیه دوقلو کد CN480">
										<img width="300" src="https://saatchico.com/uploads/products/4116/300x4e348cb68f43260a27a794cb9f81fce14ade1ab2.jpg" alt="گردنبند طلا طرح LOVE کارتیه دوقلو کد CN480">
										<h3 class="is-ellipsis">گردنبند طلا طرح LOVE کارتیه دوقلو کد CN480</h3>
										<p class="price">5,112,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/non-jeweled-ring/CR515" title="انگشتر طلا طرح LOVE کارتیر کد CR515">
										<img width="300" src="https://saatchico.com/uploads/products/3778/300x42b3011354e5849be33c19e3d320ed5df825016e.jpg" alt="انگشتر طلا طرح LOVE کارتیر کد CR515">
										<h3 class="is-ellipsis">انگشتر طلا طرح LOVE کارتیر کد CR515</h3>
										<p class="price">3,539,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/bangle-bracelet/CB453" title="دستبند النگویی طلا طرح LOVE کارتیر کد CB453">
										<img width="300" src="https://saatchico.com/uploads/products/3759/300x73b75a4cf3e31b270cbd89be5ce7c5ad9b815a9f.jpg" alt="دستبند النگویی طلا طرح LOVE کارتیر کد CB453">
										<h3 class="is-ellipsis">دستبند النگویی طلا طرح LOVE کارتیر کد CB453</h3>
										<p class="price">20,130,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/womens-pendant-set/LS617" title="نیم ست طلا طرح برگ کد LS617">
										<img width="300" src="https://saatchico.com/uploads/products/3704/300xec3548f6dc50c4425dc0bddb85cf8dec3da28fcb.jpg" alt="نیم ست طلا طرح برگ کد LS617">
										<h3 class="is-ellipsis">نیم ست طلا طرح برگ کد LS617</h3>
										<p class="price">4,794,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/pendant/CP342" title="آویز طلا طرح قاب عکس کد CP342">
										<img width="300" src="https://saatchico.com/uploads/products/3392/300x80e1ca065116720b18bdc3d2ed2ddb6d722ccc88.jpg" alt="آویز طلا طرح قاب عکس کد CP342">
										<h3 class="is-ellipsis">آویز طلا طرح قاب عکس کد CP342</h3>
										<p class="price">9,026,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/leather-bracelet/XB813" title="دستبند چرم زنانه با پلاک طلا طرح امگا کد XB813">
										<img width="300" src="https://saatchico.com/uploads/products/3136/300xd5d967199ce1702cf359b8dad6004470d6858cba.jpg" alt="دستبند چرم زنانه با پلاک طلا طرح امگا کد XB813">
										<h3 class="is-ellipsis">دستبند چرم زنانه با پلاک طلا طرح امگا کد XB813
										</h3>
										<p class="price">4,277,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/childrens-necklace/KN734" title="گردنبند طلا کودک طرح قلب کد KN734">
										<img width="300" src="https://saatchico.com/uploads/products/2983/300x5693b674782d31475f6b89544ee5082baec2e232.jpg" alt="گردنبند طلا کودک طرح قلب کد KN734">
										<h3 class="is-ellipsis">گردنبند طلا کودک طرح قلب کد KN734</h3>
										<p class="price">3,239,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/bracelet/CB424" title="دستبند طلا طرح فرد با زنجیر کارتیر کد CB424">
										<img width="300" src="https://saatchico.com/uploads/products/2964/300x02d0d61c9474e660ac9ffed6eee72174335931f7.jpg" alt="دستبند طلا طرح فرد با زنجیر کارتیر کد CB424">
										<h3 class="is-ellipsis">دستبند طلا طرح فرد با زنجیر کارتیر کد CB424</h3>
										<p class="price">19,699,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/hanging-earrings/XE267" title="گوشواره حلقه ای طلا با آویز مروارید کد XE267">
										<img width="300" src="https://saatchico.com/uploads/products/2940/300xa85675ba3a6c1c82e2545e7bb6321d5e22ef1187.jpg" alt="گوشواره حلقه ای طلا با آویز مروارید کد XE267">
										<h3 class="is-ellipsis">گوشواره حلقه ای طلا با آویز مروارید کد XE267
										</h3>
										<p class="price">1,720,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/non-jeweled-ring/CR473" title="انگشتر طلا زنانه کد CR473">
										<img width="300" src="https://saatchico.com/uploads/products/2873/300x93ff9c2ba948548b26130c253a6df3ffe63a00c0.jpg" alt="انگشتر طلا زنانه کد CR473">
										<h3 class="is-ellipsis">انگشتر طلا زنانه کد CR473</h3>
										<p class="price">610,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/men-leather-bracelet/MB130" title="دستبند چرم مردانه با پلاک طلا طرح زنجیر کارتیه کد MB130">
										<img width="300" src="https://saatchico.com/uploads/products/2547/300xbd360334bcbec9543dc077e7acfc966fdaaff13c.jpg" alt="دستبند چرم مردانه با پلاک طلا طرح زنجیر کارتیه کد MB130">
										<h3 class="is-ellipsis">دستبند چرم مردانه با پلاک طلا طرح زنجیر کارتیه
											کد MB130</h3>
										<p class="price">5,406,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/childrens-bracelet/KB360" title="دستبند طلای کودک طرح دختر کد KB360">
										<img width="300" src="https://saatchico.com/uploads/products/2303/300x821e6763b55deed3ec6a0b8ac89bfb31dc91425e.jpg" alt="دستبند طلای کودک طرح دختر کد KB360">
										<h3 class="is-ellipsis">دستبند طلای کودک طرح دختر کد KB360</h3>
										<p class="price">2,378,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/bracelet/CB368" title="دستبند طلا زنانه طرح کارتیه با گل ونکلیف کد CB368">
										<img width="300" src="https://saatchico.com/uploads/products/2062/300xccb8659da2bd3a6c719988eb5111e8e5a7178fc7.jpg" alt="دستبند طلا زنانه طرح کارتیه با گل ونکلیف کد CB368">
										<h3 class="is-ellipsis">دستبند طلا زنانه طرح کارتیه با گل ونکلیف کد
											CB368</h3>
										<p class="price">7,458,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/leather-bracelet/XB988" title="دستبند چرم زنانه با پلاک طلا طرح فرد کد XB988">
										<img width="300" src="https://saatchico.com/uploads/products/2036/300xca024f034b0088f5ed2915c354c05827490f0839.jpg" alt="دستبند چرم زنانه با پلاک طلا طرح فرد کد XB988">
										<h3 class="is-ellipsis">دستبند چرم زنانه با پلاک طلا طرح فرد کد XB988
										</h3>
										<p class="price">13,259,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/childrens-necklace/KP612" title="آویز طلا کودک طرح یونیکورن کد KP612">
										<img width="300" src="https://saatchico.com/uploads/products/1932/300x22d8f64dadca7840ad7c1e4ec88d1eb9f1549e9c.jpg" alt="آویز طلا کودک طرح یونیکورن کد KP612">
										<h3 class="is-ellipsis">آویز طلا کودک طرح یونیکورن کد KP612</h3>
										<p class="price">1,760,000 تومان</p>
									</a>
								</div>
								<div class="item">
									<a href="https://saatchico.com/necklace/LN821" title="گردنبند طلا زنانه طرح شعر کد LN821">
										<img width="300" src="https://saatchico.com/uploads/products/1916/300xa5d3aa4eb86660cb65b842aba7a3f14b91e363d2.jpg" alt="گردنبند طلا زنانه طرح شعر کد LN821">
										<h3 class="is-ellipsis">گردنبند طلا زنانه طرح شعر کد LN821</h3>
										<p class="price">5,711,000 تومان</p>
									</a>
								</div>
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
									<div class="show-video-loop" data-src="https://saatchico.com/uploads/yalda.mp4"></div>
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
					<div class="widget-content">
						<a href="https://saatchico.com/Womens-Gold?v&tag[]=79">
							<img class="d-block my-4 my-md-0" src="https://saatchico.com/uploads/widgets/banners/8/anbx9Q3x/l.jpg" />
						</a>

					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 pl-md-0 pr-md-75 order-0 order-md-1 ">
				<div class="widget-container ">
					<div class="widget-content">
						<div class="row">
							<div class="col-12 mb-4 p-0 pr-md-4 pl-md-4">
								<a href="https://saatchico.com/Womens-Gold?v&tag[]=84">
									<img class="d-block" src="https://saatchico.com/uploads/widgets/banners/40/YIv5IyYX/l.jpg" />
								</a>
							</div>
							<div class="col-12 p-0 pr-md-4 pl-md-4 mb-4 mb-md-0">
								<a href="https://saatchico.com/Womens-Gold?v&tag[]=88">
									<img class="d-block" src="https://saatchico.com/uploads/widgets/banners/40/GhpEbPG0/l.jpg" />
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
							<span class="title has-icon social-rss3">مجله تخصصی ساعتچی </span>
							<span class="d-none d-md-inline sub-title ml-auto">بدانید، هوشمند و درست طلا و
								زیورآلات خرید کنید</span>
							<a class="link" href="/mag">ورود به مجله</a>
						</div>
					</div>

				</div>
			</div>
			<div class="row m-0">
				<div class="col-12 col-md-6">
					<div class="row m-0">
						<div class="widget-container mag-banner col-5 pr-0">
							<div class="widget-content">
								<a href="https://saatchico.com/mag" title="مجله طلا ساعتچی">
									<img src="https://static.saatchico.com/uploads/images/mag-banner.jpg" alt="مجله طلا ساعتچی">
								</a>

							</div>
						</div>
						<div class="widget-container content col-7 pr-0">
							<div class="widget-head">
								<span>
									انواع مطالب خرید طلا و زیورآلات
								</span>

							</div>
							<div class="widget-content">
								<div class="row p-0 m-0">

									<div class="col-12">
										<div class="row mb-4">
											<div class="col-3 img-wrapper">
												<img src="https://saatchico.com/dest/images/idea.png" alt="انتخاب مناسب">
											</div>
											<div class="col-9 text-right">
												<p class="title-header p-0 m-0 no-border">انتخاب مناسب</p>
												<p class="d-none d-md-inline-block desc">
													همیشه برای خرید محصولات ساعتچی انتخابای فراوانی هست ، ما به
													شما کمک میکنیم بهترین ها رو انتخاب کنید
												</p>
												<a class="links d-none d-md-inline-block" href="https://www.saatchico.com/mag/category/choise/">مشاهده
													ی مطالب</a>
											</div>
										</div>
										<div class="row  mb-4">
											<div class="col-3 img-wrapper">
												<img src="https://saatchico.com/dest/images/favorites.png" alt="دنیای مد">
											</div>
											<div class="col-9 text-right">
												<p class="title-header p-0 m-0 no-border">دنیای مد</p>
												<p class="d-none d-md-inline-block desc">
													آخرین عکس ها و مقالات مربوط به طلا در دنیای مد و طراحی . در
													این بخش شما رو با معروف ترین ها آشنا میکنیم
												</p>
												<a class="links d-none d-md-inline-block" href="https://www.saatchico.com/mag/category/star/">مشاهده ی
													مطالب</a>
											</div>
										</div>
										<div class="row  mb-4">
											<div class="col-3 img-wrapper">
												<img src="https://saatchico.com/dest/images/sketch.png" alt="چی بندازم">
											</div>
											<div class="col-9 text-right">
												<p class="title-header p-0 m-0 no-border">چی بندازم</p>
												<p class="d-none d-md-inline-block desc">
													اینکه بدونید در چه مراسمی بهتره از چه جواهراتی استفاده کنید
													خیلی مهمه ، متخصصین ساعتچی شما رو تو این موضوع کمک خواهند
													کرد .
												</p>
												<a class="links d-none d-md-inline-block" href="https://www.saatchico.com/mag/category/choise/what/">مشاهده
													ی مطالب</a>
											</div>
										</div>
										<div class="row ">
											<div class="col-3 img-wrapper">
												<img src="https://saatchico.com/dest/images/selective.png" alt="چی کادو بدم">
											</div>
											<div class="col-9 text-right">
												<p class="title-header p-0 m-0 no-border">چی کادو بدم</p>
												<p class="d-none d-md-inline-block desc">
													روز مادر ، روز دختر ، ولنتاین ، روز تولد و... برای هرکدام از
													این مناسبت ها به شما پیشنهادات شگفت انگیزی خواهیم داد .
												</p>
												<a class="links d-none d-md-inline-block " href="https://www.saatchico.com/mag/category/choise/gift/">مشاهده
													ی مطالب</a>
											</div>
										</div>
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
								انواع مطالب خرید طلا و زیورآلات
							</span>

						</div>
						<div class="widget-content">
							<div class="row row p-0 m-0">

								<div class="col-6 help">
									<a href="https://saatchico.com/mag/%d8%aa%d9%81%d8%a7%d9%88%d8%aa-%da%af%d8%b1%d8%af%d9%86%d8%a8%d9%86%d8%af-%d8%b7%d9%84%d8%a7-%d9%88-%d8%a2%d9%88%db%8c%d8%b2-%d8%b7%d9%84%d8%a7/">
										<img src="https://saatchico.com/images/default300.png" data-src="https://saatchico.com/mag/wp-content/uploads/2022/01/fa04847fc8030bb434269aedc7c488d553b34048.jpg" alt="تفاوت گردنبند طلا و آویز طلا" class="blogItem-img lazy" />
										<div class="overlay"></div>
									</a>
									<div class="info">
										<p>تفاوت گردنبند طلا و آویز طلا</p>
										<a href="https://saatchico.com/mag/category/choise/">انتخاب مناسب</a>
										<span>05 بهمن 1400</span>



									</div>
								</div>


								<div class="col-6 help">
									<a href="https://saatchico.com/mag/%d9%85%d8%b9%d8%b1%d9%81%db%8c-16-%d8%b2%d9%86%d8%ac%db%8c%d8%b1-%d8%b7%d9%84%d8%a7-%da%a9%d9%84%d8%a7%d8%b3%db%8c%da%a9-%d9%88-%d9%85%d8%af%d8%b1%d9%86/">
										<img src="https://saatchico.com/images/default300.png" data-src="https://saatchico.com/mag/wp-content/uploads/2019/06/b47555d2b2af79c0da5be16ed392be3c6cf8fc31-1.jpg" alt="معرفی ۱۶ زنجیر طلا کلاسیک و مدرن" class="blogItem-img lazy" />
										<div class="overlay"></div>
									</a>
									<div class="info">
										<p>معرفی ۱۶ زنجیر طلا کلاسیک و مدرن</p>
										<a href="https://saatchico.com/mag/category/choise/">انتخاب مناسب</a>
										<span>27 تیر 1400</span>



									</div>
								</div>


								<div class="col-6 help">
									<a href="https://saatchico.com/mag/%d9%86%da%a9%d8%a7%d8%aa%db%8c-%d8%af%d8%b1-%d9%85%d9%88%d8%b1%d8%af-%d8%a7%d9%86%d8%aa%d8%ae%d8%a7%d8%a8-%d9%88-%d8%ae%d8%b1%db%8c%d8%af-%da%af%d9%88%d8%b4%d9%88%d8%a7%d8%b1%d9%87-%d8%b7%d9%84%d8%a7/">
										<img src="https://saatchico.com/images/default300.png" data-src="https://saatchico.com/mag/wp-content/uploads/2020/08/6334a999a0047586a01d971e41a247cc0c39c706.jpg" alt="نکاتی در مورد انتخاب و خرید گوشواره طلا" class="blogItem-img lazy" />
										<div class="overlay"></div>
									</a>
									<div class="info">
										<p>نکاتی در مورد انتخاب و خرید گوشواره طلا</p>
										<a href="https://saatchico.com/mag/category/choise/what/">چی بندازم</a>
										<span>31 مرداد 1399</span>



									</div>
								</div>


								<div class="col-6 help">
									<a href="https://saatchico.com/mag/%d9%87%d8%b1-%d8%a2%d9%86%da%86%d9%87-%da%a9%d9%87-%d8%a8%d8%a7%db%8c%d8%af-%d9%be%db%8c%d8%b4-%d8%a7%d8%b2-%d8%ae%d8%b1%db%8c%d8%af-%d8%af%d8%b3%d8%aa%d8%a8%d9%86%d8%af-%d8%b7%d9%84%d8%a7-%d8%a8/">
										<img src="https://saatchico.com/images/default300.png" data-src="https://saatchico.com/mag/wp-content/uploads/2020/08/1.jpg" alt="هر آنچه که باید پیش از خرید دستبند طلا بدانید" class="blogItem-img lazy" />
										<div class="overlay"></div>
									</a>
									<div class="info">
										<p>هر آنچه که باید پیش از خرید دستبند طلا بدانید</p>
										<a href="https://saatchico.com/mag/category/choise/">انتخاب مناسب</a>
										<span>26 مرداد 1399</span>



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
								<img src="https://saatchico.com/uploads/widgets/banners/43/PMKtH4Ae/l.jpg" alt="آواسنتر">
								<img src="https://saatchico.com/uploads/widgets/banners/43/6t2Oj0Yn/l.jpg" alt="بازار">
								<img src="https://saatchico.com/uploads/widgets/banners/43/1NjeQWXN/l.jpg" alt="ساعتچی">
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
											<li class="branch row mb-2 pt-3 pt-3" data-id="0">
												<div class="col-xs-12 col-sm-9 p-0">
													<span class="num">.</span>
													<p class="branch-name">
														<span class="d-inline-block w-100 title">دفتر مرکزی
															فروش</span>
														<span class="d-inline-block w-100">خیابان 15 خرداد،
															خیابان پامنار</span>
													</p>

												</div>
												<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
													<p class="branch-phone">
														<span style="direction: ltr;display: inline-block;">021-36349092</span>
													</p>
												</div>
											</li>
											<li class="branch row mb-2 pt-3 pt-3" data-id="0">
												<div class="col-xs-12 col-sm-9 p-0">
													<span class="num">1</span>
													<p class="branch-name">
														<span class="d-inline-block w-100 title">پشتیبانی فروش
															آنلاین</span>
														<span class="d-inline-block w-100">پاسخگویی از 8:30 تا
															18:00</span>
													</p>

												</div>
												<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
													<p class="branch-phone">
														<span style="direction: ltr;display: inline-block;">09120202239</span>
													</p>
												</div>
											</li>
											<li class="branch row mb-2 pt-3 pt-3" data-id="2">
												<div class="col-xs-12 col-sm-9 p-0">
													<span class="num">2</span>
													<p class="branch-name">
														<span class="d-inline-block w-100 title">شعبه سام
															سنتر</span>
														<span class="d-inline-block w-100">فرشته - مجتمع تجاری
															سام سنتر - طبقه همکف</span>
													</p>
												</div>
												<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
													<p class="branch-phone">
														<span style="direction: ltr;display: inline-block;">021-22653852</span>
													</p>
												</div>
											</li>
											<li class="branch row mb-2 pt-3 pt-3" data-id="4">
												<div class="col-xs-12 col-sm-9 p-0">
													<span class="num">3</span>
													<p class="branch-name">
														<span class="d-inline-block w-100 title">شعبه
															آواسنتر</span>
														<span class="d-inline-block w-100">شعبه اقدسیه: تهران،
															اقدسیه، خیابان موحد دانش، نبش خیابان فیروزبخش ، مرکز
															تجاری آوا سنتر، طبقه ( 1-)، روبروی پله برقی</span>
													</p>
												</div>
												<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
													<p class="branch-phone">
														<span style="direction: ltr;display: inline-block;">021-26470223</span>
													</p>
												</div>
											</li>
											<li class="branch  active row mb-2 pt-3 pb-3" data-id="1">
												<div class="col-xs-12 col-sm-9 p-0">
													<span class="num">4</span>
													<p class="branch-name">
														<span class="d-inline-block w-100 title">شعبه بازار بزرگ
															تهران (فقط عمده فروشی)</span>
														<span class="d-inline-block w-100">بازار بزرگ - جلوخان
															غربی مسجد امام - پلاک 46</span>
													</p>
												</div>
												<div class="col-xs-12 col-sm-3 p-sm-0 p-xs-2">
													<p class="branch-phone"></p>
												</div>
											</li>

										</ul>
									</div>
									<div class="d-none d-md-inline-block col-5 map-images">
										<a data-id="1" class="map" href="https://www.google.com/maps/place/%D8%B3%D8%A7%D8%B9%D8%AA%DA%86%D9%8A-+%D8%B4%D8%B9%D8%A8%D9%87+%D8%A8%D8%A7%D8%B2%D8%A7%D8%B1%E2%80%AD/@35.6767176,51.4210005,19z/data=!3m1!4b1!4m5!3m4!1s0x3f8e01f1c6c5ddcf:0xa32ed83c5570232d!8m2!3d35.6767176!4d51.4215477">
											<img src="https://saatchico.com/dest/images/map1.jpg" alt="map">
										</a>
										<a data-id="2" class="map" href="https://goo.gl/maps/ekJSVKhu3EkrCVNv6" style="display:none">
											<img src="https://saatchico.com/dest/images/map2.jpg" alt="map">
										</a>
										<a data-id="4" class="map" href="https://goo.gl/maps/47PzSi7GxFxEDbDTA" style="display:none">
											<img src="https://saatchico.com/dest/images/map4.jpg" alt="map">
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
