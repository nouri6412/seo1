<?php
$skill=$_POST['skill'];
$persent=$_POST['persent'];
if(strlen($skill)==0)
{
return;
}
$post = get_post($skill);
?>
<li class="loop-input-profile-item">
    <div class="wt-dragdroptool">
        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
    </div>
    <span class="skill-dynamic-html"><?php echo $post->post_title; ?> (<em class="skill-val"><?php echo $persent; ?></em>%)</span>
    <span class="skill-dynamic-field">

        <input data-id="user_skill_persent" type="text" name="skills[1][percentage]" value="<?php echo $persent; ?>">
        <input data-id="user_skill" type="hidden" value="<?php echo $skill; ?>" />
    </span>
    <div id="item-skills-btn" class="wt-rightarea">
        <a onclick="my_skill_btn_add(jQuery(this))" href="javascript:void(0);" class="wt-addinfo"><i class="lnr lnr-pencil"></i></a>
        <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
    </div>
</li>