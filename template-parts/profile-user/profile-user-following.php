<?php
$cur_user_id = get_current_user_id();

$search = array();
// $search["relation"] = "AND";
// $search[] =           array(
//     'key' => 'user_id',
//     'value' => $user_id,
//     'compare' => '='
// );

$args = array(
    'post_type' => 'follow',
    'post_author'  => $cur_user_id,
    'title'        => $title,
    'meta_query' => $search
);
$the_query = new WP_Query($args);

$count = $the_query->post_count;
?>
<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="row">

        <!--  -->
        <div class="container">
            <div class="full-width border-b border-gray pb++">
                <h2 class="mb0"><?php echo $count ?></h2>
                <div>دنبال شونده ها</div>
            </div>

            <!--  -->
            <div class="row pt-4">
                <div class="col-sm-12 min-h-200">
                    <div class="row">
                        <ul class="list-unstyled freelancers col-12">
                            <?php
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                                $use_id = get_post_meta(get_the_ID(), 'user_id', true);
                            ?>
                                <li class="user clearfix freelancer-list-item">
                                    <div class="fixed-col flaot-right">
                                        <div class="profile-card">
                                            <div class="col-md-5 p0 ">

                                                <a target="_Blank" class="avatar" href="<?php echo home_url("user-view/?id=".$use_id) ?>">
                                                    <?php
                                                    $avatar = get_template_directory_uri() . "/assets/img/male.jpg";
                                                    if ( get_the_author_meta('user_sex',$use_id) == "female") {
                                                        $avatar = get_template_directory_uri() . "/assets/img/female.jpg";
                                                    }
                                                    if (strlen(get_the_author_meta('avatar',$use_id))>0) {
                                                        $avatar = get_the_author_meta('avatar',$use_id);
                                                    }
                                                    ?>
                                                    <img class="img-circle profile-60" alt="" src="<?php echo $avatar ?>">

                                                    <span class="verify-status">
                                                        <i class="fa fa-check text-primary"></i>
                                                    </span>
                                                </a>

                                            </div>


                                            <div class="col-md-7 p0">
                                                <a target="_Blank" class="username" href="<?php echo home_url("user-view/?id=".$use_id) ?>" limit="10"><?php echo get_the_author_meta('user_name',$use_id) ?></a>


                                                <div class="fa-0-8em tc-9 pv-"><?php echo get_the_author_meta('user_country',$use_id) ?></div>

                                                <div class="actions d-flex">
                                                    <a class="btn btn-sm invite-btn" rel="nofollow" title="دعوت به همکاری">
                                                        <i class="fa fa-envelope text-success"></i>
                                                    </a>

                                                    <div class="follow-parts">
                                                        <div class="relative follow-btns text-warning bgc-white float-right" rel="loading" style="width: 20px;">
                                                            <i class="fa fa-check text-warning"></i>
                                                        </div>
                                                        <div class="follow-numbers pl flip">
                                                            <b class="fa-1-3em">1</b>
                                                            <br>
                                                            <span class="tc-9">دنبال شونده</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clear"></div>

                                            <div class="desc tc-app-midlight fa-0-8em pt+" data-original-title="" title="" tooltip="">
<?php echo get_the_author_meta('user_desc',$use_id) ?></div>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_query();
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>