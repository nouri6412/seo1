<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Seo1
 * @since 1.0.0
 * Template Name: صفحه ثبت نام 
 */



get_header();
$step_class_1 = "";
$step_class_2 = "";
$step_st_1 = "";
$step_st_2 = "";

if (isset($_GET["action"]) && $_GET["action"] == "verify") {
	$step_class_2 = "wt-active";
	$step_st_1 = 'style="display: none;"';

	$user_id = get_current_user_id();
	$message  = 'با تشکر از ثبت نام شما' . '<br>';
	$message .= 'کد تایید ' . '<br>';
	$message .= get_the_author_meta('user_email_code', $user_id);

	wp_mail(
		get_the_author_meta('user_email', $user_id),
		wp_specialchars_decode(sprintf('تایید ایمیل سایت' . ' ' . get_bloginfo('name'))),
		$message,
		array('Content-Type: text/html; charset=UTF-8')
	);
} else {
	$step_class_1 = "wt-active";
	$step_st_2 = 'style="display: none;"';
}

?>
<!--Inner Home Banner Start-->
<div class="wt-haslayout wt-innerbannerholder">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
				<div class="wt-innerbannercontent">
					<div class="wt-title">
						<h2> اکنون به صورت رایگان بپیوندید </h2>
					</div>
					<ol class="wt-breadcrumb">
						<li><a href="<?php echo home_url() ?>">صفحه اصلی</a></li>
						<li class="wt-active">اکنون بپیوندید</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Inner Home End-->
<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
	<!--Register Form Start-->
	<div class="wt-haslayout wt-main-section">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-xs-12 col-sm-12 col-md-10 push-md-1 col-lg-8 push-lg-2">
					<div class="wt-registerformhold">
						<div class="wt-registerformmain">
							<div class="wt-registerhead">
								<div class="wt-title">
									<h3> <?php echo get_field('title') ?></h3>
								</div>
								<div class="wt-description">
									<p><?php echo get_field('desc') ?></p>
								</div>
							</div>
							<div class="wt-joinforms">
								<ul class="wt-joinsteps">

									<li id="step-1" class="<?php echo $step_class_1;  ?>"><a href="javascrip:void(0);">1</a></li>
									<li id="step-2" class="<?php echo $step_class_2;  ?>"><a href="javascrip:void(0);">2</a></li>
									<li id="step-3"><a href="javascrip:void(0);">3</a></li>
								</ul>
								<div class="wt-formtheme wt-formregister">
									<fieldset class="wt-registerformgroup">
										<div <?php echo $step_st_1 ?> id="page-step-1">
											<div class="form-group wt-form-group-dropdown form-group-half">
												<span class="wt-select">
													<select id="user_sex" name="user_sex">
														<option value="male">مرد</option>
														<option value="female">زن</option>
													</select>
												</span>
												<input type="text" id="user_f_name" name="user_f_name" class="form-control" placeholder=" نام ">
											</div>
											<div class="form-group form-group-half">
												<input type="text" id="user_l_name" name="user_l_name" class="form-control" placeholder=" نام خانوادگی ">
											</div>
											<div class="form-group">
												<input type="text" id="user_email" name="user_email" class="form-control" placeholder="ایمیل">
											</div>
											<div class="form-group">
												<input type="password" id="user_pass_2" name="user_pass_2" class="form-control" placeholder="رمز عبور">
											</div>
											<div class="form-group">
												<input type="password" id="user_re_pass" name="user_re_pass" class="form-control" placeholder="تکرار رمز عبور">
											</div>
											<div class="form-group">
												<span class="wt-checkbox">
													<input id="user_termsconditions" type="checkbox" name="user_termsconditions" value="termsconditions">
													<label for="user_termsconditions"><span><?php echo get_field('conditions') ?><a href="<?php echo site_url('conditions') ?>"> شرایط و ضوابط</a></span></label>
												</span>
											</div>
											<div class="form-group">
												<button onclick="ajax_submit_mbm_register(
										$('#user_f_name').val()
										,$('#user_l_name').val()
										,$('#user_email').val()
										,$('#user_pass_2').val()
										,$('#user_re_pass').val()
										,$('#user_sex').val()
										,$('#user_termsconditions')
										,$('#dzFormMsg-error-2')
                                        ,$('#dzFormMsg-doned-2'))
										" name="wp-submit" id="wp-submit" class="wt-btn">ایجاد حساب</button>
											</div>
										</div>
										<div <?php echo $step_st_2 ?> id="page-step-2">
											<div class="form-group">
												<label>ما کد تأیید را به ایمیل شما ارسال کرده ایم صندوق و اسپم را بررسی نمائید.</label>
												<input type="text" id="user_confirm" name="user_confirm" class="form-control" placeholder="کد تایید را وارد کنید">
											</div>
											<div class="form-group">
												<button onclick="ajax_submit_mbm_register_confirm(
										$('#user_confirm').val()
										,$('#dzFormMsg-error-2')
                                        ,$('#dzFormMsg-doned-2'))
										" name="wp-submit" id="wp-submit" class="wt-btn">تایید ایمیل</button>
											</div>
										</div>
										<div style="display: none;" id="page-step-3">
											<div class="form-group">
												<h3 style="color: green;">تبریک می گوییم !</h3>
												<p>ثبت نام شما با موفقیت انجام شد</p>
											</div>
											<div class="form-group">
												<a href="<?php echo site_url('profile') ?>" class="wt-btn">رفتن به داشبورد</a>
											</div>
										</div>

										<div class="form-group">
											<div class="box-loading">
												<div class="loading-ajax"></div>
											</div>
											<div id="dzFormMsg-error-2" class="dzFormMsg error"></div>
											<div id="dzFormMsg-doned-2" class="dzFormMsg doned"></div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="wt-registerformfooter">
							<span> از قبل حساب کاربری دارید؟ <a href="<?php echo home_url() . '?login=user' ?>"> اکنون وارد شوید </a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Register Form End-->
</main>
<!--Main End-->
<?php
get_footer();
