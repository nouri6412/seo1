<?php
$skill=$_POST['skill'];
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
    <span class="skill-dynamic-html"><?php echo $post->post_title; ?></span>
    <span class="skill-dynamic-field">
        <input data-id="skill" type="hidden" value="<?php echo $skill; ?>" />
    </span>
    <div id="item-skills-btn" class="wt-rightarea">
        <a onclick="my_skill_btn_delete(jQuery(this))" href="javascript:void(0);" class="wt-deleteinfo"><i class="lnr lnr-trash"></i></a>
    </div>
</li>