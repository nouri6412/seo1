<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since 1.0.0
 * Template Name: پیشنهادات پروژه
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

<!--Inner Home Banner Start-->
<!-- <div class="wt-haslayout wt-innerbannerholder">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                <div class="wt-innerbannercontent">
                    <div class="wt-title">
                        <h2><?php echo get_the_title($job_id); ?> </h2>
                    </div>
                    <ol class="wt-breadcrumb">
                        <li><a href="<?php echo home_url();  ?>">صفحه اصلی</a></li>
                        <li class="wt-active"> پیشنهادات پروژه</li>
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
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                            <div class="wt-userlistingholder wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    <span><?php echo $count . ' ' . 'پیشنهاد'; ?></span>
                                </div>
                                <?php
                                while ($the_query->have_posts()) :
                                    $the_query->the_post();
                                ?>
                                    <div class="wt-userlistinghold wt-featured wt-userlistingholdvtwo">
                                        <span class="wt-featuredtag"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
                                        <div class="wt-userlistingcontent">
                                            <div class="wt-contenthead">
                                                <div class="wt-title">
                                                    <a href="usersingle.html"><i class="fa fa-check-circle"></i><?php echo get_the_author_meta('user_name'); ?></a>
                                                </div>
                                                <div class="wt-description">
                                                    <p><?php echo  get_post_meta(get_the_ID(), 'desc', true) ?></p>
                                                </div>
                                            </div>
                                            <div class="wt-viewjobholder">
                                                <ul>
                                                    <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo ' ' . get_post_meta(get_the_ID(), 'price', true) ; ?></span></li>
                                                    <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان' . ' : ' . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز'; ?></span></li>
                                                    <li><span><i class="far fa-clock "></i><?php echo  custom_get_the_date(get_the_ID()) ; ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;

                                ?>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- User Listing End-->
    </div>
</main>
<!--Main End-->

<?php

get_footer();
