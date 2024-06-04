<html>
    <head>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <!-- <meta name="fon"> -->

        <title><?=$headding?></title>
        <style>
            .heading {
                margin-top: 13px;
            }
            .row {
                display: flex;
                flex-wrap: wrap;
            }
            /* Medium devices (desktops, 992px and up) */
            .col-md-12 {
                flex: 0 0 auto;
                width: 100%;
                max-width: 100%;
            }
            .col-md-6 {
                flex: 0 0 auto;
                width: 50%;
                max-width: 50%;
            }
            .col-md-3 {
                flex: 0 0 auto;
                width: 25%;
                max-width: 25%;
            }
            .text-center {
                text-align: center;
            }
            
            table {
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
                border: 1px solid black;
                text-align: left;
                padding: 4px;
                font-size: 12px;
            }
            th {
                text-align: center;
            }
            /* body {
                margin: 0 17%;
            }
            @media print { */
                body {
                margin: 0 4%;
            /* }  */
            }
        </style>
    </head>
    <body style="font-family: DejaVu Sans; font-size: 12px; line-height: 1.5 !important;">
        <div class="heading" >
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3" style="display: flex;flex-wrap: wrap;align-content: center;">
                        <?php
                        $url = base_url('awedget/assets/img/nilg-logo.png');
                        ?>
                        <div style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;height: 80px;">
                            <img style="height: 100%;width: 100%;" src="<?=$url?>" alt="logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center" style="padding: 0;margin-bottom: 0;">
                            <span style="font-size:13px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br>
                            <span style="font-size:13px;">স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়</span><br>
                            <span style="font-size:14px; font-weight: bold;">জাতীয় স্থানীয় সরকার ইনস্টিটিউট (এনআইএলজি )</span><br>
                            <span style="font-size:12px;">২৯, আগারগাঁও, শেরে বাংলা নগর, ঢাকা - ১২০৭ </span><br>
                            <span style="font-size:12px;text-decoration: underline;color: #2246ff;">www.nilg.gov.bd </span>
                        </h5>
                    </div>
                    <div class="col-md-3"style="display: flex;align-content: center;flex-wrap: wrap;right: 0;position: relative;justify-content: flex-end;">
                        <div style="padding: 4px; border: 2px solid; font-size: 13px; float: right;">
                            <span> শেখ হাসিনার মূলনীতি </span> <br>
                            <span> গ্রাম শহরের উন্নতি </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading_footer" style="height: 44px;">
            <div class="col-md-12" style="display: flex;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;">
                <h4><span> বাজেটঃ <?=$budget_field->title;?></span></h4>
            </div>
        </div>
        <div>
            <div class="col-md-12">
                <table class="" style="width: 100%;"  border="1" cellspacing="0">
                    <thead>
                        <tr style="width: 100%;">
                            <th style="width: 10%;">ক্রম নং</th>
                            <th style="width: 75%;">খরচের খাত</th>
                            <th style="width: 15%;"> টাকা</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $total=0;
                                                    $group_name=''; 
                                                    $end=false;
                                                    $end1=false;
                                                    foreach($budget_field_details as $key => $data){
                                                        if($group_name!=$data->group_name && $data->group_name!='xnone'){
                                                            echo '<tr class="group-header group-header-'.$data->group_name.'">
                                                            <td colspan="3">
                                                                <b>'.$data->group_name.'</b>
                                                            </td>
                                                        </tr>';
                                                            $group_name=$data->group_name;
                                                        }elseif($data->group_name=='xnone'){
                                                            $end=true;
                                                            $group_name=$data->group_name;
                                                        }

                                                        if($data->head_sub_id==2147483647){
                                                            $detail_id=$data->budget_field_details_id;
                                                            $this->db->select('*');
                                                            $this->db->from('budget_custom_sub_head');
                                                            $this->db->where('details_id', $detail_id);
                                                            $query =  $this->db->get()->row();
                                                            
                                                            $name_bn='<input type=""  name="custom_m[]" class="form-control input-sm"  value="'.$query->name.'"/>
                                                            ';
                                                        }else{
                                                            $name_bn=$data->name_bn;
                                                        }
                                                        ?>

                                                    <?php if($end==false){?>
                                                    <tr class="group-row group-row-<?=$data->group_name?>">
                                                        <?php }elseif($end==true && $end1==false){ $end1=true;?>
                                                    <tr class="group-end-row">
                                                        <?php }else{?>
                                                            <tr>
                                                            <?php }?>
                            <td style="text-align: center"><?=number_bangla_format($key+1);?></td>
                            <td>
                                <?php
                                echo "$data->budget_head_name:$name_bn:&nbsp&nbsp";
                                ?>
                                <?=  number_bangla_format($data->amount).''; ?> টাকা &nbsp 
                                <?=  number_bangla_format($data->participants).''; ?> জন &nbsp
                                <?=  number_bangla_format($data->days).''; ?> দিন &nbsp&nbsp
                                (<?= number_bangla_format($data->amount) ?>&times<?= number_bangla_format($data->participants) ?>&times<?= number_bangla_format($data->days) ?>)

                            </td>
                            <td>
                                <?php
                                $total += $data->total_amt;
                                echo number_bangla_format($data->total_amt).'';
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            <div class="col-md-12">
                <?= $budget_field->description ?>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
        <script>
            window.onload = function() {
                html2pdf(document.body, {
                    margin: 2,
                    filename: 'document.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 3 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                }).then(function (pdf) {
                    window.close();
                });
            }
        </script>
        
    </body>
</html>
