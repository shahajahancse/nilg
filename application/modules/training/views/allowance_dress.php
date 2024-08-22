<style type="text/css">
  .tg {
    border-collapse: collapse;
    border-spacing: 0;
    font-family: 'Kalpurush', Arial, sans-serif;
    border: 0px solid red;
    width: 100%
  }

  .tg td {
    font-family: 'Kalpurush', Arial, sans-serif;
    font-size: 14px;
    padding: 5px 5px;
    border-style: solid;
    border-width: 1px;
    overflow: hidden;
    word-break: normal;
    border-color: #bbb;
    color: #00000;
    background-color: #E0FFEB;
    vertical-align: middle;
  }

  .tg th {
    font-family: 'Kalpurush', Arial, sans-serif;
    font-size: 14px;
    font-weight: bold;
    padding: 3px 5px;
    border-style: solid;
    border-width: 1px;
    overflow: hidden;
    word-break: normal;
    border-color: #bbb;
    color: #493F3F;
    background-color: #bce2c5;
    text-align: center;
  }

  .tg .tg-ywa9 {
    background-color: #ffffff;
    color: #ffffff;
    vertical-align: top;
    width: 300px;
    color: black;
    font-weight: bold;
  }

  .tg .tg-khup {
    background-color: #efefef;
    color: #ffffff;
    vertical-align: top;
    width: 110px;
    color: black;
    text-align: right;
  }

  .tg .tg-akf0 {
    background-color: #ffffff;
    color: #ffffff;
    vertical-align: top;
    color: black;
  }

  .tg .tg-mtwr {
    background-color: #efefef;
    vertical-align: top;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
    text-decoration: underline;
  }
</style>


<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?= base_url('dashboard') ?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?= base_url('training') ?>" class="active"> <?= $module_title; ?> </a></li>
      <li><?= $meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?= base_url('training/pdf_allowance_dress/' . $training->id) ?>" class="btn btn-primary btn-mini" target="_blank"> পোষাক ভাতার পিডিএফ</a>
              <a href="<?= base_url('training_management') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation') ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="grid-body" id="printableArea">
            <div class="row">
              <div class="col-md-12">
                <span class="training-title"><?= func_training_title($training->id) ?></span>
                <span class="training-date"><?= func_training_date($training->start_date, $training->end_date) ?></span>
              </div>
            </div>

            <?php
            //Day count
            $training_start = $training->start_date != '0000-00-00' ? $training->start_date : '';
            $training_end = $training->end_date != '0000-00-00' ? $training->end_date : '';
            $date_start = strtotime($training_start);
            $date_end   = strtotime($training_end);
            $datediff = $date_end - $date_start;
            $duration = round($datediff / (60 * 60 * 24)) + 1;
            // $duration = eng2bng($duration+1).' দিন';

            $col_span = 3;
            if ($training->type_id != 4) {
              $col_span = 6;
            }
            ?>

            <br>

            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 ">
                    <h3 style="text-align: center;"><span class="semi-bold">পোষাক ভাতার তালিকা</span></h3>
                      <div class="table-responsive">
                        <table class="tg" id="example">
                          <thead>
                            <tr>
                              <th class="tg-71hr">ক্রম</th>
                              <th class="tg-71hr">প্রশিক্ষণার্থীর নাম</th>
                              <th class="tg-71hr">পদবি</th>
                              <th class="tg-71hr">প্রতিষ্ঠানের নাম</th>
                              <?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
                                <?php if ($training->lgi_type != 8) { ?>
                                  <th class="tg-71hr">উপজেলা</th>
                                <?php } ?>
                                <th class="tg-71hr">জেলা</th>
                              <?php } ?>
                              <?php if ($training->dress != '') { ?>
                                <th class="tg-71hr text-center">পোষাক ভাতা</th>
                              <?php } ?>
                            </tr>
                          </thead>
    
                          <tbody>
                            <?php
                            $i = 0;
                            $totalDAD = $gTotalDAD = '';
                            foreach ($results as $row) {
                              $i++;
                              $totalDAD = $training->dress;
                              $gTotalDAD += $totalDAD;
    
                              $office = explode(",", $row->office_name);
                            ?>
                              <tr style="line-height: 50px;">
                                <td class="tg-031e text-center"><?= eng2bng($i) ?>.</td>
                                <td class="tg-031e"><?= $row->name_bn ?></td>
                                <td class="tg-031e"><?= $row->desig_name ?></td>
                                <td class="tg-031e"><?= $office[0] ?></td>
                                <?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
                                  <?php if ($training->lgi_type != 8) { ?>
                                    <td class="tg-031e"><?= $row->upa_name_bn ?></td>
                                  <?php } ?>
                                  <td class="tg-031e"><?= $row->dis_name_bn ?></td>
                                <?php } ?>
                                <?php if ($training->dress != '') { ?>
                                  <td class="tg-031e text-center"><?= eng2bng($totalDAD) ?></td>
                                <?php } ?>
                              </tr>
                            <?php } ?>
    
                            <tr>
                              <?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
                                <?php if ($training->lgi_type != 8) { ?>
                                  <td></td>
                                <?php } ?>
                                <td></td>
                              <?php } ?>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-right"><strong>সর্বমোট</strong> </td>
                              <?php if ($training->dress != '') { ?>
                                <td class="text-center"><?= eng2bng($gTotalDAD) ?></td>
                              <?php } ?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>

          </div> <!-- /grid-body -->
        </div>
      </div>

    </div>


  </div>
</div>