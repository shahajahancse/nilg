<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
*         ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful']            = 'Account Successfully Created';
$lang['account_creation_unsuccessful']          = 'Unable to Create Account';
$lang['account_creation_duplicate_email']       = 'Email Already Used or Invalid';
$lang['account_creation_duplicate_identity']    = 'Identity Already Used or Invalid';
$lang['account_creation_missing_default_group'] = 'Default group is not set';
$lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// Password
$lang['password_change_successful']          = 'Password Successfully Changed';
$lang['password_change_unsuccessful']        = 'Unable to Change Password';
$lang['forgot_password_successful']          = 'Password Reset Email Sent';
$lang['forgot_password_unsuccessful']        = 'Unable to email the Reset Password link';

// Activation
$lang['activate_successful']                 = 'Account Activated';
$lang['activate_unsuccessful']               = 'Unable to Activate Account';
$lang['deactivate_successful']               = 'Account De-Activated';
$lang['deactivate_unsuccessful']             = 'Unable to De-Activate Account';
$lang['activation_email_successful']         = 'Activation Email Sent. Please check your inbox or spam';
$lang['activation_email_unsuccessful']       = 'Unable to Send Activation Email';
$lang['deactivate_current_user_unsuccessful']= 'You cannot De-Activate your self.';

// Login / Logout
$lang['login_successful']                    = 'Logged In Successfully';
$lang['login_unsuccessful']                  = 'Incorrect Login';
$lang['login_unsuccessful_not_active']       = 'Account is inactive';
$lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
$lang['logout_successful']                   = 'Logged Out Successfully';

// Account Changes
$lang['update_successful']                   = 'Account Information Successfully Updated';
$lang['update_unsuccessful']                 = 'Unable to Update Account Information';
$lang['delete_successful']                   = 'User Deleted';
$lang['delete_unsuccessful']                 = 'Unable to Delete User';

// Groups
$lang['group_creation_successful']           = 'Group created Successfully';
$lang['group_already_exists']                = 'Group name already taken';
$lang['group_update_successful']             = 'Group details updated';
$lang['group_delete_successful']             = 'Group deleted';
$lang['group_delete_unsuccessful']           = 'Unable to delete group';
$lang['group_delete_notallowed']             = 'Can\'t delete the administrators\' group';
$lang['group_name_required']                 = 'Group name is a required field';
$lang['group_name_admin_not_alter']          = 'Admin group name can not be changed';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']              = 'Activate account for %s';
$lang['email_activate_subheading']           = 'Please click this link to %s.';
$lang['email_activate_link']                 = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']       = 'Reset Password for %s';
$lang['email_forgot_password_subheading']    = 'Please click this link to %s.';
$lang['email_forgot_password_link']          = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']          = 'New Password for %s';
$lang['email_new_password_subheading']       = 'Your password has been reset to: %s';


$lang['Dashboard']       					= 'ড্যাশবোর্ড';
$lang['My Profile']       					= 'আমার প্রোফাইল';
$lang['exam_names']       					= 'পরিক্ষার নাম';
$lang['exam_names_add']       					= 'পরিক্ষার নাম এন্ট্রি';
$lang['exam_names_list']       					= 'পরিক্ষার লিস্ট';
$lang['subjects']       					= 'বিষয়';
$lang['subject_add']       					= 'বিষয় এন্ট্রি';
$lang['subject_list']       					= 'বিষয় লিস্ট';
$lang['boards']       					= 'বোর্ড / বিশ্ববিদ্যালয়';
$lang['boards_add']       					= 'বোর্ড / বিশ্ববিদ্যালয় এন্ট্রি';
$lang['boards_list']       					= 'বোর্ড / বিশ্ববিদ্যালয় লিস্ট';

$lang['nilg_trainings']       					= 'এনআইএলজি প্রশিক্ষণ';
$lang['nilg_trainings_add']       					= 'প্রশিক্ষণ এন্ট্রি';
$lang['nilg_trainings_list']       					= 'প্রশিক্ষণ লিস্ট';

