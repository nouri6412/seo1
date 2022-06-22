<?php
$user_id = get_current_user_id();
?>
<div class="col-12 col-md-8 col-lg-9 col-xl-10">



    <div class="tab-wrap">

        <!-- active tab on page load gets checked attribute -->
        <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
        <label for="tab1">سه ماه گذشته</label>

        <input type="radio" id="tab2" name="tabGroup1" class="tab">
        <label for="tab2">شش ماه گذشته</label>

        <input type="radio" id="tab3" name="tabGroup1" class="tab">
        <label for="tab3">سال گذشته</label>


        <input type="radio" id="tab4" name="tabGroup1" class="tab">
        <label for="tab4">تا به امروز</label>

        <?php

        set_query_var('type_chart', 1);
        get_template_part('template-parts/report-project/report-project', 'chart'); 
        
        set_query_var('type_chart', 2);
        get_template_part('template-parts/report-project/report-project', 'chart'); 

        set_query_var('type_chart', 3);
        get_template_part('template-parts/report-project/report-project', 'chart'); 

        set_query_var('type_chart', 4);
        get_template_part('template-parts/report-project/report-project', 'chart'); 
        ?>

    </div>
</div>