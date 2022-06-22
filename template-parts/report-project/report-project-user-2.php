<?php
$user_id = get_current_user_id();

$search = array();

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


$args = array(
    'post_type' => 'job',
    'post_status' => 'publish',
    'meta_query' => $search
);
$the_query = new WP_Query($args);
$count = $the_query->post_count;
?>
<section id="tab-item-2">
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
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">کارفرما</th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">پیشنهاد انتخاب شده
                        </th>
                        <th class="no-border tc-white bgc-3 sorting_disabled" rowspan="1" colspan="1">زمان تحویل</th>
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
                            <td><?php echo get_the_author_meta('user_name')  ?></td>
                            <td><?php echo get_post_meta(get_post_meta(get_the_ID(), 'request_req_id', true), 'price', true) ?></td>
                            <td><?php
                                $d =get_post_meta(get_the_ID(), 'project_state_time', true);
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