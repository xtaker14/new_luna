<?php



defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'frontpage/homepage';
$route['404_override'] = 'frontpage/notfound';
$route['translate_uri_dashes'] = FALSE;
//$route['tes'] = 'frontpage/tes';
$route['dwn'] = 'frontpage/dwn';
$route['api/homepage'] = 'frontpage_json/homepage';
$route['api/refresh_point'] = 'frontpage_json/refresh_point';
//FRONTPAGE MEMBER
$route['media'] = 'frontpage/media';
$route['register'] = 'frontpage/register';
$route['go_register'] = 'member_login/register';
$route['login'] = 'frontpage/login';
$route['go_login'] = 'member_login/login';
$route['go_logout'] = 'member_action/logout';
//MEMBER SERVICE
$route['teleport'] = 'frontpage/teleport';
$route['go_teleport'] = 'member_action/go_teleport';
$route['history'] = 'frontpage/topup_history';
$route['pin_req'] = 'frontpage/pin_req';
$route['change_pin/(:any)'] = 'frontpage/change_pin/$1';
$route['change_pwd'] = 'frontpage/change_pwd';
$route['go_pin_req'] = 'member_action/go_pin_req';
$route['go_change_pin'] = 'member_action/go_change_pin';
$route['go_change_pwd'] = 'member_action/go_change_pwd';
//FRONTPAGE IM
$route['shop'] = 'frontpage/shop';
$route['im_list/(:num)'] = 'item_mall/im_list/$1';
$route['im_detail/(:num)'] = 'item_mall/im_detail/$1';
$route['go_buy'] = 'item_mall/buy';
//STATIC PAGE 
$route['p/(:any)'] = 'frontpage/page/$1';
$route['news/(:any)'] = 'frontpage/news/$1';
$route['rank'] = 'frontpage/rank';
//FRONTPAGEDONATE
$route['go_donate'] = 'donate/buy';
$route['donate'] = 'frontpage/donate';
$route['acc_history'] = 'frontpage/acc_history';

//ADMIN AREA
/*Login Admin*/
$route['adm'] = 'admin_login/login';
$route['adm/login'] = 'admin_login/login';
$route['adm/glogin'] = 'admin_login/glogin';
$route['adm/logout'] = 'admin/logout';
/*Admin Panel*/
$route['adm/dashboard'] = 'admin/dashboard';
$route['adm/usr_search'] = 'admin_json/usr_search';
$route['adm/topup'] = 'admin/topup';
$route['adm/go_topup'] = 'admin_action/go_topup';
$route['adm/topup_log'] = 'admin/topup_log';

$route['adm/donate'] = 'admin/donate';
$route['adm/donate_process/(:any)'] = 'admin_json/donate_process/$1';
$route['adm/referral'] = 'admin/referral';
$route['adm/new_referral'] = 'admin/new_referral';
$route['adm/edit_referral/(:num)'] = 'admin/edit_referral/$1';
$route['adm/go_make_refferal_code'] = 'admin_action/go_make_refferal_code';
$route['adm/referral_code_search'] = 'admin_json/referral_code_search';
$route['adm/referral_process/(:any)'] = 'admin_json/referral_process/$1';
$route['adm/username_search'] = 'admin_json/username_search';
$route['adm/set_status_referral'] = 'admin_json/set_status_referral';

$route['adm/referral_history'] = 'admin/referral_history';

//adm item mall
$route['adm/im_list'] = 'admin/im_list';
$route['adm/new_im'] = 'admin/new_im';
$route['adm/go_make_im'] = 'admin_action/go_make_im';
$route['api/im_status_update/(:any)/(:any)'] = 'admin_action/im_status_update/$1/$2';
$route['api/im_delete/(:num)'] = 'admin_action/im_delete/$1';
$route['adm/go_make_im_piece'] = 'admin_action/go_make_im_piece';
$route['api/im_piece_delete/(:num)'] = 'admin_action/im_piece_delete/$1';
//adm item mall piece
$route['adm/im_piece_list'] = 'admin/im_piece_list';
$route['adm/new_im_piece/(:num)'] = 'admin/new_im_piece/$1';
$route['adm/bin_search'] = 'admin_json/bin_search';
//adm send item
$route['adm/send_item'] = 'admin/send_item';
$route['adm/go_send_item'] = 'admin_action/go_send_item';
//adm article / notice
$route['adm/new_article'] = 'admin/new_article';
$route['adm/go_make_article'] = 'admin_action/go_make_article';
$route['api/article_delete/(:any)'] = 'admin_action/article_delete/$1';
$route['adm/article_list'] = 'admin/article_list';
$route['adm/article_edit/(:any)'] = 'admin/article_edit/$1';
$route['adm/go_edit_article'] = 'admin_action/go_edit_article';
//adm media
$route['adm/media'] = 'admin/media';
$route['adm/new_media'] = 'admin/new_media';
$route['adm/go_make_media'] = 'admin_action/go_make_media';
$route['adm/media_list'] = 'admin/media_list';
$route['adm/media_edit/(:any)'] = 'admin/media_edit/$1';
$route['adm/get_media_last_no_order'] = 'admin_json/get_media_last_no_order';
$route['adm/set_status_media'] = 'admin_json/set_status_media';
//Adm System
$route['adm/account_list'] = 'admin/account_list';
$route['adm/go_add_account'] = 'admin_action/go_add_account';
$route['adm/go_edit_account'] = 'admin_action/go_edit_account';
$route['api/get_data_admin'] = 'admin_json/get_data_admin';
$route['api/go_del_account/(:num)'] = 'admin_action/go_del_account/$1';
$route['adm/add_source'] = 'admin/add_source';
$route['adm/go_add_source'] = 'admin_action/go_add_source';
//game account
$route['adm/g_account_list'] = 'admin/g_account_list';
$route['adm/reg_game_member'] = 'admin_action/reg_game_member';
$route['api/del_game_member/(:num)/(:any)'] = 'admin_action/del_game_member/$1/$2';



