<div class="page-content">
    <div class="content">
        <?php //$this->load->view('filter'); ?>
        <div class="row">
            <!-- raw start -->
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng(count($budget_field))?></h2>
                            <div class="tiles-title red m-b-5">বাজেট অফিস</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng(count($budget_nilg))?></h2>
                            <div class="tiles-title red m-b-5">বাজেট এনআইএলজি</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng(count($budgets_entry))?></h2>
                            <div class="tiles-title red m-b-5">বাজেট এন্ট্রি</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng($in_amount)?></h2>
                            <div class="tiles-title red m-b-5">সর্বমোট গৃহীত পরিমাণ</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng(4000)?></h2>
                            <div class="tiles-title red m-b-5">ছাড়কৃত পরিমাণ</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;">
                                <?=eng2bng(15000)?></h2>
                            <div class="tiles-title red m-b-5">অবশিষ্ট পরিমাণ</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row end -->
        </div> <!-- /row -->
    </div> <!-- /row -->
</div>
</div>