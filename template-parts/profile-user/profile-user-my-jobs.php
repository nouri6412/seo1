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
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'job',
    'post_status' => 'publish',
    'author'  => $user_id,
    'paged' => $paged,
    'posts_per_page' => 10
);
$the_query = new WP_Query($args);
$count = $the_query->post_count;


if (isset($_GET["job_id"]) && isset($_GET["project_state"])) {
    $job_id = $_GET["job_id"];
    $author = get_post_field('post_author', $job_id);
    if ($user_id == $author) {
        update_post_meta($job_id, 'project_state', 1);
        update_post_meta($job_id, 'project_state_date', date('Y-m-d H:i:s'));
        $d = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
        update_post_meta($job_id, 'project_state_time', $d);
    }
}
?>

<div class="col-12 col-md-8 col-lg-9 col-xl-10">
            <div class="wt-dashboardbox">
                <div class="wt-dashboardboxtitle">
                    <h2> مدیریت پروژه ها </h2>
                </div>
                <div class="wt-dashboardboxcontent wt-jobdetailsholder">
                    <div class="wt-freelancerholder">
                        <div class="wt-tabscontenttitle">
                            <h2>پروژه های من</h2>
                        </div>
                        <div class="wt-managejobcontent wt-verticalscrollbar mCustomScrollbar _mCS_1">
                            <?php
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                            ?>
                                <div class="wt-userlistinghold wt-featured wt-userlistingvtwo">
                                    <span class="wt-featuredtag wt-featuredtagcolor3"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
                                    <div class="wt-userlistingcontent">
                                        <div class="wt-contenthead">
                                            <div class="wt-title">
                                                <h2> <?php echo get_the_title();
                                                        if (get_post_meta(get_the_ID(), 'project_state', true) == 1) {
                                                            echo ' - ' . '<span style="color:green">تکمیل شده</span>';
                                                        }
                                                        ?></h2>
                                            </div>
                                            <ul class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                                <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo ' ' . get_post_meta(get_the_ID(), 'min_price', true) . ' - ' . get_post_meta(get_the_ID(), 'max_price', true); ?></span></li>
                                                <li><span><?php echo get_the_author_meta('user_country'); ?></span></li>
                                                <li><span><i class="far fa-folder wt-viewjobfolder"></i> <?php $cat = get_post(get_post_meta(get_the_ID(), 'cat_id', true));
                                                                                                            echo $cat->post_title; ?></span></li>
                                                <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان' . ' : ' . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز'; ?></span></li>
                                                <li><span><i class="far fa-clock "></i><?php echo  custom_get_the_date(get_the_ID()); ?></span></li>
                                            </ul>
                                        </div>
                                        <div class="wt-rightarea">
                                            <div class="wt-btnarea">
                                                <a target="_Blank" href="<?php echo get_the_permalink(); ?>" class="wt-btn">مشاهده پروژه</a>
                                            </div>
                                            <div style="margin-right: 10px;" class="wt-btnarea">
                                                <a href="<?php echo home_url('profile?action=create-project&job_id=' . get_the_ID()); ?>" class="wt-btn">ویرایش پروژه</a>
                                            </div>
                                            <div style="margin-right: 10px;" class="wt-btnarea">
                                                <a href="<?php echo home_url('profile?action=request-project&job_id=' . get_the_ID()); ?>" class="wt-btn">پیشنهادات </a>
                                            </div>
                                            <div style="margin-right: 10px;" class="wt-btnarea">
                                                <?php
                                                if (get_post_meta(get_the_ID(), 'project_state', true) == 1) {
                                                    ?>
                                                <a href="#" style="background: green;" class="wt-btn">تکمیل شد</a>

                                                    <?php
                                                } else{
                                                ?>
                                                <a href="<?php echo home_url('profile?action=my-jobs&project_state=1&job_id=' . get_the_ID()); ?>" class="wt-btn">اتمام پروژه </a>

                                                <?php } ?>
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