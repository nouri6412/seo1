<?php
$user_id = get_current_user_id();


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$search = array();

$search["relation"] = "OR";
$search[] =           array(
    'key' => 'owner_id',
    'value' => $user_id,
    'compare' => '='
);

$search[] =           array(
    'key' => 'sender_id',
    'value' => $user_id,
    'compare' => '='
);

$args = array(
    'post_type' => 'request',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => 10,
    'meta_query' => $search
);
$the_query = new WP_Query($args);


$count = $the_query->post_count;

$request_id = 0;
$chat = [];
if (isset($_GET["request_id"])) {
    $request_id = $_GET["request_id"];
    $str = get_post_meta($request_id, 'chat', true);
    if (strlen($str) > 0) {
        $chat = json_decode($str, true);
    }
    update_post_meta($request_id, "new_message", 0);
}


if (count($chat) == 0) {
    $message = get_post_meta($request_id, 'desc', true);
    if (strlen($message) > 0) {
        $chat[] = ["user_id" => get_post_meta($request_id, 'owner_id', true), "text" => $message, "date" => get_the_time('U', $request_id)];
    }
}

$message = "";

if (isset($_POST["message"])) {
    $message = trim($_POST["message"]);
    $d = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
    $chat[] = ["user_id" => $user_id, "text" => $message, "date" => $d];
    update_post_meta($request_id, "chat", json_encode($chat, JSON_UNESCAPED_UNICODE));
    update_post_meta($request_id, "new_message", 1);
    update_post_meta($request_id, "new_message_desc", $message);
}

?>
<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-dashboardbox wt-messages-holder">
        <div class="wt-dashboardboxtitle">
            <h2>پیام ها</h2>
        </div>
        <div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages">
            <ul>
                <li>
                    <!-- <form class="wt-formtheme wt-formsearch">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" name="Location" class="form-control" placeholder="اینجا  جستجو کنید">
                                <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                            </div>
                        </fieldset>
                    </form> -->
                    <div class="wt-verticalscrollbar wt-dashboardscrollbar">
                        <?php
                        while ($the_query->have_posts()) :
                            $the_query->the_post();
                            $job_id = get_post_meta(get_the_ID(), 'job_id', true);
                            //$request_id = get_post_meta($job_id, 'request_id', true);
                            $class = " wt-dotnotification wt-active";
                            $class = "";
                        ?>
                            <div class="wt-ad <?php echo $class ?>">
                                <a href="<?php echo home_url('profile?action=message&request_id=' . get_the_ID()) ?>">
                                    <figure><img src="<?php echo (strlen(get_the_author_meta('avatar')) > 0) ? get_the_author_meta('avatar') : get_template_directory_uri() . '/assets/img/user.png' ?>" alt="image description"></figure>
                                    <div class="wt-adcontent">
                                        <h3><?php
                                            $new_message = get_post_meta(get_the_ID(), 'new_message', true);

                                            echo get_the_author_meta('user_name');
                                            if ($new_message == 1) {
                                                echo '<span style="font-size:10px;margin-right:10px;color:red">پیام جدید</span>';
                                            }
                                            ?></h3>
                                        <span><?php echo (strlen(get_the_author_meta('job_title')) > 0) ? get_the_author_meta('job_title') : get_the_author_meta('user_country')   ?></span>
                                    </div>
                                </a>
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
                </li>
                <li>
                    <?php if (count($chat) == 0) { ?>
                        <div class="wt-chatarea wt-chatarea-empty">
                            <figure class="wt-chatemptyimg">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/message-img.png" alt="img description">
                                <figcaption>
                                    <h3>پیامی انتخاب نشده است</h3>
                                </figcaption>
                            </figure>
                        </div>
                    <?php } ?>
                    <div class="wt-chatarea">
                        <div class="wt-messages wt-verticalscrollbar wt-dashboardscrollbar">
                            <?php $index = 65;
                            foreach ($chat as $item) {

                                $style = "";
                                $class = "wt-memessage wt-readmessage";
                                if ($user_id != $item["user_id"]) {
                                    $class = "wt-offerermessage";
                                }
                            ?>
                                <div style="margin-top: <?php echo $index ?>px;" class="<?php echo $class ?>">
                                    <figure><img src="<?php echo (strlen(get_the_author_meta('avatar', $item["user_id"])) > 0) ? get_the_author_meta('avatar', $item["user_id"]) : get_template_directory_uri() . '/assets/img/user.png' ?>" alt="image description"></figure>
                                    <div class="wt-description">
                                        <p><?php echo $item["text"]; ?></p>
                                        <div class="clearfix"></div>
                                        <time datetime="2017-08-08"><?php echo  human_time_diff($item["date"], current_time('timestamp')) . ' ' . 'پیش'  ?></time>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php $index = 0;
                            } ?>
                        </div>
                        <div class="wt-replaybox">
                            <form method="post" action="<?php echo home_url('profile?action=message&request_id=' . $request_id) ?>">
                                <div class="form-group">
                                    <textarea id="message" name="message" class="form-control" name="reply" placeholder="پیام را اینجا تایپ کنید"></textarea>
                                </div>
                                <div class="wt-iconbox">
                                    <i class="lnr lnr-thumbs-up"></i>
                                    <i class="lnr lnr-thumbs-down"></i>
                                    <i class="lnr lnr-smile"></i>
                                    <button type="submit" class="wt-btnsendmsg">ارسال</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>