$lang['personal_datas']=$lang['personal_datas_list']= 'ব্যাক্তিগত ডাটা সীট';
$lang['Add Personal Data Sheet']=$lang['personal_datas_add']       					= 'ব্যাক্তিগত ডাটা এন্ট্রি';
$lang['personal_datas_emp_list']       					= 'ব্যাক্তিগত ডাটা সীট (কর্মকর্তা / কর্মচারী)';
$lang['personal_datas_gov_list']       					= 'ব্যাক্তিগত ডাটা সীট (জনপ্রতিনিধি)';
$lang['personal_datas_list']       					= 'ব্যাক্তিগত ডাটার তালিকা';

$lang['Add New']       					= 'নতুন এন্ট্রি';
$lang['personal_data_sheet_add'] = 'নতূন ব্যাক্তিগত ডাটা যোগ করুন';
$lang['personal_data_sheet_edit'] = 'ব্যাক্তিগত ডাটা সীট সম্পাদন করুন';
$lang['name_bangla']       					= 'নাম (বাংলায়)';
$lang['nij_jela_id']       					= 'নিজ জেলা';
$lang['bortoman_thickana']       					= 'বর্তমান ঠিকানা';
$lang['current_prothistan_daitto_pod_name']       					= 'বর্তমান প্রতিস্থানের দাইত্বপ্রাপ্ত পদের নাম';
$lang['stu_clas_training_entry']       					= 'প্রশিক্ষণ এর জন্য সিলেক্ট করুন';
$lang['stu_clas_Edit']       					= 'সম্পাদন';
$lang['stu_clas_Delete']       					= 'মুছে ফেলুন';
$lang['Exam name entry']       					= 'পরিক্ষার নাম এন্ট্রি';
$lang['exam_name']       					= 'পরিক্ষার নাম';
$lang['exam name list']       					= 'পরিক্ষার নামের তালিকা';
$lang['subjects_list']       					= 'বিষয় সমূহ';
$lang['subjects_add']       					= 'বিষয় এন্ট্রি';
$lang['sub_name']       					= 'বিষয়ের নাম';
$lang['board_name']       					= 'বোর্ড / বিশ্ববিদ্যালয় নাম';
$lang['board entry']       					= 'বোর্ড / বিশ্ববিদ্যালয় এন্ট্রি';

$lang['board entry list']       					= 'বোর্ড / বিশ্ববিদ্যালয়ের লিস্ট';
$lang['Proshikkhon Entry']       					= 'প্রশিক্ষণ এন্ট্রি';
$lang['proshikkhon_name']       					= 'প্রশিক্ষনের নাম';
$lang['proshikkhon_mead']       					= 'প্রশিক্ষনের মেয়াদ';
$lang['training list']       					= 'প্রশিক্ষনের তালিকা';
$lang['trainers']       					= 'প্রশিক্ষণার্থী';
$lang['traineer_list']=$lang['trainers_list']	= 'প্রশিক্ষণার্থীর তালিকা';

$lang['organizations'] = 'প্রতিষ্ঠান সমূহ';
$lang['organizations_list'] = 'প্রতিষ্ঠানের নামের তালিকা';
$lang['org_name'] = 'প্রতিষ্ঠানের নাম';

$lang['form_setting_list']= 'প্রশিক্ষন ফর্ম';
$lang['form_settings_list']= 'প্রশিক্ষন ফর্ম লিস্ট';
$lang['name']= 'নাম';
$lang['label_lang']= 'ফিল্ড লেবেল';
$lang['field_type']= 'ফিল্ড টাইপ';
$lang['db_type']= 'ডাটাবেস টাইপ';
$lang['type_length']= 'ফিল্ড লেন্থ';
$lang['values']= 'ডাটা (চেকবক্স এবং রেডিও বাটন আর জন্য)';
$lang['proshikkhonarthi Registration form']= 'প্রশিক্ষণার্থী রেজিস্ট্রেশন ফর্ম';
$lang['nilg_training_id']= 'প্রশিক্ষন কোর্সের নাম';
$lang['data_sheet_id']= 'ডাটা সীট আইডি';
$lang['entry_date']= 'নিবন্ধনের তারিখ'; 
$lang['course_name']= 'কোর্সের নাম'; 
$lang['course_duration_day']= 'কোর্সের মেয়াদ'; 
$lang['stu_clas_View']= 'দেখুন'; 
$lang['proshikkhonarthir data']= 'প্রশিক্ষণার্থীর ডাটা'; 
$lang['reports']= 'রিপোর্ট';  
$lang['reports_all']= 'রিপোর্টস';  
$lang['jonoprothinidhi_report']= 'জনপ্রতিনিধির রিপোর্ট'; 
$lang['kormokorta_report']= 'কর্মকর্তা / কর্মচারীর রিপোর্ট'; 
$lang['proshikkhon_report']= 'প্রশিক্ষণ রিপোর্ট'; 
$lang['jonoprothinidhi_report_summ']= 'জনপ্রতিনিধির সামারি রিপোর্ট'; 
$lang['proshikkhon_report_summary']= 'প্রশিক্ষন সামারি রিপোর্ট'; 
$lang['national_id']= 'জাতীও পরিচয় পত্র'; 
$lang['prosikkhon_start_date']= 'প্রশিক্ষন শুরুর তারিখ'; 
$lang['course_name_id']= 'কোর্স এর নাম';
$lang['data_sheet_type']= 'ডাটা টাইপ';
$lang['start_date']= 'শুরুর তারিখ';
$lang['end_date']= 'শেষ তারিখ';
$lang['filter_data']= 'ফিল্টার';
$lang['select']= 'সিলেক্ট';

