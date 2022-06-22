<?php
class Kaktos_Chart_Ajax
{
    function chart()
    {
        global $wpdb;
        $user_id = get_current_user_id();

        $result = [];
        $result["color"] = "#d53838";
        $result["data"] = [];
        $result["x"] = [];
        $result["y"] = [];

        $chart_type = $_POST["chart_type"];
        $report_type = $_POST["report_type"];

        $result = $this->chart_1($chart_type, $report_type);


        echo json_encode([
            'success'       => true,
            'result'          => $result,
            'sql'          => "",
            'max_num_pages' => 1
        ]);
        die();
    }
    function chart_1($chart_type, $type, $is_count = 0)
    {
        $user_id = get_current_user_id();
        $search = [];

        $date_query = [];

        $date_query["relation"] = "AND";

        if ($chart_type == 1) {
            $date_query[] =           array(
                'after'  => '3 month ago'
            );
        } else if ($chart_type == 2) {
            $date_query[] =           array(
                'after'  => '6 month ago'
            );
        } else if ($chart_type == 3) {
            $date_query[] =           array(
                'after'  => '1 year ago'
            );
        } else if ($chart_type == 4) {
            $date_query = [];
        }


        $post_type = "";

        if ($type == 1 || $type == 2 || $type == 3 || $type == 4) {
            $search = [];
            $search["relation"] = "AND";
            $search[] =           array(
                'key' => 'user_id',
                'value' => $user_id,
                'compare' => '='
            );


            if ($type == 1) {
                $post_type = "view-user";
            } else if ($type == 2) {
                $post_type = "view-project";
            } else if ($type == 3) {
                $post_type = "like-project";
            } else if ($type == 4) {
                $post_type = "request";
            }
        }

        if ($type == 5) {
            $post_type = "job";

            $search = [];
            $search["relation"] = "AND";

            $search[] =           array(
                'key' => 'request_id',
                'value' => $user_id,
                'compare' => '='
            );

            $search[] =           array(
                'key' => 'project_state',
                'value' => 1,
                'compare' => '='
            );
        }

        if ($type == 6) {
            $post_type = "like-project";
        }

        if ($type == 7) {
            $post_type = "request";
        }

        if ($type == 8) {
            $post_type = "job";
        }


        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'date_query' => $date_query,
            'meta_query' => $search
        );

        if ($type == 6 || $type == 7 || $type == 8) {
            $args["post_author"] = $user_id;
        }

        $the_query = new WP_Query($args);


        $count_query = $the_query->post_count;
        if ($is_count == 1) {
            return $count_query;
        }

        $data = [];

        if ($chart_type == 1) {
            $data = [
                date('m', strtotime('0 month')) => ["title" => date('M', strtotime('0 month')), 'count' => 0],
                date('m', strtotime('1 month')) => ["title" => date('M', strtotime('1 month')), 'count' => 0],
                date('m', strtotime('2 month')) => ["title" => date('M', strtotime('2 month')), 'count' => 0]
            ];
        } else if ($chart_type == 2) {
            $data = [
                date('m', strtotime('0 month')) => ["title" => date('M', strtotime('0 month')), 'count' => 0],
                date('m', strtotime('1 month')) => ["title" => date('M', strtotime('1 month')), 'count' => 0],
                date('m', strtotime('2 month')) => ["title" => date('M', strtotime('2 month')), 'count' => 0],
                date('m', strtotime('3 month')) => ["title" => date('M', strtotime('3 month')), 'count' => 0],
                date('m', strtotime('4 month')) => ["title" => date('M', strtotime('4 month')), 'count' => 0],
                date('m', strtotime('5 month')) => ["title" => date('M', strtotime('5 month')), 'count' => 0]
            ];
        } else if ($chart_type == 3) {
            $data = [
                date('m', strtotime('0 month')) => ["title" => date('M', strtotime('0 month')), 'count' => 0],
                date('m', strtotime('1 month')) => ["title" => date('M', strtotime('1 month')), 'count' => 0],
                date('m', strtotime('2 month')) => ["title" => date('M', strtotime('2 month')), 'count' => 0],
                date('m', strtotime('3 month')) => ["title" => date('M', strtotime('3 month')), 'count' => 0],
                date('m', strtotime('4 month')) => ["title" => date('M', strtotime('4 month')), 'count' => 0],
                date('m', strtotime('5 month')) => ["title" => date('M', strtotime('5 month')), 'count' => 0],
                date('m', strtotime('0 month')) => ["title" => date('M', strtotime('0 month')), 'count' => 0],
                date('m', strtotime('1 month')) => ["title" => date('M', strtotime('1 month')), 'count' => 0],
                date('m', strtotime('2 month')) => ["title" => date('M', strtotime('2 month')), 'count' => 0],
                date('m', strtotime('3 month')) => ["title" => date('M', strtotime('3 month')), 'count' => 0],
                date('m', strtotime('4 month')) => ["title" => date('M', strtotime('4 month')), 'count' => 0],
                date('m', strtotime('5 month')) => ["title" => date('M', strtotime('5 month')), 'count' => 0]
            ];
        } else if ($chart_type == 4) {
            $date_query = [];
        }

        if ($chart_type != 4) {
            while ($the_query->have_posts()) :
                $the_query->the_post();

                if (!isset($data[get_the_date('m')])) {
                    $data[get_the_date('m')] = ["title" => get_the_date('M'), 'count' => 0];
                }
                $data[get_the_date('m')]["count"] = $data[get_the_date('m')]["count"] + 1;

            endwhile;
        } else {
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $index = get_the_date() . get_the_date('m');
                if (!isset($data[$index])) {
                    $data[$index] = ["title" => get_the_date('M'), 'count' => 0];
                }
                $data[$index]["count"] = $data[$index]["count"] + 1;

            endwhile;
        }

        rsort($data);

        $result = [];
        $result["color"] = "#d53838";
        $result["data"] = [];
        $result["x"] = [];
        $result["y"] = [];

        foreach ($data as $item) {
            $result["y"][] = $item["count"];
            $result["x"][] = $item["title"];
        }

        return $result;
    }
}
$Kaktos_Chart_Ajax = new Kaktos_Chart_Ajax;
add_action('wp_ajax_mbm_chart_project', array($Kaktos_Chart_Ajax, 'chart'));
add_action('wp_ajax_nopriv_mbm_chart_project', array($Kaktos_Chart_Ajax, 'chart'));
