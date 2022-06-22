<?php

/**
 * The template for displaying job single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since Kaktos 1.0
 *  * Template Name: مشاهده کاربر
 */

get_header();
$user_id = 0;
if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
}

if ($user_id == 0) {
    get_footer();
    return;
}



$cur_user_id = get_current_user_id();

if ($cur_user_id > 0) {
    $search = array();
    $search["relation"] = "AND";
    $search[] =           array(
        'key' => 'user_id',
        'value' => $user_id,
        'compare' => '='
    );

    $args = array(
        'post_type' => 'view-user',
        'post_author'  => $cur_user_id,
        'title'        => $title,
        'meta_query' => $search
    );
    $the_query = new WP_Query($args);

    $count = $the_query->post_count;
    wp_reset_query();

    if ($count == 0) {
        $args_post = array(
            'post_title'   => $cur_user_id,
            'post_type'    => 'view-user',
            'post_author'  => $cur_user_id,
            'post_status'  => 'publish',
            'meta_input'   => array(
                'user_id' => $user_id
            )
        );
        $id = wp_insert_post($args_post);
    }
}
$followed = 0;
$search = array();
$search["relation"] = "AND";
$search[] =           array(
    'key' => 'user_id',
    'value' => $user_id,
    'compare' => '='
);

$args = array(
    'post_type' => 'follow',
    'post_author'  => $cur_user_id,
    'title'        => $title,
    'meta_query' => $search
);
$the_query = new WP_Query($args);

$count = $the_query->post_count;

if ($count > 0) {
    $followed = 1;
}

if ($cur_user_id > 0 && isset($_GET["follow"])) {


    if ($count == 0) {
        $args_post = array(
            'post_title'   => $cur_user_id,
            'post_type'    => 'follow',
            'post_author'  => $cur_user_id,
            'post_status'  => 'publish',
            'meta_input'   => array(
                'user_id' => $user_id
            )
        );
        $id = wp_insert_post($args_post);
        $followed = 1;
    } else {
        $followed = 0;
        while ($the_query->have_posts()) :
            $the_query->the_post();
            wp_delete_post(get_the_ID());
        endwhile;
    }
}

wp_reset_query();
?>

<!--Inner Home Banner Start-->
<div style="background-image: url(<?php echo (strlen(get_the_author_meta('avatar_bg', $user_id)) > 0) ? get_the_author_meta('avatar_bg', $user_id) : get_template_directory_uri() . '/assets/images/bannerimg/img-02.jpg' ?>);" class="wt-haslayout wt-innerbannerholder wt-innerbannerholdervtwo">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
            </div>
        </div>
    </div>
