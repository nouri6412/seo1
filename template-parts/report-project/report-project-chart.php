<?php
$type_chart = get_query_var('type_chart');
$chart_id = "chart-" . $type_chart;
$Seo1_Chart_Ajax=new Seo1_Chart_Ajax;
?>
<div class="tab__content">
    <div class="row pv+++">
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div id="stats" style="width: 100%; height: 300px;">
                            <div style="position: relative;">
                                <div dir="ltr" style="position: relative; width: 100%; height: 300px;">
                                    <div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                                        <div class="chart-box">
                                            <canvas id="<?php echo $chart_id ?>" style="width:100%;padding: 5px; "></canvas>
                                        </div>

                                        <script>
                                            setTimeout(function() {
                                                custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 1, '<?php echo $chart_id ?>', '', true, false, '');
                                            }, 500 * <?php echo $type_chart ?>);
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 height-50px"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 height-50px"></div>
            </div>

        </div>
        <div class="col-md-4 hidden-xs hidden-xxs hidden-sm">
            <div class="row">
                <div class="col-sm-12 fa-1-5em">
                    <span>دریافت شده</span>

                </div>
                <div class="col-sm-12 pv+">
                    <div class="list-group list-group-horizontal text-center visible-table full-width min-h-80">
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 1, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-4 visible-table-cell middle-v-a active"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,1,1) ?><br>
                            <span class="fa-0-8em">
                                بازدید از پروفایل
                            </span>
                        </div>
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 2, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-4 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,2,1) ?><br>
                            <span class="fa-0-8em">بازدید از پروژه شما</span>
                        </div>
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 3, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-4 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,3,1) ?><br>
                            <span class="fa-0-8em">پروژه های شما را پسندیدند</span>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 pb+">
                    <div class="list-group list-group-horizontal visible-table full-width min-h-80">
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 4, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-6 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,4,1) ?><br>
                            <span class="fa-0-8em">
                                پیشنهاد روی پروژه های شما
                            </span>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 fa-1-5em pv++">
                    <span>انجام شده</span>
                </div>
                <div class="col-sm-12 pb+">
                    <div class="list-group list-group-horizontal visible-table full-width min-h-80">
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 5, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-6 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,5,1) ?><br>
                            <span class="fa-0-8em">پروژه انجام داده اید</span>
                        </div>
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 6, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-6 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,6,1) ?><br>
                            <span class="fa-0-8em">پروژه پسندیده اید</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 pb+">
                    <div class="list-group list-group-horizontal visible-table full-width min-h-80">
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 7, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-6 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,7,1) ?><br>
                            <span class="fa-0-8em">پیشنهاد ارسال کرده اید</span>
                        </div>
                        <div onclick="custom_theme_mbm_chart_project('<?php echo $type_chart ?>', 8, '<?php echo $chart_id ?>', '', true, false,jQuery(this))" href="#" class="list-group-item width-xs-6 visible-table-cell middle-v-a"><?php echo $Seo1_Chart_Ajax->chart_1($type_chart,8,1) ?><br>
                            <span class="fa-0-8em">پروژه ایجاد کرده اید</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>