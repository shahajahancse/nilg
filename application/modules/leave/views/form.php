
<?php
$user = $this->ion_auth->user($row->user_id)->row();
if (!empty($row->assign_person)) {
    $user2 = $this->ion_auth->user($row->assign_person)->row();
    $desig2 = $this->db->get_where('designation',array('id'=>$user2->crrnt_desig_id))->row();
} else {
    $desig2 = null;
    $user2 = null;
}
$desig= $this->db->get_where('designation',array('id'=>$row->desig_id))->row();
$results = $this->Leave_model->get_yearly_leave_count($row->user_id);
$total_leave= $results['total_leave'];
$used_leave= $results['used_leave'];
$leave_address = json_decode($row->leave_address);
$leave_type = $this->db->get_where('leave_type',array('id'=>$row->leave_type))->row();
if (isset($leave_address->upazila_id)) {
    $upazila= $this->db->get_where('upazilas',array('id'=>$leave_address->upazila_id))->row();
}
// dd($upazila);
if (isset($leave_address->district_id)) {
    $district= $this->db->get_where('districts',array('id'=>$leave_address->district_id))->row();
}

// dd($desig);
// dd($user);
// [id] => 177
// [username] => 3273133821
// [is_office] => 0
// [office_type] => 7
// [office_id] => 125
// [partner_id] =>
// [employee_type] => 2
// [name_bn] => মো: নাজিম উদ্দিন
// [name_en] => MD. NAZIM UDDIN
// [father_name] => মো: মোজাম্মেল হক
// [mother_name] => মোসা: ছালেহা বেগম
// [nid] => 3273133821
// [mobile_no] => 01860673571
// [email] => nazim.nilg@yahoo.com

//dd($row)

?>
<!-- stdClass Object
(
    [id] => 4
    [user_id] => 177
    [dept_id] => 3
    [desig_id] => 100
    [leave_type] => 8
    [from_date] => 2024-03-28
    [to_date] => 2024-03-28
    [leave_days] => 1
    [reason] => sdsfdsfds
    [status] => 1
    [assign_person] => 181
    [assign_remark] =>
    [leave_address] => {"father_name":"Md. Nahid","division_id":"6","district_id":"47","upazila_id":"273","village":"Dolapara","post_office":"Magura"}
    [file_name] =>
    [created_date] => 2024-03-28
) -->
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
        .no-print{
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
        <h4 style="text-decoration: underline;line-height: 32px;">নৈমিত্তিক ছুটির আবেদন পত্র</h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                            <span><strong>অবশিষ্ট :  <?php echo eng2bng($total_leave[0]->yearly_total_leave - $used_leave->casual_leave); ?></strong></span>&nbsp&nbsp | &nbsp&nbsp
                            <span><strong >ঐচ্ছিক : <?php echo eng2bng($total_leave[1]->yearly_total_leave); ?></strong></span>&nbsp
                            <span><strong >অবশিষ্ট : <?php echo eng2bng($total_leave[1]->yearly_total_leave - $used_leave->optional_leave); ?></strong></span>
                        </td>
                    </tr>
                    <tr>
                        <th>০৬. ছুটিকালীন বিকল্প কর্মকর্তার নাম ও পদবি</th>
                        <td>:</td>
                        <td>
                            <?php
                                if (!empty($user2)) {
                                    echo $user2->name_bn . ' (' . $desig2->desig_name . ')';
                                } else {
                                    echo 'কর্মকর্তা নির্ধারিত করা হয়নি';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>০৭. ছুটিকালীন ঠিকানা (কেবলমাত্র কর্মস্থল ত্যাগের ক্ষেত্রে প্রযোজ্য)</th>
                        <td>:</td>
                        <td>পিতার
                            নাম/প্রযন্ত্রে:&nbsp&nbsp&nbsp&nbsp<?=isset($leave_address->father_name)?$leave_address->father_name:'................................'?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>গ্রাম/মহল্লা:&nbsp&nbsp&nbsp&nbsp<?= isset($leave_address->village)?$leave_address->village:'................................' ?> ডাকঘর:&nbsp&nbsp&nbsp&nbsp<?=isset($leave_address->post_office)?$leave_address->post_office:'................................'?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>উপজেলা:&nbsp&nbsp&nbsp&nbsp<?=(isset($upazila->upa_name_bn))?$upazila->upa_name_bn:'................................'?> জেলা:&nbsp&nbsp&nbsp&nbsp<?=isset($district->dis_name_bn)?$district->dis_name_bn:'................................'?>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td>ফোন/মোবাইল
                            নম্বর:&nbsp&nbsp<?=isset($leave_address->mobile_number)?$leave_address->mobile_number:'................................'?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12"
                style="display: flex;justify-content: space-between;width: 100%;margin-top: 32px;padding: 26px;">
                <span>নিয়ন্ত্রণকারি কর্মকর্তার সুপারিশ : <br>তাঁকে ছুটি মঞ্জুর করা যেতে পারে/পারে না</span>
                <span>আবেদনকারীর স্বাক্ষর ও তারিখ</span>
            </div>
            <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding: 9px 26px;">
                <span>নিয়ন্ত্রণকারী কর্মকর্তার স্বাক্ষর ও তারিখ।</span>
            </div>
            <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding: 9px 26px;">
                <span>অফিস কর্তৃক পূরণীয়-</span>
            </div>
            <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding:26px;">
                <span>সংশ্লিষ্ট উচ্চমান সহকারীর স্বাক্ষর ও তারিখ</span>
                <span>প্রশাসনিক কর্মকর্তার স্বাক্ষর ও তারিখ</span>
                <span>ছুটি অনুমোদনকারী কর্মকর্তার<br>
                    স্বাক্ষর তারিখ ও সিলমোহর।</span>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="border-top: dashed;"></div>
    <div class="header">
        <h3>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h3>
        <p>জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি)</p>
        <p>২৯, আগারগাঁও, শেরে বাংলা নগর ঢাকা - ১২০৭</p>
        <h4 style="text-decoration: underline;line-height: 32px;">ছুটি মঞ্জুরী পত্র</h4>
    </div>
    <div class="col-md-12" style="width: 100%;padding:26px;">
        <span>জনাব/বেগম &nbsp&nbsp&nbsp&nbsp <?php echo $user->name_bn; ?>&nbsp&nbsp&nbsp&nbsp পদবি &nbsp&nbsp&nbsp&nbsp<?php echo $desig->desig_name; ?>&nbsp&nbsp&nbsp কে &nbsp&nbsp&nbsp

            <?= date_bangla_calender_format($row->from_date) ?> থেকে <?= date_bangla_calender_format($row->to_date) ?> পর্যন্ত
                            মোট <?= eng2bng($row->leave_days) ?> দিন  &nbsp&nbsp&nbsp&nbsp <?=$leave_type->leave_name_bn?> &nbsp&nbsp&nbsp&nbsp
            মঞ্জুরী করা হল
        </span>
    </div>
    <div class="col-md-12" style="display: flex;justify-content: space-between;width: 100%;padding:26px;">
        <span></span>
        <span>ছুটি অনুমোদনকারী কর্মকর্তার স্বাক্ষর,<br> তারিখ ও সিলমোহর।</span>
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
