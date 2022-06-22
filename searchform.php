<form class="wt-formtheme wt-formsearch" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <fieldset>
        <div class="form-group">
            <input type="text" name="s" class="form-control" placeholder="جستجوی مقاله" value="<?php echo get_search_query(); ?>">
            <button class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
        </div>
    </fieldset>
</form>