<!DOCTYPE html>
<html>

<head>
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <meta charset="utf-8" />
   <title><?= $meta_title ?> | <?= $domain_title ?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta content="Mysoftheaven (BD) Ltd." name="author" />

   <link href="<?= base_url(); ?>awedget/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
   <link href="<?= base_url(); ?>awedget/assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" media="screen" />
   <!-- <link href="<?= base_url(); ?>awedget/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/> -->
   <link href="<?= base_url(); ?>awedget/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />

   <link href="<?= base_url(); ?>awedget/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen" />
   <link rel="stylesheet" href="<?= base_url(); ?>awedget/assets/plugins/ios-switch/ios7-switch.css" type="text/css" media="screen">
   <!-- <link href="<?= base_url(); ?>awedget/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/> -->
   <link href="<?= base_url(); ?>awedget/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen" />

   <?php if ($this->router->fetch_class('dashboard') == 'dashboard') { ?>
   <link rel="stylesheet" href="<?= base_url(); ?>awedget/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen">
   <link rel="stylesheet" href="<?= base_url(); ?>awedget/assets/plugins/jquery-morris-chart/css/morris.css" type="text/css" media="screen">
   <?php } ?>

   <!-- BEGIN CORE CSS FRAMEWORK -->
   <link href="<?= base_url(); ?>awedget/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/css/animate.min.css" rel="stylesheet" type="text/css" />

   <!-- BEGIN CSS TEMPLATE -->
   <link href="<?= base_url(); ?>awedget/assets/css/responsive.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />


   <script src="<?= base_url(); ?>awedget/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
   <script src="<?= base_url(); ?>awedget/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
   <script src="<?= base_url(); ?>awedget/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script> -->
   <!-- <link href="<?= base_url('assets/css/select2.min.css') ?>" type="text/css" /> -->
   <script src="<?= base_url('assets/js/select2.full.min.js'); ?>"></script>

   <link href="<?= base_url(); ?>awedget/assets/css/autocomplete.css" rel="stylesheet" type="text/css" />
   <script src="<?= base_url(); ?>awedget/assets/js/jquery.autocomplete.js" type="text/javascript"></script>

   <!-- <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet"> -->
   <link href="<?= base_url('assets/css/bootstrap-datetimepicker.css') ?>" type="text/css" />
   <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script> -->
   <script src="<?= base_url('assets/js/moment-with-locales.js'); ?>"></script>
   <!-- <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script> -->
   <script src="<?= base_url('assets/js/bootstrap-datetimepicker.js'); ?>"></script>


   <!-- <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" type="text/css" /> -->
   <!-- <link href="//cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" type="text/css" /> -->
   <link href="<?= base_url('assets/css/jquery.dataTables.min.css') ?>" type="text/css" />
   <link href="<?= base_url('assets/css/buttons.dataTables.min.css') ?>" type="text/css" />


   <script src="<?= base_url('assets/js/highcharts.js'); ?>"></script>
   <script src="<?= base_url('assets/js/data.js'); ?>"></script>
   <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
   <!-- <script src="https://code.highcharts.com/modules/data.js"></script> -->
   <link href="<?= base_url(); ?>awedget/assets/css/style.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url(); ?>awedget/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript">
      var hostname = '<?php echo base_url(); ?>';
   </script>

   <!--Load the AJAX API-->
   <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
   <script src="<?= base_url('assets/js/loader.js'); ?>"></script>



   <!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> -->
</head> <!-- END HEAD -->