$lang['settings'] = 'সেটিংস';
$lang['update_profile']= 'প্রোফাইল সম্পাদন';
$lang['update_successfully'] = 'তথ্যটি সঠিকভাবে সম্পাদন হয়েছে';
$lang['change_image'] = 'ছবি পরিবর্তন করুন';
$lang['change_email'] = 'ই-মেইল পরিবর্তন করুন';
$lang['change_password'] = 'পাসওয়ার্ড পরিবর্তন করুন';

//Left Menu
$lang['office_profile'] = 'অফিস প্রোফাইল';
$lang['user_management'] = 'ইউজার ম্যানেজমেন্ট';
$lang['user_management_list'] = 'ব্যাবহারকারীর তালিকা';
$lang['user_create'] = 'নতুন ইউজার তৈরি করুন';
$lang['user_update'] = 'ইউজার সম্পাদনা করুন';

//Common Language
$lang['common_dashboard'] = 'ড্যাশবোর্ড';
$lang['common_save'] = 'সংরক্ষণ করুন';
$lang['common_close'] = 'বন্ধ করুন';
$lang['common_edit'] = 'সংশোধন করুন';
$lang['common_details'] = 'বিস্তারিত দেখুন';
$lang['common_delete'] = 'মুছে ফেলুন';
$lang['common_select'] = 'নির্বাচন করুন';
$lang['select'] = '-- নির্বাচন করুন --';

$lang['select_division'] = '-বিভাগ নির্বাচন করুন-';
$lang['select_district'] = '-জেলা নির্বাচন করুন-';
$lang['select_up_thana'] = '-উপজেলা নির্বাচন করুন-';
$lang['select_union'] = '-ইউনিয়ন নির্বাচন করুন-';
$lang['select_office_type'] = '-অফিসের ধরণ নির্বাচন করুন-';
$lang['select_data_type'] = '-ডাটার ধরণ নির্বাচন করুন-';

//My Profile
$lang['my_profile'] = 'আমার প্রোফাইল';
$lang['my_profile_name'] = 'নাম (বাংলা)';
$lang['my_profile_phone'] = 'ফোন নম্বর';
$lang['my_profile_gender'] = 'লিঙ্গ';
$lang['my_profile_dob'] = 'জন্ম তারিখ';
$lang['my_profile_designation'] = 'এনআইএলজি পদবি';
$lang['my_profile_present_address'] = 'বর্তমান ঠিকানা';
$lang['my_profile_permanent_address'] = 'স্থায়ী ঠিকানা';
$lang['my_profile_update'] = 'প্রোফাইল সম্পাদন করুন';

$lang['my_training'] = 'আমার প্রশিক্ষণ';


// General Setting
$lang['setting_general'] = 'জেনারেল সেটিংস';
$lang['setting_division'] = 'বিভাগ সমূহ';
$lang['setting_district'] = 'জেলা সমূহ';
$lang['setting_upazila_thana'] = 'উপজেলা / থানা সমূহ';
$lang['setting_union'] = 'ইউনিয়ন সমূহ';

$lang['no_training_yet'] = 'প্রশিক্ষণ পায়নি তাদের তালিকা';
$lang['got_training'] = 'প্রশিক্ষণ পেয়াছে তাদের তালিকা';
