<?php
$rand = rand();
?>
<li class="loop-input-profile-item">
    <div class="wt-accordioninnertitle">
        <div class="wt-projecttitle collapsed" data-toggle="collapse"  data-target="#innertitleaone<?php echo $rand; ?>">
            <figure>
                <img id="pro-img-<?php echo $rand; ?>" src="<?php echo get_template_directory_uri(); ?>/assets/img/NoImage.jpg" alt="img description">
            </figure>
            <h3>عنوان فایل در اینجا </h3>
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
                <input id="pro-imput-<?php echo $rand; ?>" value="" data-id="img" type="hidden">
                    <input data-id="title" type="text" name="Project Title" class="form-control" placeholder="عنوان فایل">
                </div>
                <div class="form-group">
                    <textarea data-id="desc" name="message" class="form-control" placeholder="شرح فایل"></textarea>
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