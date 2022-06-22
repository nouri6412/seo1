<?php
class Seo1_Job
{
    function insert_job()
    {
        $user_id = get_current_user_id();

        if($user_id==0)
        {
            echo json_encode([]);
            die();
        }

        $job_id = sanitize_text_field($_POST["job_id"]);

        $job = get_post( $job_id );

        $author = $job->post_author;

        if($user_id!=$author && $job_id>0)
        {
            echo json_encode([]);
            die();
        }

        $title = "";
        $desc = "";
        $coop_type = '';
        $exp = '';
        $min_salary = '';
        $max_salary = "";
        $state_id = 0;
        $city_id = 0;
        $address = '';

        $title = sanitize_text_field($_POST["job_title"]);
        $email = sanitize_text_field($_POST["job_email"]);
        $tag = sanitize_text_field($_POST["job_tag"]);
        $desc = $_POST["desc_job"];
        $sex = sanitize_text_field($_POST["job_sex"]);
        $coop_type = sanitize_text_field($_POST["job_coop_type"]);
        $exp = sanitize_text_field($_POST["job_exp"]);
        $min_salary = sanitize_text_field($_POST["job_min_salary"]);
        $max_salary = sanitize_text_field($_POST["job_max_salary"]);
        $state_id = sanitize_text_field($_POST["job_state_id"]);
        $city_id = sanitize_text_field($_POST["job_city_id"]);
        $address = sanitize_text_field($_POST["job_address"]);
        $cat_id = sanitize_text_field($_POST["cat_id"]);
        $status = sanitize_text_field($_POST["job_status"]);

        if($status==1)
        {
            $status=0;
        }
       

        $args_post = array(
            'post_title'   => $title,
            'post_type'    => 'job',
            'post_author'  => $user_id,
            'post_status'  => 'publish',
            'post_content'      => $desc,
            'meta_input'   => array(
                'title' =>$title,
                'desc' =>$desc,
                'active' => $status,
                'coop-type' => $coop_type,
                'job-email' => $email,
                'exp' => $exp,
                'tag' => $tag,
                'min-salary' => $min_salary,
                'max-salary' => $max_salary,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'address' => $address,
                'sex' => $sex,
                'cat_id' => $cat_id
            )
        );


        $max_job_option = 50;

        $get_option = get_field('job_max_job', 'option');

        if (is_numeric($get_option)) {
            $max_job_option = $get_option;
        }

        $args = array(
            'post_type' => 'job',
            'post_author'  => $user_id,
            'meta_key'        => 'active',
            'meta_value'    => 1
        );
        $the_query = new WP_Query($args);

        $count_max = $the_query->post_count;
        wp_reset_query();

        $args = array(
            'post_type' => 'job',
            'post_author'  => $user_id,
            'title'        => $title
        );
        $the_query = new WP_Query($args);

        $count = $the_query->post_count;
        wp_reset_query();

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';

        if($job_id==0)
        {
            if ($count > 0) {
                $result["state"] = 0;
                $result["message"] = 'عنوان آگهی تکراری می باشد';
            } else if ($count_max < $max_job_option) {
                $id = wp_insert_post($args_post);
                $result["state"] = 1;
                $result["message"] = 'با موفقیت ذخیره شد';
            } else {
                $result["state"] = 0;
                $result["message"] = 'تعداد آگهی های فعال نباید بیش از 5 باشد';
            }
        }
        else
        {
            $my_post = array(
                'ID'            => $job_id,
                'post_title'   => $title,
                'post_content'      => $desc
            );
            wp_update_post( $my_post );
            update_post_meta( $job_id, 'title', $title );
            update_post_meta( $job_id, 'desc', $desc );
            update_post_meta( $job_id, 'active', $status );
            update_post_meta( $job_id, 'coop-type', $coop_type );
            update_post_meta( $job_id, 'email', $email );
            update_post_meta( $job_id, 'exp', $exp );
            update_post_meta( $job_id, 'tag', $tag );
            update_post_meta( $job_id, 'min-salary', $min_salary );
            update_post_meta( $job_id, 'max-salary', $max_salary );
            update_post_meta( $job_id, 'state_id', $state_id );
            update_post_meta( $job_id, 'city_id', $city_id );
            update_post_meta( $job_id, 'address', $address );
            update_post_meta( $job_id, 'sex', $sex );
            update_post_meta( $job_id, 'cat_id', $cat_id );
        }

        echo json_encode($result);
        die();
    }
    function remove_job()
    {
        $user_id = get_current_user_id();

        if($user_id==0)
        {
            echo json_encode([]);
            die();
        }
        $job_id = sanitize_text_field($_POST["job_id"]);
      
        $job = get_post( $job_id );

        $author = $job->post_author;

        if($user_id==$author)
        {
            wp_delete_post($job_id);
        }
        

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';
        echo json_encode($result);
        die();
    }

