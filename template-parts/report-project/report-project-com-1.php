<?php
$user_id = get_current_user_id();

$search = array();

$search["relation"] = "AND";

$search[] =           array(
    'key' => 'request_id',
    'value' => 0,
    'compare' => '='
);


$args = array(
    'post_type' => 'job',
    'post_status' => 'publish',
    'author'  => $user_id,
    'meta_query' => $search
);
$the_query = new WP_Query($args);
$count = $the_query->post_count;
?>
<section id="tab-item-1">
    <div id="general-tables-1">
        <div class="form-inline dt-bootstrap no-footer dataTables_wrapper pb-2">
            <!-- <div class="flip pull-left width-xs-8 width-sm-10 search">
                <div class=" col-12">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control col-12" placeholder="جستجو">
                    </div>
                </div>
            </div>
            <div class="">
                <div class="dataTables_length" id="DataTables_Table_150_length"><label><select class="form-control input-sm col-12">
                            <option value="5">نمایش 5</option>
                            <option value="10">نمایش 10</option>
                            <option value="15">نمایش 15</option>
                        </select></label></div>
            </div> -->
        </div>
        <div class="table-responsive">
            <table class="tablelist table no-footer dataTable" id="DataTables_Table_150">
                <thead class="fa-0-8em border-a border-color-4 no-border-b">
                    <tr class="no-border" role="row">
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">نام پروژه</th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">پیشنهادها</th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">میانگین
                            پیشنهادها
                        </th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">تاریخ پایان</th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1"><i class="pf pf-other"></i></th>
                    </tr>
                </thead>
                <tbody class="border-a border-color-10">
                    <?php
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                    ?>
                        <tr>
                            <td><?php echo get_the_title() ?></td>
                            <?php
                            $avg = 0;
                            $sql       = $wpdb->prepare("select (select pm1.meta_value from " . $wpdb->prefix . "postmeta pm1 where p.ID=pm1.post_id and pm1.meta_key='price') as price from " . $wpdb->prefix . "posts p left join " . $wpdb->prefix . "postmeta pm on p.ID=pm.post_id where p.post_type='request' and  p.post_status='publish' and pm.meta_key='job_id' and pm.meta_value='" . get_the_ID() . "'", array());
                            $result = $wpdb->get_results($sql, 'ARRAY_A');
                            $count1 = count($result);

                            if (count($result) > 0) {
                                foreach ($result as $item) {
                                    $avg += $item["price"];
                                }
                            }
                            if ($count1 > 0) {
                                $avg = round($avg / $count1);
                            }

                            ?>
                            <td><?php echo $count1 ?></td>
                            <td><?php echo $avg ?></td>
                            <td><?php
                                $date = date_create();
                                date_modify($date, "+" . get_post_meta(get_the_ID(), 'expire', true) . " day");

                                $d = mktime(date_format($date, "H"), date_format($date, "i"), date_format($date, "s"), date_format($date, "m"), date_format($date, "d"), date_format($date, "Y"));
                                $cur = current_time('timestamp');
                                if ($d > $cur) {
                                    echo  human_time_diff($cur, $d) . ' ' . 'دیگر';
                                } else {
                                    echo  human_time_diff($d, $cur) . ' ' . 'گذشته';
                                }
                                ?></td>
                            <td></td>
                        </tr>
                    <?php
                    endwhile;
                    ?>

                    <?php if ($count == 0) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="5" class="dataTables_empty">
                                <div class="no-result">
                                    <div>پروژه ای پیدا نشد</div>
                                </div>
                            </td>
                        </tr>
                    <?php  } ?>

                </tbody>
            </table>
        </div>

    </div>
</section>