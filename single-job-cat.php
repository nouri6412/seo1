<?php

/** 
 * The template for displaying job single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kaktos
 * @since Kaktos 1.0
 */

get_header();

?>
<!-- Content -->
<div class="page-content bg-white">
    <?php
$cat_id=0;
    // Start the Loop.
    while (have_posts()) :
        the_post();
$cat_id=get_the_ID();
    ?>

    <?php

    endwhile; // End the loop.
    ?>
</div>
<!-- Content END-->
<script>
window.location.href='<?php echo site_url('search-job?cat_id='.$cat_id) ?>';
</script>
