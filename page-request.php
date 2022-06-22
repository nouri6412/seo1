<?php

/**
 * The template for displaying job single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since Kaktos 1.0
 *  *  * Template Name: پیشنهاد 
 */

get_header();
$user_id = get_current_user_id();
$job_id = 0;
if (isset($_GET["id"])) {
    $job_id = $_GET["id"];
}

if ($job_id == 0) {
    get_footer();
    return;
}
?>
<!-- Content -->
<div class="page-content bg-white">
    <!--Inner Home Banner Start-->
    <!-- <div class="wt-haslayout wt-innerbannerholder">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2> پیشنهاد کار </h2>
                        </div>
                        <ol class="wt-breadcrumb">
                            <li><a href="<?php echo home_url() ?>"> صفحه اصلی </a></li>
                            <li><a href="<?php echo home_url('search-job') ?>"> پروژه ها </a></li>
                            <li><a href="<?php echo get_the_permalink($job_id); ?>">جزئیات شغل </a></li>
                            <li class="wt-active"> پیشنهاد کار </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--Inner Home End-->
    <!--Main Start-->
    <main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
        <div class="wt-haslayout wt-main-section">
            <!-- User Listing Start-->
            <div class="container">
                <div id="form-request" class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                        <div class="wt-jobalertsholder">
                            <ul class="wt-jobalerts">
                                <?php if (isset($_GET["created"])) { ?>
                                    <li class="alert alert-success alert-dismissible fade show">
                                        <span>پیشنهاد شما با موفقیت ارسال گردید </span>
                                        <a href="<?php echo home_url('requests?id='.$job_id); ?>" class="wt-alertbtn primary">مشاهده</a>
                                        <a href="javascript:void(0)" class="for-close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </li>
                                <?php } ?>
                                <!-- <li class="alert alert-warning alert-dismissible fade show">
											<span><em> هشدار: </em>  شما تمام امتیازات خود را برای اعمال شغل جدید مصرف کرده اید.</span>
											<a href="javascript:void(0)" class="wt-alertbtn warning"> اکنون بخرید</a>
											<a href="javascript:void(0)" class="for-close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
										</li> -->
                                <!-- <li class="alert alert-primary alert-dismissible fade show">
											<span><em> اطلاعات: </em> شما مهارت "PHP" را ندارید اما می توانید برای این کار درخواست دهید. </span>
											<a href="javascript:void(0)" class="wt-alertbtn primary">مشاهده</a>
											<a href="javascript:void(0)" class="for-close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
										</li> -->
                                <!-- <li class="alert alert-danger alert-dismissible fade show">
											<span><em> دیر رسیدی:</em> متأسفیم ، اما شغلی که می خواهید درخواست کنید دیگر در دسترس نیست دیر رسیدی: دیگر برای عموم/فریلنسرها.</span>
											<a href="javascript:void(0)" class="wt-alertbtn danger">متوجه شدم</a>
											<a href="javascript:void(0)" class="for-close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
										</li> -->
                            </ul>
                        </div>
                        <div class="wt-proposalholder">
                            <span class="wt-featuredtag"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
                            <div class="wt-proposalhead">
                                <h2> <?php echo get_the_title($job_id) ?> </h2>
                                <ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
                                    <li><span><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i> <?php echo ' ' . get_post_meta($job_id, 'min_price', true) . ' - ' . get_post_meta($job_id, 'max_price', true); ?></span></li>
                                    <li><span> <?php echo get_the_author_meta('user_country', $job_id); ?> </span></li>
                                    <li><span><i class="far fa-folder"></i> <?php $cat = get_post(get_post_meta($job_id, 'cat_id', true));
                                                                            echo $cat->post_title; ?>
                                        </span></li>
                                    <li><span><i class="far fa-clock"></i> <?php echo 'زمان' . ' : ' . get_post_meta($job_id, 'time', true) . ' ' . 'روز'; ?> </span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wt-proposalamount-holder">
                            <div class="wt-proposalamount accordion">
                                <div class="form-group">
                                    <label> مقدار پیشنهادی ( دلار )</label>
                                    <input data-id="price" type="number" name="amount" class="form-control input-profile" placeholder="مقدار پیشنهاد خود را وارد کنید">
                                </div>

                            </div>
                            <div class="wt-proposalamount accordion">
                                <div class="form-group">
                                    <label> زمان پیشنهادی ( روز )</label>
                                    <input data-id="time" type="number" name="amount" class="form-control input-profile" placeholder=" زمان پیشنهادی خود را وارد کنید">
                                </div>

                            </div>
                            <div class="wt-formtheme wt-formproposal">
                                <fieldset>
                                    <div class="form-group">
                                        <textarea data-id="desc" class="form-control input-profile" placeholder="افزودن توضیحات*"></textarea>
                                    </div>
                                    <div class="wt-btnarea">
                                        <button onclick="ajax_submit_mbm_post_data_resume_save_form(
            {
                'action': 'mbm_profile_user_request_project',
                'job_id':<?php echo $job_id ?>,
                'meta_key':'request',
                'meta_action':'request',
            }
            ,'form-request'
            ,$('#dzFormMsg-error-profile'),
            2
        )" class="wt-btn">ارسال درخواست همکاری</button>
                                        <div class="box-loading">
                                            <div class="loading-ajax"></div>
                                        </div>
                                        <div id="dzFormMsg-error-profile" class="dzFormMsg error"></div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Listing End-->
        </div>
    </main>
    <!--Main End-->

</div>
<!-- Content END-->

<?php
get_footer();
