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
              <a href="<?= base_url('training/pdf_allowance/' . $training->id) ?>" class="btn btn-primary btn-mini" target="_blank"> প্রশিক্ষণ ভাতার পিডিএফ</a>
              <a href="<?= base_url('training') ?>" class="btn btn-primary btn-xs btn-mini"> তালিকা</a>
              <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> <span class="fa fa-ellipsis-v"></span> </a>
                <ul class="dropdown-menu pull-right">
                  <?php $this->load->view('navigation') ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="grid-body" id="printableArea">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');; ?>
              </div>
            <?php endif; ?>
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

            $vata = $this->db->where('training_id', $training->id)->get('training_allowance_change')->row();
            if ($vata) {
              $changeDays = $vata->days;
              $changeVata = $vata->total_amount;
            } else {
              $changeDays = 0;
              $changeVata = 0;
            }
            // $duration = eng2bng($duration+1).' দিন';

            /*$col_span=3;
            if($training->type_id != 4){
              $col_span=6;
            }*/
            ?>

            <br>

            <div class="row ">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <h3 style="text-align: center;"><span class="semi-bold">প্রশিক্ষণ ভাতার তালিকা</span></h3>
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
                            <?php if ($training->ta > 0) { ?>
                              <th class="tg-71hr text-center">টিএ</th>
                            <?php } ?>
                            <?php if ($training->da > 0) { ?>
                              <th class="tg-71hr text-center">ডিএ</th>
                            <?php } ?>
                            <?php if ($training->tra_a > 0) { ?>
                              <th class="tg-71hr text-center">ভাতা</th>
                            <?php } ?>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          $i = 0;
                          $exp = '';
                          $totalDA = $totalDAA = $totalDAD = $gTotalTA = $gTotalDA = $gTotalDAA = $gTotalDAD = '';
                          foreach ($results as $row) {
                            $i++;

                            $exp = explode(',', $row->office_name);
                            $officeName = $exp[0];

                            $totalDA = $training->da * $duration;
                            $totalDAA = ($training->tra_a * ($duration - $changeDays)) + $changeVata;
                            $totalDAD = $training->dress;

                            $gTotalTA += $training->ta;
                            $gTotalDA += $totalDA;
                            $gTotalDAA += $totalDAA;
                            $gTotalDAD += $totalDAD;
                          ?>
                            <tr style="line-height: 50px;">
                              <td class="tg-031e text-center"><?= eng2bng($i) ?>.</td>
                              <td class="tg-031e"><?= $row->name_bn ?></td>
                              <td class="tg-031e"><?= $row->desig_name ?></td>
                              <td class="tg-031e"><?= $officeName ?></td>
                              <?php if (!in_array($training->lgi_type, array(6, 7, 9, 10))) { ?>
                                <?php if ($training->lgi_type != 8) { ?>
                                  <td class="tg-031e"><?= $row->upa_name_bn ?></td>
                                <?php } ?>
                                <td class="tg-031e"><?= $row->dis_name_bn ?></td>
                              <?php } ?>

                              <?php if ($training->ta > 0) { ?>
                                <td class="tg-031e text-center"><?= eng2bng($training->ta) ?></td>
                              <?php } ?>
                              <?php if ($training->da > 0) { ?>
                                <td class="tg-031e text-center"><?= eng2bng($totalDA) ?></td>
                              <?php } ?>
                              <?php if ($training->tra_a > 0) { ?>
                                <td class="tg-031e text-center"><?= eng2bng($totalDAA) ?></td>
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
                            <?php if ($training->ta > 0) { ?>
                              <td class="text-center"><?= eng2bng($gTotalTA) ?></td>
                            <?php } ?>
                            <?php if ($training->da > 0) { ?>
                              <td class="text-center"><?= eng2bng($gTotalDA) ?></td>
                            <?php } ?>
                            <?php if ($training->tra_a > 0) { ?>
                              <td class="text-center"><?= eng2bng($gTotalDAA) ?></td>
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