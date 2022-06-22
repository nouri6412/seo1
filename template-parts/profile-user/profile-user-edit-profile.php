<?php
$user_info = get_query_var('user_info');
$user_meta = get_query_var('user_meta');

?>
<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="wt-dashboardbox wt-dashboardtabsholder">
            <div class="wt-dashboardboxtitle">
                <h2>پروفایل من </h2>
            </div>
            <div class="wt-dashboardtabs">
                <ul class="wt-tabstitle nav navbar-nav">
                    <li class="nav-item">
                        <a class="active" data-toggle="tab" href="#wt-skills">اطلاعات شخصی و مهارت ها </a>
                    </li>
                    <li class="nav-item"><a data-toggle="tab" href="#wt-education">تجربه و آموزش </a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#wt-awards">پروژه ها و نمونه کارها </a></li>
                </ul>
            </div>
            <div id="form-profile" class="wt-tabscontent tab-content">
                <div class="wt-personalskillshold tab-pane active fade show" id="wt-skills">
                    <div class="wt-yourdetails wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>اطلاعات شما </h2>
                        </div>
                        <div class="wt-formtheme wt-userform">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <span class="wt-select">
                                        <select data-id="user_sex" class="input-profile">
                                            <option <?php echo (isset($user_meta["user_sex"]) && $user_meta["user_sex"][0] == "other") ? 'selected' : ''; ?> value="other" disabled="">جنسیت را انتخاب کنید</option>
                                            <option <?php echo (isset($user_meta["user_sex"]) && $user_meta["user_sex"][0] == "male") ? 'selected' : ''; ?> value="male">مرد</option>
                                            <option <?php echo (isset($user_meta["user_sex"]) && $user_meta["user_sex"][0] == "female") ? 'selected' : ''; ?> value="female">زن</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["user_name"]) ? $user_meta["user_name"][0] : ''; ?>" type="text" name="first name" data-id="user_name" class="form-control input-profile" placeholder="نام و نام خانوادگی">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo isset($user_meta["company_name"]) ? $user_meta["company_name"][0] : ''; ?>" type="text" name="first name" data-id="company_name" class="form-control input-profile" placeholder="نام شرکت">
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["job_title"]) ? $user_meta["job_title"][0] : ''; ?>" type="text" name="first name" data-id="job_title" class="form-control input-profile" placeholder="عنوان شغلی">
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["tel"]) ? $user_meta["tel"][0] : ''; ?>" type="text"  data-id="tel" class="form-control input-profile" placeholder="شماره موبایل">
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["user_nerx"]) ? $user_meta["user_nerx"][0] : ''; ?>" type="number"  class="form-control input-profile" data-id="user_nerx" placeholder="نرخ ساعتی خدمات شما (دلار)">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo isset($user_meta["user_address"]) ? $user_meta["user_address"][0] : ''; ?>" data-id="user_address" type="text" name="tagline" class="form-control input-profile" placeholder="نشانی خود را اینجا اضافه کنید">
                                </div>
                                <div class="form-group">
                                    <textarea data-id="user_desc" name="message" class="form-control input-profile" placeholder="توضیحات"><?php echo isset($user_meta["user_desc"]) ? $user_meta["user_desc"][0] : ''; ?></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="wt-profilephoto wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>عکس پروفایل</h2>
                        </div>
                        <div class="wt-profilephotocontent">
                            <div class="wt-description">
                            </div>
                            <form class="wt-formtheme wt-formprojectinfo wt-formcategory">
                                <fieldset>
                                    <div class="form-group form-group-label">
                                        <div class="wt-labelgroup">
                                            <label for="filep">
                                                <span class="wt-btn">انتخاب فایل </span>
                                                <input onchange="ajax_mbm_upload_image($(this),'profile-avatar')" type="file" name="file" id="filep">
                                            </label>
                                            <span> فایل را برای بارگذاری اینجا رها کنید </span>
                                            <em class="wt-fileuploading">بارگذاری<i class="fa fa-spinner fa-spin"></i></em>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <ul class="wt-attachfile wt-attachfilevtwo">
                                            <li class="wt-uploadingholder wt-companyimg-user">
                                                <div class="wt-uploadingbox">
                                                    <figure>
                                                        <?php
                                                        $avatar = get_template_directory_uri() . "/assets/img/male.jpg";
                                                        if (isset($user_meta['user_sex']) && $user_meta['user_sex'][0] == "female") {
                                                            $avatar = get_template_directory_uri() . "/assets/img/female.jpg";
                                                        }
                                                        if (isset($user_meta['avatar'])) {
                                                            $avatar = $user_meta['avatar'][0];
                                                        }
                                                        ?>
                                                        <img id="profile-avatar" src="<?php echo $avatar; ?>">
                                                    </figure>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="wt-bannerphoto wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>عکس بنر</h2>
                        </div>
                        <div class="wt-profilephotocontent">
                            <div class="wt-description">
                            </div>
                            <form class="wt-formtheme wt-formprojectinfo wt-formcategory">
                                <fieldset>
                                    <div class="form-group form-group-label">
                                        <div class="wt-labelgroup">
                                            <label for="filew">
                                                <span class="wt-btn">انتخاب فایل </span>
                                                <input onchange="ajax_mbm_upload_image($(this),'profile-avatar-bg','avatar_bg')" type="file" name="file" id="filew">
                                            </label>
                                            <span> فایل را برای بارگذاری اینجا رها کنید </span>
                                            <em class="wt-fileuploading">بارگذاری<i class="fa fa-spinner fa-spin"></i></em>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <ul class="wt-attachfile wt-attachfilevtwo">
                                            <li class="wt-uploadingholder">
                                                <div class="wt-uploadingbox">
                                                    <div class="wt-designimg">
                                                        <input id="demoq" type="radio" name="employees" value="company" checked="">
                                                        <label for="demoq">
                                                            <?php
                                                            $avatar = get_template_directory_uri() . "/assets/images/company/img-10.jpg";
                                                            if (isset($user_meta['avatar_bg'])) {
                                                                $avatar = $user_meta['avatar_bg'][0];
                                                            }
                                                            ?>
                                                            <img id="profile-avatar-bg" src="<?php echo $avatar; ?>">
                                                            <i class="fa fa-check"></i></label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="wt-location wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2> مکان شما</h2>
                        </div>
                        <form class="wt-formtheme wt-userform">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["user_country"]) ? $user_meta["user_country"][0] : ''; ?>" type="text"  class="form-control input-profile" data-id="user_country" placeholder="کشور">
                                </div>
                                <!-- <div class="form-group wt-formmap">
                                    <div id="wt-locationmap" class="wt-locationmap"></div>
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["user_lng"]) ? $user_meta["user_lng"][0] : ''; ?>" data-id="user_lng" type="text" name="text" class="form-control input-profile" placeholder="طول جغرافیایی وارد کنید (اختیاری)">
                                </div>
                                <div class="form-group form-group-half">
                                    <input value="<?php echo isset($user_meta["user_lat"]) ? $user_meta["user_lat"][0] : ''; ?>" data-id="user_lat" type="text" name="text" class="form-control input-profile" placeholder=" عرض جغرافیایی وارد کنید (اختیاری)">
                                </div> -->

                                <div class="form-group">
                                    <label>مهارت های من</label>
                                <input type="text" value="<?php echo isset($user_meta["skills"]) ? $user_meta["skills"][0] : ''; ?>" class="form-control input-profile tags_input" data-id="skills" placeholder=" مهارت های من ">
                                </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="wt-educationholder tab-pane fade" id="wt-education">
                    <div class="wt-userexperience wt-tabsinfo">
                        <div class="wt-tabscontenttitle wt-addnew">
                            <h2>تجربه خود را اضافه کنید </h2>
                            <a onclick="ajax_submit_mbm_post_data_resume_get_form(
            {
                'action': 'mbm_profile_user_get_form',
                'meta_action':'exp-form'
            }
            ,'items-exp'
        )" href="javascript:void(0);"> افزودن جدید</a>
                        </div>
                        <ul data-id="user_exp" id="items-exp" class="wt-experienceaccordion accordion loop-input-profile">
                            <?php
                            if (isset($user_meta["user_exp"])) {
                                $json = json_decode($user_meta["user_exp"][0], true);
                                foreach ($json as $item) {
                            ?>
                                    <?php
                                    $rand = rand();
                                    ?>
                                    <li class="loop-input-profile-item">
                                        <div class="wt-accordioninnertitle">
                                            <span id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" data-target="#innertitle<?php echo $rand; ?>"><?php echo $item["job_title"] ?><em>(<?php echo $item["start"] . ' - ' . $item["end"] ?>)</em></span>
                                            <div class="wt-rightarea">
                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" data-target="#innertitle<?php echo $rand; ?>" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                                                <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="wt-collapseexp collapse show" id="innertitle<?php echo $rand; ?>" aria-labelledby="accordioninnertitle<?php echo $rand; ?>" data-parent="#accordion">
                                            <form class="wt-formtheme wt-userform">
                                                <fieldset>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["company_title"] ?>" data-id="company_title" type="text" name="Company Title" class="form-control" placeholder="عنوان شرکت">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["start"] ?>" data-id="start" type="text" name="Starting Date" class="form-control" placeholder="تاریخ شروع">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["end"] ?>" data-id="end" type="text" name="Ending Date" class="form-control" placeholder="تاریخ پایان ">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["job_title"] ?>" data-id="job_title" type="text" name="Job Title" class="form-control" placeholder="عنوان شغل شما">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea data-id="job_desc"  class="form-control" placeholder="شرح شغل شما"><?php echo $item["job_desc"] ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <span>* اگر پایان کار شغل فعلی شماست ، تاریخ خالی بگذارید </span>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="wt-userexperience">
                        <div class="wt-tabscontenttitle wt-addnew">
                            <h2>تحصیلات خود را اضافه کنید </h2>
                            <a onclick="ajax_submit_mbm_post_data_resume_get_form(
            {
                'action': 'mbm_profile_user_get_form',
                'meta_action':'edu-form'
            }
            ,'items-edu'
        )" href="javascript:void(0);"> افزودن جدید</a>
                        </div>
                        <ul data-id="user_edu" id="items-edu" class="wt-experienceaccordion accordion loop-input-profile">
                            <?php
                            if (isset($user_meta["user_edu"])) {
                                $json = json_decode($user_meta["user_edu"][0], true);
                                foreach ($json as $item) {
                            ?>
                                    <?php
                                    $rand = rand();
                                    ?>
                                    <li class="loop-input-profile-item">
                                        <div class="wt-accordioninnertitle">
                                            <span id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" data-target="#innertitle<?php echo $rand; ?>"><?php echo $item["major_title"] ?><em>(<?php echo $item["start"] . ' - ' . $item["end"] ?>)</em></span>
                                            <div class="wt-rightarea">
                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" data-target="#innertitle<?php echo $rand; ?>" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                                                <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="wt-collapseexp collapse show" id="innertitle<?php echo $rand; ?>" aria-labelledby="accordioninnertitle<?php echo $rand; ?>" data-parent="#accordion">
                                            <form class="wt-formtheme wt-userform">
                                                <fieldset>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["uni_title"] ?>" data-id="uni_title" type="text" name="Company Title" class="form-control" placeholder="نام دانشگاه">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["start"] ?>" data-id="start" type="text" name="Starting Date" class="form-control" placeholder="تاریخ شروع">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["end"] ?>" data-id="end" type="text" name="Ending Date" class="form-control" placeholder="تاریخ پایان ">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["major_title"] ?>" data-id="major_title" type="text" name="Job Title" class="form-control" placeholder="عنوان رشته تحصیلی">
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="wt-awardsholder tab-pane fade" id="wt-awards">
                    <div class="wt-addprojectsholder wt-tabsinfo">
                        <div class="wt-tabscontenttitle wt-addnew">
                            <h2>پروژه های خود را اضافه کنید</h2>
                            <a onclick="ajax_submit_mbm_post_data_resume_get_form(
            {
                'action': 'mbm_profile_user_get_form',
                'meta_action':'pro-form'
            }
            ,'items-pro'
        )" href="javascript:void(0);">افزودن جدید</a>
                        </div>
                        <ul data-id="user_pro" id="items-pro" class="wt-experienceaccordion accordion loop-input-profile">
                            <?php
                            if (isset($user_meta["user_pro"])) {
                                $json = json_decode($user_meta["user_pro"][0], true);
                                foreach ($json as $item) {
                            ?>
                                    <?php
                                    $rand = rand();
                                    ?>
                                    <li class="loop-input-profile-item">
                                        <div class="wt-accordioninnertitle">
                                            <div class="wt-projecttitle collapsed" data-toggle="collapse" data-target="#innertitleaone<?php echo $rand; ?>">
                                                <figure>
                                                    <img id="pro-img-<?php echo $rand; ?>" src="<?php echo (strlen($item["img"]) > 0) ? $item["img"] : get_template_directory_uri() . '/assets/img/NoImage.jpg'; ?>" alt="img description">
                                                </figure>
                                                <h3><?php echo $item["title"] ?> <span><?php echo $item["address"] ?></span></h3>
                                            </div>
                                            <div class="wt-rightarea">
                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" data-toggle="collapse" data-target="#innertitleaone<?php echo $rand; ?>"><i class="lnr lnr-pencil"></i></a>
                                                <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="wt-collapseexp collapse" id="innertitleaone<?php echo $rand; ?>" aria-labelledby="accordioninnertitle" data-parent="#accordion">
                                            <form class="wt-formtheme wt-userform wt-formprojectinfo">
                                                <fieldset>
                                                    <div class="form-group form-group-half">
                                                        <input id="pro-imput-<?php echo $rand; ?>" value="<?php echo $item["img"] ?>" data-id="img" type="hidden">

                                                        <input value="<?php echo $item["title"] ?>" data-id="title" type="text" name="Project Title" class="form-control" placeholder="عنوان پروژه">
                                                    </div>
                                                    <div class="form-group form-group-half">
                                                        <input value="<?php echo $item["address"] ?>" data-id="address" type="text" name="Project URL" class="form-control" placeholder="آدرس پروژه">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea data-id="desc" name="message" class="form-control" placeholder="شرح پروژه"><?php echo $item["desc"] ?></textarea>
                                                    </div>
                                                    <div class="form-group form-group-label wt-infouploading">
                                                        <div class="wt-labelgroup">
                                                            <label for="filen-<?php echo $rand; ?>">
                                                                <span class="wt-btn">انتخاب تصویر پروژه </span>
                                                                <input onchange="ajax_mbm_upload_image($(this),'pro-img-<?php echo $rand; ?>','temp_pro_img','pro-imput-<?php echo $rand; ?>')" type="file" name="file-<?php echo $rand; ?>" id="filen-<?php echo $rand; ?>">
                                                            </label>
                                                            <span> فایل را برای بارگذاری اینجا رها کنید </span>
                                                            <em class="wt-fileuploading">بارگذاری<i class="fa fa-spinner fa-spin"></i></em>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-updatall">
        <i class="ti-announcement"></i>
        <span>تنها با کلیک روی دکمه "ذخیره و ادامه" ، آخرین تغییرات ایجاد شده توسط خود را به روز کنید.</span>
        <button onclick="ajax_submit_mbm_post_data_resume_save_form(
            {
                'action': 'mbm_profile_user_save_resume',
                'meta_key':'profile',
                'meta_action':'profile',
            }
            ,'form-profile'
            ,$('#dzFormMsg-error-profile')
        )" type="button" class="wt-btn">ذخیره و به روز رسانی</button>
        <div class="box-loading">
            <div class="loading-ajax"></div>
        </div>
        <div id="dzFormMsg-error-profile" class="dzFormMsg error"></div>
    </div>
</div>