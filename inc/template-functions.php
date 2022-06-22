<?php
/**
 * Filters the default archive titles.
 */
function custom_theme_get_the_archive_title() {
	if ( is_category() ) {
		$title = 'دسته' .' '. '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = 'تگ' .' '. '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = 'نویسنده'.' ' . '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = 'سال' .' '. '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentynineteen' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = 'ماه'.' ' . '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentynineteen' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = 'روز' .' '. '<span class="page-description">' . custom_get_the_date(get_the_ID()) . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = '' . '<span class="page-description">' . post_type_archive_title( '', false ) . '</span>';
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: %s: Taxonomy singular name. */
		$title = sprintf( esc_html__( '%s :', 'twentynineteen' ), $tax->labels->singular_name );
	} else {
		$title = '';
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'custom_theme_get_the_archive_title' );

function custom_generate_menu_li($navItem, $menu)
{
    $item_class = "";
    $i = '';
    $item_class="nav-item";
    if (isset($menu[$navItem->ID])) {
      $item_class="menu-item-has-children page_item_has_children";
    }
?>
    <li class="<?php echo $item_class; ?>">
        <a href="<?php echo $navItem->url; ?>"><?php echo $navItem->title; ?><?php echo $i; ?></a>
        <?php
        if (isset($menu[$navItem->ID])) {
        ?>
            <ul class="sub-menu">
                <?php
                foreach ($menu[$navItem->ID] as $item) {
                    custom_generate_menu_li($item, $menu);
                }
                ?>

            </ul>
        <?php
        }
        ?>
    </li>
<?php
}