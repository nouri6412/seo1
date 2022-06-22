<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since 1.0.0
 * Template Name: صفحه اصلی
 */

get_header();

?>
<!--Home Banner Start-->
<div class="wt-haslayout wt-bannerholder">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-5">
				<div class="wt-bannerimages">
					<figure class="wt-bannermanimg" data-tilt>
						<?php $data = get_field('slider') ?>
						<img src="<?php echo $data["imgs"]["img1"]; ?>" alt="img description">
						<img src="<?php echo $data["imgs"]["img2"]; ?>" class="wt-bannermanimgone" alt="img description">
						<img src="<?php echo $data["imgs"]["img3"]; ?>" class="wt-bannermanimgtwo" alt="img description">
					</figure>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
				<div class="wt-bannercontent">
					<div class="wt-bannerhead">
						<div class="wt-title">
							<h1><?php echo $data["title"]; ?> </h1>
						</div>
						<div class="wt-description">
							<p><?php echo $data["desc"]; ?></p>
						</div>
					</div>
					<form class="wt-formtheme wt-formbanner" action="<?php echo home_url('search-job'); ?>" method="get">
						<fieldset>
							<div class="form-group">
								<input type="text" id="search_word" name="search_word" class="form-control" placeholder="من دنبال ... می گردم.">
								<div class="wt-formoptions">
									<button type="submit" class="wt-searchbtn"><i class="lnr lnr-magnifier"></i></button>
								</div>
							</div>
						</fieldset>
					</form>
					<div class="wt-videoholder">
						<div class="wt-videoshow">
							<a data-rel="prettyPhoto[video]" href="<?php echo $data["film"]; ?>"><i class="fa fa-play"></i></a>
						</div>
						<div class="wt-videocontent">
							<span> <?php echo $data["film_desc"]; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Home Banner End-->
<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout">
	<!--Categories Start-->
	<section class="wt-haslayout wt-main-section">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
					<div class="wt-sectionhead wt-textcenter">
						<div class="wt-sectiontitle">
							<h2> کاوش در دسته بندی ها </h2>
							<span>حرفه ای بر اساس دسته بندی</span>
						</div>
					</div>
				</div>
				<div class="wt-categoryexpl">
					<?php
					$data = get_field("cats");
					if (is_array($data)) {
						foreach ($data as $item) {

							$id = (isset($item["cat_id"]->ID)) ?  $item["cat_id"]->ID : 0;
					?>
							<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 float-right">
								<div class="wt-categorycontent">
									<figure><img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="javascrip:void(0);"><?php echo get_the_title($id); ?> </a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p><?php echo get_the_excerpt($id); ?></p>
										<a href="<?php echo home_url('search-job?cat_id=' . $id)   ?>">جست و جو <i class="fa fa-arrow-left"></i></a>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 float-right">
						<div class="wt-btnarea">
							<a href="<?php echo home_url('search-job') ?>" class="wt-btn">مشاهده همه </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Categories End-->
	<!--Join Company Info Start-->
	<section class="wt-haslayout wt-main-section wt-paddingnull wt-companyinfohold">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<div class="wt-companydetails">
						<div class="wt-companycontent">
							<div class="wt-companyinfotitle">
								<h2>شروع به عنوان شرکت </h2>
							</div>
							<div class="wt-description">
								<p><?php echo get_field("reg1") ?></p>
							</div>
							<div class="wt-btnarea">
								<a href="<?php echo home_url('register') ?>" class="wt-btn"> اکنون بپیوندید</a>
							</div>
						</div>
						<div class="wt-companycontent">
							<div class="wt-companyinfotitle">
								<h2>شروع به عنوان فریلنسر </h2>
							</div>
							<div class="wt-description">
								<p><?php echo get_field("reg2") ?></p>
							</div>
							<div class="wt-btnarea">
								<a href="<?php echo home_url('register') ?>" class="wt-btn"> اکنون بپیوندید</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Join Company Info End-->
	<!--Limitless Experience Start-->
	<section class="wt-haslayout wt-main-section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
					<?php $data = get_field('sec1') ?>
					<figure class="wt-mobileimg">
						<img src="<?php echo $data['image']; ?>" alt="img description">
					</figure>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
					<div class="wt-experienceholder">
						<div class="wt-sectionhead">
							<div class="wt-sectiontitle">
								<h2><?php echo $data['title']; ?> </h2>
								<span><?php echo $data['desc_short']; ?></span>
							</div>
							<div class="wt-description">
								<p><?php echo $data['desc']; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Limitless Experience End-->
	<!--Skills Start-->
	<section style="display: none;" class="wt-haslayaout wt-main-section wt-footeraboutus">
		<div class="container">
			<div class="row">

				<div class="col-12 col-sm-6 col-md-3 col-lg-3">
					<div class="wt-widgetskills">
						<?php
						$data = get_field("sec2")['col-1'];
						?>
						<div class="wt-fwidgettitle">
							<h3><?php echo $data['title']; ?> </h3>
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
				<div class="col-12 col-sm-6 col-md-3 col-lg-3">
					<div class="wt-widgetskill">
						<?php
						$data = get_field("sec2")['col-2'];
						?>
						<div class="wt-fwidgettitle">
							<h3><?php echo $data['title']; ?> </h3>
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
				<div class="col-12 col-sm-6 col-md-3 col-lg-3">
					<div class="wt-footercol wt-widgetcategories">
						<?php
						$data = get_field("sec2")['col-3'];
						?>
						<div class="wt-fwidgettitle">
							<h3><?php echo $data['title']; ?> </h3>
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
				<div class="col-12 col-sm-6 col-md-3 col-lg-3">
					<div class="wt-widgetbylocation">
						<?php
						$data = get_field("sec2")['col-4'];
						?>
						<div class="wt-fwidgettitle">
							<h3><?php echo $data['title']; ?> </h3>
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
	</section>
	<!--Skills Start End-->
</main>
<!--Main End-->
<?php

get_footer();
