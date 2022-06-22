<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since 1.0.0
 * Template Name: پروفایل من
 */



get_header('db');

$user_id = get_current_user_id();


$user_info = get_userdata($user_id);
$user_meta = get_user_meta($user_id);

$action = "profile";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

set_query_var('page_action', $action);
set_query_var('user_info', $user_info);
set_query_var('user_meta', $user_meta);

$active = get_the_author_meta('active_state', $user_id);

?>
<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout">
    <!--Sidebar Start-->
    <?php
    if ($user_id > 0) {
        get_template_part('template-parts/profile-user/profile-user', 'aside');
    }
    ?>
    <!--Sidebar Start-->
    <!--Register Form Start-->
    <section style="min-height: 600px;" class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-md-4 col-lg-3 col-xl-2"></div>
            <?php
            if ($user_id > 0 && ($active == 1 || current_user_can('administrator'))) {
                $user_type = "user";
                set_query_var('back_action', get_the_author_meta('page_action', $user_id));
                update_user_meta($user_id, "page_action", $action);
                get_template_part('template-parts/profile-' . $user_type . '/profile-' . $user_type, $action);
                //  get_template_part('template-parts/profile-user/profile-user', 'aside-left');
            } else if ($active == 0) {
            ?>
                <div style="height: 500px;">
                    <a href="<?php echo home_url('register?action=verify') ?>"><i class="fa fa-lock"></i> ثبت نام شما تایید نشده است برای تایید ایمیل کلیک فرمائید </a>

                </div>
            <?php
            } else {
            ?>
                <div style="height: 500px;">
                    <a href="#"><i class="fa fa-lock"></i> لطفا وارد سایت شوید </a>

                </div>
            <?php
            }
            ?>
        </div>
    </section>
    <!--Register Form End-->
</main>
<!--Main End-->
<?php
get_footer('db');
