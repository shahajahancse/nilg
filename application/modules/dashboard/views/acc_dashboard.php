<div class="page-content">
    <div class="content">
        <?php if ($this->ion_auth->in_group(array('admin', 'bdg', 'nilg', 'bdh', 'acc'))) { ?>
        <div class="row">
            <!-- raw start -->
            <?php if ($this->ion_auth->in_group(array('bdg', 'acc', 'nilg', 'admin'))) { ?>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-3 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #9424b8;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-9 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin" style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($in_amount)?></h2>
                            <div class="tiles-title red m-b-5">সর্বমোট গৃহীত পরিমাণ (রাজস্ব)</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-3 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #0aa699;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <?php
                        $this->db->select_sum('total_overall_expense');
                        $this->db->from('budget_field');
                        $this->db->where('status', 1);
                        $out_amount = $this->db->get()->row()->amount;
                    ?>
                    <div class="col-md-9 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($out_amount)?></h2>
                            <div class="tiles-title red m-b-5">ছাড়কৃত পরিমাণ (রাজস্ব)</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-b-20">
                <div class="row tiles-container">
                    <div class="col-md-3 no-padding">
                        <div class="tiles blue" style="padding:20px;background: #00adef;">
                            <i class="fa fa-dashboard" style="font-size: 38px;"></i>
                        </div>
                    </div>
                    <div class="col-md-9 no-padding">
                        <div class="tiles white text-center">
                            <h2 class="semi-bold text-error no-margin"
                                style="padding-top: 6px; padding-bottom: 6px;font-family: 'Kalpurush'; font-size: 25px;"><?=eng2bng($in_amount - $out_amount)?> </h2>
                            <div class="tiles-title red m-b-5">অবশিষ্ট পরিমাণ (রাজস্ব)</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <!-- row end -->
        </div> <!-- /row -->
        <?php } ?>

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
                                    <td>রাজস্ব রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                    $reveneu=all_journal_amount('revenue')
                                    ?>
                                    <td><?=eng2bng($reveneu) ?></td>
                                </tr>
                                <tr>
                                    <td>হোস্টেল রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                    $hostel=all_journal_amount('hostel')
                                    ?>
                                    <td><?=eng2bng($hostel) ?></td>
                                </tr>
                                <tr>
                                    <td>প্রকাশনা রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                    $hostel=all_journal_amount('publication')
                                    ?>
                                    <td><?=eng2bng($hostel) ?></td>
                                </tr>
                                <tr>
                                    <td>জিপিএফ রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                    $hostel=all_journal_amount('gpf')
                                    ?>
                                    <td><?=eng2bng($hostel) ?></td>
                                </tr>
                                <tr>
                                    <td>পেনশন রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                    $hostel=all_journal_amount('pension')
                                    ?>
                                    <td><?=eng2bng($hostel) ?></td>
                                </tr>
                                <tr>
                                    <td>বিবিধ রেজিস্টার এন্ট্রি</td>
                                    <td class="sub-mark">:</td>
                                    <?php 
                                        $hostel=all_journal_amount('miscellaneous')
                                    ?>
                                    <td><?=eng2bng($hostel) ?></td>
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
