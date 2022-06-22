<?php
class Seo1_User
{
    function save_profile()
    {
        global $wpdb;
        $user_id = get_current_user_id();

        if ($user_id == 0) {
            echo json_encode([]);
            die();
        }

        $result = [];

        $meta = [];

        foreach ($_POST as $key => $post) {
            if ($key != "action") {
                update_user_meta($user_id, $key, $post);
            }
        }

        wp_update_user(array('ID' => $user_id, 'user_email' => $_POST["user_email"]));


        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';

        echo json_encode($result);
        die();
    }

    function save_resume()
    {
        global $wpdb;
        $user_id = get_current_user_id();

        if ($user_id == 0) {
            echo json_encode([]);
            die();
        }

        $result = [];

        $meta = [];

        $meta_key = sanitize_text_field($_POST["meta_key"]);

        $data_str = "";
        $result["html"] = $data_str;

        foreach ($_POST as $key => $post) {
            if ($key != "action" && $key != "meta_key" && $key != "meta_action") {
                $result["html"] = $post;
                // $meta[$key] = sanitize_text_field($post);
                $data_str = $post;
            }
        }

        foreach ($data_str as $key => $item) {
            $result["html"] = $result["html"] . $key . '  - ' . $item;

            if (!is_array($item)) {
                update_user_meta($user_id, $key, $item);
            } else {
                update_user_meta($user_id, $key, json_encode($item, JSON_UNESCAPED_UNICODE));
            }
        }

        $meta_value = json_encode($meta, JSON_UNESCAPED_UNICODE);

        //    update_user_meta($user_id, $meta_key, $meta_value);

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';



        echo json_encode($result);
        die();
    }

    function request_project()
    {
        global $wpdb;
        $user_id = get_current_user_id();

        if ($user_id == 0) {
            echo json_encode([]);
            die();
        }

        $result = [];

        $meta = [];

        $meta_key = sanitize_text_field($_POST["meta_key"]);

        $data_str = "";
        $result["html"] = $data_str; 

        $job_id = $_POST["job_id"];

        foreach ($_POST as $key => $post) {
            if ($key != "action" && $key != "meta_key" && $key != "meta_action" && $key != "job_id") {
                $data_str = $post;
            }
        }
        $error = "";
        if (strlen($data_str["price"]) == 0) {
            $error .= "مقدار پیشنهادی نباید خالی بماند";
        }

        if (strlen($data_str["time"]) == 0) {
            $error .= "<br>" . "زمان پیشنهادی نباید خالی بماند";
        }

        if (strlen($data_str["desc"]) == 0) {
            $error .= "<br>" . "توضیحات نباید خالی بماند";
        }

        if (strlen($error) > 0) {
            $result["state"] = 0;
            $result["job_id"] = $job_id;
            $result["message"] = $error;

            echo json_encode($result);
            die();
            return;
        }


        $args_post = array(
            'post_title'   => get_the_author_meta('user_name', $user_id) . ' ' . date('Y-m-d H:i:s'),
            'post_type'    => 'request',
            'post_author'  => $user_id,
            'post_status'  => 'publish',
            'post_content'      => $data_str["desc"]
        );

        $id = $job_id;


        $job_id = wp_insert_post($args_post);


        update_post_meta($job_id,  "job_id", $id);
        update_post_meta($job_id,  "sender_id", $user_id);
        update_post_meta($job_id,  "owner_id", get_post_field( 'post_author', $id ));


        foreach ($data_str as $key => $item) {
            $result["html"] = $result["html"] . $key . '  - ' . $item;

            if (!is_array($item)) {
                update_post_meta($job_id,  $key, $item);
            } else {
                update_post_meta($job_id,  $key, json_encode($item, JSON_UNESCAPED_UNICODE));
            }
        }

        $meta_value = json_encode($meta, JSON_UNESCAPED_UNICODE);

        //    update_user_meta($user_id, $meta_key, $meta_value);

        $result["state"] = 1;
        $result["job_id"] = $id;
        $result["message"] = 'با موفقیت ذخیره شد';

        echo json_encode($result);
        die();
    }

