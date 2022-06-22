<div class="col-12 col-md-8 col-lg-9 col-xl-10">
    <div class="wt-haslayout wt-dbsectionspace">
        <div class="wt-dashboardbox wt-dashboardtabsholder">
            <div class="wt-dashboardboxtitle">
                <h2>تغییر رمز عبور </h2>
            </div>
            <div id="form-profile" class="my-form">
                <div class="wt-personalskillshold tab-pane active fade show" id="wt-skills">
                    <div class="wt-yourdetails wt-tabsinfo">
                        <div class="wt-formtheme wt-userform">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>رمز جدید </label>
                                            <input id="new_pass" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>تکرار رمز جدید</label>
                                            <input id="re_pass" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 m-b10">
                                        <div class="box-loading">
                                            <div class="loading-ajax"></div>
                                        </div>
                                        <button style="margin: 34px;" onclick="ajax_submit_mbm_change_pass(
            {
                'action': 'mbm_profile_company_profile_change_pass',
                'new_pass':$('#new_pass').val(),
                're_pass':$('#re_pass').val()
            }
            ,$('#dzFormMsg-error1')
            ,$('#dzFormMsg-doned1')
        )" class="wt-btn">ذخیره تغییرات</button>
                                    </div>
                                    <div style="margin: 34px;" id="dzFormMsg-error1" class="dzFormMsg error"></div>
                                    <div style="margin: 34px;" id="dzFormMsg-doned1" class="dzFormMsg doned"></div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>