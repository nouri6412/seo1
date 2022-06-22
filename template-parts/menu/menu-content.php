<?php
$menuLocations = get_nav_menu_locations();

$menuID = $menuLocations['primary-menu'];

$primaryNav = wp_get_nav_menu_items($menuID);
$menus = [];
//var_dump($primaryNav);
$menus = get_menu_array_nav_item($primaryNav);
?>
<ul class="navbar-nav">
    <li class="menu-item-has-children page_item_has_children">
        <a href="<?php echo home_url('search-job'); ?>">دسته بندی</a>

        <ul class="sub-menu">
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
            ?>
                <li class="nav-item">
                    <a href="<?php echo home_url('search-job?cat_id=' . get_the_ID()); ?>"><?php echo get_the_title(); ?></a>
                </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </li>
    <?php
    foreach ($menus[0] as $navItem) {
        custom_generate_menu_li($navItem, $menus);
    }
    ?>
    <?php
    if (is_user_logged_in()) {
    ?>
        <li class="nav-item coment">
            <?php
            $search = array();

            $search["relation"] = "AND";

            $search2 = [];
            $search2["relation"] = "OR";
            $search2[] =           array(
                'key' => 'owner_id',
                'value' => $user_id,
                'compare' => '='
            );

            $search2[] =           array(
                'key' => 'sender_id',
                'value' => $user_id,
                'compare' => '='
            );

            $search[] = $search2;

            $search1 = [];
            $search1["relation"] = "AND";

            $search1[] =           array(
                'key' => 'last_sender_message',
                'value' => $user_id,
                'compare' => '!='
            );
            $search1[] =           array(
                'key' => 'last_sender_message',
                'value' => 0,
                'compare' => '>'
            );
            $search1[] =           array(
                'key' => 'new_message',
                'value' => 1,
                'compare' => '='
            );

            $search[] = $search1;

            $args = array(
                'post_type' => 'request',
                'post_status' => 'publish',
                'meta_query' => $search
            );
            $the_query = new WP_Query($args);


            $count = $the_query->post_count;
            ?>
            <a href="<?php echo home_url('profile?action=message') ?>" class=""><i class="fa fa-envelope"></i>
                <?php if ($count > 0) { ?>
                    <span class="badge badge-pill badge-danger"><?php echo $count; ?></span>
                <?php } ?>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="btn offcanvas"><i class="fa fa-bell"></i></a>
        </li>
    <?php } ?>
</ul>