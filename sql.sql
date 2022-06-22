SELECT * FROM `wp_posts` WHERE post_parent>0 and post_type='attachment' and (post_mime_type ='image/png' or post_mime_type ='image/jpg' or post_mime_type ='image/jpeg')  
ORDER BY `wp_posts`.`post_mime_type`  ASC

SELECT * FROM `wp_postmeta`  where meta_key = '_thumbnail_id'