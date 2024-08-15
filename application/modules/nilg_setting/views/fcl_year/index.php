<style>
   @media only screen and  (max-width: 1140px){
    .tableresponsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-y: hidden;
      overflow-x: scroll;
      -webkit-overflow-scrolling: touch;
      white-space: nowrap;
    }
}
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
            <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
            <li> <?=$meta_title;?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right" style="display: flex;align-content: center;justify-content: center;flex-wrap: wrap;gap: 8px;">
                            <a href="<?=base_url('nilg_setting/fcl_create')?>" class="btn btn-blueviolet btn-xs btn-mini">অর্থ বছর তৈরি করুন</a>
                        </div>
                    </div>

                    <div class="grid-body tableresponsive">
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>

                        <style type="text/css">
                            .btt-m,
                            .btt-m:focus,
                            .btt-m:active:focus,
                            .btt-m.active:focus {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px;
                            }

                            .btt-t,
                            .btt-t:focus,
                            .btt-t:active:focus,
                            .btt-t.active:focus,
                            .btt-t:hover {
                                outline: none !important;
                                padding: 5px 25px !important;
                                margin-top: 0px !important;
                                width: 40px !important;
                                background: #ddb90a;
                            }
                        </style>
                        <table class="table table-hover table-condensed" border="0">
                            <thead>
                                <tr>
                                    <th> ক্রম </th>
                                    <th>অর্থ বছর</th>
                                    <th>স্ট্যাটাস</th>
                                    <th style="text-align: right;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page']; foreach ($results as $row): $sl++; ?>
                                <tr>
                                    <td class="v-align-middle"><?=$sl.'.'?></td>
                                    <td class="v-align-middle"><?=$row->session_name; ?></td>
                                    <?php if ($row->status == 1) {
                                        $type = 'এনাবল';
                                    } else {
                                        $type = 'ডিজেবল';
                                    } ?>
                                    <td class="v-align-middle"><?=$type; ?></td>
                                    <td align="right">
                                        <div class="btn-group">
                                            <button class="btn btn-mini btn-primary">অ্যাকশন</button>
                                            <button class="btn btn-mini btn-primary dropdown-toggle"
                                                data-toggle="dropdown"> <span class="caret"></span> </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="<?php echo base_url('nilg_setting/fcl_edit/'.encrypt_url($row->id))?>"><i class="fa fa-pencil-square"></i> সংশোধন করুন </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> সর্বমোট <span
                                    style="color: green; font-weight: bold;"><?php echo eng2bng($total_rows); ?>
                                    অর্থ বছর  </span></div>
                            <div class="col-sm-8 col-md-8 text-right">
                                <?php echo $pagination['links']; ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div> <!-- END Content -->
</div>



