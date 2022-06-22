<?php
$user_id = get_current_user_id();
$job_id = 0;
$title = "ایجاد پروژه";
if (isset($_GET["job_id"])) {
    $job_id = $_GET["job_id"];
    $title = "ویرایش پروژه";

    $job = get_post($job_id);

    $author = $job->post_author;

    if ($user_id != $author && $job_id > 0) {
        die();
    }
}

?>
<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="wt-dashboardbox wt-dashboardtabsholder">
            <div class="wt-dashboardboxtitle">
                <?php if (isset($_GET["created"]) && $_GET["created"] == 1) { ?>
                    <div class="alert alert-success">پروژه با موفقیت ذخیره شد</div>
                <?php  } ?>
                <h2><?php echo $title; ?> </h2>
            </div>
            <div id="form-profile" class="my-form">
                <div class="wt-personalskillshold tab-pane active fade show" id="wt-skills">
                    <div class="wt-yourdetails wt-tabsinfo">
                        <div class="wt-formtheme wt-userform">
                            <fieldset>
                                <div class="form-group">
                                    <div class="desc-label">
                                        <span>1</span>
                                        <label>چه کاری می خواهید برای شما انجام شود؟</label>
                                    </div>
                                    <label>دسته بندی پروژه</label>
                                    <span class="wt-select">
                                        <select data-id="cat_id" class="input-profile">
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
                                                $cat_id = get_post_meta($job_id, 'cat_id', true);

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
                                <div class="form-group">
                                    <div class="desc-label">
                                        <span>2</span>
                                        <label>پروژه شما درباره چیست؟</label>
                                    </div>

                                    <label for="title">عنوان پروژه</label>
                                    <input value="<?php echo get_post_meta($job_id, 'title', true); ?>" type="text" name="title" data-id="title" class="form-control input-profile" placeholder="عنوان پروژه">
                                </div>

                                <div class="form-group ">
                                    <div class="desc-label">
                                        <span>3</span>
                                        <label>چقدر زمان لازم است پروژه پیاده سازی شود؟</label>
                                    </div>
                                </div>

                                <div class="form-group form-group-half">
                                    <label> زمان پروژه (روز)</label>
                                    <input value="<?php echo get_post_meta($job_id, 'time', true); ?>" type="number" name="time" data-id="time" class="form-control input-profile" placeholder="زمان پروژه (روز)">
                                </div>

                                <div class="form-group form-group-half">
                                    <label> زمان انقضا (روز)</label>
                                    <input value="<?php echo (strlen(get_post_meta($job_id, 'expire', true)) > 0) ? get_post_meta($job_id, 'expire', true) : '60'; ?>" type="number" name="expire" data-id="expire" class="form-control input-profile" placeholder="زمان انقضا (روز)">
                                </div>


                                <div class="form-group ">
                                    <div class="desc-label">
                                        <span>4</span>
                                        <label>بودجه شما چقدر است</label>
                                    </div>

                                </div>

                                <div class="form-group form-group-half">

                                    <label>حداقل بودجه (دلار)</label>
                                    <input value="<?php echo get_post_meta($job_id, 'min_price', true); ?>" type="number"  class="form-control input-profile" data-id="min_price" placeholder="حداقل بودجه (دلار)">
                                </div>
                                <div class="form-group form-group-half">
                                    <label>حداکثر بودجه (دلار)</label>
                                    <input value="<?php echo get_post_meta($job_id, 'max_price', true); ?>" type="number"  class="form-control input-profile" data-id="max_price" placeholder="حداکثر بودجه (دلار)">
                                </div>
                                <div class="form-group">
                                    <div class="desc-label">
                                        <span>5</span>
                                        <label>درباره پروژه خود بیشتر بگویید</label>
                                    </div>
                                    <label>پروژه خود را توضیح دهید</label>
                                    <textarea data-id="desc" name="message" class="form-control input-profile" placeholder="پروژه خود را توضیح دهید"><?php echo get_post_meta($job_id, 'desc', true); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>مهارت های مورد نیاز</label>
                                    <input type="text" value="<?php echo get_post_meta($job_id, 'skills', true); ?>" class="form-control input-profile tags_input" data-id="skills" placeholder="مهارت های موردنیاز">
                                </div>
                               
                                <div class="form-group plan-project">
                                    <span class="wt-checkbox ">
                                        <input <?php echo (get_post_meta($job_id, 'plan_1', true)=='1'? 'checked' :'') ?> data-id="plan_1" style="display: inline;"  class="input-profile-check" type="checkbox" value="termsconditions">
                                        <div class="plan-project-title"><?php echo 'برجسته' .' '.'(50 $)'?></div><span class="plan-project-detail">پروژه برجسته به دلیل برجسته بودن بیشتر مورد توجه فریلنسرهای حرفه ای قرار می گیرد و فریلنسرهای بیشتری در پروژه شرکت خواهند کرد.</span>
                                    </span>
                                </div>
                                <div class="form-group plan-project">
                                    <span class="wt-checkbox ">
                                        <input <?php echo (get_post_meta($job_id, 'plan_2', true)=='1'? 'checked' :'') ?> data-id="plan_2" style="display: inline;"  class="input-profile-check" type="checkbox" value="termsconditions">
                                        <div class="plan-project-title"><?php echo 'فوری' .' '.' '.'(50 $)'?></div><span class="plan-project-detail">پروژه فوری نشانگر عجله کارفرما برای انجام هرچه سریع تر پروژه است و مورد توجه فریلنسرهای حرفه ای که علاقه دارند زودتر پروژه دریافت کنند قرار می گیرد.</span>
                                    </span>
                                </div>
                                <div class="form-group plan-project">
                                    <span class="wt-checkbox ">
                                        <input <?php echo (get_post_meta($job_id, 'plan_3', true)=='1'? 'checked' :'') ?> data-id="plan_3" style="display: inline;"  class="input-profile-check" type="checkbox" value="termsconditions">
                                        <div class="plan-project-title"><?php echo 'محرمانه' .' '.' '.'(50 $)'?></div><span class="plan-project-detail">
