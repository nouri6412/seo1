<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since 1.0.0
 * Template Name: پروژه ها
 */

get_header();

$search = array();

$search["relation"] = "AND";

$cat_id = 0;
$skill_id = 0;
$min_time = 0;
$max_time = 0;
$min_price = 0;
$max_price = 0;
$search_word = "";
$tags = "";

if (isset($_GET["search_word"])) {
    $search_word = $_GET["search_word"];
}

if (isset($_GET["tags"])) {
    $tags = $_GET["tags"];
}

if (isset($_GET["min_time"]) && $_GET["min_time"] > 0) {
    $min_time = $_GET["min_time"];
}
if (isset($_GET["max_time"]) && $_GET["max_time"] > 0) {
    $max_time = $_GET["max_time"];
}
if (isset($_GET["min_price"]) && $_GET["min_price"] > 0) {
    $min_price = $_GET["min_price"];
}
if (isset($_GET["max_price"]) && $_GET["max_price"] > 0) {
    $max_price = $_GET["max_price"];
}


if (isset($_GET["cat_id"]) && $_GET["cat_id"] > 0) {
    $cat_id = $_GET["cat_id"];
}

if (isset($_GET["skill_id"]) && $_GET["skill_id"] > 0) {
    $skill_id = $_GET["skill_id"];
}

if (strlen($search_word) > 0) {
    $search_title = [];
    $search_title["relation"] = "OR";
    $search_title[] =           array(
        'key' => 'title',
        'value' => $search_word,
        'compare' => 'LIKE'
    );
    $search_title[] =           array(
        'key' => 'desc',
        'value' => $search_word,
        'compare' => 'LIKE'
    );


    if (strlen($tags) > 0) {
        $tagss = explode(',', $tags);
        foreach ($tagss as $tag) {
            $search_title[] =           array(
                'key' => 'skills',
                'value' => $tag,
                'compare' => 'LIKE'
            );
        }
    }


    $search[] = $search_title;
}

if ($min_time > 0) {
    $search[] =           array(
        'key' => 'time',
        'value' => $min_time,
        'compare' => '>'
    );
}

if ($max_time > 0) {
    $search[] =           array(
        'key' => 'time',
        'value' => $max_time,
        'compare' => '<'
    );
}

if ($skill_id > 0) {
    $search[] =           array(
        'key' => 'skills',
        'value' => '"skill":"' . $skill_id . '"',
        'compare' => 'LIKE'
    );
}

