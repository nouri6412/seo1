<?php
$rand=rand();
?>
<li class="loop-input-profile-item">
    <div class="wt-accordioninnertitle">
        <span id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" aria-expanded="true" data-target="#innertitle<?php echo $rand; ?>">تجربه کاری جدید</span>
        <div class="wt-rightarea">
            <a href="javascript:void(0);" class="wt-addinfo wt-skillsaddinfo" id="accordioninnertitle<?php echo $rand; ?>" data-toggle="collapse" data-target="#innertitle<?php echo $rand; ?>" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
            <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
        </div>
    </div>
    <div class="wt-collapseexp collapse show" id="innertitle<?php echo $rand; ?>" aria-labelledby="accordioninnertitle<?php echo $rand; ?>" data-parent="#accordion">
        <form class="wt-formtheme wt-userform">
            <fieldset>
                <div class="form-group form-group-half">
                    <input data-id="uni_title" type="text" name="Company Title" class="form-control" placeholder="نام دانشگاه">
                </div>
                <div class="form-group form-group-half">
                    <input data-id="start" type="text" name="Starting Date" class="form-control" placeholder="تاریخ شروع">
                </div>
                <div class="form-group form-group-half">
                    <input data-id="end" type="text" name="Ending Date" class="form-control" placeholder="تاریخ پایان ">
                </div>
                <div class="form-group form-group-half">
                    <input data-id="major_title" type="text" name="Job Title" class="form-control" placeholder="رشته تحصیلی">
                </div>
            </fieldset>
        </form>
    </div>
</li>