    function save_project()
    {
        global $wpdb;
        $user_id = get_current_user_id();

        if ($user_id == 0) {
            echo json_encode([]);
            die();
        }

        $result = [];

        $meta = [];

        $meta_key = sanitize_text_field($_POST["meta_key"]);

        $data_str = "";
        $result["html"] = $data_str;

        $job_id = $_POST["job_id"];

        foreach ($_POST as $key => $post) {
            if ($key != "action" && $key != "meta_key" && $key != "meta_action" && $key != "job_id") {
                $data_str = $post;
            }
        }


        $args_post = array(
            'post_title'   => $data_str["title"],
            'post_type'    => 'job',
            'post_author'  => $user_id,
            'post_status'  => 'publish',
            'post_content'      => $data_str["desc"]
        );


        if ($job_id == 0) {
            $job_id = wp_insert_post($args_post);
        } else {
            $my_post = array(
                'ID'            => $job_id,
                'post_title'   => $data_str["title"],
                'post_content'      => $data_str["desc"]
            );
            wp_update_post($my_post);
        }


        update_post_meta($job_id,  'request_id', '0');
        update_post_meta($job_id,  'project_state', '0');

        foreach ($data_str as $key => $item) {
            $result["html"] = $result["html"] . $key . '  - ' . $item;

            if (!is_array($item)) {
                update_post_meta($job_id,  $key, $item);
            } else {
                update_post_meta($job_id,  $key, json_encode($item, JSON_UNESCAPED_UNICODE));
            }
        }

        $meta_value = json_encode($meta, JSON_UNESCAPED_UNICODE);

        //    update_user_meta($user_id, $meta_key, $meta_value);

        $result["state"] = 1;
        $result["job_id"] = $job_id;
        $result["message"] = 'با موفقیت ذخیره شد';

        echo json_encode($result);
        die();
    }


    function get_form()
    {
        $action = sanitize_text_field($_POST["meta_action"]);
        $result = [];
        $result["html"] =  custom_render_php(get_template_directory() . "/template-parts/profile-user/profile-user-" . $action . ".php");

        echo json_encode($result);
        die();
    }

    function get_user()
    {
        $user_id = sanitize_text_field($_POST["user_id"]);
        $req_id = sanitize_text_field($_POST["req_id"]);
        $date = sanitize_text_field($_POST["date"]);
        $result = [];
        $result["state"] = 1;

        $user_info = get_userdata($user_id);
        $user_meta = get_user_meta($user_id);

        set_query_var('user_info', $user_info);
        set_query_var('user_meta', $user_meta);
        set_query_var('req_id', $req_id);
        set_query_var('date', $date);
        set_query_var('user_id', $user_id);

        $result["html"] =  custom_render_php(get_template_directory() . "/template-parts/profile-user/profile-user-resume-popup.php");

        echo json_encode($result);
        die();
    }
}

$Seo1_User = new Seo1_User;
add_action('wp_ajax_mbm_profile_user_profile', array($Seo1_User, 'save_profile'));
add_action('wp_ajax_nopriv_mbm_profile_user_profile', array($Seo1_User, 'save_profile'));

add_action('wp_ajax_mbm_profile_user_save_resume', array($Seo1_User, 'save_resume'));
add_action('wp_ajax_nopriv_mbm_profile_user_save_resume', array($Seo1_User, 'save_resume'));

add_action('wp_ajax_mbm_profile_user_save_project', array($Seo1_User, 'save_project'));
add_action('wp_ajax_nopriv_mbm_profile_user_save_project', array($Seo1_User, 'save_project'));

add_action('wp_ajax_mbm_profile_user_request_project', array($Seo1_User, 'request_project'));
add_action('wp_ajax_nopriv_mbm_profile_user_request_project', array($Seo1_User, 'request_project'));

add_action('wp_ajax_mbm_profile_user_get_form', array($Seo1_User, 'get_form'));
add_action('wp_ajax_nopriv_mbm_profile_user_get_form', array($Seo1_User, 'get_form'));

add_action('wp_ajax_mbm_user_resume_popup', array($Seo1_User, 'get_user'));
add_action('wp_ajax_nopriv_mbm_user_resume_popup', array($Seo1_User, 'get_user'));
