<?php
///post type contact

function seo1_post_type_contact()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('ارتباط با ما', 'plural'),
        'singular_name' => _x('ارتباط با ما', 'singular'),
        'menu_name' => _x('ارتباط با ما', 'admin menu'),
        'name_admin_bar' => _x('ارتباط با ما', 'admin bar'),
        'add_new' => _x('ثبت ارتباط با ما جدید', 'add new'),
        'add_new_item' => "ثبت ارتباط با ما جدید",
        'new_item' => "ارتباط با ما جدید",
        'edit_item' => "ویرایش ارتباط با ما",
        'view_item' => "مشاهده ارتباط با ما",
        'all_items' => "همه ارتباط با ما ها",
        'search_items' => "جستجوی ارتباط با ما",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'contact_form'),
        'has_archive' => true,
        'hierarchical' => false,
        // 'capabilities' => array(
        //     'create_posts' => 'do_not_allow'
        // )
    );
    register_post_type('contact_form', $args);
}
add_action('init', 'seo1_post_type_contact');


///post type job

function seo1_post_type_job()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('پروژه', 'plural'),
        'singular_name' => _x(' پروژه', 'singular'),
        'menu_name' => _x('پروژه', 'admin menu'),
        'name_admin_bar' => _x('پروژه', 'admin bar'),
        'add_new' => _x('ثبت پروژه جدید', 'add new'),
        'add_new_item' => "ثبت  پروژه جدید",
        'new_item' => " پروژه جدید",
        'edit_item' => "ویرایش  پروژه",
        'view_item' => "مشاهده  پروژه",
        'all_items' => "همه  پروژه ها",
        'search_items' => "جستجوی  پروژه",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('job', $args);
}
add_action('init', 'seo1_post_type_job');

///post type state

function seo1_post_type_state()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('استان', 'plural'),
        'singular_name' => _x('استان', 'singular'),
        'menu_name' => _x('استان', 'admin menu'),
        'name_admin_bar' => _x('استان', 'admin bar'),
        'add_new' => _x('ثبت استان جدید', 'add new'),
        'add_new_item' => "ثبت  استان جدید",
        'new_item' => " استان  جدید",
        'edit_item' => "ویرایش  استان ",
        'view_item' => "مشاهده  استان",
        'all_items' => "همه  استان ها",
        'search_items' => "جستجوی   استان",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'state'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('state', $args);
}
add_action('init', 'seo1_post_type_state');

///post type city

function seo1_post_type_city()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('شهر', 'plural'),
        'singular_name' => _x('شهر', 'singular'),
        'menu_name' => _x('شهر', 'admin menu'),
        'name_admin_bar' => _x('شهر', 'admin bar'),
        'add_new' => _x('ثبت شهر جدید', 'add new'),
        'add_new_item' => "ثبت  شهر جدید",
        'new_item' => " شهر  جدید",
        'edit_item' => "ویرایش  شهر ",
        'view_item' => "مشاهده  شهر",
        'all_items' => "همه  شهر ها",
        'search_items' => "جستجوی   شهر",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'city'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('city', $args);
}
add_action('init', 'seo1_post_type_city');


/// skills

function seo1_post_type_skill()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('مهارت', 'plural'),
        'singular_name' => _x('مهارت', 'singular'),
        'menu_name' => _x('مهارت', 'admin menu'),
        'name_admin_bar' => _x('مهارت', 'admin bar'),
        'add_new' => _x('ثبت مهارت', 'add new'),
        'add_new_item' => "ثبت مهارت جدید",
        'new_item' => " مهارت جدید",
        'edit_item' => "ویرایش مهارت ",
        'view_item' => "مشاهده مهارت",
        'all_items' => "همه مهارت ها",
        'search_items' => "جستجوی مهارت",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'skill'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('skill', $args);
}
add_action('init', 'seo1_post_type_skill');

/// job cat

function seo1_post_type_job_cat()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('دسته پروژه ها', 'plural'),
        'singular_name' => _x('دسته پروژه ها', 'singular'),
        'menu_name' => _x('دسته پروژه ها', 'admin menu'),
        'name_admin_bar' => _x('دسته پروژه ها', 'admin bar'),
        'add_new' => _x('ثبت  دسته پروژه ها', 'add new'),
        'add_new_item' => "ثبت  دسته پروژه ها جدید",
        'new_item' => " دسته پروژه ها  جدید",
        'edit_item' => "ویرایش  دسته پروژه ها ",
        'view_item' => "مشاهده  دسته پروژه ها",
        'all_items' => "همه  دسته پروژه ها",
        'search_items' => "جستجوی   دسته پروژه ها",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-cat'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('job-cat', $args);
}
add_action('init', 'seo1_post_type_job_cat');

///post type tag

function seo1_post_type_job_tag()
{

    $supports = array(
        'title', // post title
        'thumbnail', // featured images
		'editor',
		'excerpt',
        'custom-fields', // custom fields
        'post-formats', // post formats
		
    );

    $labels = array(
        'name' => _x('برچسب پروژه', 'plural'),
        'singular_name' => _x('برچسب پروژه', 'singular'),
        'menu_name' => _x('برچسب پروژه', 'admin menu'),
        'name_admin_bar' => _x('برچسب پروژه', 'admin bar'),
        'add_new' => _x('ثبت برچسب پروژه جدید', 'add new'),
        'add_new_item' => "ثبت  برچسب پروژه جدید",
        'new_item' => " برچسب پروژه  جدید",
        'edit_item' => "ویرایش  برچسب پروژه ",
        'view_item' => "مشاهده  برچسب پروژه",
        'all_items' => "همه  برچسب پروژه ها",
        'search_items' => "جستجوی   برچسب پروژه",
        'not_found' => "یافت نشد"
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-tag'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('job-tag', $args);
}
add_action('init', 'seo1_post_type_job_tag');