//NEW ---
//FRONTPAGE USER
$route['daily_login'] = 'frontpage/daily_login';
$route['change_email'] = 'frontpage/change_email';
$route['go_change_email'] = 'member_action/go_change_email';
$route['user'] = 'frontpage/user';
$route['overview'] = 'frontpage/overviewpage';

//ADMIN
$route['adm/checkin_history'] = 'admin/checkin_history';
$route['adm/checkin_item/(:num)'] = 'admin/checkin_item/$1';
$route['adm/checkin_item'] = 'admin/checkin_item';
$route['adm/save_checkin_item'] = 'admin_action/save_checkin_item';
$route['adm/checkin_item_list'] = 'admin/checkin_item_list';
$route['adm/update_checkin_day'] = 'admin_json/update_checkin_day';
$route['adm/my_profile'] = 'admin/my_profile';
$route['adm/go_save_my_profile'] = 'admin_action/my_profile';
$route['adm/char_list'] = 'admin/char_list';
$route['adm/char/(:any)'] = 'admin/char/$1';
$route['adm/go_update_char'] = 'admin_action/go_update_char';
$route['adm/web_config'] = 'admin/web_config';
$route['adm/collapse_page'] = 'admin/collapse_page';
$route['adm/go_save_web_config'] = 'admin_json/web_config';
$route['adm/go_save_img_web_config'] = 'admin_action/web_config';
$route['adm/send_item_log'] = 'admin/send_item_log';
$route['adm/top_donate/(:any)'] = 'admin/top_donate/$1';
$route['adm/top_donate/(:any)/(:any)'] = 'admin/top_donate/$1/$2';
$route['adm/top_donate/(:any)/(:any)/(:any)'] = 'admin/top_donate/$1/$2/$3';
$route['adm/game_trade_log/(:any)/(:num)'] = 'admin/game_trade_log/$1/$2';
$route['adm/game_trade_log/(:any)'] = 'admin/game_trade_log/$1';
$route['adm/game_trade_log'] = 'admin/game_trade_log';
$route['adm/top_donate'] = 'admin/top_donate';
$route['adm/donate_price'] = 'admin/donate_price';
$route['adm/new_donate_price'] = 'admin/new_donate_price';
$route['adm/edit_donate_price/(:num)'] = 'admin/edit_donate_price/$1';
$route['adm/go_make_donate_price'] = 'admin_json/go_make_donate_price';
$route['adm/donate_process'] = 'admin_json/donate_process';
$route['adm/im_edit/(:num)'] = 'admin/im_edit/$1';
$route['adm/go_update_im/(:num)'] = 'admin_action/go_update_im/$1';
$route['adm/im_piece_edit/(:num)'] = 'admin/im_piece_edit/$1';
$route['adm/go_update_im_piece/(:num)'] = 'admin_action/go_update_im_piece/$1';
$route['adm/im_log'] = 'admin/im_log';

// API
$route['api/checkin_now'] = 'frontpage_json/checkin_now';
$route['api/donate_process_payment'] = 'frontpage_json/process_payment';
$route['api/checkin_item_status_update/(:any)/(:any)'] = 'admin_action/checkin_item_status_update/$1/$2';
$route['api/checkin_item_delete/(:num)'] = 'admin_action/checkin_item_delete/$1';
$route['api/referral_delete/(:num)'] = 'admin_action/referral_delete/$1';
$route['api/donate_price_status_update/(:any)/(:any)'] = 'admin_action/donate_price_status_update/$1/$2';
$route['api/donate_price_delete/(:num)'] = 'admin_action/donate_price_delete/$1';

$route['duitku/return/(:any)'] = 'duitku_c/return/$1';
$route['duitku/callback/(:any)'] = 'duitku_c/callback/$1';