<body class="">
   <div class="header navbar navbar-inverse ">
      <div class="navbar-inner">
         <div class="header-seperation">
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
               <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class="">
                  <div class="iconset top-menu-toggle-white"></div>
                  </a>
               </li>
            </ul>

            <a href="<?= base_url() ?>">
               <img src="<?= base_url(); ?>awedget/assets/img/logo.png" class="logo" alt="NILG Logo" data-src="<?= base_url(); ?>awedget/assets/img/logo.png" data-src-retina="<?= base_url(); ?>awedget/assets/img/logo.png" height="60" />
            </a>
         </div> <!-- END RESPONSIVE MENU TOGGLER -->

         <div class="header-quick-nav">
            <div class="pull-left">
               <ul class="nav quick-section">
                  <li class="quicklinks">
                     <a href="javascript:;" class="" id="layout-condensed-toggle">
                        <i class="fa fa-bars" style="font-size: 22px; color: #ffffff !important;"></i>
                     </a>
                  </li>
               </ul>
            </div> <!-- END TOP NAVIGATION MENU -->

            <!-- BEGIN CHAT TOGGLER -->
            <div class="pull-right">
               <div class="chat-toggler">
                  <a href="javascript:;">
                     <div class="user-details">
                        <div class="username">
                           <span class="bold">
                              <?php
                              if ($this->ion_auth->in_group(array('admin', 'nilg', 'city', 'ddlg', 'zp', 'uz', 'paura', 'up'))) {
                                 echo $userDetails->office_name;
                              } else {
                                 echo $userDetails->name_bn;
                              }
                              ?>
                           </span>
                           <span style="margin-right: 10px;">(<strong><?= $userGroups; ?></strong>)</span>
                        </div>
                     </div>
                  </a>

                  <?php
                  if ($this->ion_auth->in_group(array('trainee', 'trainer', 'partner'))) {
                     $path = base_url('uploads/profile/');
                     if ($userDetails->profile_img != NULL) {
                        $img_url = $path . $userDetails->profile_img;
                     } else {
                        $img_url = $path . 'blank.png';
                     }
                     ?>
                     <div class="profile-pic"> <img src="<?= $img_url ?>" alt="Profile Image" data-src="<?= $img_url ?>" data-src-retina="<?= $img_url ?>" width="35" height="35" /> </div>
                  <?php }  ?>
               </div>

               <ul class="nav quick-section ">
                  <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="javascript:;" id="user-options"> <i class="fa fa-cog" style="font-size: 22px; color: #ffffff !important;"></i> </a>
                     <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                        <li><a href="<?= base_url('office_profile/change_password') ?>"><i class="fa fa-key"></i>&nbsp;&nbsp;পাসোর্য়াড পরিবর্তন</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url('login/logout') ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;লগ আউট</a></li>
                     </ul>
                  </li>
               </ul>
            </div> <!-- END CHAT TOGGLER -->
         </div> <!-- END TOP NAVIGATION MENU -->
      </div> <!-- END TOP NAVIGATION BAR -->
   </div> <!-- END HEADER -->

   <!-- BEGIN CONTAINER -->
   <div class="page-container row-fluid">
      <div class="page-sidebar" id="main-menu">
         <div class="page-sidebar-wrapper" id="main-menu-wrapper">
            <br>
            <ul class="pull-left">

               <li class="start <?= backend_activate_menu_class('dashboard') ?>">
                  <a href="<?= base_url('dashboard'); ?>"> <i class="icon-custom-home"></i> <span class="title"><?= lang('Dashboard') ?></span></a>
               </li>

               <?php if ($this->ion_auth->in_group(array('trainer', 'trainee'))) { ?>
                  <li class="start <?= backend_activate_menu_class('my_profile') ?>">
                     <a href="<?= base_url('my_profile'); ?>"> <i class="fa fa-user"></i> <span class="title">মাই প্রোফাইল</span></a>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'city', 'ddlg', 'zp', 'uz', 'paura', 'up', 'cc'))) { ?>
                  <li class="start <?= backend_activate_menu_class('trainee') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষণার্থী</span> <span class="selected"></span>
                     <?php
                     if ($request_trainee_no > 0) {
                        echo '<span class="badge badge-danger pull-right">' . eng2bng($request_trainee_no) . '</span>';
                     }
                     ?>
                     <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <?php //if (!$this->ion_auth->in_group(array('nilg'))) { ?>
                        <li> <a href="<?= base_url('trainee/all_pr'); ?>"> জনপ্রতিনিধির তালিকা </a> </li>
                        <?php //} ?>
                        <li class="start <?= backend_activate_menu_method('all_employee') ?>"> <a href="<?= base_url('trainee/all_employee'); ?>"> কর্মকর্তা / কর্মচারীর তালিকা </a> </li>
                        <li> <a href="<?= base_url('trainee/request'); ?>"> প্রশিক্ষণার্থীর আবেদন
                           <?php
                           if ($request_trainee_no > 0) {
                              echo '<span style="margin-right:5px" class="badge badge-danger pull-right">' . eng2bng($request_trainee_no) . '</span>';
                           }
                           ?>
                        </a></li>
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('partner'))) { ?>
                  <li class="start <?= backend_activate_menu_class('trainee') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষণার্থী</span> <span class="selected"></span>
                     <?php if ($request_trainee_no > 0) {
                        echo '<span class="badge badge-danger pull-right">' . eng2bng($request_trainee_no) . '</span>';
                     } ?>
                     <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li class="start <?= backend_activate_menu_method('all_employee') ?>"> <a href="<?= base_url('trainee/all_employee'); ?>"> কর্মকর্তা / কর্মচারীর তালিকা </a> </li>
                        <li> <a href="<?= base_url('trainee/request'); ?>"> প্রশিক্ষণার্থীর আবেদন
                           <?php
                           if ($request_trainee_no > 0) {
                              echo '<span class="badge badge-danger pull-right">' . eng2bng($request_trainee_no) . '</span>';
                           }
                           ?>
                        </a></li>
                     </ul>
                  </li>
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('admin', 'nilg'))) { ?>
                  <li class="start <?= backend_activate_menu_class('trainer') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষক</span> <span class="selected"></span>
                     <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('trainer/all'); ?>"> প্রশিক্ষকের তালিকা মোবাইল</a> </li>
                        <li> <a href="<?= base_url('trainer/all_email'); ?>"> প্রশিক্ষকের তালিকা ইমেইল </a> </li>
                     </ul>
                  </li>
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('trainee', 'guest'))) { ?>
                  <li class="start ">
                     <a href="<?= base_url('dashboard/course_registration'); ?>"> <i class="fa fa-book"></i> <span class="title">কোর্স রেজিষ্ট্রেশন</span></a>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('trainee'))) { ?>
                  <li class="start <?= backend_activate_menu_method('my_training') ?>">
                     <a href="<?= base_url('dashboard/my_training'); ?>"> <i class="fa fa-book"></i> <span class="title">মাই কোর্স</span></a>
                  </li>
                  <li class="start <?= backend_activate_menu_method('my_pre_exam') ?>">
                     <a href="<?= base_url('evaluation/my_pre_exam') ?>"> <i class="fa fa-book"></i> <span class="title">প্রশিক্ষণপূর্ব মূল্যায়ন</span>
                        <?php
                        if ($pre_exam_notify > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($pre_exam_notify) . '</span>';
                        }
                        ?>
                     </a>
                  </li>
                  <li class="start <?= backend_activate_menu_method('my_post_exam') ?>">
                     <a href="<?= base_url('evaluation/my_post_exam') ?>"> <i class="fa fa-book"></i> <span class="title">প্রশিক্ষণ পরবর্তী মূল্যায়ন</span>
                        <?php
                        if ($post_exam_notify > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($post_exam_notify) . '</span>';
                        }
                        ?>
                     </a>
                  </li>
                  <li class="start <?= backend_activate_menu_method('my_module_exam') ?>">
                     <a href="<?= base_url('evaluation/my_module_exam') ?>"> <i class="fa fa-book"></i> <span class="title">মডিউল ভিত্তিক মূল্যায়ন</span>
                        <?php
                        if ($module_exam_notify > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($module_exam_notify) . '</span>';
                        }
                        ?>
                     </a>
                  </li>
                  <li class="start <?= backend_activate_menu_method('my_course_evaluation') ?>">
                     <a href="<?= base_url('evaluation/my_course_evaluation') ?>"> <i class="fa fa-book"></i> <span class="title">কোর্স মূল্যায়ন</span>
                     </a>
                  </li>
                  <li class="start <?= backend_activate_menu_method('my_trainer_evaluation') ?>">
                     <a href="<?= base_url('evaluation/my_trainer_evaluation') ?>"> <i class="fa fa-book"></i> <span class="title">আলোচক মূল্যায়ন</span>
                     </a>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('trainer'))) { ?>
                  <li class="start">
                     <a href="<?= base_url('training/assigned_topic'); ?>"> <i class="fa fa-book"></i> <span class="title">নির্ধারিত বিষয় সমূহ</span></a>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('city', 'zp', 'uz', 'paura', 'up'))) { ?>
                  <!-- <li class="start <?= backend_activate_menu_class('office_profile') ?>">
                     <a href="<?= base_url('office_profile'); ?>"> <i class="fa fa-briefcase"></i> <span class="title"><?= lang('office_profile') ?></span></a>
                  </li> -->
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'uz', 'ddlg'))) { ?>
                  <li class="start <?= backend_activate_menu_class('training') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষণ</span> <span class="selected"></span>
                        <?php
                        if ($request_training_application_no > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($request_training_application_no) . '</span>';
                        }
                        ?>
                        <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                           <li> <a href="<?= base_url('training'); ?>">প্রশিক্ষণের তালিকা
                              <?php
                              if ($request_training_application_no > 0) {
                                 echo '<span class="badge badge-danger pull-right">' . eng2bng($request_training_application_no) . '</span>';
                              }
                              ?>
                           </a> </li>
                        <?php /*
                        if ($this->ion_auth->in_group(array('uz', 'ddlg'))) { ?>
                        <li> <a href="<?= base_url('training/create'); ?>"> প্রশিক্ষণ এন্ট্রি </a> </li>
                        <?php } */ ?>
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('cc'))) { ?>
                  <li class="start <?= backend_activate_menu_class('training') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষণ</span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('training'); ?>">প্রশিক্ষণের তালিকা </a> </li>
                        <?php if ($this->ion_auth->in_group(array('uz', 'ddlg'))) { ?>
                        <li> <a href="<?= base_url('training/create'); ?>"> প্রশিক্ষণ এন্ট্রি </a> </li>
                        <?php } ?>
                     </ul>
                  </li>
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('admin', 'nilg', 'uz', 'ddlg', 'cc'))) { ?>
                  <li class="start <?= backend_activate_menu_class('evaluation') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">প্রশিক্ষণ মূল্যায়ন</span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('evaluation/pre_exam'); ?>">প্রশিক্ষণপূর্ব মূল্যায়ন প্রশ্নের তালিকা </a> </li>
                        <li> <a href="<?= base_url('evaluation/post_exam'); ?>">প্রশিক্ষণ পরবর্তী মূল্যায়ন প্রশ্নের তালিকা </a> </li>
                        <li> <a href="<?= base_url('evaluation/module_exam'); ?>">মডিউল ভিত্তিক প্রশ্নের তালিকা </a> </li>
                        <li> <a href="<?= base_url('evaluation/course_evaluation') ?>">কোর্স মূল্যায়নের তালিকা</a></li>
                        <li> <a href="<?= base_url('evaluation/team_evaluation') ?>">টিম কর্তৃক মূল্যায়নের তালিকা</a></li>
                        <li> <a href="<?= base_url('evaluation/trainer_evaluation') ?>">প্রশিক্ষক মূল্যায়নের তালিকা</a></li>
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->in_group(array('admin', 'bdg', 'nilg', 'bdh', 'acc', 'uz', 'ddlg')) || $userDetails->office_type == 7) { ?>
                  <?php if ($this->ion_auth->in_group(array('uz', 'ddlg'))) { ?>
                     <li class="start <?= backend_activate_menu_class('budgets') ?>"> <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">হিসাব বিভাগ</span> <span class="selected"></span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                           <li class="start <?= backend_activate_menu_method('budget_field') ?>"> <a href="<?= base_url('budgets/budget_field'); ?>">বাজেট</a> </li>
                        </ul>
                     </li>
                  <?php } else { ?>

                  <li class="start <?= backend_activate_menu_class('budgets') ?>"> <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">হিসাব বিভাগ</span> <span class="selected"></span>
                     <?php if ($budget_nilg_ntfy > 0 || $budget_office_ntfy > 0 || $budget_chahida_ntfy > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($budget_nilg_ntfy + $budget_office_ntfy + $budget_chahida_ntfy) . '</span>';
                        }
                     ?> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li class="start <?= backend_activate_menu_method('budget_nilg') ?>">
                           <a href="<?= base_url('budgets/budget_nilg'); ?>">বাজেট এনআইএলজি
                           <?php
                           if ($budget_nilg_ntfy > 0) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_nilg_ntfy) . '</span>';
                           }
                           ?>
                           </a>
                        </li>
                        <li class="start <?= backend_activate_menu_method('budget_field') ?>">
                           <a href="<?= base_url('budgets/budget_field'); ?>">বাজেট অফিস
                           <?php
                           if ($budget_office_ntfy > 0) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_office_ntfy) . '</span>';
                           }
                           ?>
                           </a>
                        </li>
                        <li class="start <?= backend_activate_menu_method('budget_entry') ?>"> <a href="<?= base_url('budgets/budget_entry'); ?>">এন্ট্রি </a> </li>
                        <li class="start <?= backend_activate_menu_method('chahida_potro') ?>">
                           <a href="<?= base_url('budgets/chahida_potro'); ?>">চাহিদা পত্র
                           <?php
                           if ($budget_chahida_ntfy > 0) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_chahida_ntfy) . '</span>';
                           }
                           ?>
                           </a>
                        </li>
                        <li class="start <?= backend_activate_menu_method('budget_entry') ?>"> <a href="<?= base_url('budgets/budget_report'); ?>">রিপোর্ট</a> </li>
                     </ul>
                  </li>

                  <li class="start <?= backend_activate_menu_class('journal_entry') ?>"> <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">জার্নাল এন্ট্রি</span> <span class="selected"></span>
                     <?php if ($budget_check_ntfy > 0 || $budget_revenue_ntfy > 0 || $budget_hostel_ntfy > 0 || $budget_public_ntfy > 0 || $budget_gpf_ntfy > 0 || $budget_pension_ntfy > 0 || $budget_other_ntfy > 0) {
                           echo '<span class="badge badge-danger pull-right">' . eng2bng($budget_check_ntfy + $budget_revenue_ntfy + $budget_hostel_ntfy + $budget_public_ntfy + $budget_gpf_ntfy + $budget_pension_ntfy + $budget_other_ntfy) . '</span>';
                        }
                     ?> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li class="start <?= backend_activate_menu_method('cheque_entry') ?>"> <a href="<?= base_url('journal_entry/cheque_entry'); ?>">চেক রেজিস্টার এন্ট্রি
                        <?php if ($budget_check_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_check_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('revenue_entry') ?>"> <a href="<?= base_url('journal_entry/revenue_entry'); ?>">রাজস্ব রেজিস্টার এন্ট্রি
                        <?php if ($budget_revenue_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_revenue_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('hostel_entry') ?>"> <a href="<?= base_url('journal_entry/hostel_entry'); ?>">হোস্টেল রেজিস্টার এন্ট্রি
                        <?php if ($budget_hostel_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_hostel_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('publication_entry') ?>"> <a href="<?= base_url('journal_entry/publication_entry'); ?>">প্রকাশনা রেজিস্টার এন্ট্রি
                        <?php if ($budget_public_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_public_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('gpf_entry') ?>"> <a href="<?= base_url('journal_entry/gpf_entry'); ?>">জিপিএফ রেজিস্টার এন্ট্রি
                        <?php if ($budget_gpf_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_gpf_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('pension_entry') ?>"> <a href="<?= base_url('journal_entry/pension_entry'); ?>">পেনশন রেজিস্টার এন্ট্রি
                        <?php if ($budget_pension_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_pension_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                        <li class="start <?= backend_activate_menu_method('miscellaneous_entry') ?>"> <a href="<?= base_url('journal_entry/miscellaneous_entry'); ?>">বিবিধ রেজিস্টার এন্ট্রি\
                        <?php if ($budget_other_ntfy > 0 ) {
                              echo '<span style="margin-right:15px" class="badge badge-danger pull-right">' . eng2bng($budget_other_ntfy) . '</span>';
                           }
                        ?>
                        </a> </li>
                     </ul>
                  </li>

                  <li class="start <?= backend_activate_menu_class('nilg_setting') ?> <?= backend_activate_menu_class('budget_head') ?> <?= backend_activate_menu_class('budget_sub_head') ?>"> <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">হিসাব সেটিংস</span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li class="start <?= backend_activate_menu_method('account_types') ?>"> <a href="<?= base_url('nilg_setting/account_types'); ?>">অ্যাকাউন্ট টাইপ </a> </li>
                        <li class="start <?= backend_activate_menu_method('index') ?>"> <a href="<?= base_url('nilg_setting/budget_head'); ?>">বাজেট হেড</a> </li>
                        <li class="start <?= backend_activate_menu_method('index') ?>"> <a href="<?= base_url('nilg_setting/budget_sub_head'); ?>">বাজেট সাব হেড</a> </li>
                        <li class="start <?= backend_activate_menu_method('budget_description') ?>"> <a href="<?= base_url('nilg_setting/budget_head/budget_description'); ?>">বাজেট সামারি</a> </li>
                        <li class="start <?= backend_activate_menu_method('session_year') ?>"> <a href="<?= base_url('nilg_setting/session_year'); ?>">অর্থ বছর</a> </li>
                     </ul>
                  </li>
               <?php } } ?>

               <?php if ($this->ion_auth->in_group('cc')) { ?>
                  <li class="start <?= backend_activate_menu_class('qbank') ?>"> <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">এনআইএলজি সেটিংস</span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('nilg_setting/qbank'); ?>">প্রশ্ন ব্যাংক</a> </li>
                     </ul>
                  </li>
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('admin', 'cc'))) { ?>
                  <!-- <li class="start <?= backend_activate_menu_class('training_management') ?>">
                     <a href="<?= base_url('training_management'); ?>"> <i class="fa fa-book"></i> <span class="title">প্রশিক্ষণ ব্যবস্থাপনা</span></a>
                  </li> -->
               <?php } ?>


               <?php if($this->ion_auth->in_group(array('admin', 'nilg')) || func_nilg_auth($userDetails->office_type) == 'employee'){ ?>
                  <li class="start <?= backend_activate_menu_class('leave') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">ছুটির ব্যবস্থাপনা</span> <span class="selected"></span>
                     <?php if ($leave_notify > 0) {
                        echo '<span class="badge badge-danger pull-right">' . eng2bng($leave_notify) . '</span>';
                     } ?>
                     <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <?php //if($this->ion_auth->in_group(array('admin', 'nilg'))){ ?>
                        <?php if($this->ion_auth->in_group(array('admin', 'leave_jd', 'leave_dg', 'leave_director'))){ ?>
                           <li> <a href="<?= base_url('leave'); ?>"> ছুটির তালিকা </a> </li>
                           <li class="start <?= backend_activate_menu_method('pending_list') ?>"><a href="<?= base_url('leave/pending_list') ?>">অপেক্ষমাণ তালিকা
                              <?php if ($leave_notify > 0) {
                                 echo '<span class="badge badge-danger pull-right" style="margin-right:10px">' . eng2bng($leave_notify) . '</span>';
                              } ?>
                        </a></li>
                        <li> <a href="<?= base_url('leave/index/2'); ?>"> অনুমোদিত তালিকা </a> </li>
                        <li class="start <?= backend_activate_menu_method('rejected_list') ?>"><a href="<?= base_url('leave/rejected_list') ?>">প্রত্যাখ্যাত তালিকা
                        </a></li>
                        <li class="start <?= backend_activate_menu_method('leave_reports') ?>"><a href="<?= base_url('leave/leave_reports') ?>">রিপোর্ট</a></li>
                        <?php } elseif (func_nilg_auth($userDetails->office_type) == 'employee') { ?>
                        <li> <a href="<?= base_url('leave'); ?>"> ছুটির তালিকা </a> </li>
                        <?php } ?>
                     </ul>
                  </li>
               <?php } ?>

               <?php if(!$this->ion_auth->in_group(array('nilg'))){
                  if ($this->ion_auth->in_group(array('admin', "jd", "dg")) || (func_nilg_auth($userDetails->office_type) == 'employee')) { ?>
                     <li class="start <?= backend_activate_menu_class('inventory') ?>">
                        <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title">ইনভেন্টরি</span> <span class="selected"></span>
                           <?php
                           if (isset($request_stor_no['total']) && $request_stor_no['total'] > 0) {
                              echo '<span class="badge badge-danger pull-right">' . $request_stor_no['total'] . '</span>';
                           } else if ($Joint_director_no > 0) {
                              echo '<span class="badge badge-danger pull-right">' . $Joint_director_no . '</span>';
                           } else if ($director_general_no > 0) {
                              echo '<span class="badge badge-danger pull-right">' . $director_general_no . '</span>';
                           } ?>

                           <?php
                           if (isset($request_staff_no) && $request_staff_no > 0) {
                              if ($request_staff_no > 0 || $un_available_item_notify > 0) {
                                 echo '<span class="badge badge-danger pull-right">' . ($request_staff_no + $un_available_item_notify) . '</span>';
                              }
                           }
                           ?>

                           <span class="badge badge-danger pull-right"></span>
                           <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                           <li class="start <?= backend_activate_menu_class('inventory') ?>">
                              <a href="<?= base_url('inventory/my_requisition'); ?>"><span class="title">মাই রিকুইজিশন</span>
                                 <?php if ($request_staff_no > 0) {
                                    echo '<span class="badge badge-danger pull-right" style="margin-right:15px;">' . $request_staff_no . '</span>';
                                 } ?>
                              </a>
                           </li>
                           <li class="start <?= backend_activate_menu_class('inventory') ?>">
                              <a href="<?= base_url('inventory/again_requisition_list/'.encrypt_url($userDetails->id)); ?>"><span class="title">পুনরায় রিকুইজিশন</span>
                                 <?php if ($un_available_item_notify > 0) {
                                    echo '<span class="badge badge-danger pull-right" style="margin-right:15px;">' . $un_available_item_notify . '</span>';
                                 } ?>
                              </a>
                           </li>

                           <?php $people2 = array("jd", "dg", "admin");?>
                           <?php /*if (in_array(func_nilg_auth($userDetails->office_type, $userDetails->crrnt_desig_id), $people2)) { */?>
                           <?php if ($this->ion_auth->in_group(array('admin','jd','dg'))) { ?>
                              <li class="start <?= backend_activate_menu_method('request_requisition_list') ?>">
                                 <a href="<?= base_url('inventory/request_requisition_list') ?>">এপ্রোভড রিকুয়েস্ট
                                    <?php if ($Joint_director_no > 0) {
                                       echo '<span class="badge badge-danger pull-right" style="margin-right:15px;">' . $Joint_director_no . '</span>';
                                    } else if ($director_general_no > 0) {
                                       echo '<span class="badge badge-danger pull-right" style="margin-right:15px;">' . $director_general_no . '</span>';
                                    } ?>
                                 </a>
                              </li>
                           <?php } ?>

                           <?php if ($this->ion_auth->in_group(array('admin','sm','asm'))) { ?>
                              <li class="start <?= backend_activate_menu_method('index') ?>"><a href="<?= base_url('inventory/index') ?>">রিকুইজিশনের তালিকা</a></li>
                              <li class="start <?= backend_activate_menu_method('pending_list') ?>">
                                 <a href="<?= base_url('inventory/pending_list') ?>">পেন্ডিং তালিকা
                                 <?php if ($request_stor_no['pending'] > 0) {
                                    echo '<span class="badge badge-danger pull-right" style="margin-right:15px">' . $request_stor_no['pending'] . '</span>';
                                 } ?>
                                 </a>
                              </li>

                              <li>
                                 <a href="<?= base_url('inventory/approve_list') ?>">এপ্রোভড তালিকা
                                 <?php if ($request_stor_no['approve'] > 0) {
                                    echo '<span class="badge badge-danger pull-right" style="margin-right:15px">' . $request_stor_no['approve'] . '</span>';
                                    } ?>
                                 </a>
                              </li>

                              <li><a href="<?= base_url('inventory/delivered_list') ?>">ডেলিভারি তালিকা</a></li>
                              <li>
                                 <a href="<?= base_url('inventory/rejected_list') ?>">রিজেক্ট তালিকা
                                 <?php if ($request_stor_no['reject'] > 0) {
                                    echo '<span class="badge badge-danger pull-right" style="margin-right:15px">' . $request_stor_no['reject'] . '</span>';
                                 } ?>
                                 </a>
                              </li>
                              <li><a href="<?= base_url('inventory/unavailable_list') ?>">আন-অ্যাভেলেবল রিকুইজিশন</a></li>
                              <li><a href="<?= base_url('inventory/item_setup'); ?>">আইটেম সেটআপ</a></li>
                              <li><a href="<?= base_url('inventory/item_purchase_list'); ?>"> আইটেম পার্সেস</a></li>
                              <li><a href="<?= base_url('inventory/inventory_reports'); ?>">রিপোর্ট</a></li>
                           <?php } ?>
                        </ul>
                     </li>
                  <?php  } ?>
               <?php } ?>

               <?php if ($this->ion_auth->is_admin() && !$this->ion_auth->in_group('nilg')) { ?>
                  <li class="start <?= backend_activate_menu_class('reports') ?>">
                     <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title"><?= lang('reports_all') ?></span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('reports/representative'); ?>"> জনপ্রতিনিধির রিপোর্ট</a> </li>
                        <li> <a href="<?= base_url('reports/employee'); ?>"> কর্মকর্তা/কর্মচারী রিপোর্ট</a> </li>
                        <li> <a href="<?= base_url('reports/nilg_employee'); ?>"> এনআইএলজি রিপোর্ট</a> </li>
                        <!-- <li> <a href="<?= base_url('reports/others_employee'); ?>"> অন্যান্য রিপোর্ট</a> </li> -->
                        <li> <a href="<?= base_url('reports/training'); ?>"> প্রশিক্ষণ রিপোর্ট</a> </li>
                        <li> <a href="<?= base_url('reports/others_employee'); ?>">রিপোর্ট</a> </li>
                        <!-- <li> <a href="<?= base_url('reports/jonoprothinidhi_report'); ?>"> <?= lang('jonoprothinidhi_report') ?> </a> </li>
                        <li> <a href="<?= base_url('reports/kormokorta_report'); ?>"> <?= lang('kormokorta_report') ?></a></li>
                        <li> <a href="<?= base_url('reports/trainer_reports'); ?>"> <?= lang('proshikkhon_report') ?></a></li>
                        <li> <a href="<?= base_url('reports/bochor_onujaI_proshikhon_report'); ?>"> বছর অনুযায়ী প্রশিক্ষন রিপোর্ট</a></li>
                        <li> <a href="<?= base_url('reports/no_training_yet'); ?>"> প্রশিক্ষণ পায়নি</a></li>
                        <li> <a href="<?= base_url('reports/got_training'); ?>"> প্রশিক্ষণ পেয়েছে</a></li>
                        <li> <a href="<?= base_url('reports/exam_report'); ?>"> শিক্ষা ভিত্তিক রিপোর্ট</a></li>
                        <li> <a href="<?= base_url('reports/trainer_reports_sum'); ?>"> <?= lang('proshikkhon_report_summary') ?></a></li>
                        <li> <a href="<?= base_url('reports/jonoprothinidhi_report_summ'); ?>"> <?= lang('jonoprothinidhi_report_summ') ?></a></li>
                        <li> <a href="<?= base_url('reports/kormokorta_report_summ'); ?>"> কর্মকর্তা/কর্মচারীর সামারি রিপোর্ট</a></li>
                        <li> <a href="<?= base_url('reports/individual_report'); ?>"> নির্বাচন ও বয়স ভিত্তিক রিপোর্ট</a></li> -->
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('nilg')) { ?>
                  <!-- <li class="start <?= backend_activate_menu_class('trainers') ?>">
                     <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title"><?= lang('trainers') ?></span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('trainers/all'); ?>"> <?= lang('traineer_list') ?></a></li>
                     </ul>
                  </li> -->
               <?php } ?>


               <?php if ($this->ion_auth->in_group(array('admin', 'cc'))) { ?>
                  <!-- <li class="start <?= backend_activate_menu_class('trainer_register') ?>">
                     <a href="<?= base_url('trainer_register'); ?>"> <i class="fa fa-user"></i>  <span class="title">প্রশিক্ষক নিবন্ধন</span></a>
                  </li> -->
               <?php } ?>

               <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('nilg')) { ?>
                  <li class="start <?= backend_activate_menu_class('qbank') ?> <?= backend_activate_menu_class('office') ?> <?= backend_activate_menu_class('designation') ?> <?= backend_activate_menu_class('course') ?> <?= backend_activate_menu_class('evaluation_subject') ?> <?= backend_activate_menu_class('training_material') ?> <?= backend_activate_menu_class('dev_partner') ?>">
                     <a href=" javascript:;"> <i class="fa fa-user"></i> <span class="title">এনআইএলজি সেটিংস</span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('nilg_setting/qbank'); ?>">প্রশ্ন ব্যাংক</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/office'); ?>">অফিসের তালিকা</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/calendar'); ?>">ট্রেনিং ক্যালেন্ডার</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/designation'); ?>">পদবির তালিকা</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/course'); ?>">কোর্সের তালিকা</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/course_type'); ?>">কোর্সের টাইপ</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/evaluation_subject'); ?>">মূল্যায়নের বিষয়ের তালিকা</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/training_material'); ?>">ট্রেনিং মেটেরিয়ালের তালিকা</a> </li>
                        <li> <a href="<?= base_url('nilg_setting/dev_partner'); ?>">উন্নয়ন সহযোগী প্রতিষ্টান</a> </li>
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(array('sm', 'asm'))) { ?>
                  <li class="start <?= backend_activate_menu_class('general_setting') ?>"> <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title"><?= lang('setting_general') ?></span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">

                        <?php if ($this->ion_auth->is_admin()) { ?>
                        <li class="start <?= backend_activate_menu_method('role') ?>">
                           <a href="<?= base_url('general_setting/role'); ?>"> রোলের তালিকা </a>
                        </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin','leave_jd', 'leave_director', 'leave'))) { ?>
                        <li> <a href="<?= base_url('general_setting/leave_type'); ?>"> ছুটির টাইপ </a></li>
                        <li> <a href="<?= base_url('general_setting/manage_designation'); ?>"> পদবী ব্যবস্থাপনা </a></li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin','sm', 'asm'))) { ?>
                        <li> <a href="<?= base_url('general_setting/categories'); ?>"> ক্যাটাগরি </a></li>
                        <li> <a href="<?= base_url('general_setting/sub_categories'); ?>">সাব ক্যাটাগরি</a></li>
                        <li> <a href="<?= base_url('general_setting/item_unit'); ?>"> আইটেম ইউনিট</a></li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <li> <a href="<?= base_url('general_setting/exam'); ?>">পরীক্ষার তালিকা</a> </li>
                        <li> <a href="<?= base_url('general_setting/subject'); ?>">পরীক্ষার বিষয়ের তালিকা</a> </li>
                        <li> <a href="<?= base_url('general_setting/board'); ?>">বোর্ড / বিশ্ববিদ্যালয়ের তালিকা</a> </li>
                        <!-- <li> <a href="<?= base_url('general_setting/statistics'); ?>">প্রতিষ্ঠানের পরিসংখ্যান</a> </li> -->
                        <li> <a href="<?= base_url('general_setting/financing'); ?>">অর্থায়নে</a> </li>
                        <!-- <li> <a href="<?= base_url('general_setting/pourashava'); ?>">পৌরসভা সমূহ</a> </li> -->
                        <li> <a href="<?= base_url('general_setting/union'); ?>"><?= lang('setting_union') ?></a> </li>
                        <li> <a href="<?= base_url('general_setting/upazila_thana'); ?>"> <?= lang('setting_upazila_thana') ?> </a></li>
                        <li> <a href="<?= base_url('general_setting/district'); ?>"> <?= lang('setting_district') ?></a></li>
                        <li> <a href="<?= base_url('general_setting/division'); ?>"> <?= lang('setting_division') ?></a></li>
                        <?php } ?>
                     </ul>
                  </li>
               <?php } ?>

               <?php if ($this->ion_auth->is_admin()) { ?>
                  <li class="start <?= backend_activate_menu_class('acl') ?>"> <a href="javascript:;"> <i class="fa fa-user"></i> <span class="title"><?= lang('user_management') ?></span> <span class="selected"></span> <span class="arrow"></span> </a>
                     <ul class="sub-menu">
                        <li> <a href="<?= base_url('acl'); ?>"> <?= lang('user_management_list') ?> </a> </li>
                        <!-- <li> <a href="<?= base_url('acl/group_name'); ?>"> Group Name</a></li> -->
                     </ul>
                  </li>
               <?php } ?>

               <li class="start"><a href="<?= base_url('login/logout') ?>"> <i class="fa fa-power-off"></i>
                  <span class="title">লগ আউট</span> </a></li>

            </ul>
            <div class="clearfix"></div>
         </div> <!-- BEGIN MINI-PROFILE -->
      </div><!-- END SIDEBAR MENU -->

      <a href="#" class="scrollup">Scroll</a>

      <div class="footer-widget">
         <div class="copyrights pull-left">
            <span style="vertical-align: top;">
               কারিগরি সহযোগীতায় -
               <div style="font-weight: bold;"> মাইসফট হ্যাভেন বিডি লিমিটেড | </div>
            </span>
         </div>
         <div class="pull-right">
            <a href="http://www.mysoftheaven.com/" target="_blank">
               <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png') ?>" height="30">
            </a>
         </div>
      </div>
   </div>
   <!-- END SIDEBAR -->
