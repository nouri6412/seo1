<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since 1.0.0
 */

$user_id = get_current_user_id();

$state = 0;

if (isset($_GET["state"])) {
    $state = $_GET["state"];
}
$page_count = 10;

if ($state == 1) {
    $page_count = 1000;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'request',
    'post_status' => 'publish',
    'author'  => $user_id,
    'paged' => $paged,
    'posts_per_page' => $page_count
);
$the_query = new WP_Query($args);
$count = $the_query->post_count;
?>

<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-dashboardbox">
        <div class="wt-dashboardboxtitle">
            <h2> پیشنهادات من </h2>
        </div>
        <div class="wt-dashboardboxcontent wt-jobdetailsholder">
            <div class="wt-freelancerholder">
                <div class="wt-tabscontenttitle">
                    <h2>پیشنهادات من</h2>
                </div>
                <div class="wt-managejobcontent wt-verticalscrollbar mCustomScrollbar _mCS_1">
                    <?php
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                        $job_id = get_post_meta(get_the_ID(), 'job_id', true);
                        $request_id = get_post_meta($job_id, 'request_id', true);
                        if ($state == 1 && $request_id != $user_id) {
                            continue;
                        }
                    ?>
                        <div class="wt-userlistinghold wt-featured wt-userlistingvtwo">
                            <span class="wt-featuredtag wt-featuredtagcolor3"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
                            <div class="wt-userlistingcontent">
                                <div class="wt-contenthead">
                                    <div class="wt-title">
                                        <h2> <?php echo get_the_title($job_id);
                                                echo ($request_id == $user_id) ? '<span style="margin-right: 10px;
    color: #08d518;">(استخدام شدم)</span>' : ''; ?></h2>
                                    </div>
                                    <ul class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                        <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo ' ' . get_post_meta($job_id, 'min_price', true) . ' - ' . get_post_meta($job_id, 'max_price', true); ?></span></li>

                                        <li><span><?php echo get_the_author_meta('user_country'); ?></span></li>
                                        <li><span><i class="far fa-folder wt-viewjobfolder"></i> <?php $cat = get_post(get_post_meta($job_id, 'cat_id', true));
                                                                                                    echo $cat->post_title; ?></span></li>
                                        <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان' . ' : ' . get_post_meta($job_id, 'time', true) . ' ' . 'روز'; ?></span></li>
                                        <li><span><i class="far fa-clock "></i><?php echo  get_the_date($job_id); ?></span></li>
                                    </ul>
                                    <ul style="margin-top: 8px;" class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                        <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo 'قیمت پیشنهادی من' . ' : ' . get_post_meta(get_the_ID(), 'price', true) . ' ' . 'دلار' ?></span></li>
                                        <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان پیشنهادی من' . ' : ' . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز'; ?></span></li>
                                        <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo custom_get_the_date(get_the_ID()); ?></span></li>
                                    </ul>
                                    <div style="margin-top: 8px;">
                                        <?php echo get_post_meta(get_the_ID(), 'desc', true) ?>
                                    </div>
                                </div>
                                <div class="wt-rightarea">
                                    <div class="wt-btnarea">
                                        <a target="_Blank" href="<?php echo get_the_permalink(); ?>" class="wt-btn">مشاهده پروژه</a>
                                    </div>
                                    <div style="margin-right: 10px;" class="wt-btnarea">
                                        <a href="<?php echo home_url('profile?action=request-project&job_id=' . $job_id); ?>" class="wt-btn">پیشنهادات </a>
                                    </div>
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