<?php

class Seo1_Company
{
    function save_profile()
    {
        global $wpdb;
        $user_id = get_current_user_id();
        
        if($user_id==0)
        {
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

        wp_update_user( array( 'ID' => $user_id, 'user_email' => $_POST["user_email"] ) );


        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';

        echo json_encode($result);
        die();
    }

    function change_pass()
    {
        global $wpdb;
        $user_id = get_current_user_id();
        
        if($user_id==0)
        {
            echo json_encode([]);
            die();
        }

        wp_set_password( sanitize_text_field($_POST["new_pass"]), $user_id );

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';

        $notifi = [];
        $str = get_the_author_meta('notifi', $user_id);
        if (strlen($str) > 0) {
            $notifi = json_decode($str, true);
        }

            $d = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
            $message="رمز عبور شما با موفقیت تغییر یافت";
            $notifi[] = [ "text" => $message, "date" => $d];

            update_user_meta($user_id, 'notifi', json_encode($notifi,JSON_UNESCAPED_UNICODE));

        echo json_encode($result);
        die();
    }
}

$Seo1_Company = new Seo1_Company;
add_action('wp_ajax_mbm_profile_company_profile', array($Seo1_Company, 'save_profile'));
add_action('wp_ajax_nopriv_mbm_profile_company_profile', array($Seo1_Company, 'save_profile'));

add_action('wp_ajax_mbm_profile_company_profile_change_pass', array($Seo1_Company, 'change_pass'));
add_action('wp_ajax_nopriv_mbm_profile_company_profile_change_pass', array($Seo1_Company, 'change_pass'));

