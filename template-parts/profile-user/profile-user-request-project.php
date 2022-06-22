<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Seo1
 * @since 1.0.0
 */

$user_id = get_current_user_id();
$job_id = 0;
if (isset($_GET["job_id"])) {
    $job_id = $_GET["job_id"];
}

if ($job_id == 0) {
    return;
}


$request_id = get_post_meta($job_id, 'request_id', true);

if (isset($_GET["request_id"]) &&  ($request_id == 0 || $request_id == '')) {
    $author = get_post_field('post_author', $job_id);
    if ($user_id == $author) {
        update_post_meta($job_id, 'request_id', $_GET["request_id"]);
        update_post_meta($job_id, 'user_id', get_post_field('post_author', $job_id));
        update_post_meta($job_id, 'request_req_id', $_GET["req_id"]);
        update_post_meta($job_id, 'request_accept_time', current_time('timestamp'));
        update_post_meta($job_id, 'request_accept_date', date('Y-m-d H:i:s'));
    }
}


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'request',
    'post_status' => 'publish',
    'meta_key' => 'job_id',
    'paged' => $paged,
    'meta_value' => $job_id,
    'posts_per_page' => 10
);
$the_query = new WP_Query($args);
$count = $the_query->post_count;
?>

<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle">
            <h2> پیشنهادات پروژه </h2>
        </div>
        <div class="wt-dashboardboxcontent wt-jobdetailsholder">
            <div class="wt-freelancerholder">
                <div class="wt-tabscontenttitle">
                    <h2>پیشنهادات</h2>
                </div>
                <div class="wt-managejobcontent wt-verticalscrollbar mCustomScrollbar _mCS_1">
                    <div class="wt-userlistinghold wt-featured wt-userlistingvtwo">
                        <span class="wt-featuredtag wt-featuredtagcolor3"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style mCS_img_loaded"></span>
                        <div class="wt-userlistingcontent">
                            <div class="wt-contenthead">
                                <div class="wt-title">
                                    <h2> <?php echo get_the_title($job_id); ?></h2>
                                </div>
                                <ul class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                    <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo ' ' . get_post_meta($job_id, 'min_price', true) . ' - ' . get_post_meta($job_id, 'max_price', true); ?></span></li>
                                    <li><span><?php echo get_the_author_meta('user_country'); ?></span></li>
                                    <li><span><i class="far fa-folder wt-viewjobfolder"></i> <?php $cat = get_post(get_post_meta($job_id, 'cat_id', true));
                                                                                                echo $cat->post_title; ?></span></li>
                                    <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان' . ' : ' . get_post_meta($job_id, 'time', true) . ' ' . 'روز'; ?></span></li>
                                    <li><span><i class="far fa-clock "></i><?php echo  get_the_date($job_id); ?></span></li>
                                </ul>
                            </div>
                            <div class="wt-rightarea">
                                <div class="wt-hireduserstatus">
                                    <h4><?php echo $count ?></h4><span>پیشنهادات دریافت شده </span>
                                </div>
                                <div class="wt-hireduserstatus">
                                    <?php if ($request_id > 0) {
                                    ?>
                                        <h4>استخدام </h4><span> <a target="_Blank" href="<?php echo home_url('user-view?id=' . $request_id) ?>" class="wt-btn"> <?php echo get_the_author_meta('user_name') . ' ' . 'استخدام شد' ?></a>
                                        </span>
                                        <ul class="wt-hireduserimgs">
                                            <li>
                                                <figure><img src="<?php echo  get_the_author_meta('avatar', $request_id) ?>" alt="img"></figure>
                                            </li>
                                        </ul>
                                    <?php

                                    } else {
                                    ?>


                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                    ?>
                        <div class="wt-userlistinghold wt-featured wt-proposalitem">
                            <span class="wt-featuredtag"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style mCS_img_loaded"></span>
                            <figure class="wt-userlistingimg">
                                <img src="<?php echo get_the_author_meta('avatar') ?>" alt="image description" class="mCS_img_loaded">
                            </figure>
                            <div class="wt-proposaldetails">
                                <div class="wt-contenthead">
                                    <div class="wt-title">
                                        <a target="_Blank" href="<?php echo home_url('user-view?id=' . get_the_author_meta('ID')) ?>"><?php echo get_the_author_meta('user_name'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-rightarea">
                                <div class="wt-btnarea">
                                    <?php if ($request_id > 0) {
                                    ?>

                                    <?php

                                    } else {
                                    ?>

                                        <a href="<?php echo home_url('profile?action=request-project&job_id=' . $job_id . '&request_id=' . get_the_author_meta('ID') . "&req_id=" . get_the_ID())  ?>" class="wt-btn"> اکنون استخدام کنید</a>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="wt-hireduserstatus">
                                    <h5><?php echo get_post_meta(get_the_ID(), 'price', true) . ' ' . 'دلار' ?></h5>
                                    <span><?php echo get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز' ?></span>
                                </div>
                                <div class="wt-hireduserstatus">
                                    <p><?php echo custom_get_the_date(get_the_ID()); ?></p>
                                    <?php echo get_post_meta(get_the_ID(), 'desc', true) ?>
                                </div>
                            </div>

                        </div>
                    <?php
                    endwhile;
                    ?>
                </div>
            </div>
        </div>

        <div class="pagination">
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
    </div>
</div>