if ($cat_id > 0) {
    $search[] =           array(
        'key' => 'cat_id',
        'value' => $cat_id,
        'compare' => '='
    );
}


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'job',
    'post_status' => 'publish',
    'meta_key' => 'active',
    'meta_value' => '1',
    'paged' => $paged,
    'meta_query' => $search,
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
                        <h2>جستجوی پروژه ها </h2>
                    </div>
                    <ol class="wt-breadcrumb">
                        <li><a href="<?php echo home_url();  ?>">صفحه اصلی</a></li>
                        <li class="wt-active"> پروژه ها </li>
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
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-right">
                            <aside id="wt-sidebar" class="wt-sidebar">
                                <form action="<?php echo home_url('search-job'); ?>" method="get">
                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>جستجوی کلید واژه </h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input value="<?php echo isset($_GET["search_word"]) ? $_GET["search_word"] : '' ?>" type="text" id="search_word" name="search_word" class="form-control input-profile" placeholder=" جستجوی کلید واژه">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>جستجو بر اساس مهارت</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input value="<?php echo isset($_GET["tags"]) ? $_GET["tags"] : '' ?>" type="text" id="tags" name="tags" class="form-control input-profile tags_input">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>


                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <label>دسته بندی پروژه</label>
                                                <span class="wt-select">
                                                    <select id="cat_id" name="cat_id" class="input-profile">
                                                        <option value="">انتخاب دسته بندی</option>
                                                        <?php
                                                        $args = array(
                                                            'post_type' => 'job-cat'
                                                        );
                                                        $the_query1 = new WP_Query($args);
                                                        ?>
                                                        <?php
                                                        while ($the_query1->have_posts()) :
                                                            $the_query1->the_post();
                                                            $selected = "";
                                                            $cat_id = isset($_GET["cat_id"]) ? $_GET["cat_id"] : '0';

                                                            if ($cat_id == get_the_ID()) {
                                                                $selected = "selected";
                                                            }
                                                        ?>
                                                            <option <?php echo $selected ?> value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
                                                        <?php
                                                        endwhile;
                                                        wp_reset_query();
                                                        ?>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:none; padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>مهارت های لازم</h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <span class="wt-select">
                                                    <select id="skill_id" name="skill_id">
                                                        <option value=""> انتخاب مهارت </option>
                                                        <?php
                                                        $args = array(
                                                            'post_type' => 'skill'
                                                        );
                                                        $the_query1 = new WP_Query($args);
                                                        ?>
                                                        <?php
                                                        while ($the_query1->have_posts()) :
                                                            $the_query1->the_post();
                                                            $selected = "";
                                                            $cat_id = isset($_GET["skill_id"]) ? $_GET["skill_id"] : '0';

                                                            if ($cat_id == get_the_ID()) {
                                                                $selected = "selected";
                                                            }
                                                        ?>
                                                            <option <?php echo $selected ?> value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
                                                        <?php
                                                        endwhile;
                                                        wp_reset_query();
                                                        ?>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>زمان پروژه </h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group form-group-half">
                                                        <label>حداقل (روز)</label>
                                                        <input value="<?php echo isset($_GET["min_time"]) ? $_GET["min_time"] : '' ?>" type="number" name="min_time" id="min_time" class="form-control input-profile" placeholder="حداقل (روز)">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <label>حداکثر (روز)</label>
                                                        <input value="<?php echo isset($_GET["max_time"]) ? $_GET["max_time"] : '' ?>" type="number" name="max_time" id="max_time" class="form-control input-profile" placeholder="حداکثر (روز)">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgettitle">
                                            <h2>بودجه پروژه </h2>
                                        </div>
                                        <div class="wt-widgetcontent">
                                            <div class="wt-formtheme wt-formsearch">
                                                <fieldset>
                                                    <div class="form-group form-group-half">
                                                        <label>حداقل (دلار)</label>
                                                        <input value="<?php echo isset($_GET["min_price"]) ? $_GET["min_price"] : '' ?>" type="number" id="min_price" name="min_price" class="form-control input-profile" placeholder="حداقل (دلار)">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <label>حداکثر (دلار)</label>
                                                        <input value="<?php echo isset($_GET["max_price"]) ? $_GET["max_price"] : '' ?>" type="number" id="max_price" name="max_price" class="form-control input-profile" placeholder="حداکثر (دلار)">
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-top: 5px;padding-bottom:5px" class="wt-widget wt-effectiveholder">
                                        <div class="wt-widgetcontent">
                                            <div class="wt-applyfilters">
                                                <span> روی "اعمال فیلتر" کلیک کنید تا آخرین تغییرات ایجاد شده توسط شما را اعمال کنید. </span>
                                                <button type="submit" class="wt-btn">اعمال فیلتر </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingholder wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    <span><?php echo $count . ' ' . 'نتیجه'; ?></span>
                                </div>
                                <?php
                                while ($the_query->have_posts()) :
                                    $the_query->the_post();
                                ?>
                                    <div class="wt-userlistinghold wt-featured wt-userlistingholdvtwo">
                                        <!-- <span class="wt-featuredtag"><img src="<?php //echo get_template_directory_uri(); 
                                                                                    ?>/assets/images/featured.png" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span> -->
                                        <div class="wt-userlistingcontent">
                                            <div class="wt-contenthead">
                                                <div class="wt-title">
                                                    <a href="#"><i class="fa fa-check-circle"></i><?php echo (strlen(get_the_author_meta('company_name')) > 0) ? get_the_author_meta('company_name') : get_the_author_meta('user_name'); ?></a>
                                                    <h2><?php echo get_post_meta(get_the_ID(), 'title', true);
                                                        ?></h2>

                                                    <h5><?php
                                                        $cat = get_post(get_post_meta(get_the_ID(), 'cat_id', true));
                                                        echo  '<a href="' . home_url('search-job?cat_id=' . get_post_meta(get_the_ID(), 'cat_id', true)) . '">' . $cat->post_title . '</a>'  ?></h5>
                                                </div>

                                                <div class="wt-description">
                                                    <p><?php echo  wp_trim_words(get_post_meta(get_the_ID(), 'desc', true), 50, null) ?></p>
                                                </div>
                                                <div class="wt-tag wt-widgettag">
                                                    <?php
                                                    $tags_str = get_post_meta(get_the_ID(), 'skills', true);
                                                    $tags = explode(',', $tags_str);
                                                    foreach ($tags as $tag) {
                                                    ?>
                                                        <a href="javascript:void(0);"><span><?php echo $tag; ?></span></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="wt-viewjobholder">
                                                <ul>
                                                    <li><span><i class="fa fa-dollar-sign wt-viewjobdollar"></i><?php echo ' '.'بودجه' . ' : ' . 'از' . ' ' . get_post_meta(get_the_ID(), 'min_price', true) . ' ' . 'تا' . ' ' . get_post_meta(get_the_ID(), 'max_price', true) . ' ' .'$C'; ?></span></li>
                                                    <li><span><?php echo get_the_author_meta('user_country'); ?></span></li>
                                                    <li><span><i class="far fa-folder wt-viewjobfolder"></i> <?php $cat = get_post(get_post_meta(get_the_ID(), 'cat_id', true));
                                                                                                                 echo  '<a href="' . home_url('search-job?cat_id=' . get_post_meta(get_the_ID(), 'cat_id', true)) . '">' . $cat->post_title . '</a>' ?></span></li>
                                                    <li><span><i class="far fa-clock wt-viewjobclock"></i><?php echo 'زمان' . ' : ' . get_post_meta(get_the_ID(), 'time', true) . ' ' . 'روز'; ?></span></li>
                                                    <li><span><i class="far fa-clock "></i><?php echo  custom_get_the_date(get_the_ID()); ?></span></li>

                                                    <li><a href="javascript:void(0);" class="wt-clicklike wt-clicksave"><i class="fa fa-heart"></i> ذخیره</a></li>
                                                    <li class="wt-btnarea"><a href="<?php echo get_the_permalink(); ?>" class="wt-btn">مشاهده پروژه</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;

                                ?>
                                <?php wp_reset_query(); ?>
                            </div>
                            <div style="float: left;    margin-top: 11px;" class="pagination">
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