با انتخاب این قسمت توضیحات پروژه شما فقط به کاربرانی که وارد سایت شده اند نمایش داده می شود و پروژه به موتور های جستجو معرفی نمی شود.</span>
                                    </span>
                                </div>
                                <div class="form-group plan-project">
                                    <span class="wt-checkbox ">
                                        <input <?php echo (get_post_meta($job_id, 'plan_4', true)=='1'? 'checked' :'') ?> data-id="plan_4" style="display: inline;"  class="input-profile-check" type="checkbox" value="termsconditions">
                                        <div class="plan-project-title"><?php echo 'تمام وقت' .' '.' '.'(50 $)'?></div><span class="plan-project-detail">
                                        در پروژه تمام وقت از کارفرما و فریلنسر تا سقف 1000 دلار کمیسیون دریافت نمی شود. پروژه های بازاریابی و استخدامی و حضوری می بایست بصورت تمام وقت ایجاد شود.
                                        </span>
                                    </span>
                                </div>
                                <div class="form-group plan-project">
                                    <span class="wt-checkbox ">
                                        <input <?php echo (get_post_meta($job_id, 'plan_5', true)=='1'? 'checked' :'') ?> data-id="plan_5" style="display: inline;"  class="input-profile-check" type="checkbox" value="termsconditions">
                                        <div class="plan-project-title"><?php echo 'متمایز' .' '.' '.'(50 $)'?></div><span class="plan-project-detail">
                                        رنگ پیش زمینه پروژه شما در فهرست پروژه ها متمایز از بقیه پروژه ها خواهد بود. این کار باعث می شود فریلنسرهای بیشتری به پروژه شما توجه کنند.                                        </span>
                                    </span>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div style="display: none;" class="wt-addprojectsholder wt-tabsinfo">
                        <div style="padding-top: 40px;" class="wt-tabscontenttitle wt-addnew">
                            <h2>فایل های پروژه را اضافه کنید</h2>
                            <a onclick="ajax_submit_mbm_post_data_resume_get_form(
            {
                'action': 'mbm_profile_user_get_form',
                'meta_action':'pro-form-file'
            }
            ,'items-file'
        )" href="javascript:void(0);">افزودن جدید</a>
                        </div>
                        <ul data-id="files" id="items-file" class="wt-experienceaccordion accordion loop-input-profile">
                            <?php
                            $json = json_decode(get_post_meta($job_id, 'files', true), true);
                            if (is_array($json)) {

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
                                                <h3><?php echo $item["title"] ?></span></h3>
                                            </div>
                                            <div class="wt-rightarea">
                                                <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" data-toggle="collapse" data-target="#innertitleaone<?php echo $rand; ?>"><i class="lnr lnr-pencil"></i></a>
                                                <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="wt-collapseexp collapse" id="innertitleaone<?php echo $rand; ?>" aria-labelledby="accordioninnertitle" data-parent="#accordion">
                                            <form class="wt-formtheme wt-userform wt-formprojectinfo">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input id="pro-imput-<?php echo $rand; ?>" value="<?php echo $item["img"] ?>" data-id="img" type="hidden">

                                                        <input value="<?php echo $item["title"] ?>" data-id="title" type="text" name="Project Title" class="form-control" placeholder="عنوان فایل">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea data-id="desc" name="message" class="form-control" placeholder="شرح فایل"><?php echo $item["desc"] ?></textarea>
                                                    </div>
                                                    <div class="form-group form-group-label wt-infouploading">
                                                        <div class="wt-labelgroup">
                                                            <label for="filen-<?php echo $rand; ?>">
                                                                <span class="wt-btn">انتخاب تصویر فایل </span>
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
        <span>برای اعمال تغییرات گزینه ذخیره پروژه را بزنید</span>
        <button onclick="ajax_submit_mbm_post_data_resume_save_form(
            {
                'action': 'mbm_profile_user_save_project',
                'job_id':<?php echo $job_id ?>,
                'meta_key':'profile',
                'meta_action':'profile',
            }
            ,'form-profile'
            ,$('#dzFormMsg-error-profile'),
            1
        )" type="button" class="wt-btn">ذخیره پروژه</button>
        <div class="box-loading">
            <div class="loading-ajax"></div>
        </div>
        <div id="dzFormMsg-error-profile" class="dzFormMsg error"></div>
    </div>
</div>