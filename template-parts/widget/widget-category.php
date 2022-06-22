<?php
$cats = get_field('widget-category', 'option');
?>
<div class="wt-widget wt-categoriesholder">
    <div class="wt-widgettitle">
        <h2>دسته بندی ها</h2>
    </div>
    <div class="wt-widgetcontent">
        <ul class="wt-categoriescontent">
            <?php
            if (is_array($cats)) {
                foreach ($cats as $cat) {
            ?>
                    <li><a href="<?php echo get_category_link($cat["cat"]["link"]->term_id) ?>"><?php echo $cat["cat"]["text"] ?></a></li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</div>