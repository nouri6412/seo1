<?php $user_id = get_current_user_id(); ?>

<body class="wt-login">
    <div class="convas-body">
        <div class="body-list">
            <div class="notif">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?php echo home_url('profile?action=my-bell') ?>">مشاهده همه</a>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-sm-12 p-0">
                            <div class="notifications-content">
                                <ul class="list-unstyled">
                                    <?php
                                    $notifi = [];
                                    $str = get_the_author_meta('notifi', $user_id);
                                    if (strlen($str) > 0) {
                                        $notifi = json_decode($str, true);
                                    }
                                    $index = 0;
                                    ?>
                                    <?php for ($x = count($notifi) - 1; $x >= 0; $x--) {
                                        $index++;
                                        if ($index > 10) {
                                            break;
                                        }
                                    ?>
                                        <li class="full-width clearfix">
                                            <div class="visible-table full-width">
                                                <div class="notification-title visible-table-cell">
                                                    <div><?php echo $notifi[$x]["text"]; ?></div>
                                                    <div class="tc-9 pt- fa-0-8em"><?php echo  human_time_diff($notifi[$x]["date"], current_time('timestamp')) . ' ' . 'پیش'  ?></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Preloader Start -->
    <div class="preloader-outer">
        <div class="loader"></div>
    </div>
    <!-- Preloader End -->
    <!-- Wrapper Start -->
    <div id="wt-wrapper" class="wt-wrapper wt-haslayout wt-openmenu">
        <!-- Content Wrapper Start -->
        <div class="wt-contentwrapper">
            <!-- Header Start -->
            <header id="wt-header" class="wt-header wt-haslayout">
                <div class="wt-navigationarea">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <strong style="margin: 15px 0;" class="wt-logo"><a href="<?php echo home_url() ?>"><img style="width: 170px;height:50px;" src="<?php echo get_field('header', 'option')["logo"]; ?>" alt="<?php echo get_bloginfo('name'); ?>"></a></strong>
                                <div class="wt-rightarea">
                                    <nav id="wt-nav" class="wt-nav navbar-expand-lg">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                            <i class="lnr lnr-menu"></i>
                                        </button>
                                        <div class="collapse navbar-collapse wt-navigation" id="navbarNav">
                                            <?php
                                            get_template_part('template-parts/menu/menu', 'content');
                                            ?>
                                        </div>
                                    </nav>
                                    <?php
                                    if (!is_user_logged_in()) {
                                    ?>
                                        <div style="display: block;" class="wt-loginarea">
                                            <figure class="wt-userimg">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/user-login.png" alt="img description">
                                            </figure>
                                            <div class="wt-loginoption">
                                                <a href="javascript:void(0);" id="wt-loginbtn" class="wt-loginbtn">ورود به سیستم</a>
                                                <div class="wt-loginformhold">
                                                    <div class="wt-loginheader">
                                                        <span>ورود به سیستم</span>
                                                        <a href="javascript:;"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    <div class="wt-formtheme wt-loginform do-login-form">
                                                        <fieldset>
                                                            <div class="box-loading">
                                                                <div class="loading-ajax"></div>
                                                            </div>
                                                            <div id="dzFormMsg-error" class="dzFormMsg error"></div>
                                                            <div id="dzFormMsg-doned" class="dzFormMsg doned"></div>
                                                            <div class="form-group">
                                                                <input type="text" id="user_login" name="user_login" class="form-control" placeholder="نام کاربری">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" id="user_pass" name="user_pass" class="form-control" placeholder="رمز عبور">
                                                            </div>
                                                            <div class="wt-logininfo">

                                                                <button onclick="ajax_submit_mbm_login(
										$('#user_login').val()
										,$('#user_pass').val()
										,$('#dzFormMsg-error')
                                        ,$('#dzFormMsg-doned'))" type="button" class="wt-btn do-login-button">ورود به سیستم </button>


                                                                <span class="wt-checkbox">
                                                                    <input id="wt-login" type="checkbox" name="rememberme">
                                                                    <label for="wt-login">اطلاعات مرا به خاطر بسپار</label>
                                                                </span>
                                                            </div>
                                                        </fieldset>
                                                        <div class="wt-loginfooterinfo">
                                                            <a href="javascript:;" class="wt-forgot-password">فراموشی رمز عبور</a>
                                                            <a href="<?php echo home_url('register') ?>">ایجاد حساب</a>
                                                        </div>
                                                    </div>
                                                    <form class="wt-formtheme wt-loginform do-forgot-password-form wt-hide-form">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <input type="email" name="email" class="form-control get_password" placeholder="ایمیل">
                                                            </div>

                                                            <div class="wt-logininfo">
                                                                <a href="javascript:;" class="wt-btn do-get-password">دریافت رمز عبور</a>
                                                            </div>
                                                        </fieldset>
                                                        <div class="wt-loginfooterinfo">
                                                            <a href="javascript:void(0);" class="wt-show-login">ورود به سیستم</a>
                                                            <a href="<?php echo home_url('register') ?>">ایجاد حساب</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a href="<?php echo home_url('register') ?>" class="wt-btn">اکنون بپیوندید</a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div style="display: block;position: relative;" class="wt-userlogedin">
                                            <figure class="wt-userimg">
                                                <?php
                                                $avatar = get_template_directory_uri() . "/assets/img/male.jpg";
                                                if (get_the_author_meta('user_sex', $user_id) == "female") {
                                                    $avatar = get_template_directory_uri() . "/assets/img/female.jpg";
                                                }
                                                if (strlen(get_the_author_meta('avatar', $user_id)) > 0) {
                                                    $avatar = get_the_author_meta('avatar', $user_id);
                                                }
                                                ?>
                                                <img src="<?php echo $avatar; ?>" alt="image description">
                                            </figure>
                                            <div class="wt-username">
                                                <h3> <?php echo get_the_author_meta('user_name', $user_id) ?></h3>
                                            </div>
                                            <nav class="wt-usernav">
                                                <ul>
                                                    <?php
                                                    get_template_part('template-parts/menu/menu', 'top');
                                                    ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!--Header End-->