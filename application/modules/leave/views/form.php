<?php
$user = $this->ion_auth->user($row->user_id)->row();
$app_user = $this->ion_auth->user($row->approve_person)->row();
$con_user = $this->ion_auth->user($row->control_person)->row();

if (!empty($row->assign_person)) {
    $user2 = $this->ion_auth->user($row->assign_person)->row();
    $desig2 = $this->db->get_where('designations', array('id' => $user2->crrnt_desig_id))->row();
} else {
    $desig2 = null;
    $user2 = null;
}
$desig = $this->db->get_where('designations', array('id' => $row->desig_id))->row();
$results = $this->Leave_model->get_yearly_leave_count($row->user_id);
$total_leave = $results['total_leave'];
$used_leave = $results['used_leave'];
$leave_address = json_decode($row->leave_address);
$leave_type = $this->db->get_where('leave_type', array('id' => $row->leave_type))->row();
if (isset($leave_address->upazila_id)) {
    $upazila = $this->db->get_where('upazilas', array('id' => $leave_address->upazila_id))->row();
}
// dd($upazila);
if (isset($leave_address->district_id)) {
    $district = $this->db->get_where('districts', array('id' => $leave_address->district_id))->row();
}

?>

<html lang="en">

<head>
    <title>ছুটির রিপোর্ট</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .header {
            padding: 1em;
            text-align: center;
        }

        .table td,
        .table th {
            border-top: none !important;
        }

        th {
            width: 280px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <a style="position: absolute;right: 31px;color: white;top: 30;" class="btn btn-primary btn-sm no-print" onclick="window.print()">Print</a>

    <div class="header">
        <h3>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h3>
        <p>জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি)</p>
        <p>২৯, আগারগাঁও, শেরে বাংলা নগর ঢাকা - ১২০৭</p>
        <h4 style="font-family: SutonnyMJ; text-decoration: underline; line-height: 32px;">‰bwgwËK QywU gÄyix cÎ</h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table">
                    <tr>
                        <th>০১. কর্মকর্তা/কর্মচারীর নাম</th>
                        <td>:</td>
                        <td>
                            <?php echo $user->name_bn; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>০২. পদবি</th>
                        <td>:</td>
                        <td>
                            <?php echo $desig->desig_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>০৩. প্রার্থীত ছুটির তারিখ</th>
                        <td>:</td>
                        <td> <?= date_bangla_calender_format($row->from_date) ?> থেকে <?= date_bangla_calender_format($row->to_date) ?> পর্যন্ত
                            মোট <?= eng2bng($row->leave_days) ?> দিন </td>
                    </tr>
                    <tr>
                        <th>০৪. ছুটি চাওয়ার কারণ</th>
                        <td>:</td>
                        <td>
                            <?php echo $row->reason; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>০৫. প্রাপ্য ছুটির বিবরণ</th>
                        <td>:</td>
                        <td>
                            <span><strong>নৈমিত্তিক : <?php echo eng2bng($total_leave[0]->yearly_total_leave); ?></strong></span> &nbsp
                            <span><strong>অবশিষ্ট : <?php echo eng2bng($total_leave[0]->yearly_total_leave - $used_leave->casual_leave); ?></strong></span>&nbsp&nbsp | &nbsp&nbsp
                            <span><strong>ঐচ্ছিক : <?php echo eng2bng($total_leave[1]->yearly_total_leave); ?></strong></span>&nbsp
                            <span><strong>অবশিষ্ট : <?php echo eng2bng($total_leave[1]->yearly_total_leave - $used_leave->optional_leave); ?></strong></span>
                        </td>
                    </tr>
                    <tr>
                        <th>০৬. ছুটিকালীন বিকল্প কর্মকর্তার নাম ও পদবি</th>
                        <td>:</td>
                        <td>
                            <?php
                            if (!empty($user2->name_bn) && !empty($desig2->desig_name)) {
                                echo $user2->name_bn . ' (' . $desig2->desig_name . ')';
                            } else {
                                echo $row->bikolpo;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>০৭. ছুটিকালীন ঠিকানা (কেবলমাত্র কর্মস্থল ত্যাগের ক্ষেত্রে প্রযোজ্য)</th>
                        <td>:</td>
                        <td>পিতার
                            নাম/প্রযন্ত্রে:&nbsp&nbsp&nbsp&nbsp<?= isset($leave_address->father_name) ? $leave_address->father_name : '................................' ?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>গ্রাম/মহল্লা:&nbsp&nbsp&nbsp&nbsp<?= isset($leave_address->village) ? $leave_address->village : '................................' ?> ডাকঘর:&nbsp&nbsp&nbsp&nbsp<?= isset($leave_address->post_office) ? $leave_address->post_office : '................................' ?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>উপজেলা:&nbsp&nbsp&nbsp&nbsp<?= (isset($upazila->upa_name_bn)) ? $upazila->upa_name_bn : '................................' ?> জেলা:&nbsp&nbsp&nbsp&nbsp<?= isset($district->dis_name_bn) ? $district->dis_name_bn : '................................' ?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>ফোন/মোবাইল
                            নম্বর:&nbsp&nbsp<?= isset($leave_address->mobile_number) ? $leave_address->mobile_number : '................................' ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-md-12"
                style="display: flex;justify-content: space-between;width: 100%;margin-top: 32px;padding: 26px;">
                <span>নিয়ন্ত্রণকারি কর্মকর্তার সুপারিশ : <?php echo $row->control_remark; ?></span>
                <span>
                    <?php if (!empty($user->signature)) {
                        $url = base_url('uploads/signature/') . $user->signature;
                    } else {
                        $url = base_url('uploads/signature/blank.jpg');
                    } ?>
                    <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
                    আবেদনকারীর স্বাক্ষর ও তারিখ
                </span>
            </div>

            <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding:26px;">
                <span>
                    <?php if (!empty($con_user->signature)) {
                        $url = base_url('uploads/signature/') . $con_user->signature;
                    } else {
                        $url = base_url('uploads/signature/blank.jpg');
                    } ?>
                    <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
                    নিয়ন্ত্রণকারী কর্মকর্তার স্বাক্ষর ও তারিখ।
                </span>
                <span>
                    <?php if (!empty($app_user->signature)) {
                        $url = base_url('uploads/signature/') . $app_user->signature;
                    } else {
                        $url = base_url('uploads/signature/blank.jpg');
                    } ?>
                    <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
                    ছুটি অনুমোদনকারী কর্মকর্তার<br>
                    স্বাক্ষর তারিখ ও সিলমোহর।
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="border-top: dashed;"></div>
    <div class="header">
        <h3>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h3>
        <p>জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি)</p>
        <p>২৯, আগারগাঁও, শেরে বাংলা নগর ঢাকা - ১২০৭</p>
        <h4 style="font-family: SutonnyMJ; text-decoration: underline; line-height: 32px;">‰bwgwËK QywU gÄyix cÎ</h4>
    </div>
    <div class="col-md-12" style="width: 100%;padding:26px;">
        <span>জনাব/বেগম &nbsp&nbsp&nbsp&nbsp <?php echo $user->name_bn; ?>&nbsp&nbsp&nbsp&nbsp পদবি &nbsp&nbsp&nbsp&nbsp<?php echo $desig->desig_name; ?>&nbsp&nbsp&nbsp কে &nbsp&nbsp&nbsp

            <?= date_bangla_calender_format($row->from_date) ?> থেকে <?= date_bangla_calender_format($row->to_date) ?> পর্যন্ত
            মোট <?= eng2bng($row->leave_days) ?> দিন &nbsp <?= $leave_type->leave_name_bn ?> &nbsp
            <span style="font-family: SutonnyMJ; font-size: 22px;">gÄyi</span> করা হল
        </span>
    </div>
    <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding:26px;">
        <span></span>
        <span>
            <?php if (!empty($app_user->signature)) {
                $url = base_url('uploads/signature/') . $app_user->signature;
            } else {
                $url = base_url('uploads/signature/blank.jpg');
            } ?>
            <div><img src="<?= $url ?>" style="width:160; height: 50px; display: block;"></div>
            ছুটি অনুমোদনকারী কর্মকর্তার <br> স্বাক্ষর, তারিখ ও সিলমোহর।
        </span>
    </div>



















    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>