    function active()
    {


        if(!is_admin())
        {
            echo json_encode([]);
            die();
        }
        $job_id = sanitize_text_field($_POST["job_id"]);
        $active = sanitize_text_field($_POST["active"]);


        update_post_meta( $job_id, 'active', $active );

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';
        echo json_encode($result);
        die();
    }

    function favorite()
    {

        $user_id = get_current_user_id();

        if($user_id==0)
        {
            echo json_encode([]);
            die();
        }
        $job_id = sanitize_text_field($_POST["job_id"]);
        $status = sanitize_text_field($_POST["status"]);

        $job = get_post( $job_id );

        $author =get_post_meta($job_id, 'owner_id', true) ;

        if($user_id!=$author)
        {
            $result["state"] = 0;
            $result["message"] = 'شما صاحب آگهی نیستید'.$author.'-'.$user_id;
            
            echo json_encode($result);
            die();
        }

        update_post_meta( $job_id, 'favorite', $status );

        $result["state"] = 1;
        $result["favorite"] = $status;
        $result["message"] = 'با موفقیت ذخیره شد';
        echo json_encode($result);
        die();
    }

    function status()
    {
        $user_id = get_current_user_id();

        if($user_id==0)
        {
            echo json_encode([]);
            die();
        }
        $job_id = sanitize_text_field($_POST["job_id"]);
        $status = sanitize_text_field($_POST["status"]);

        $job = get_post( $job_id );

        $author =get_post_meta($job_id, 'owner_id', true) ;

        if($user_id!=$author)
        {
            $result["state"] = 0;
            $result["message"] = 'شما صاحب آگهی نیستید'.$author.'-'.$user_id;
            
            echo json_encode($result);
            die();
        }

        update_post_meta( $job_id, 'status', $status );

        $result["state"] = 1;
        $result["message"] = 'با موفقیت ذخیره شد';
        echo json_encode($result);
        die();
    }
}

$Seo1_Job = new Seo1_Job;
add_action('wp_ajax_mbm_profile_company_insert_job', array($Seo1_Job, 'insert_job'));
add_action('wp_ajax_nopriv_mbm_profile_company_insert_job', array($Seo1_Job, 'insert_job'));

add_action('wp_ajax_mbm_profile_company_remove_job', array($Seo1_Job, 'remove_job'));
add_action('wp_ajax_nopriv_mbm_profile_company_remove_job', array($Seo1_Job, 'remove_job'));

add_action('wp_ajax_mbm_change_status_request', array($Seo1_Job, 'status'));
add_action('wp_ajax_nopriv_mbm_change_status_request', array($Seo1_Job, 'status'));

add_action('wp_ajax_mbm_change_favorite_request', array($Seo1_Job, 'favorite'));
add_action('wp_ajax_nopriv_mbm_change_favorite_request', array($Seo1_Job, 'favorite'));


add_action('wp_ajax_mbm_change_status_job', array($Seo1_Job, 'active'));
add_action('wp_ajax_nopriv_mbm_change_status_job', array($Seo1_Job, 'active'));