</div>
<!--Inner Home End-->
<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
    <!-- User Profile Start-->
    <div class="wt-main-section wt-paddingtopnull wt-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                    <div class="wt-userprofileholder">
                        <span class="wt-featuredtag"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 float-right">
                            <div class="row">
                                <div class="wt-userprofile">
                                    <figure>
                                        <img src="<?php echo (strlen(get_the_author_meta('avatar', $user_id)) > 0) ? get_the_author_meta('avatar', $user_id) : get_template_directory_uri() . '/assets/img/NoImage.jpg' ?>" alt="img description">
                                        <div class="wt-userdropdown wt-online">
                                        </div>
                                    </figure>
                                    <div class="wt-title">
                                        <h3><i class="fa fa-check-circle"></i> <?php echo get_the_author_meta('user_name', $user_id)  ?></h3>
                                        <div>
                                            <?php if ($followed == 0) {
                                                $text = "دنبال کردن";
                                                $color = "#d5ab11";
                                            } else {
                                                $text = "دنبال نکردن";
                                            }
                                            ?>
                                            <div class="wt-btnarea"><a style="background: <?php echo $color ?>;margin-right: 10px;margin-left: 10px;" href="<?php echo home_url('user-view?id=' . $cur_user_id . '&follow=1') ?>" class="wt-btn"><?php echo $text; ?></a></div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9 float-left">
                            <div class="row">
                                <div class="wt-proposalhead wt-userdetails">
                                    <h2> <?php echo get_the_author_meta('job_title', $user_id)  ?></h2>
                                    <ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
                                        <li><span><i class="far fa-money-bill-alt"></i> <?php echo get_the_author_meta('user_nerx', $user_id)  ?> / ساعتی</span></li>
                                        <li><span> <?php echo get_the_author_meta('user_country', $user_id)  ?> </span></li>
                                        <li><a href="javascript:void(0);" class="wt-clicksave"><i class="fa fa-heart"></i> ذخیره</a></li>
                                    </ul>
                                    <div class="wt-description">
                                        <?php echo get_the_author_meta('user_desc', $user_id)  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Profile End-->
        <!-- User Listing Start-->
        <div class="container">
            <div class="row">
                <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                        <div class="wt-usersingle">
                            <div class="wt-craftedprojects">
                                <div class="wt-usertitle">
                                    <h2>نمونه کارهای انجام شده با این سایت</h2>
                                </div>
                                <div class="wt-projects">
                                    <?php
                                    $search = array();

                                    $search["relation"] = "AND";
                                    $search[] =           array(
                                        'key' => 'request_id',
                                        'value' => $user_id,
                                        'compare' => '='
                                    );
                                    $search[] =           array(
                                        'key' => 'project_state',
                                        'value' => 1,
                                        'compare' => '='
                                    );

                                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $args = array(
                                        'post_type' => 'job',
                                        'post_status' => 'publish',
                                        'paged' => $paged,
                                        'posts_per_page' => 10,
                                        'meta_query' => $search
                                    );

                                    $the_query = new WP_Query($args);
                                    $count = $the_query->post_count;
                                    while ($the_query->have_posts()) :
                                        $the_query->the_post();
                                    ?>
                                        <div class="wt-project">
                                            <div class="wt-projectcontent">
                                                <h3><?php echo get_the_title() ?></h3>
                                                <a target="_Blank" href="<?php echo get_the_permalink() . '?viewed_by=' . get_current_user_id(); ?>">مشاهده پروژه</a>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                    if ($count == 0) {
                                    ?>
                                        <h3 style="color: red;">تا کنون پروژه ای در این سایت انجام نداده ام</h3>

                                    <?php
                                    }
                                    ?>
                                    <?php wp_reset_query(); ?>
                                </div>
                            </div>
                            <div class="wt-craftedprojects">
                                <div class="wt-usertitle">
                                    <h2>نمونه کارها</h2>
                                </div>
                                <div class="wt-projects">
                                    <?php
                                    $json = json_decode(get_the_author_meta('user_pro', $user_id), true);
                                    if (is_array($json)) {
                                        foreach ($json as $item) {
                                    ?>
                                            <div class="wt-project">
                                                <figure>
                                                    <img src="<?php echo (strlen($item["img"]) > 0) ? $item["img"] : get_template_directory_uri() . '/assets/img/NoImage.jpg'; ?>" alt="img description">
                                                </figure>
                                                <div class="wt-projectcontent">
                                                    <h3><?php echo $item["title"] ?></h3>
                                                    <a href="javascript:void(0);"><?php echo $item["address"] ?></a>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="wt-experience">
                                <div class="wt-usertitle">
                                    <h2>تجربه</h2>
                                </div>
                                <div class="wt-experiencelisting-hold">
                                    <?php
                                    $json = json_decode(get_the_author_meta('user_exp', $user_id), true);
                                    if (is_array($json)) {
                                        foreach ($json as $item) {
                                    ?>
                                            <div class="wt-experiencelisting wt-bgcolor">
                                                <div class="wt-title">
                                                    <h3><?php echo $item["job_title"] ?></h3>
                                                </div>
                                                <div class="wt-experiencecontent">
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        <li><span><i class="far fa-building"></i> <?php echo $item["company_title"] ?></span></li>
                                                        <li><span><i class="far fa-calendar"></i> <?php echo $item["start"] . ' - ' . $item["end"] ?></span></li>
                                                    </ul>
                                                    <div class="wt-description">
                                                        <p><?php echo $item["job_desc"] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <div class="divheight"></div>
                                </div>
                            </div>
                            <div class="wt-experience wt-education">
                                <div class="wt-usertitle">
                                    <h2>آموزش</h2>
                                </div>
                                <div class="wt-experiencelisting-hold">
                                    <?php
                                    $json = json_decode(get_the_author_meta('user_edu', $user_id), true);
                                    if (is_array($json)) {
                                        foreach ($json as $item) {
                                    ?>
                                            <div class="wt-experiencelisting wt-bgcolor">
                                                <div class="wt-title">
                                                    <h3><?php echo $item["major_title"] ?></h3>
                                                </div>
                                                <div class="wt-experiencecontent">
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        <li><span><i class="far fa-building"></i> <?php echo $item["uni_title"] ?></span></li>
                                                        <li><span><i class="far fa-calendar"></i> <?php echo $item["start"] . ' - ' . $item["end"] ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <div class="divheight"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                        <aside id="wt-sidebar" class="wt-sidebar">
                            <div id="wt-ourskill" class="wt-widget">
                                <div class="wt-widgettitle">
                                    <h2>مهارت های من</h2>
                                </div>
                                <div class="wt-widgetcontent wt-skillscontent">

                                    <?php
                                    $tags_str = get_post_meta(get_the_ID(), 'skills', true);
                                    $tags = explode(',', $tags_str);
                                    foreach ($tags as $tag) {
                                    ?>
                                        <div class="wt-skillholder" data-percent="100%">
                                            <span><?php echo $tag ?> <em style="margin-left: 10px;">100%</em></span>
                                            <div class="wt-skillbarholder">
                                                <div class="wt-skillbar"></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="wt-widget wt-sharejob">
                                <div class="wt-widgettitle">
                                    <h2>اشتراک گذاری این کاربر</h2>
                                </div>
                                <div class="wt-widgetcontent">
                                    <ul class="wt-socialiconssimple">

                                        <li class="wt-facebook"><a class="social-share facebook" href="javascript:void(0);"><i class="fab fa-facebook-f"></i>اشتراک گذاری در فیسبوک</a></li>
                                        <li class="wt-twitter"><a class="social-share twitter" href="javascript:void(0);"><i class="fab fa-twitter"></i>اشتراک گذاری در توئیتر</a></li>
                                        <li class="wt-linkedin"><a class="social-share linkedin" href="javascript:void(0);"><i class="fab fa-linkedin-in"></i>اشتراک گذاری در لینکدین</a></li>
                                        <li class="wt-googleplus"><a class="social-share google-plus" href="javascript:void(0);"><i class="fab fa-google-plus-g"></i>اشتراک گذاری در گوگل پلاس</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
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
