<!DOCTYPE html>
<html lang="fa">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css">
	<?php wp_head(); ?>
</head>

<div id="saatchi">
	<?php
	$header = get_field("header", "option");

	?>
	<header id="header" class="">

		<div class="">
			<div class="top-wrapper">
				<ul class="inner_wrapper maxWidth">
					<?php
					foreach ($header['top-menu'] as $navItem) {
					?>
						<li>
							<a href="<?php echo get_permalink($navItem->ID); ?>"><?php echo $navItem->post_title; ?></a>
						</li>
					<?php
					}
					?>
					<li>
						<a class="col-lg-2" href="<?php echo  $header["link-cal-price"] ?>" target="_blank">
							<i class="fa fa-line-chart text-danger"></i>
							محاسبه قیمت
						</a>
					</li>
					<li>
						<a class="col-lg-2" href="<?php echo  $header["link-buy-price"] ?>" target="_blank">
							<i class="fa fa-bell text-info"></i>
							خرید عمده
						</a>
					</li>
					<li class="contact ml-0">
						<a class="col-lg-2 mr-auto pl-0" href="tel:+<?php echo  $header["support-tel"] ?>">
							<i class="fa fa-phone headphone"></i>
							تماس با پشتیبانی
							<?php echo  $header["support-tel"] ?>
						</a>
					</li>
				</ul>
			</div>

			<div class="bottom_nav pages">
				<div class="bottom_nav-wrapp  clrfx row">
					<div class="inner_wrapper maxWidth pl-0 pl-md-4">
						<a href="/" class="logo-wrapper">
							<img src="<?php echo  $header["logo"] ?>" alt="<?php echo  $header["site-title"] ?>" class="logo">
							<p class="brand-title"><?php echo  $header["site-title"] ?></p>
							<p class="brand-tagline"><?php echo  $header["site-title-desc"] ?></p>
						</a>
						<a href="/" class="responsive-logo">
							<img src="<?php echo  $header["responsive-logo"] ?>" alt="">
							<span class="mobile-title"><?php echo  $header["site-title"] ?></span>
						</a>
						<a href="#" id="menu-icon" class="hamburger hamburger--squeeze">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</a>
						<div class="login-wrapper">
							<ul>
								<li class="shopping_cart home_cart ">

									<a href="javascript:void(0)" title="" class="r-cart">

										<span class="head-shoppings">
											<span class="number d-none"></span>
											<span>سبد خرید</span>
											<i class="fa fa-shopping-basket shopping-basket"></i>
										</span>
									</a>

								</li>
								<li class="login">
									<a href="" class="openLoginModal">
										<span class="title">
											<i class="fa fa-user"></i>
											<span class="display-none">ورود/ ثبت نام</span>
										</span>
									</a>
								</li>
								<li class="likes">
									<a href="" class="likes-title">
										<span class="title">
											<i class="fa fa-heart"></i>
											<span class="display-none">علاقمندی ها</span>
										</span>
									</a>
									<div class="new-favoriteBox">
									</div>
								</li>
								<li class="search">
									<form action="/" class="search-form">
										<input type="text" name="query" value="" placeholder="نام و یا دسته محصول مورد نظر را جستجو کنید ...">
										<button type="submit"><i class="fa fa-search"></i></button>
									</form>
								</li>
							</ul>
							<div class="overLay"></div>
							<div class="shop"></div>
							<div id="favorites">
								<div class="fav-menu">
									<div class="favoriteBox row p-4 pr-5">

										<div class="col-12 h-100 p-0">
											<div class="row pb-4 mb-3 has-border">
												<a href="javascript:void(0)" class="col-1 has-icon close-fav pull-left cursor-pointer"></a>
												<p class="title col-11 ">
													<span class=" has-icon heart3 text">
														مورد علاقه های شما
													</span>
												</p>
											</div>
											<div class="favoriteBox-inner clrfx">

												<div class="row p-0 m-0 w-100">

													<ul class="col-12 productList FFav p-0 ">
													</ul>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bottom_nav-wrapp clrfx menu-wrapper row">
						<div class="bottom-menu w-100">
							<ul class="menu inner_wrapper clrfx row maxWidth">
								<?php
								foreach ($header["menu"] as $menu) {
								?>
									<li>
										<a href="<?php echo  $menu["link"]  ?>"><?php echo $menu["title"] ?></a>
										<div class="row menu-box p-4 clrfx">
											<div class="menubox-inner">
												<div class=" submenu-wrapper">
													<div class="top-submenu">
														<p><?php echo $menu["title"] ?>
															<a class="has-icon arrow-left" href="<?php echo  $menu["link"]  ?>">
																مشاهده همه ی محصولات
															</a>
														</p>
														<ul>
															<li>
																<a href="<?php echo  $menu["link"]  ?>"><?php echo 'انواع' . ' ' . $menu["title"] ?> </a>
																<ul>
																	<?php
																	foreach ($menu['items'] as $item) {
																	?>
																		<li>
																			<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
																		</li>
																	<?php
																	}
																	?>
																</ul>
															</li>
															<li>
																<a href="/womens-pendant-set">رنج قیمت </a>
																<ul>
																	<?php
																	foreach ($menu['items-price'] as $item) {
																	?>
																		<li>
																			<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
																		</li>
																	<?php
																	}
																	?>
																</ul>
															</li>
														</ul>
													</div>
												</div>
												<div class="menuImageContainer">
													<img src="<?php $menu["img1"]['img'] ?>" alt="<?php $menu["img1"]['title'] ?>" data-href="<?php $menu["img1"]['link'] ?>" class="menu-image">

													<div>
														<img src="<?php $menu["img2"]['img'] ?>" alt="<?php $menu["img2"]['title'] ?>" data-href="<?php $menu["img2"]['link'] ?>" class="menu-image">
													</div>
													<div>
													</div>

												</div>
											</div>
										</div>
									</li>
								<?php } ?>

								<?php
								foreach ($header['top-menu'] as $navItem) {
								?>
									<li class="r-show">
										<a href="<?php echo get_permalink($navItem->ID); ?>"><?php echo $navItem->post_title; ?></a>
									</li>
								<?php
								}
								?>
								<li class="r-show">
									<a href="<?php echo  $header["link-cal-price"] ?>" target="_blank">
										<i class="fa fa-line-chart text-danger"></i>
										محاسبه قیمت
									</a>
								</li>
								<li class="r-show">
									<a href="<?php echo  $header["link-buy-price"] ?>" target="_blank">
										<i class="fa fa-bell text-info"></i>
										خرید عمده
									</a>
								</li>
								<li class="r-show">
									<a href="tel:+<?php echo  $header["support-tel"] ?>">
										<i class="fa fa-phone headphone"></i>
										تماس با پشتیبانی
										<?php echo  $header["support-tel"] ?>
									</a>
								</li>
							</ul>

						</div>
					</div>
				</div>
			</div>

			<div class="modal register " id="login-modal">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-close has-icon"></div>
						<div class="modal-body ">
							<div class="row">
								<div class="col-12 col-md-6 p-0">
									<div class="row">
										<div class="col-md-12 content h-100">
											<div class="align-items-start">
												<div class="col-12 title">ورود و عضویت</div>
												<p class="col-12 desc">جهت ورود یا عضویت در فروشگاه
													شماره همراه
													خود را
													وارد نمایید:</p>
												<div class="sent-password-container">
													<p class="col-12 sent-password">رمز عبور به شماره همراه شما
														ارسال شد.</p>
													<p class='phone-no'>شماره همراه وارد شده: <span></span></p>
												</div>

											</div>
											<div class="row align-items-center phone m-0 p-0">
												<div class="inputLabel col-12 bold">
													شماره تلفن همراه
												</div>
												<div class="col-12 p-0">
													<form name="login" class="loginForm" accept-charset="utf-8">
														<input type="hidden" name="_token" value="ZHDrKTJqvIHjF2ZzV5vqORVMH5ss58eqplCerY39">

														<div class="input_row identifier m-0">

															<div class="input-group">
																<img src="<?php echo get_template_directory_uri() ?>/assets/images/cell-phone.png" alt="">
																<input type="tel" name="identifier" class="has-icon cell-phone" id="identifier" value="" placeholder="شماره موبایل (09*********)" autocomplete="off">
															</div>
														</div>

														<div class="input_row password m-0 is-hidden ">

															<div class="input-group">
																<img src="<?php echo get_template_directory_uri() ?>/assets/images/cell-phone.png" alt="">
																<input type="text" name="password" id="password" autocomplete="off">
															</div>
														</div>
														<div class="input_btn">
															<div>
																<button id="step1confirm" type="button" name="button" class="btn  confirm-code btn--success btn--token">
																	ادامه
																	<span class="has-icon arrowDown"></span>
																</button>
																<img class="loader" src="<?php echo get_template_directory_uri() ?>/assets/images/loading.gif" alt="">

															</div>
															<button id="step2confirm" type="button" name="button" class=" links btn--token confirm-code is-hidden">دریافت
																مجدد
																کد
																عبور
															</button>
															<button id="reload" type="button" name="button" class=" links btn--token is-hidden change-phone">تغییر
																تلفن
																همراه
															</button>
														</div>

														<div class="input_btn">
															<p class="password-error is-hidden">رمز وارد شده اشتباه
																است</p>
															<button type="button" class="btn btn--success   loginBtn" disabled>
																ورود
																<span class="has-icon arrowDown"></span>
															</button>
														</div>
													</form>
												</div>
											</div>
											<div class="row modal-footer align-items-end desc-login">
												پس از ثبت شماره همراه، برای شما یک کد تایید به صورت پیامک ارسال
												خواهد شد که در
												مرحله بعد
												می باید این کد را وارد نمایید
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 p-0 d-none d-md-inline-block h-100">
									<img src="<?php echo  $header["login-image"] ?>" class="lazy" alt="<?php echo  $header["site-title"] ?> ">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- /header -->
	<div class="menu-content">
		<ul class="menu clrfx headerPageMenu">
			<?php
			foreach ($header["menu"] as $menu) {
			?>
				<li>
					<a href="<?php echo  $menu["link"]  ?>"><?php echo $menu["title"] ?></a>
					<div class="row menu-box p-4 clrfx">
						<div class="menubox-inner">
							<div class=" submenu-wrapper">
								<div class="top-submenu">
									<p><?php echo $menu["title"] ?>
										<a class="has-icon arrow-left" href="<?php echo  $menu["link"]  ?>">
											مشاهده همه ی محصولات
										</a>
									</p>
									<ul>
										<li>
											<a href="<?php echo  $menu["link"]  ?>"><?php echo 'انواع' . ' ' . $menu["title"] ?> </a>
											<ul>
												<?php
												foreach ($menu['items'] as $item) {
												?>
													<li>
														<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
													</li>
												<?php
												}
												?>
											</ul>
										</li>
										<li>
											<a href="/womens-pendant-set">رنج قیمت </a>
											<ul>
												<?php
												foreach ($menu['items-price'] as $item) {
												?>
													<li>
														<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
													</li>
												<?php
												}
												?>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="menuImageContainer">
								<img src="<?php $menu["img1"]['img'] ?>" alt="<?php $menu["img1"]['title'] ?>" data-href="<?php $menu["img1"]['link'] ?>" class="menu-image">

								<div>
									<img src="<?php $menu["img2"]['img'] ?>" alt="<?php $menu["img2"]['title'] ?>" data-href="<?php $menu["img2"]['link'] ?>" class="menu-image">
								</div>
								<div>
								</div>

							</div>
						</div>
					</div>
				</li>
			<?php } ?>
			<?php
			foreach ($header['top-menu'] as $navItem) {
			?>
				<li class="r-show">
					<a href="<?php echo get_permalink($navItem->ID); ?>"><?php echo $navItem->post_title; ?></a>
				</li>
			<?php
			}
			?>
			<li class="r-show">
				<a href="<?php echo  $header["link-cal-price"] ?>" target="_blank">
					<i class="fa fa-line-chart text-danger"></i>
					محاسبه قیمت
				</a>
			</li>
			<li class="r-show">
				<a href="<?php echo  $header["link-buy-price"] ?>" target="_blank">
					<i class="fa fa-bell text-info"></i>
					خرید عمده
				</a>
			</li>
			<li class="r-show">
				<a href="tel:+<?php echo  $header["support-tel"] ?>">
					<i class="fa fa-phone headphone"></i>
					تماس با پشتیبانی
					<?php echo  $header["support-tel"] ?>
				</a>
			</li>
		</ul>
	</div>