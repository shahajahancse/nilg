<div class="page-content">
    <div class="content">

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
                        <div class="tiles blue" style="padding:20px;background: #78c72f;">
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
                        <div class="tiles blue" style="padding:20px;background: #ff940b;">
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
                        <div class="tiles blue" style="padding:20px;background: #9424b8;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($in_amount)?></h2>
                            <div class="tiles-title red m-b-5">সর্বমোট গৃহীত পরিমাণ</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-4 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #0aa699;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng(4000)?></h2>
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
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($in_amount - 4000)?> </h2>
                            <div class="tiles-title red m-b-5">অবশিষ্ট পরিমাণ</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row end -->
        </div> <!-- /row -->

        <div class="row"> <!-- /row -->
            <div class="col-md-4 col-sm-6">
                <div class="tiles white added-margin new new4">
                    <div class="tiles-body">

                    <div class="tiles-title"> জার্নাল গৃহীত সামারি রিপোর্ট </div>
                        <div class="row-fluid ">
                            <div class="heading"> <span class="" data-value="" data-animation-duration="700"></span><?=eng2bng(25) ?></div>
                        </div>
                        <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
                        <div class="description">
                            <table class="report-table">
                            <tbody>
                                <tr>
                                    <td>তথ্যের ধরণ</td>
                                    <td></td>
                                    <td>সংখ্যা</td>
                                </tr>
                                <tr>
                                    <td>রাজস্ব রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(9) ?></td>
                                </tr>
                                <tr>
                                    <td>হোস্টেল রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(7) ?></td>
                                </tr>
                                <tr>
                                    <td>প্রকাশনা রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(4) ?></td>
                                </tr>
                                <tr>
                                    <td>জিপিএফ রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(1) ?></td>
                                </tr>
                                <tr>
                                    <td>পেনশন রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(1) ?></td>
                                </tr>
                                <tr>
                                    <td>বিবিধ রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(3) ?></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="triangle-up"></div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="tiles white added-margin new new2">
                    <div class="tiles-body">
                        <div class="tiles-title"> জার্নাল ছাড়কৃত সামারি রিপোর্ট </div>
                        <div class="heading "> <span class="" data-value="" data-animation-duration="1000"></span><?=eng2bng(15) ?> </div>

                        <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
                        <div class="description">
                            <table class="report-table report-tabe2">
                                <tbody>
                                    <tr>
                                        <td>তথ্যের ধরণ</td>
                                        <td></td>
                                        <td>সংখ্যা</td>
                                    </tr>
                                    <tr>
                                        <td>রাজস্ব রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(7) ?></td>
                                    </tr>
                                    <tr>
                                        <td>হোস্টেল রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(3) ?></td>
                                    </tr>
                                    <tr>
                                        <td>প্রকাশনা রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(2) ?></td>
                                    </tr>
                                    <tr>
                                        <td>জিপিএফ রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(1) ?></td>
                                    </tr>
                                    <tr>
                                        <td>পেনশন রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(1) ?></td>
                                    </tr>
                                    <tr>
                                        <td>বিবিধ রেজিস্টার এন্ট্রি</td>
                                        <td class="sub-mark">:</td>
                                        <td><?=eng2bng(1) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="triangle-up"></div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="tiles white added-margin new new1">
                    <div class="tiles-body">
                        <div class="tiles-title"> ভাউচার সামারি </div>
                        <div class="heading"> <span class="" data-value="" data-animation-duration=""><?=eng2bng(10)?></span> </div>

                        <div style="border-bottom:1px solid #fff; margin-bottom: 10px"></div>
                        <div class="description">
                            <table class="report-table">
                            <tbody>
                                <tr>
                                    <td>তথ্যের ধরণ</td>
                                    <td></td>
                                    <td>সংখ্যা</td>
                                </tr>
                                <tr>
                                    <td> চেক রেজিস্টার এন্ট্রি </td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(3) ?></td>
                                </tr>
                                <tr>
                                    <td> চাহিদা পত্র </td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(2) ?></td>
                                </tr>
                                <tr>
                                    <td> হোস্টেল পত্র </td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(6) ?></td>
                                </tr>
                                <tr>
                                    <td> প্রকাশনা পত্র </td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(4) ?></td>
                                </tr>
                                <tr>
                                    <td> বিবিধ পত্র </td>
                                    <td class="sub-mark">:</td>
                                    <td><?=eng2bng(1) ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="sub-mark">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="triangle-up"></div>
                </div>
            </div>
        </div> <!-- /row -->
    </div>
</div>
